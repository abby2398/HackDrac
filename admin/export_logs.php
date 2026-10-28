<?php
require_once("../config.php");

header('Content-Type: text/csv');
header('Content-Disposition: attachment;filename=security_logs.csv');

$output = fopen("php://output", "w");

fputcsv($output, [
    'IP',
    'Country',
    'City',
    'Method',
    'URI',
    'Suspicious',
    'Time'
]);

$result = mysqli_query($conn, "SELECT * FROM visitor_logs ORDER BY id DESC");

while ($row = mysqli_fetch_assoc($result)) {
    fputcsv($output, [
        $row['ip_address'],
        $row['country'],
        $row['city'],
        $row['request_method'],
        $row['request_uri'],
        $row['suspicious_flag'],
        $row['created_at']
    ]);
}

fclose($output);
exit;
?>