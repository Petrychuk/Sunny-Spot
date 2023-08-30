<?php
require('config.php');


if (isset($_POST['add_cabin'])) {
  $cabin_type = $_POST['cabin_type'];
  $cabin_description = $_POST['cabin_description'];
  $price_day = $_POST['price_day'];
  $price_week = $_POST['price_week'];
  $cabin_image = $_FILES['cabinimage']['name']; // Get the name of the uploaded image file

  // File upload handling
  $target_dir = '../images/';
  $target_file = $target_dir . basename($_FILES['cabinimage']['name']);

  $uploadOk = 1;
  $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

  // Check if the file is an actual image
  $check = getimagesize($_FILES['cabinimage']['tmp_name']);
  if ($check !== false) {
      $uploadOk = 1;
  } else {
      echo "File is not an image.";
      $uploadOk = 0;
  }

  // Check if the file already exists
  if (file_exists($target_file)) {
      echo "Sorry, the file already exists.";
      $uploadOk = 0;
  }

  // Check the file size
  if ($_FILES['cabinimage']['size'] > 5000000) {
      echo "Sorry, the file is too large.";
      $uploadOk = 0;
  }

  // Allow only certain file formats (modify this as per your requirements)
  if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
      echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
      $uploadOk = 0;
  }

  // If the file upload is successful, move the file to the target directory
  if ($uploadOk == 1) {
    if (move_uploaded_file($_FILES['cabinimage']['tmp_name'], $target_file)) {
        // Prepare the SQL statement
        $stmt = $conn->prepare("INSERT INTO cabin (cabinType, cabinDescription, pricePerNight, pricePerWeek, photo) VALUES (?, ?, ?, ?, ?)");
        
        // Bind parameters to the prepared statement
        $stmt->bind_param("sssss", $cabin_type, $cabin_description, $price_day, $price_week, $cabin_image);
        
        // Execute the prepared statement
        if ($stmt->execute()) {
            echo "A new cabin has been inserted successfully.";
            echo "<script>setTimeout(function(){ window.location.href = 'showAllCabins.php'; }, 5000);</script>";
        } else {
            echo "Error inserting into table: " . $conn->error;
        }
        
        // Close the prepared statement
        $stmt->close();
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
  }
}
$conn->close();
?>