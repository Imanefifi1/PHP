<?php
 include ('connection.php');
 $connect =new Connection();
 include ('client.php');
 $connect->selectDatabase("POOphp4");
include('city.php');


 $clients=[];
    //call the static selectAllClients method and store the result of the method in $clients
    $clients=Client::selectAllClients("Clients",$connect->conn);
     if(isset($_POST['submit'])){

    $clients=Client::selectClientsByCity('Clients',$connect->conn,$_POST['cities']);
 }




?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List of users</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <style>
        body {
            background-color: #1a1a40; /* Couleur de l'espace */
            color: #ffffff;
        }
        .table-dark {
            background-color: #2a2a72; /* Bleu sombre de galaxie */
        }
        .table-dark th {
            color: #ffdd57; /* Couleur dorée pour les étoiles */
        }
        .table-dark td {
            color: #d9d9f3; /* Gris clair pour les cellules */
        }
        .btn-space {
            background-color: #ff6f61; /* Rouge profond pour l'action */
            border: none;
        }
        .btn-space:hover {
            background-color: #ff8a75;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4" style="color: #ffdd57;">List of users</h1> <br> <br>
        <a  class="btn btn-primary" href="univsignup.php" role="button">Signup</a><br><br>
        <form method="post">

<div class="input-group">
<span class="input-group-btn">

<button class="btn btn-success" type="submit" name="submit">Search</button>

</span>
<div class="row mb-3">
        <div class="col-sm-6">
            <select name='cities' class="form-select">
            <option selected>Select your city</option>
            <?php
$cities = City::selectAllCities('Cities',$connect->conn);
foreach($cities as $city){
    echo "<option value='$city[id]' >$city[cityName]</option>";

}

?>
            </select>
            </div>
</div>
</form>
        
        <table class="table table-dark table-striped text-center">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">First Name</th>
                    <th scope="col">Last Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">City</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                
                <?php
            
               foreach($clients as $row){
                $city = City::selectCityById('Cities',$connect->conn,$row['idCity']);
                echo " <tr>
                <td scope='col'>$row[id]</td>
                <td scope='col'>$row[firstname]</td>
                <td scope='col'>$row[lastname]</td>
                <td scope='col'>$row[email]</td>
                <td scope='col'>$city[cityName]</td>
                <td scope='col'>
                <a class='btn btn-success btn-sm' href='update.php?idUpdated=$row[id]'>Edit</a>
                <a class='btn btn-danger btn-sm' href='delete.php?idDeleted=$row[id]'>Delete</a>
                </td>
               </tr>";  
                        }
                        
                
               
                ?>
            </tbody>
        </table>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
