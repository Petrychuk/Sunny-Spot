<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sunnyspot Accommodation</title>
  <link href="https://fonts.googleapis.com/css?family=Quando&display=swap" rel="stylesheet">
  <link href="../style/sunny.css" rel="stylesheet" type="text/css">
  <style>
    .row {
      display: flex;
      flex-wrap: wrap;
      justify-content: space-between;
    }

    .row article {
      width: 25%;
      padding: 20px;
      box-sizing: border-box;
    }

    .row article img {
      width: 100%;
      height: auto;
    }
  </style>
</head>

<body>
  <?php include_once "../include/nav.php"?>
  <div class="wrapper">
    <h2>All Cabins</h2>
    <?php
       $servername = "localhost";
       $username = "root";
       $password = "";/* Put your password */
       $dbname = "sunnyspot";/* Put your database name */
       
       /* Create connection */
       $conn = new mysqli($servername, $username, $password, $dbname);
       
       /* Check connection */
       if ($conn->connect_error) {
           die("Connection failed: " . $conn->connect_error);
       }
       
       $sql = "SELECT cabinType, cabinDescription, pricePerNight, pricePerWeek, photo FROM cabin";
       $result = $conn->query($sql);
      
      if ($result->num_rows > 0) {
        $count = 0;
        while ($row = $result->fetch_assoc()) {
            if ($count % 3 === 0) {
                echo "<div class='row'>";        
            }
            echo "<article>";
            echo "<h2>". $row['cabinType']."</h2>";
            echo "<img src='../images/" . $row['photo'] . "' alt='" . $row['cabinType'] . "'>";
            echo "<p><span>Description: </span>" . $row['cabinDescription'] . "</p>";
            echo "<p><span>Price per night: </span>$" . $row['pricePerNight'] . "</p>";
            echo "<p><span>Price per week: </span>$" . $row['pricePerWeek'] . "</p>";
            echo "</article>";

            if (($count +1) % 3 === 0) {
                echo "</div>";
            }
            $count++;
        }

        if ($count % 3 !== 0) {
            echo "</div>";
        }

      } else  {
        echo "No cabins found in the database.";  
      }
    $conn->close();
    ?>
    <?php include "../include/footer.php"?>
  </div>
</body>

</html>
