<?php
session_start();
include("database.php");
include("client.php");

class ClientManager {
    private $conn;
    public $message;

    public function __construct($dbConnection) {
        $this->conn = $dbConnection;
        $this->message = "";
    }

    public function deleteClientById($id) {
        if (!empty($id)) {
            if (Client::deleteClient($this->conn, $id)) {
                $this->message = "User deleted successfully.";
            } else {
                $this->message = "Error deleting user: " . $this->conn->error;
            }
        } else {
            $this->message = "No ID specified.";
        }
    }

    public function getMessage() {
        return $this->message;
    }
}

// Créer une instance du gestionnaire de clients
$clientManager = new ClientManager($conn);

// Vérifier et supprimer l'utilisateur en fonction de l'ID passé en paramètre
if (isset($_GET['idDeleted'])) {
    $clientManager->deleteClientById($_GET['idDeleted']);
} else {
    $clientManager->message = "No ID specified.";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Suppression d'utilisateur</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f8d7da;
        }
        .message-container {
            background: #f8d7da;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.05);
            width: 100%;
            max-width: 400px;
            text-align: center;
        }
        .btn-primary {
            margin-top: 20px;
            width: 100%;
        }
    </style>
</head>
<body>
<div class="message-container">
    <h4><?php echo htmlspecialchars($clientManager->getMessage()); ?></h4>
    <a href="read.php" class="btn btn-primary">Back to list</a>
</div>
<!-- Bootstrap JS Bundle -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<?php
$conn->close();
?>
