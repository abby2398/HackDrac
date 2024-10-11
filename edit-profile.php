<?php
session_start();
require_once("config.php");

if (!isset($_SESSION["authenticated"]) || $_SESSION["authenticated"] !== true) {
    header("Location: login.php");
    exit;
}

// // Check if a new username is being submitted
// if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["username"])) {
//     // Directly using user input without sanitization or validation
//     $newUsername = $_POST["username"];

//     // Update the username in the database (vulnerable to SQL injection)
//     $updateUsernameQuery = "UPDATE users SET username = '$newUsername' WHERE email = '" . $_SESSION['email'] . "'";
//     mysqli_query($conn, $updateUsernameQuery);
    
//     // For SSTI vulnerability demonstration
//     //echo "<script>alert('Your username has been updated to: $newUsername');</script>";
//     echo "<h3>Your username has been updated to: {{ '$newUsername' }}</h3>";
// }
$referrer = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : 'dashboard.php';

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
    <link rel="icon" href="/images/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" type="text/css" href="/css/edit-profile.css"> 
    <link rel="stylesheet" type="text/css" href="/css/navbar.css">
</head>
<body>
<nav>
        <a href="index">Home</a>
        <a href="contact" target="_blank">Contact</a>
        <a href="about" target="_blank">About Us</a>
    </nav>
    
    <div>
    <a href="<?php echo $referrer; ?>"><h4 class="back-btn">Go back</h4></a>
    <h2>Update Profile</h2>
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
    <form action="upload.php" method="post" enctype="multipart/form-data">
        <label for="profileImage">Upload Profile Picture:</label>
        <input type="file" id="profileImage" name="profileImage" accept="image/*">
        <br>
        <input type="submit" value="Upload" style = "margin-top: 10px">
    </form>
    </div>
<!-- ------------------------***********update username*********------------------------ -->
    <!-- <div class="container">
    <form action="edit-profile.php" method="post">
        <label>Update username</label>
        <input type="text" name="username" style = "margin-left: 80px"/>
        <br>
        <input type="submit" value="Update username" style = "margin-top: 10px">
    </form>
    </div> -->
    <?php include_once 'footer.php'; ?>
</body>
</html>