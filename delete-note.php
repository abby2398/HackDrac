<?php
session_start();
require_once("config.php"); // Include your database connection

// Check if the user is logged in
if (!isset($_SESSION["authenticated"]) || $_SESSION["authenticated"] !== true) {
    header("Location: login.php");
    exit;
}
$id = $_SESSION["id"];

// Check if note_id is provided in the POST request
if (isset($_POST['note_id'])) {
    $note_id = $_POST['note_id']; // IDOR vulnerability, no validation
    $user_id = $_SESSION['id']; // User ID taken directly from session

    // Vulnerability: SQL Injection (direct user input used in SQL query)
    $deleteQuery = "DELETE FROM notes WHERE message_id = $note_id"; 
    $result = mysqli_query($conn, $deleteQuery);
      
    if ($result) {
        echo "<script>alert('Your message has been deleted successfully!');</script>";
    } else {
        echo '<p class="error-message">Error deleting note: ' . mysqli_error($conn) . '</p>';
    }
} else {
    echo '<p class="error-message">No note ID provided.</p>';
}

// Redirect back to notes page after deletion
header("Location: dashboard.php?id=$id");
exit;
?>
