<?php
// Include database connection
require_once('config.php');

// Check if document_id is set in the GET request
if (isset($_GET['document_id'])) {
    // document_id is base64-encoded on the client/redirect side.
    // Decode it and use it directly as a filename inside pdfs/ -- no sanitization,
    // no basename()/realpath() containment check. Intentionally vulnerable to LFI:
    // base64_encode('../../../../etc/passwd') style payloads will break out of pdfs/.
    $document_id = $_GET['document_id'];
    $decodedName = base64_decode($document_id);
    $pdf_path = __DIR__ . '/pdfs/' . $decodedName; // no path sanitization -> LFI

    // Check if the PDF file exists
    if (file_exists($pdf_path)) {
        // Serve the file for download
        header('Content-Type: application/pdf');
        header('Content-Disposition: inline; filename="' . basename($pdf_path) . '"');
        readfile($pdf_path);
        exit();
    } else {
        echo "PDF file does not exist.";
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
