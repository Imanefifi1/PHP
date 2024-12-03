<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="test.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Login Page</title>
</head>
<body>
    <header class="header">
        <a href="univhome.php" class="logo">IUNIV</a>
        <nav class="navbar">
            <a href="univhome.php">Home</a>
            <a href="#">Login</a>
            <a href="univsignup.php">Signup</a>
        </nav>
    </header>

    <!-- Video Background Section -->
    <div class="c1">
        <video autoplay muted loop src="sci-fi-space.1920x1080.mp4"></video>
    </div>

    <!-- Login Box -->
    <div class="loginbox">
        <h2>Login</h2>
        <form action="olduser.php" method="post">
            <div class="user"> 
                <label for="inp1">Email:</label> <br> <br>
                <input id="inp1" type="email" placeholder="Enter your email" required>
            </div>
            <div class="user">
                <label for="inp2">Password:</label> <br> <br>
                <input id="inp2" type="password" placeholder="Enter your password" required> <br>
            </div>
            <input id="inp3" type="submit" value="Login">
        </form>
    </div>

    <!-- Footer -->
    <section class="footer">
        <div class="social">
            <a href="#"><i class="fa-brands fa-facebook"></i></a>
            <a href="#"><i class="fa-brands fa-instagram"></i></a>
            <a href="#"><i class="fa-brands fa-twitter"></i></a>
            <a href="#"><i class="fa-brands fa-google-plus"></i></a>
            <a href="#"><i class="fa-brands fa-youtube"></i></a>
        </div>
        <ul class="list">
            <li><a href="#">Home</a></li>
            <li><a href="#">Login</a></li>
            <li><a href="#">Sign up</a></li>
            <li><a href="#">Terms</a></li>
            <li><a href="#">Privacy Policy</a></li>
        </ul>
        <p class="copyright">
            Future Coder Imane @ 2024
        </p>
    </section>
</body>
</html>
