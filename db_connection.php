<?php

class DatabaseConnection {
    private $host = 'localhost';
    private $username = 'root';
    private $password = '';
    private $dbname = 'database1';

    private $conn;

    public function __construct() {
        $this->conn = new mysqli($this->host, $this->username, $this->password, $this->dbname);

        if ($this->conn->connect_error) {
            die("Koneksi Gagal: " . $this->conn->connect_error);
        }
    }

    public function getConnection() {
        return $this->conn;
    }
}
