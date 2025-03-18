<?php
session_start();
require_once("config.php");

if (!isset($_SESSION["authenticated"]) || $_SESSION["authenticated"] !== true) {
    header("Location: login.php");
    exit;
}

$id = $_SESSION["id"];


if(isset($_POST['message'])){
        $message = $_POST['message'];
        
        $createNote = "INSERT INTO notes (message, user_id) VALUES ('$message', '$id')";
        if ($conn->query($createNote) === TRUE) {
            echo "<script>alert('Your message has been saved successfully!');</script>";
            // After successfully processing the form data and inserting into the database
            echo "<script>window.location.href = 'dashboard.php';</script>";
            exit;
        } else {
            echo '<p class="error-message">Error: ' . $conn->error . '</p>';
        }
}   

?>
