<?php 
// Start the session
session_start();
include("database.php");
include('client.php');

$errormsg = "";
$successmsg = "";
$fnamevalue = "";
$lnamevalue = "";
$emailvalue = "";

// Handle GET request to fetch the user data
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (isset($_GET['idUpdated'])) {
        $id = $_GET['idUpdated'];
        $row = Client::selectClientById($conn, $id);
        if ($row) {
            $fnamevalue = $row['firstname'];
            $lnamevalue = $row['lastname'];
            $emailvalue = $row['email'];
        } else {
            $errormsg = "No user found with ID: " . htmlspecialchars($id);
        }
    }
} elseif (isset($_POST["submit"])) {
    // Handle POST request for updating user data
    if (isset($_GET['idUpdated'])) {
        $id = $_GET['idUpdated'];
        $fnamevalue = trim($_POST["fname"]);
        $lnamevalue = trim($_POST["lname"]);
        $emailvalue = trim($_POST["emailname"]);

        if (empty($fnamevalue) || empty($lnamevalue) || empty($emailvalue)) {
            $errormsg = "All fields must be filled out!";
        } elseif (!filter_var($emailvalue, FILTER_VALIDATE_EMAIL)) {
            $errormsg = "Invalid email format.";
        } else {
            // Check for duplicate email
            $emailCheckQuery = "SELECT email FROM Clients WHERE email = ? AND id != ? LIMIT 1";
            $stmt = $conn->prepare($emailCheckQuery);
            if (!$stmt) {
                die("Prepare failed: " . $conn->error);
            }
            $stmt->bind_param("si", $emailvalue, $id);
            $stmt->execute();
            $stmt->store_result();

            if ($stmt->num_rows > 0) {
                $errormsg = "This email is already in use by another user.";
            } else {
                // Update the user in the database
                $client = new Client($fnamevalue, $emailvalue);
                if ($client->updateClient($conn, $id)) {
                    $successmsg = "User updated successfully!";
                    header("Location: read.php");
                    exit();
                } else {
                    $errormsg = "Error updating user.";
                }
            }
            $stmt->close();
        }
    } else {
        $errormsg = "Invalid request.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="signup.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Update User</title>
</head>
<body>
    <header class="header">
        <a href="univhome.php" class="logo">IUNIV</a>
        <nav class="navbar">
            <a href="univhome.php">Home</a>
            <a href="univlogin.php">Login</a>
            <a href="#">Signup</a>
        </nav>
    </header>
    <div class="c1">
        <video autoplay muted loop src="sci-fi-space.1920x1080.mp4"></video> 
    </div>
    <div class="loginbox">
        <h2>Update User</h2>
        <?php if (!empty($errormsg)) { ?>
            <div style="color: red;"><?php echo $errormsg; ?></div>
        <?php } ?>
        <?php if (!empty($successmsg)) { ?>
            <div style="color: green;"><?php echo $successmsg; ?></div>
        <?php } ?>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'] . '?idUpdated=' . urlencode($id)); ?>">
            <div class="user"> 
                <label for="inp1">First name:</label><br><br>
                <input id="inp1" value="<?php echo htmlspecialchars($fnamevalue); ?>" type="text" name="fname" placeholder="Enter your first name" required>
            </div>
            <div class="user"> 
                <label for="inp1">Last name:</label><br><br>
                <input id="inp1" value="<?php echo htmlspecialchars($lnamevalue); ?>" type="text" name="lname" placeholder="Enter your last name" required>
            </div>
            <div class="user"> 
                <label for="inp2">Email:</label><br><br>
                <input id="inp2" value="<?php echo htmlspecialchars($emailvalue); ?>" type="email" name="emailname" placeholder="Enter your email" required>
            </div>
            <button id="inp4" name="submit" type="submit">Update</button>
            <a id="inp4" href="read.php">Cancel</a>
        </form>
    </div>
    <section class="footer">
        <div class="social">
            <a href="#"><i class="fa-brands fa-facebook"></i></a>
            <a href="#"><i class="fa-brands fa-instagram"></i></a>
            <a href="#"><i class="fa-brands fa-twitter"></i></a>
            <a href="#"><i class="fa-brands fa-google-plus"></i></a>
            <a href="#"><i class="fa-brands fa-youtube"></i></a>
        </div>
        <ul class="list">
            <li><a href="univhome.php">Home</a></li>
            <li><a href="univlogin.php">Login</a></li>
            <li><a href="univsignup.php">Sign up</a></li>
            <li><a href="#">Terms</a></li>
            <li><a href="#">Privacy Policy</a></li>
        </ul>
        <p class="copyright">Future Coder Imane @ 2024</p>
    </section>
</body>
</html>
