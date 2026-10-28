<?php
$servername = "localhost:3306";
$username = "webuser";
$password = "WebUser@123";
$dbname = "hackdrac";
// Create database connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
die("Connection failed: " . $conn->connect_error);
}
/* ?? IMPORTANT: Enable full UTF-8 support (emoji safe) */
$conn->set_charset("utf8mb4");

?>