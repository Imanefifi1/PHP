<?php

// sql to delete a record
include ("connection.php");
 $connect =new Connection();
 include ("client.php");
 $connect->selectDatabase("POOphp4");

 Client::deleteClient("Clients",$connect->conn,$_GET['idDeleted']);


?>