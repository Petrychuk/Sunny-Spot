<?php
require('config.php');

if (isset($_GET['type'])) {
    $type = mysqli_real_escape_string($conn, $_GET['type']);
    if ($type == 'delete') {
        $id = mysqli_real_escape_string($conn, $_GET['id']);
        header("Location: deleteCabin.php?id=$id");
        exit();
    }
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Admin cabin page</title>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css?family=Quando&display=swap" rel="stylesheet">
    <link href="../style/sunny.css" rel="stylesheet" type="text/css">
    <style>
        /* CSS styles here */
        table, th, td {
            border: 1px solid black;
            border-collapse: collapse;
            padding: 20px;
            margin: auto; 
            width: 1380px;   
        }
        
        th a {
            text-decoration: none;
            color: #fff;
            background-color: #4BA5C1;
            padding: 10px;
            border-radius: 5px;
        }

        tr:nth-child(even) {
            background-color: #D6EEEE;
        }
        .links a {
            color: black;
            padding-top: 15px;
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
<h2>Manage cabin</h2>
<?php
    $sql = "SELECT * FROM `cabin`";
    if($ans = $conn->query($sql)){
        if($ans->num_rows < 0){
            echo "No record exists in the manage table";
        }else{
            ?>

    <table>
        <tr>
            <th colspan="7">
            <a href="../php/cabinForm.php" class="button">Add a new cabin</a>
            </th>
        </tr>
        <tr>
            <td>CabinType</td>
            <td>CabinDescription</td>
            <td>PricePerNight</td>
            <td>PricePerWeek</td>
            <td>Photo</td>
            <td>Action</td>
        </tr>
<?php
    while($row = $ans->fetch_array()){
?>
  <tr>
     <td><?php echo $row["cabinType"]; ?></td>
     <td><?php echo $row["cabinDescription"]; ?></td>
     <td><?php echo $row["pricePerNight"]; ?></td>
     <td><?php echo $row["pricePerWeek"]; ?></td>
     <td><img class="img-thumbnail" style="max-width:200px;height:150px" src="../images/<?php echo $row['photo']?>" alt=""></td>
     <td class="links">
        <a href="updateCabin.php?id=<?php echo $row['cabinID']?>" class="btn-cancel">Edit</a><br><br><br>
        <a href="deleteCabin.php?id=<?php echo $row['cabinID'] ?>" class="btn btn-primary">Delete</a>
     </td>
  </tr>
<?php
    }
?>
</table>
<?php
        }
    }
    $ans->free();
    $conn->close();
?>
</div>
<footer> 
    <a href="../php/adminLogout.php">Logout</a>
    <p>Copywrite © - Create by Sunny Spot develop 2023</p>  
  </footer>
</body>
</html>
