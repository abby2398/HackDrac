<?php
$servername = "localhost:3306";
$username = "root";
$password = "";
$dbname = "hackdrac_logs";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

/* 🔥 IMPORTANT: Enable full UTF-8 support (emoji safe) */
$conn->set_charset("utf8mb4");

require_once "logger.php";
?>