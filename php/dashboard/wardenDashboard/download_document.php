<?php
session_start();

// Include your database connection
include "../../../connection/connection.php";

// Check if a document ID is provided in the URL
if (isset($_GET['id'])) {
    $documentId = $_GET['id'];

    // Fetch the document details from the database
    $query = "SELECT * FROM files WHERE id = $documentId";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        $document = $result->fetch_assoc();
        $documentPath = $document['file_path'];

        // Debugging: Output the file path
        echo "File Path: $documentPath";

        // Set the Content-Type header to display the PDF in the browser
        header('Content-Type: application/pdf');

        // Debugging: Output any errors during readfile
        set_error_handler(function ($errno, $errstr) {
            echo "Error: [$errno] $errstr";
        }, E_WARNING);
        
        // Output the PDF content
        readfile($documentPath);

        exit();
    }
}

// Redirect back to the document list if the document is not found
header("Location: view_documents.php");
exit();
?>
