<?php
// Database connection parameters
include '../../../connection/connection.php';


// SQL query to copy data from one table to another
$sql = "INSERT INTO hostel_student_registration_backup SELECT * FROM hostel_student_registration";

// Execute the query
if ($conn->query($sql) === TRUE) {
    echo "<script>alert('Backup completed.');</script>";
    
      
    echo "<script>window.location.href = 'points.php';</script>";} else {
    echo "Error copying data: " . $conn->error;
}

// Close the connection
$conn->close();
?>
