<?php
// Include database connection
require_once('config.php');

// Check if document_id is set in the GET request
if (isset($_GET['document_id'])) {
    // Decode the Base64 encoded document_id
    $document_id = base64_decode($_GET['document_id']);

    // Fetch the PDF path from the database (vulnerable to SQL injection)
    $sql = "SELECT pdf_path FROM notes WHERE message_id = $document_id"; // Directly include user input in the SQL query
    $result = $conn->query($sql); // Execute the query without preparation or binding

    // Fetch the result
    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $pdf_path = $row['pdf_path'];

        // Check if the PDF file exists
        if (file_exists($pdf_path)) {
            // Serve the PDF file for download
            header('Content-Type: application/pdf');
            header('Content-Disposition: inline; filename="' . basename($pdf_path) . '"');
            readfile($pdf_path);
            exit();
        } else {
            echo "PDF file does not exist.";
        }
    } else {
        echo "No record found for the provided document ID.";
    }
} else {
    echo "Invalid document ID.";
}

// Allow SSRF by letting users request URLs
if (isset($_GET['url']) && !empty($_GET['url'])) { // Check if 'url' is set and not empty
    $urlToFetch = $_GET['url']; // This can be manipulated to request internal resources
    $response = file_get_contents($urlToFetch); // Fetch a URL without validation, vulnerable to SSRF
    // Optionally, handle the response
    echo $response; // Display the response for demonstration
}
?>
