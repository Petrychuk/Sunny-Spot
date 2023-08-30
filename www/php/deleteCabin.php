<?php
require('config.php');

if (isset($_GET['id'])) {
    $id = mysqli_real_escape_string($conn, $_GET['id']);

    $sql = "SELECT * FROM cabin WHERE cabinID = '$id'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $cabinType = $row['cabinType'];

        if (isset($_POST['confirm_delete'])) {
            $conn->autocommit(FALSE); // Отключаем автокоммит

            // Удаление связанных записей в таблице cabininclusion
            $deleteCabinInclusionSql = "DELETE FROM cabininclusion WHERE cabinID = '$id'";
            if ($conn->query($deleteCabinInclusionSql) === FALSE) {
                echo "Error deleting cabin inclusions: " . $conn->error;
                $conn->rollback(); // Откатываем изменения
                exit();
            }

            // Удаление кабины из таблицы cabin
            $deleteCabinSql = "DELETE FROM cabin WHERE cabinID = '$id'";
            if ($conn->query($deleteCabinSql) === TRUE) {
                $conn->commit(); // Фиксируем изменения
                echo "Record deleted successfully.";
                echo "<script>setTimeout(function() {window.location.href = 'showAllCabins.php';}, 5000);</script>";
                exit();
            } else {
                echo "Error deleting record: " . $conn->error;
                $conn->rollback(); // Откатываем изменения
                exit();
            }
        }
    } else {
        echo "No cabin found with ID: $id";
        exit();
    }
    $result->free();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Cabin</title>
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
      <li><a href="../php/allCabins.php">All Cabins</a></li>
      <li><a href="contact.html">Contact</a></li>
      <li><a href="../php/adminLogin.php">Admin</a></li> 
    </ul>
   </nav>
  </div>
    <main>
    <form method="post" action="" class="add_cabin">
            <h2>Delete Cabin</h2>
            <br>
            <p>Are you sure you want to delete <?php echo $cabinType; ?>?</p><br>
            <div class="delete_button">
            <a href="showAllCabins.php" class="btn-cancel">Cancel</a><br>               
            <input type="submit" name="confirm_delete" class="btn btn-primary" value="Delete">
            </div>
        </form>
    </main>

    <footer> 
    <a href="../php/adminLogout.php">Logout</a>
    <p>Copywrite © - Create by Sunny Spot develop 2023</p>  
  </footer>
</body>
</html>
