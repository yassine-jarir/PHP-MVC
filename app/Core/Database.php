<?php

namespace App\Core;

class Database {
    private $connection;
    private $config;

     public function __construct($config) {
        $this->config = $config;
    }

    public function getConnection() {
         $dsn = "pgsql:host=" . $this->config['db_host'] . ";dbname=" . $this->config['db_name'];
        $username = $this->config['db_username'];
        $password = $this->config['db_password'];

        try {
             $this->connection = new \PDO($dsn, $username, $password);
            $this->connection->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            return $this->connection;
        } catch (\PDOException $e) {
            die("Database connection failed: " . $e->getMessage());
        }
    }
}
