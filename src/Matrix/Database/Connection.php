<?php

namespace Matrix\Database;

use PDO;

class Connection {

    private static ?Connection $instance = null;
    private PDO $conn;

    private string $host = "mysql";
    private string $user = "root";
    private string $pass = "secret123";
    private string $name = "phpProject";

    private function __construct()
    {
        $this->conn = new PDO("mysql:host={$this->host};
    dbname={$this->name}", $this->user,$this->pass,
            array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
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
