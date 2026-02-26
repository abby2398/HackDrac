<?php
include 'seo.php';
session_start();
require_once("config.php");

// Check if 'id' is present in the URL
if (!isset($_GET['id']) || empty($_GET['id'])) {
    // Redirect to an error page or display an error message
    echo "<script>alert('Invalid request. User ID is missing.');</script>";
    echo "<script>window.location.href = 'forget.php';</script>";
    exit; // Terminate script execution
}


// Check if the user has accessed the page with the id parameter
if (isset($_GET['id'])) {
    // Retrieve the user ID directly from the GET parameter
    $userId = $_GET['id'];

    // Vulnerable SQL query to check if the user ID exists in the database
    $checkUserQuery = "SELECT * FROM users WHERE id = '$userId'";
    $result = mysqli_query($conn, $checkUserQuery);

    if (mysqli_num_rows($result) > 0) {
        // User exists, allow password reset
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Get the new password from the form
            $newPassword = $_POST['new_password'];

            // Vulnerable SQL update query
            $updatePasswordQuery = "UPDATE users SET password = '$newPassword' WHERE id = '$userId'";
            if (mysqli_query($conn, $updatePasswordQuery)) {
                echo "<script>alert('Password has been reset successfully.');</script>";
                echo "<script>window.location.href = 'login.php';</script>";
                exit;
            } else {
                echo "Failed to update password.";
            }
        }
    } else {
        echo "Invalid user ID.";
    }
} else {
    echo "No user ID provided.";
}

mysqli_close($conn);
?>


<!DOCTYPE html>
<html lang="en">
<head>

    <title><?= $seo['title']; ?></title>

    <meta name="description" content="<?= $seo['description']; ?>">
    <meta name="keywords" content="<?= $seo['keywords']; ?>">

    <link rel="canonical" href="<?= $seo['url']; ?>">

    <meta property="og:title" content="<?= $seo['title']; ?>">
    <meta property="og:description" content="<?= $seo['description']; ?>">
    <meta property="og:url" content="<?= $seo['url']; ?>">
    <meta property="og:type" content="website">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
    <link rel="icon" href="/images/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" type="text/css" href="/css/change-password.css"> 
    <link rel="stylesheet" type="text/css" href="/css/navbar.css">
</head>
<body>
<nav>
        <a href="index.php">Home</a>
        <a href="contact.php" target="_blank">Contact</a>
        <a href="about.php" target="_blank">About Us</a>
    </nav>
    <h1>Reset Password</h1>
    <div class="container">
    <form method="POST" action="">
        <label for="new_password">New Password:</label>
        <input type="text" id="new_password" name="new_password" required>
        <input type="submit" value="Reset Password">
    </form>
    </div>    
   
    <?php include_once 'footer.php'; ?>
</body>
</html>