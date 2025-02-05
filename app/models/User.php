<?php
namespace App\Models;

use PDO;

class User {
    private $db;
    
    public function __construct($db) {
        $this->db = $db;
    }

     public function getUserByUsername($email) {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

     public function createUser($username, $password, $role = 'student') {
        $stmt = $this->db->prepare("INSERT INTO users (email, password, role) VALUES (:email, :password, :role)");
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);  
        $stmt->bindParam(':email', $username);
        $stmt->bindParam(':password', $hashedPassword);
        $stmt->bindParam(':role', $role);
        return $stmt->execute();
    }

     public function validateUser($username, $password) {
        $user = $this->getUserByUsername($username);
        if ($user && password_verify($password, $user['password'])) {
            return $user;
        }
        return false;
    }
    public function getAllCourses(){
        $course = $this->db->prepare("SELECT * FROM users WHERE role='student'");
        $course->execute();
        return $course->fetchAll(PDO::FETCH_ASSOC);
        // var_dump($course) ;
       
    }
}
