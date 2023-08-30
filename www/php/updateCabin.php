<?php
require('header.php');
require('config.php');

if (isset($_GET['id'])) {
    $cabin_id = mysqli_real_escape_string($conn, $_GET['id']);

    $sql = "SELECT * FROM `cabin` WHERE cabinID ='$cabin_id'";
    if ($res = $conn->query($sql)) {
        if ($res->num_rows > 0) {
            while ($row = $res->fetch_array()) {
                if (isset($row['cabinID'])) {
                    $cabin_id = $row['cabinID'];
                }
                if (isset($row['cabinType'])) {
                    $cabin_type = $row['cabinType'];
                }
                if (isset($row['cabinDescription'])) {
                    $cabin_description = $row['cabinDescription'];
                }
                if (isset($row['pricePerNight'])) {
                    $price_day = $row['pricePerNight'];
                }
                if (isset($row['pricePerWeek'])) {
                    $price_week = $row['pricePerWeek'];
                }
                if (isset($row['photo'])) {
                    $cabin_image = $row['photo'];
                }
            }
        } else {
            echo "No record found for the provided ID.";
            exit();
        }
    } else {
        echo "ERROR: Could not able to execute $sql. " . $conn->error;
        exit();
    }
} else {
    echo "No ID parameter provided.";
    exit();
}

if (!isset($_GET['id'])) {
    echo "No ID parameter provided.";
    exit();
}

if (isset($_POST['update_cabin'])) {
    $cabin_id = mysqli_real_escape_string($conn, $_POST['cabin_id']);

    $update_fields = []; // Массив для хранения полей для обновления

    if (!empty($_POST['cabin_type'])) {
        $cabin_type = mysqli_real_escape_string($conn, $_POST['cabin_type']);
        $update_fields[] = "`cabinType` = '$cabin_type'";
    }

    if (!empty($_POST['cabin_description'])) {
        $cabin_description = mysqli_real_escape_string($conn, $_POST['cabin_description']);
        $update_fields[] = "`cabinDescription` = '$cabin_description'";
    }

    if (!empty($_POST['price_day'])) {
        $price_day = mysqli_real_escape_string($conn, $_POST['price_day']);
        $update_fields[] = "`pricePerNight` = '$price_day'";
    }

    if (!empty($_POST['price_week'])) {
        $price_week = mysqli_real_escape_string($conn, $_POST['price_week']);
        $update_fields[] = "`pricePerWeek` = '$price_week'";
    }

    // File upload handling
    if (!empty($_FILES['cabinimage']['name'])) {
        $cabin_image = $_FILES['cabinimage']['name'];
        $target_dir = '../Images/';
        $target_file = $target_dir . basename($_FILES['cabinimage']['name']);
        $update_fields[] = "`photo` = '$cabin_image'";

        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Check if the file is an actual image
        $check = getimagesize($_FILES['cabinimage']['tmp_name']);
        if ($check === false) {
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
                // Delete the old image file if a new image was uploaded
                if (!empty($cabin_image) && !empty($row['photo']) && $cabin_image !== $row['photo']) {
                    $old_image_file = $target_dir . $row['photo'];
                    if (file_exists($old_image_file)) {
                        unlink($old_image_file);
                    }
                }

                if (!empty($update_fields)) {
                    $update_fields_str = implode(", ", $update_fields);
                    $sql = "UPDATE `cabin` SET $update_fields_str WHERE `cabinID` = '$cabin_id'";
            
                    if ($conn->query($sql) === true) {
                        echo "Cabin data updated successfully.";
                        header("refresh:5;url=showAllCabins.php");
                        exit();
                    } else {
                        echo "ERROR: Could not able to execute $sql. " . $conn->error;
                    }
                } else {
                    echo "No fields to update.";
                }
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
    } else {
        if (!empty($update_fields)) {
            $update_fields_str = implode(", ", $update_fields);
            $sql = "UPDATE `cabin` SET $update_fields_str WHERE `cabinID` = '$cabin_id'";
    
            if ($conn->query($sql) === true) {
                echo "Cabin data updated successfully.";
                header("refresh:5;url=showAllCabins.php");
                exit();
            } else {
                echo "ERROR: Could not able to execute $sql. " . $conn->error;
            }
        } else {
            echo "No fields to update.";
        }
    }
}

$conn->close();
?>

<header>
    <div class="logo"> 
        <h1>Sunnyspot <img src="../images/accommodation.png" alt="Accommodation"> Accommodation</h1>
    </div>
</header>

<form class="add_cabin" action="updateCabin.php?id=<?php echo $cabin_id; ?>" method="POST" enctype="multipart/form-data">         
    <h1>Update Cabin</h1>

    <!-- Добавьте скрытое поле для передачи значения id -->
    <input type="hidden" name="cabin_id" value="<?php echo $cabin_id; ?>">

    <label>CabinType:</label>
    <input type="text" id="cabin_type" name="cabin_type" value="<?php echo $cabin_type; ?>" required>

    <label>CabinDescription:</label>
    <textarea id="description" name="cabin_description" rows="4" cols="50"><?php echo $cabin_description; ?></textarea>

    <label>PricePerNight:</label>
    <input type="text" id="price_day" name="price_day" value="<?php echo $price_day; ?>">

    <label>PricePerWeek:</label>
    <input type="text" id="price_week" name="price_week" value="<?php echo $price_week; ?>">

    <label for="cabinimage" class="file-upload">CabinImages:</label>
    <input type="file" id="cabinimage" name="cabinimage" accept="image/*">
    <br>

    <input type="submit" name="update_cabin" id="update_cabin" class="btn_add" value="Update">
    <a href="showAllCabins.php" class="btn-cancel">Cancel</a>
</form>

</main>

<footer> 
    <a href="../php/adminLogout.php">Log Out</a>
    <p>Copywrite © - Create by Sunny Spot develop 2023</p>  
</footer>
