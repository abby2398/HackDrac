<?php
session_start();

require_once("config.php");
// Check if the user is dashboard
if (!isset($_SESSION["dashboard"]) || $_SESSION["dashboard"] !== true) {
    header("Location: login.php");
    exit;
}


if (isset($_FILES["profileImage"]) && $_FILES["profileImage"]["error"] == UPLOAD_ERR_OK) {
    $email = $_SESSION["email"];
    $uploadDir = "images/uploads/";
    $uniqueFilename =  $_FILES["profileImage"]["name"];
    $uploadPath = $uploadDir . $uniqueFilename;

    if (move_uploaded_file($_FILES["profileImage"]["tmp_name"], $uploadPath)) {
        
        $updateSql = "UPDATE users SET ProfileImage = '$uploadPath' WHERE email = '$email'";
        mysqli_query($conn, $updateSql);
        echo "<script>alert('Your profile picture was uploaded.');</script>";
        echo "<script>window.location.href = 'dashboard.php';</script>";
    }
}


mysqli_close($conn);

?>
