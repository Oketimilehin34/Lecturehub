<?php
if (isset($_GET['file'])) {
    $file_name = basename($_GET['file']); // prevent directory traversal

    $file_path = 'uploads/' . $file_name; // adjust path if needed

    if (file_exists($file_path)) {
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="' . $file_name . '"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($file_path));
        readfile($file_path);
        exit;   
    } else {
        echo "File not found.";
    }
} else {
    echo "No file specified.";
}
?> 
