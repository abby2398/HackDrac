<?php
session_start();
require_once("config.php");

// Check if the user is dashboard
if (!isset($_SESSION["authenticated"]) || $_SESSION["authenticated"] !== true) {
    header("Location: login.php");
    exit;
}


/// Get the username and email from the session
$username = isset($_SESSION["username"]) ? $_SESSION["username"] : "User"; // Fallback to 'User' if not set
$email = $_SESSION["email"];

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
   <?php
    // Display the user's profile picture if available
    $profileImagePath = '';
    $email = $_SESSION["email"]; 
    $profileImageQuery = "SELECT ProfileImage FROM users WHERE email = '$email'";
    $result = mysqli_query($conn, $profileImageQuery);

    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $profileImagePath = $row['ProfileImage'];
    }
    ?>
    <div class="outer">
    <div class="dashboard">
        <h1>Welcome back, <?php echo $username; ?></h1>   <!--  htmlspecialchars($username) for removing special chars -->
        <?php   if (!empty($profileImagePath)) {
        echo "<img src='$profileImagePath' alt='Profile Picture' class='profile-picture'>";
    } ?>
    </div>

    <div class="right-bar">
        <a href="edit-profile" class="profile-link">Edit Profile</a>
        <form action="logout" method="post" class="logout-form">
        <input type="submit" class="logout-button" value="Logout">
        </form>
    </div>
</div>
  

    <?php include_once 'footer.php'; ?>
    
</body>
</html>
