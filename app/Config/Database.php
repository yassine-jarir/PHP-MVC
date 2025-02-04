<?php
namespace App\Config;
use PDO;

class Database {
    private static $host = 'localhost';
    private static $dbname = 'youdemyv2';
    private static $user = 'postgres';  
    private static $pass = 'localhost'; 
    private static $connection;

    public static function getConnection() {
        if (!self::$connection) {
            try {
                self::$connection = new PDO(
                    'pgsql:host=' . self::$host . ';dbname=' . self::$dbname,
                    self::$user,
                    self::$pass
                );
                self::$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                die('Error: ' . $e->getMessage());
            }
        }
        return self::$connection;
    }
}
