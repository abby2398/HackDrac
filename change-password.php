<?php
session_start();
require_once("config.php");

if (!isset($_SESSION["authenticated"]) || $_SESSION["authenticated"] !== true) {
    header("Location: login.php");
    exit;
}

$email = $_SESSION["email"]; 

if(!empty($_POST["newPassword"])) {
    
    if(isset($_POST["newPassword"])) {
        $newpass = $_POST['newPassword'];

        // Update password query
        $updatePass = "UPDATE users SET Password = '$newpass' WHERE email = '$email'";
        mysqli_query($conn, $updatePass);

        if(mysqli_affected_rows($conn) > 0) {
            // Password changed successfully, logout the user
            echo "<script>alert('Your password changed successfully. You will now be logged out.');</script>";

            // Destroy the session to log out the user
            session_destroy();

            // Redirect to login page
            echo "<script>window.location.href = 'login.php';</script>";
            exit;
        } else {
            echo "Unable to change password.";
        }
    } else {
        echo "No password provided.";
    }
}

mysqli_close($conn);
?>