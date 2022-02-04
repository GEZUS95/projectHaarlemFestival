<?php

namespace Matrix\Database;

use PDO;

class Connection {

    private static ?Connection $instance = null;
    private PDO $conn;

    private function __construct()
    {
        $this->conn = new PDO(
            "mysql:host={$_ENV['DATABASE_HOST']};
                dbname={$_ENV['DATABASE_NAME']}",
                $_ENV['DATABASE_USER'],
                $_ENV['DATABASE_PASSWORD'],
                array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'")
        );

        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public static function getInstance(): ?Connection
    {
        if(!self::$instance)
        {
            self::$instance = new Connection();
        }

        return self::$instance;
    }

    public function getConnection(): PDO
    {
        return $this->conn;
    }
}
