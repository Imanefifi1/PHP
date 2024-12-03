<?php 
include("connection.php");
$connect = new Connection();
$connect->selectDatabase('POOphp4');
$errormesag ="";
$fnamevalue = "";
$lnamevalue = "";
$emailvalue = "";
$passwordvalue = "";
$successmesag = "";
   if(isset($_POST["submit"])){
   
    $fnamevalue = $_POST["fname"];
    $lnamevalue = $_POST["lname"];
    $emailvalue = $_POST["emailname"];
    $passwordvalue = $_POST["passname"];
    $idCityvalue = $_POST["cityname"];
    if($emailvalue =="" || $fnamevalue == "" || $lnamevalue == "" || $passwordvalue == ""){
     $errormesag = "All fields must be filled out !";
    } else if(strlen($passwordvalue)<8){
       $errormesag = "The password must contain at least 8 characters !";
    }
    else if(preg_match('/[A-Z]+/',$passwordvalue)==0){
        $errormesag = "Password must contain at least one capital letter !";
    }
     else {
        
        include('client.php');
        $client = new Client($fnamevalue,$lnamevalue,$emailvalue,$passwordvalue,$idCityvalue);
        $client->insertClient('Clients',$connect->conn);
        $successmesag = Client ::$successMsg;
        $errormesag = Client ::$errorMsg;

        session_start();
        $_SESSION["fnameS"] = $fnamevalue;
        $_SESSION["emailS"] = $emailvalue;
        $_SESSION["passS"] = $passwordvalue;
        header("Location: newuser.php");
     }
   }
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
        <a href="univhome.php"  href="#"  class="logo">IUNIV</a>
  
         <nav   class="navbar">
  
          <a href="univhome.php" href="#">Home</a>
          <a  href="univlogin.php" href="#">Login</a>
          <a  href="#">Signup</a>
  
  
         </nav>
  
      </header>
      <div class="c1">
        <video autoplay="autoplay" muted="" loop="infinite" src="sci-fi-space.1920x1080.mp4"></video> 
       </div>
       <div class="loginbox">
        <h2>Signup</h2>
        <?php
        if (!empty($errormesag)) {
            echo '<div style="color: red;">';
            echo $errormesag;
            echo '</div>';} ?>
        <form method="post">
        <div class="user"> 
                <label for="inp1">First name :</label> <br> <br>
                <input id="inp1" value="<?php echo $fnamevalue ?>" type="text" name="fname" placeholder="Enter your full name" required>
            </div>
            <div class="user"> 
                <label for="inp1">Last name :</label> <br> <br>
                <input id="inp1" value="<?php echo $lnamevalue ?>" type="text" name="lname" placeholder="Enter your full name" required>
            </div>
            <div class="user"> 
                <label for="inp2">Email :</label> <br> <br>
                <input id="inp2" value="<?php  echo $emailvalue ?>" type="email" name="emailname" placeholder="Enter your email" required>
                
            </div>
            <div class="user">
                
                <label for="inp3">Cities:</label><br> <br>
                <select id="inp3" name="cityname" >
                    <option value="" disabled selected>Choose a city</option>
                    <!-- <option value="city1">Marrakech</option>
                    <option value="city2">Tanger</option> -->
                    <?php

include("city.php");
$cities = City::selectAllCities('Cities',$connect->conn);
foreach($cities as $city){
    echo "<option value='$city[id]'>$city[cityName]</option>";

}

?>
                </select>
                <br><br>
            </div>
            <div class="user">
                <label  for="inp3">Password :</label> <br> <br>
                <input id="inp3" value="<?php echo $passwordvalue ?>" type="password" name="passname" placeholder="Enter your password" required> <br>
                
            </div>
            <?php
        if (!empty($successmesag)) {
            echo '<div style="color: green;">';
            echo $successmesag;
            echo '</div>';}?>
           
            <button id="inp4" name="submit" type="submit" >submit</button>
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
        <a  href="univhome.php">Home</a>
    </li>
    <li>
        <a  href="univlogin.php">Login</a>
    </li>
    <li>
        <a  href="univsignup.php">Sign up</a>
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