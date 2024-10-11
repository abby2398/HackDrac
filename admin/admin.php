<?php
session_start();
require_once("../config.php");

if (!isset($_SESSION['id']) || $_SESSION['id'] !=1){
    echo "Access Denied";
    exit;
}
$username = $_SESSION['username'];

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Dashboard Page</title>
        <link rel="stylesheet" type="text/css" href="/css/dashboard.css">
        <link rel="stylesheet" type="text/css" href="/css/navbar.css">
        <link rel="icon" href="/images/favicon.ico" type="image/x-icon">
    </head>
    <body>
        <nav>
            <a href="index">Home</a>
            <a href="contact" target="_blank">Contact</a>
            <a href="about" target="_blank">About Us</a>
        </nav>
    <!-- <h1 style="color: blueviolet; text-align: center;">dashboard to Hackdrac</h1> -->
    
        <div class="outer">
            <div class="dashboard">
                <h1>ADMIN DASHBOARD</h1>   <!--  htmlspecialchars($username) for removing special chars -->
            </div>

            <div class="right-bar">
                <a href="edit-profile" class="profile-link">Edit Profile</a>
                <form action="../logout" method="post" class="logout-form">
                <input type="submit" class="logout-button" value="Logout">
                </form>
            </div>
        </div>
    
        <div class = "search-user">
           <h3>Search User by email</h3>

        </div>

        <?php include_once '../footer.php'; ?>
        
    </body>
</html>
