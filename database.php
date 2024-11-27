<?php
include('connection.php');

// Create an instance of Connection
$connObj = new Connection();

// Select the 'univdata' database
$connObj->selectDatabase('univdata');

// Now, $connObj->conn can be used as the database connection
$conn = $connObj->conn;


//echo "Connected successfully"; 
// Createdatabase la database est deja creer
/*
$sql = "CREATE DATABASE univdata";
if (mysqli_query($conn, $sql)) {
    echo "Database created successfully";
} else {
    echo "Error creating database: " . mysqli_error($conn);
}
*/
/*
$query = "
CREATE TABLE Clients (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    firstname VARCHAR(30) NOT NULL,
    email VARCHAR(50) UNIQUE,
    password VARCHAR(255),
    reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);
";

if (mysqli_query($conn, $query)) {
    echo "Table Clients created successfully";
} else {
    echo "Error creating table: " . mysqli_error($conn);
}
// hachage du mot de passe

$password = password_hash("imane123456", PASSWORD_DEFAULT);

$sql = "INSERT INTO Clients (firstname, lastname, email,password)
VALUES ('Imane', 'Hf', 'imanehf@gmail.com','$password')";

if (mysqli_query($conn, $sql)) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}
$password = password_hash("imane123456", PASSWORD_DEFAULT);

$sql = "INSERT INTO Clients (firstname,email, password)
VALUES ('John', 'Doe', 'john@example.com','$password');";
if (mysqli_multi_query($conn, $sql)) {
    echo "New records created successfully";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}
*/
?>