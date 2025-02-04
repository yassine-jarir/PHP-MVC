<?php

namespace Core;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class JWTHelper
{
    private static $secretKey = 'your_secret_key_here';  

    public static function generateToken($data)
    {
        $issuedAt = time();
        $expirationTime = $issuedAt + 3600; 

        $payload = [
            'iat' => $issuedAt,
            'exp' => $expirationTime,
            'data' => $data
        ];

        return JWT::encode($payload, self::$secretKey, 'HS256');
    }

    public static function validateToken($token)
    {
        try {
            $decoded = JWT::decode($token, new Key(self::$secretKey, 'HS256'));
            return $decoded->data;
        } catch (\Exception $e) {
            return false;
        }
    }
}