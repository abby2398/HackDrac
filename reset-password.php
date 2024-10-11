<?php
session_start();
require_once("config.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the email from the form
    $email = $_POST['email']; 

    // Check if the email exists in the database
    $checkEmailQuery = "SELECT * FROM users WHERE email = '$email'";
    $result = mysqli_query($conn, $checkEmailQuery);

    if (mysqli_num_rows($result) > 0) {
        // Email exists, fetch user ID
        $user = mysqli_fetch_assoc($result);
        $userId = $user['id']; // Assuming 'id' is the user's ID

        // Generate a random token for the reset link (not validated)
        $randomToken = bin2hex(random_bytes(16)); // Generates a random 32-character hex string

        // Send password reset link using the Host header directly
        $resetLink = "http://" . $_SERVER['HTTP_HOST'] . "/reset-password-confirm.php?id=" . $userId. "&token=" . $randomToken;
        $subject = "Password Reset Request";
        $message = "Click the following link to reset your password: $resetLink";
        $headers = "From: noreply@yourwebsite.com";


        // use this html because no mail server has been setup yet--------------*********------------
        echo "Since there is no SMTP configured on your server, the reset password link is shown below.<br>THIS IS NOT A VULNERABILITY!<br>";
        print_r($resetLink);
        die;
        //--------------*********--------------------------*********------------




        if (mail($email, $subject, $message, $headers)) {
            
            echo "A password reset link has been sent to your email.";
        } else {
            echo "Failed to send email.";
        }
    } else {
        echo "<script>alert('No account found with that email.');</script>";
        echo "<script>window.location.href = 'forget.php';</script>";
        exit;
    }
}

mysqli_close($conn);
?>