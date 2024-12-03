<?php 
include("connection.php");
$errormessag ="";
$fnamevalue = "";
$lnamevalue = "";
$emailvalue = "";
$successmessag = "";

$connect = new Connection();

$connect->selectDatabase('POOphp4');

include('client.php');

if($_SERVER['REQUEST_METHOD']=='GET'){
$id = $_GET['idUpdated'];
    $row = Client::selectClientById('Clients',$connect->conn,$id);
   $fnamevalue= $row['firstname']; 
  $lnamevalue= $row['lastname']; 
  $emailvalue= $row['email'];
    
    
}
 else if(isset($_POST["submit"])){
   
    $fnamevalue = $_POST["fname"];
    $lnamevalue = $_POST["lname"];
    $emailvalue = $_POST["emailname"];
    if($emailvalue =="" || $fnamevalue == "" || $lnamevalue == "" ){
     $errormessag = "All fields must be filled out !";
    } 
   else {
    $client = new Client($fnamevalue,$lnamevalue,$emailvalue,'');
    Client::updateClient($client,'Clients',$connect->conn,$_GET['idUpdated']);

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
    <title>Update</title>
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
        <h2>Update</h2>
        <?php
        if (!empty($errormessag)) {
            echo '<div style="color: red;">';
            echo $errormessag;
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
           
            <?php
        if (!empty($successmessag)) {
            echo '<div style="color: green;">';
            echo $successmessag;
            echo '</div>';}?>
           
            <button id="inp4" name="submit" type="submit" href="read.php">Update</button>
            <button id="inp4" name="submit" type="submit" href="read.php" >Cancel</button>
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