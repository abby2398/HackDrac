<?php
include 'seo.php';
session_start();
require_once("config.php");

if (!isset($_SESSION["authenticated"]) || $_SESSION["authenticated"] !== true) {
    header("Location: login.php");
    exit;
}
$id = $_SESSION["id"];

if (isset($_FILES["profileImage"]) && $_FILES["profileImage"]["error"] == UPLOAD_ERR_OK) {
    $email = $_SESSION["email"];
    $uploadDir = "images/uploads/";
    $uniqueFilename =  $_FILES["profileImage"]["name"];
    $uploadPath = $uploadDir . $uniqueFilename;

    if (move_uploaded_file($_FILES["profileImage"]["tmp_name"], $uploadPath)) {
        
        $updateSql = "UPDATE users SET ProfileImage = '$uploadPath' WHERE email = '$email'";
        mysqli_query($conn, $updateSql);
        echo "<script>alert('Your profile picture was uploaded.');</script>";
        echo "<script>window.location.href = 'dashboard.php?id=$id';</script>";
    }
}

$referrer = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : 'dashboard.php';

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
    <link rel="stylesheet" type="text/css" href="/css/edit-profile.css"> 
    <link rel="stylesheet" type="text/css" href="/css/navbar.css">
    <link rel="stylesheet" type="text/css" href="/css/dashboard.css">
</head>
<body>
<nav>
        <a href="index.php">Home</a>
        <a href="contact.php" target="_blank">Contact</a>
        <a href="about.php" target="_blank">About Us</a>
    </nav>
    
    <div>
    
    <h2>Update Profile</h2>
    </div>
    <div class="right-bar">
    <a href="<?php echo $referrer; ?>"><h4 class="back-btn">Go back</h4></a>
        <form action="logout.php" method="post" class="logout-form">
        <input type="submit" class="logout-button" value="Logout">
        </form>
    </div>
    <!-- ------------------------*******Change Password*************------------------------ -->
    <div class="container">
        <form method="POST" action="change-password.php" class="form-pass">
            <label>New Password</label>
            <input type="password" name="newPassword" style="
                                                        margin-left: 86px;
                                                    "/><br>
            <label>Confirm New Password</label>
            <input type="password" name="confirmPassword" style="
                                                   margin-left: 25px;
                                                    margin-top: 10px;
                                                    margin-bottom: 10px;
                                                    "/></br>
        
            <input type="submit" name="submit" value="Update Password"/>
        </form>
    </div>    

    <!-- ------------------------*********DeleteAccount***********------------------------ -->
    <div class="container">
    <h2>Danger Zone</h2>
    <!-- Vulnerable Account Deletion -->
    <form action="delete_account.php" method="POST">
        <input type="submit" name="deleteAccount" value="Delete Account">
    </form>
    </div> 

    <!-- ------------------------**********Upload profile**********------------------------ -->
    <div class="container">
    <form action="edit-profile.php" method="post" enctype="multipart/form-data">
        <label for="profileImage">Upload Profile Picture:</label>
        <input type="file" id="profileImage" name="profileImage" accept="image/*">
        <br>
        <input type="submit" value="Upload" style = "margin-top: 10px">
    </form>
    </div>
<!-- ------------------------***********update username*********------------------------ -->
    <div class="container">
    <form action="edit-profile.php" method="post">
        <label>Update username</label>
        <input type="text" name="username" style = "margin-left: 80px"/>
        <br>
        <input type="submit" value="Update username" style = "margin-top: 10px">
    </form>
    </div>
    <?php include_once 'footer.php'; ?>
</body>
</html>