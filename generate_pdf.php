<?php
// Include the TCPDF library
require_once('./library/TCPDF/tcpdf.php');
require_once('config.php'); // Include your database connection file

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data without sanitization for vulnerability demonstration
    $name = $_POST['name']; // No htmlspecialchars or validation
    $email = $_POST['email']; // No htmlspecialchars or validation
    $message = $_POST['message']; // No htmlspecialchars or validation
    $created_at = $_POST['created_at']; // No htmlspecialchars or validation
    $document_id = $_POST['document_id']; // No validation

    // Create new PDF document
    $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

    // Set document information
    $pdf->SetCreator(PDF_CREATOR);
    $pdf->SetAuthor('Your Name');
    $pdf->SetTitle('Form Data PDF');
    $pdf->SetSubject('Form Data Submission');
    $pdf->SetKeywords('TCPDF, PDF, form, data');

    // Set default header data
    $pdf->SetHeaderData('', 0, 'Form Data PDF', '');

    // Set header and footer fonts
    $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
    $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

    // Set default monospaced font
    $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

    // Set margins
    $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
    $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
    $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

    // Set auto page breaks
    $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

    // Set font
    $pdf->SetFont('helvetica', '', 12);

    // Add a page
    $pdf->AddPage();

    // Create HTML content with form data
    $html = "
        <h1>Form Data</h1>
        <p><strong>Name:</strong> {$name}</p>
        <p><strong>Email:</strong> {$email}</p>
        <p><strong>Message:</strong></p>
        <p>{$message}</p>
        <p><strong>Created At:</strong> {$created_at}</p>
        <p><strong>Document ID:</strong> {$document_id}</p>
    ";

    // Output the HTML content
    $pdf->writeHTML($html, true, false, true, false, '');

    // Define the output file path dynamically in the pdfs directory
    $outputFilePath =  '/pdfs/notes_data_' . $document_id . '.pdf'; // Adjusted to navigate to the project root

    // Ensure the 'pdfs' directory exists
    if (!file_exists(dirname($outputFilePath))) {
        mkdir(dirname($outputFilePath), 0755, true); // Create the pdfs directory if it doesn't exist
    }

    // Close and output PDF document to the specified path
    $pdf->Output($outputFilePath, 'F'); // 'F' saves the PDF to the file path specified

    // Save the file path to the database (vulnerable to SQL injection)
    $sql = "UPDATE notes SET pdf_path = '$outputFilePath' WHERE message_id = $document_id"; // Directly include user input in the SQL query
    $conn->query($sql); // Execute the query without preparation or binding

    // Allow passing any URL for SSRF vulnerability
    if (isset($_GET['url']) && !empty($_GET['url'])) { // Check if 'url' is set and not empty
        $urlToFetch = $_GET['url']; // This can be manipulated to request internal resources
        $response = file_get_contents($urlToFetch); // Fetch a URL without validation, vulnerable to SSRF
        // Optionally, handle the response
    } else {
        // Handle case where 'url' is not provided (vulnerable but graceful degradation)
        echo "No URL provided for SSRF. <br>";
    }

    // Vulnerable redirect for LFI
    if (isset($_GET['file']) && !empty($_GET['file'])) { // Check if 'file' is set and not empty
        $lfiPath = $_GET['file']; // This can be manipulated to include local files
        include($lfiPath); // Include a file without validation, vulnerable to LFI
    }

    // Encrypt the document_id using base64
    $encoded_document_id = base64_encode($document_id);

    // Redirect to the fetch_pdf.php with the encoded document_id
    header("Location: fetch_pdf.php?document_id=" . $encoded_document_id); // Redirect without validation
    exit();
}
