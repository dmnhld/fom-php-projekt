<?php

class Database {
    private static ?Database $instance = null;
    private mysqli $connection;

    private string $host = 'localhost:8889';
    private string $db   = 'shop';
    private string $user = 'shop';
    private string $pass = '';

    private function __construct() {
        $this->connection = new mysqli($this->host, $this->user, $this->pass, $this->db);

        if ($this->connection->connect_error) {
            die('Verbindungsfehler (' . $this->connection->connect_errno . ') ' . $this->connection->connect_error);
        }
    }

    public static function getInstance(): ?Database {
        if (!self::$instance) {
            self::$instance = new Database();
        }
        return self::$instance;
    }

    public function query($sql): mysqli_result|bool {
        return $this->connection->query($sql);
    }

    public function prepare($sql): false|mysqli_stmt {
        return $this->connection->prepare($sql);
    }

    public function close(): void {
        $this->connection->close();
    }
}