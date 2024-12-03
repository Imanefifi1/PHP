<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="new.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Welcome</title>
</head>
<body>
<header class="header">
        <a href="univhome.php"  href="#"  class="logo">IUNIV</a>
  
         <nav   class="navbar">
  
            <a href="univhome.php" href="#">Home</a>
            <a href="#"><?php $_SESSION["fullnameS"] ?></a>
            <a href="univlogin.php"  href="#">Logout</a>
  
  
         </nav>
  
      </header>
    <div class="user">
        <video autoplay="autoplay" muted="" loop="infinite" src="sci-fi-space.1920x1080.mp4"></video>
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
 <li>
        <a href="#" href="univhome.php">Home</a>
    </li>
    <li>
        <a href="#" href="univlogin.php">Login</a>
    </li>
    <li>
        <a href="#" href="univsignup.php">Sign up</a>
    </li>
    <li>
        <a href="#"> Terms</a>
    </li>
    <li>
        <a href="#">Privacy Policy</a>
    </li>
 </ul>
 <p class="copyright">
    Future Coder Imane @ 2024
 </p>
</section>
</body>
</html>