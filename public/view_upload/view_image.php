<?php

//$file = FCPATH . 'uploads/'.$file_name;+
$file = 'C:/xampp/htdocs/system-integration-codeigniter4-2024/public/uploads/qwewqeq/Capture3.PNG';

// Determine the file extension
//$extension = pathinfo($file, PATHINFO_EXTENSION);
$extension = strtolower(pathinfo($file, PATHINFO_EXTENSION));
             
// Set the appropriate content type based on the file extension
switch ($extension) {
    case 'jpg':
    case 'jpeg':
        $content_type = 'image/jpeg';
        break;
    case 'png':
        $content_type = 'image/png';
        break;
    default:
        // Unsupported file type, handle accordingly
        exit('Unsupported file type');
}

// Send headers to the browser
header('Content-Type: ' . $content_type);
header('Content-Length: ' . filesize($file));

// Output the image file
readfile($file);


?>