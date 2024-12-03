<?php 
session_start();
session_destroy();
$emailError = $passwordError = "";
   if(isset($_POST["submit"])){

    $emailvalue = $_POST["emailName"];
    $passwordvalue = $_POST["passName"];

    if($emailvalue ==""){
        $emailError = "email must be filled out ";
    } else if($passwordvalue == ""){
        $passwordError = "password must be filled out";
    }
   
     else {
        session_start();
        $_SESSION["emailS"] = $emailvalue;
        $_SESSION["passS"] = $passwordvalue;
        header("Location: olduser.php");
     }
   }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="univin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Welcome</title>
</head>
<body>
    <header class="header">
        <a href="univhome.php"  href="#"  class="logo">IUNIV</a>
  
         <nav   class="navbar">
  
          <a  href="univhome.php" href="#">Home</a>
          <a  href="#">Login</a>
          <a  href="univsignup.php" href="#">Signup</a>
  
  
         </nav>
  
      </header>
 
    <div class="c1">
        <video autoplay="autoplay" muted="" loop="infinite" src="sci-fi-space.1920x1080.mp4"></video> 
       </div>
       <div class="loginbox">
        <h2>Login</h2>
        <form action="olduser.php" method="post">
            <div class="user"> 
                <label for="inp1">Email :</label> <br> <br>
                <input id="inp1" type="email" value="<?php if(isset($emailvalue)) echo $emailvalue ?>" name="emailName" placeholder="Enter your email" required >
                <span style="color: red;"><?php echo $emailError  ?></span>
            </div>
            <div class="user">
                <label for="inp2">Password :</label> <br> <br>
                <input id="inp2" type="password" name="passName" placeholder="Enter your password" required> <br>
                <span style="color: red;"><?php echo $passwordError  ?></span>
            </div>
            <button name="submit" id="inp3" type="submit" >Login</button>
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
 <li>
        <a href="univhome.php">Home</a>
    </li>
    <li>
        <a href="univlogin.php">Login</a>
    </li>
    <li>
        <a href="univsignup.php">Sign up</a>
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