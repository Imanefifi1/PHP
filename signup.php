<?php
class SignupHandler {
    private $errormsg = "";
    private $successmsg = "";
    private $formData = [
        "fname" => "",
        "lname" => "",
        "emailname" => "",
        "passname" => ""
    ];

    public function __construct() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST["submit"])) {
            $this->handleSignup();
        }
    }

    public function getErrorMessage() {
        return $this->errormsg;
    }

    public function getSuccessMessage() {
        return $this->successmsg;
    }

    public function getFormValue($field) {
        return htmlspecialchars($this->formData[$field] ?? "", ENT_QUOTES, 'UTF-8');
    }

    private function handleSignup() {
        // Sanitize and validate input
        $this->formData = [
            "fname" => $_POST["fname"] ?? "",
            "lname" => $_POST["lname"] ?? "",
            "emailname" => $_POST["emailname"] ?? "",
            "passname" => $_POST["passname"] ?? ""
        ];

        if (empty($this->formData["fname"]) || empty($this->formData["lname"]) || empty($this->formData["emailname"]) || empty($this->formData["passname"])) {
            $this->errormsg = "All fields must be filled out!";
            return;
        }

        if (strlen($this->formData["passname"]) < 8) {
            $this->errormsg = "The password must contain at least 8 characters!";
            return;
        }

        if (!preg_match('/[A-Z]+/', $this->formData["passname"])) {
            $this->errormsg = "Password must contain at least one capital letter!";
            return;
        }

        $this->registerUser();
    }

    private function registerUser() {
        include("database.php");

        $fname = $this->formData["fname"];
        $lname = $this->formData["lname"];
        $email = $this->formData["emailname"];
        $password = password_hash($this->formData["passname"], PASSWORD_DEFAULT);

        $sql = "INSERT INTO Clients (firstname, lastname, email, password) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssss", $fname, $lname, $email, $password);

        if ($stmt->execute()) {
            $this->successmsg = "New record created successfully";
            session_start();
            $_SESSION["fnameS"] = $fname;
            $_SESSION["emailS"] = $email;
            $_SESSION["passS"] = $this->formData["passname"];
            header("Location: newuser.php");
            exit();
        } else {
            $this->errormsg = "Error: " . $stmt->error;
        }

        $stmt->close();
        $conn->close();
    }
}

$signupHandler = new SignupHandler();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="univup.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Sign up</title>
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
        <video autoplay="autoplay" muted loop="infinite" src="sci-fi-space.1920x1080.mp4"></video>
    </div>
    <div class="loginbox">
        <h2>Signup</h2>
        <?php if (!empty($signupHandler->getErrorMessage())): ?>
            <div style="color: red;"><?php echo $signupHandler->getErrorMessage(); ?></div>
        <?php endif; ?>
        <?php if (!empty($signupHandler->getSuccessMessage())): ?>
            <div style="color: green;"><?php echo $signupHandler->getSuccessMessage(); ?></div>
        <?php endif; ?>
        <form method="post">
            <div class="user">
                <label for="inp1">First name:</label><br><br>
                <input id="inp1" value="<?php echo $signupHandler->getFormValue('fname'); ?>" type="text" name="fname" placeholder="Enter your full name" required>
            </div>
            <div class="user">
                <label for="inp1">Last name:</label><br><br>
                <input id="inp1" value="<?php echo $signupHandler->getFormValue('lname'); ?>" type="text" name="lname" placeholder="Enter your full name" required>
            </div>
            <div class="user">
                <label for="inp2">Email:</label><br><br>
                <input id="inp2" value="<?php echo $signupHandler->getFormValue('emailname'); ?>" type="email" name="emailname" placeholder="Enter your email" required>
            </div>
            <div class="user">
                <label for="inp3">Password:</label><br><br>
                <input id="inp3" value="<?php echo $signupHandler->getFormValue('passname'); ?>" type="password" name="passname" placeholder="Enter your password" required><br>
            </div>
            <button id="inp4" name="submit" type="submit">Submit</button>
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
