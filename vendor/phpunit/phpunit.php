<?php
require_once "../../config.php";

$ip = $_SERVER['REMOTE_ADDR'];
$userAgent = $_SERVER['HTTP_USER_AGENT'] ?? '';

mysqli_query($conn, "
INSERT INTO visitor_logs 
(ip_address, country, city, user_agent, request_method, request_uri, suspicious_flag)
VALUES ('$ip', 'Honeypot', 'Trap', '$userAgent', 'GET', 'phpunit_trap', 1)
");

http_response_code(403);
echo "Forbidden";
exit;
?>