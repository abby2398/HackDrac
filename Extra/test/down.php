<?php
// Directory path where this script resides
$scriptDir = __DIR__;

// Directory path to the directory you want to zip (outside of the script directory)
$dirToZip = 'C:\xampp\htdocs\hms'; // Replace with the desired path

$zipname = 'downloaded_files.zip';

// Create a zip file and add all files in the specified directory
$zip = new ZipArchive();
if ($zip->open($zipname, ZipArchive::CREATE) === TRUE) {
    $files = new RecursiveIteratorIterator(
        new RecursiveDirectoryIterator($dirToZip),
        RecursiveIteratorIterator::SELF_FIRST
    );

    foreach ($files as $file) {
        // Exclude ".", "..", and the script file itself
        if ($file->isFile() && $file->getRealPath() !== realpath($scriptDir . '/download-all.php')) {
            $relativePath = substr($file->getRealPath(), strlen(realpath($dirToZip)) + 1);
            $zip->addFile($file->getRealPath(), $relativePath);
        }
    }
    $zip->close();
    
    // Set headers to force download
    header('Content-Type: application/zip');
    header('Content-Disposition: attachment; filename="' . $zipname . '"');
    header('Content-Length: ' . filesize($zipname));
    
    // Output the zip file to the browser
    readfile($zipname);
    
    // Delete the zip file after download
    unlink($zipname);
    exit;
} else {
    echo 'Unable to create zip file.';
}
?>
