<?php
class Connection {
    private $servername = "localhost";
    private $username = "imane";
    private $password = "";
    public $conn;

    public function __construct() {
        $this->conn = new mysqli($this->servername, $this->username, $this->password);
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    public function selectDatabase($dbName) {
        if ($this->conn->select_db($dbName) === FALSE) {
            die("Error selecting database: " . $this->conn->error);
    }
}
}
?>