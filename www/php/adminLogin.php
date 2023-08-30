<?php
require('config.php');

$sql = "SELECT cabinType, cabinDescription, pricePerNight, pricePerWeek, photo FROM Cabin";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link href="https://fonts.googleapis.com/css?family=Quando&display=swap" rel="stylesheet">
    <link href="../style/sunny.css" rel="stylesheet" type="text/css">
</head>
<body>
<header>
    <div class="logo"> 
    <h1>Sunnyspot <img src="../images/accommodation.png" alt="Accommodation"> Accommodation</h1>
   </div>
  </header>
   <div class="navigation">
   <nav>
    <ul>
      <li><a href="../index.html">Home</a></li>
      <li><a href="../php/allCabins.php">Cabins</a></li>
      <li><a href="contact.html">Contact</a></li>
      <li><a href="../php/adminLogin.php">Admin</a></li> 
    </ul>
   </nav>
  </div>
  <main>        
        <form action="login.php" method="POST" class="form">
            <h1>Admin Login</h1>
        
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required><br><br>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required><br>
            <br><br>
            <input type="submit" name="login" id="login" value="Login">
        </form>
    </main>

    <footer> 
    <a href="../php/adminLogin.php">Admin</a>
    <p>Copywrite © - Create by Sunny Spot develop 2023</p>  
  </footer>
</body>
</html>