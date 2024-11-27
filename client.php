<?php
// Client.php
class Client {
    public $id;
    public $firstname;
    public $email;
    public $password;
    public $reg_date;
    public static $errorMsg = "";
    public static $successMsg = "";
    public function __construct($firstname, $email, $password = null) {
        $this->firstname = $firstname;
        $this->email = $email;
        if (!empty($password)) {
            $this->password = $password; 
        }
    }
    public function insertClient($conn) {
        $sql = "INSERT INTO Clients (firstname, email, password) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        if (!$stmt) {
            self::$errorMsg = "Prepare failed: " . $conn->error;
            return;
        }
        $stmt->bind_param("sss", $this->firstname, $this->email, $this->password);
        if ($stmt->execute()) {
            self::$successMsg = "New record created successfully";
        } else {
            self::$errorMsg = "Error: " . $stmt->error;
        }
        $stmt->close();
    }
    public static function selectAllClients($conn) {
        $sql = "SELECT * FROM Clients";
        $result = $conn->query($sql);
        $data = [];

        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
        }
        return $data;
    }
    public static function selectClientById($conn, $id) {
        $sql = "SELECT * FROM Clients WHERE id = ?";
        $stmt = $conn->prepare($sql);
        if (!$stmt) {
            self::$errorMsg = "Prepare failed: " . $conn->error;
            return null;
        }
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result && $result->num_rows == 1) {
            $row = $result->fetch_assoc();
            $stmt->close();
            return $row;
        } else {
            self::$errorMsg = "No user found with ID: " . $id;
            $stmt->close();
            return null;
        }
    }
    public function updateClient($conn, $id) {
        $sql = "UPDATE Clients SET firstname = ?, email = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        if (!$stmt) {
            self::$errorMsg = "Prepare failed: " . $conn->error;
            return;
        }
        $stmt->bind_param("ssi", $this->firstname, $this->email, $id);
        if ($stmt->execute()) {
            self::$successMsg = "Record updated successfully";
            header("Location: read.php"); 
            exit();
        } else {
            self::$errorMsg = "Error updating record: " . $stmt->error;
        }
        $stmt->close();
    }
    public static function deleteClient($conn, $id) {
        $sql = "DELETE FROM Clients WHERE id = ?";
        $stmt = $conn->prepare($sql);
        if (!$stmt) {
            self::$errorMsg = "Prepare failed: " . $conn->error;
            return;
        }
        $stmt->bind_param("i", $id);
        if ($stmt->execute()) {
            self::$successMsg = "Record deleted successfully";
            header("Location: read.php"); 
            exit();
        } else {
            self::$errorMsg = "Error deleting record: " . $stmt->error;
        }
        $stmt->close();
}
}
?>