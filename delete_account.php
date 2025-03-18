<?php
session_start();
require_once("config.php");

// Check if the user is dashboard
if (!isset($_SESSION["authenticated"]) || $_SESSION["authenticated"] !== true) {
    header("Location: login.php");
    exit;
}

$email = $_SESSION["email"];

if (isset($_POST['deleteAccount'])) {  

    if ($email != "admin@hackdrac.com") {
    // Vulnerable query for account deletion (SQL Injection)
    $deleteQuery = "DELETE FROM users WHERE email = '$email'";
    mysqli_query($conn, $deleteQuery);

    // Logout and redirect to login page
    session_destroy();
    header("Location: login.php");

    exit;
    }
    else {
        echo "Error: You cannot delete the admin account.";
    }
}
?>
