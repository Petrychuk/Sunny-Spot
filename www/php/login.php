<?php
session_start();

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

if (isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true) {
    header("Location: adminMenu.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT staffID, userName, firstName, lastName FROM admin WHERE userName = '$username' AND password = '$password'";
    $result = $conn->query($sql);

    if ($result && $result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $_SESSION['admin_logged_in'] = true;
        $_SESSION['admin_id'] = $row['staffID'];
        $_SESSION['admin_username'] = $row['userName'];
        $_SESSION['admin_name'] = $row['firstName'] . ' ' . $row['lastName'];

        header("Location: adminMenu.php");
        exit;
    } else
    { 
       header("Location: adminLogin.php");
    }
}       
?>