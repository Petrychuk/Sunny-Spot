<?php
session_start();

// Check if the user is not logged in
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: adminlogin.php"); // Redirect to the login page if not logged in
    exit;
}

require('config.php');

// Logout logic
if (isset($_GET['logout']) && $_GET['logout'] == 1) {
  // Destroy all session data
  session_unset();
  session_destroy();
  header("Location: adminlogin.php"); // Redirect to the login page after logout
  exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Menu</title>
    <link href="https://fonts.googleapis.com/css?family=Quando&display=swap" rel="stylesheet">
    <link href="../style/sunny.css" rel="stylesheet" type="text/css">
    <style>
    body {
      font-family: Quando, arial, serif;
      background-color: #f9f9f9;
    }
    
    .container {
      max-width: 400px;
      height: 700px;
      margin: 0 auto;
      padding: 20px;
      background-color: #fff;
      border: 1px solid #ccc;
      border-radius: 4px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      margin-bottom: 60px;
    }
    
    .container h2 {
      text-align: center;
    }
    
    .naf-list {
      list-style: none;
      padding: 0;
      margin-top: 20px;
    }
    
    .naf-list li {
      margin-bottom: 25px;
      
    }
  
    .naf-list a {
      display: block;
      text-decoration: none;
      padding: 8px;
      background-color: #397a8e;
      color: #fff;
      border-radius: 4px;
      text-align: center;
      height: 50px;
      padding-top: 15px;
    }
    
    .naf-list a:hover {
      background-color: #4BA5C1;
    }
  </style>
  </head>
<body>
<header>
    <div class="logo"> 
    <h1>Sunnyspot <img src="../images/accommodation.png" alt="Accommodation"> Accommodation</h1>
   </div>
  </header>
  <div class="container">
    <section>
        <h3>Welcome, <?php echo $_SESSION['admin_name']; ?></h3>
        <p>This is the admin panel of Sunnyspot Accommodation. You have successfully logged in as an admin.</p>
    </section>
    <h2>Administrative Menu</h2>
   
    <ul class="naf-list">
      <li><a href="../index.html">Home</a></li>
      <li><a href="../php/showAllCabins.php">Show Cabins</a></li>
      <li><a href="../php/cabinForm.php">Insert a new cabin</a></li>
      <li><a href="../php/showAllCabins.php">Update a cabin</a></li>
      <li><a href="../php/showAllCabins.php">Delete a cabin</a></li>
   
    </ul>
  </div>
</body>
<footer> 
  <a href="logout.php">Logout</a>
  </footer>
</body>
</html>
</html>
