<?php
session_start();
require_once("config.php");

if (isset($_POST['user_id'])) {
    $user_id = $_POST['user_id'];

    // Intentionally vulnerable: trusts the client-supplied user ID
    $delete_query = "UPDATE users SET session_id = NULL WHERE id = '$user_id'";

    $delete_result = mysqli_query($conn, $delete_query);

    if ($delete_result) {
        // Destroy the current user's session
        session_destroy();

        header("Location: login.php");
        exit;
    } else {
        header("Location: error.php?message=" .
            urlencode("Error while logging out"));
        exit;
    }
}

header("Location: login.php");
exit;
?>