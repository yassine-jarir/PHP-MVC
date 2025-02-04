<?php 
namespace App\Services; 

use Firebase\JWT\JWT; 
use Firebase\JWT\Key; 

class AuthService { 
    private static $secretKey = "123123123yassine123123"; 
    private static $algorithm = 'HS256'; 
    
    public static function createToken($userData) { 
        $issuedAt = time(); 
        $expirationTime = $issuedAt + 3600; 
        $payload = array( 
            'iat' => $issuedAt, 
            'exp' => $expirationTime, 
            'data' => $userData 
        ); 
        return JWT::encode($payload, self::$secretKey, self::$algorithm); 
    } 
    
    public static function isAuthenticated() { 
        if (!isset($_COOKIE['jwt'])) { 
            // echo "JWT Cookie not set!"; 
            return false; 
        } 
        $jwt = $_COOKIE['jwt']; 
        $userData = self::validateToken($jwt); 
        if (!$userData) { 
            // echo "Invalid JWT!"; 
            return false; 
        } 
        // echo "User authenticated!"; 
        return $userData; 
    } 
    
    public static function hasRole($requiredRole) { 
        $userData = self::isAuthenticated(); 
        if (!$userData) { 
            return false; 
        } 
        return $userData['role'] === $requiredRole; 
    } 
    
    public static function validateToken($jwt) { 
        try { 
            $decoded = JWT::decode($jwt, new Key(self::$secretKey, self::$algorithm)); 
            return (array) $decoded->data; 
        } catch (\Exception $e) { 
            return null; 
        } 
    }

    public static function logout() {
         setcookie('jwt', '', time() - 3600, '/'); 
        return true;  
    }
}
