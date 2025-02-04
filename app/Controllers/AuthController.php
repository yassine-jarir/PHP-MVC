<?php
namespace App\Controllers;

require_once "../app/Config/Database.php";
require_once "../app/models/User.php";
require_once "../app/Services/AuthService.php";

use App\Services\AuthService;
use App\Models\User;
use App\Config\Database;
ob_start();
class AuthController {

    private $db;
    private $userModel;

    public function __construct() {
        $this->db = Database::getConnection();
        $this->userModel = new User($this->db);
    }

    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'];
            $password = $_POST['password'];
    
             $user = $this->userModel->validateUser($username, $password);
    
            if ($user) {
                $role = $user['role'];
                $userData = ['username' => $username, 'role' => $role];
                $jwt = AuthService::createToken($userData);
    
                 setcookie("jwt", $jwt, time() + 3600, "/", "", false, true);  
                 if ($role === 'admin') {
                    header("Location: /admin/dashboard");
                    exit;
                } else {
                    header("Location: /user/dashboard");
                    exit;
                }
            } else {
                echo json_encode(['message' => 'Invalid credentials.']);
            }
        }
    }
    
     public function signup() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'];
            $password = $_POST['password'];
            
             $existingUser = $this->userModel->getUserByUsername($username);
            if ($existingUser) {
                echo json_encode(['message' => 'Username already taken.']);
                return;
            }
            
             if ($this->userModel->createUser($username, $password)) {
                echo json_encode(['message' => 'User registered successfully.']);
            } else {
                echo json_encode(['message' => 'Error occurred during registration.']);
            }
        }
    }

     public function showLoginPage() {
        include_once __DIR__ . '/../Views/user/login.php';
    }

     public function showSignupPage() {
        include_once __DIR__ . '/../Views/user/signup.php';
    }
 
    public function dashboard() {
        if (!AuthService::isAuthenticated()){
            header("Location: /login");
            exit;
        } 
        if(AuthService::hasRole('student')) {
            include __DIR__ . '/../Views/user/dashboard.php';
        }
        if(AuthService::hasRole('admin')) {
            include __DIR__ . '/../Views/admin/dashboard.php';
        }
    }

    public function logout() {
        AuthService::logout();
        include __DIR__ . '/../Views/user/login.php';
        exit;
    }
}
