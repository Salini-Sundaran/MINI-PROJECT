<?php
// Database connection parameters
include '../../../connection/connection.php';

// SQL query to truncate the table
$sql = "TRUNCATE TABLE hostel_student_registration";

// Execute the query
if ($conn->query($sql) === TRUE) {
    echo "<script>alert('Data Cleared successfully.');</script>";
    
      
    echo "<script>window.location.href = 'points.php';</script>";
} else {
    echo "Error truncating table: " . $conn->error;
}

// Close the connection
$conn->close();
?>
