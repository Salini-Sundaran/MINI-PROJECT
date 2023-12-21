<?php
session_start();

// Include your database connection
include "../../../connection/connection.php";

// Verify the document based on the document ID
if (isset($_GET['id'])) {
    $documentId = $_GET['id'];
    $query = "UPDATE files SET verified = 1 WHERE id = $documentId";
    $conn->query($query);
}

$conn->close();

// Redirect back to the document list page
header("Location: document_verification.php");
exit();
?>
