<?php
include "../../../connection/connection.php"; // Include your database connection file

// Start the session
session_start();

// Check if the admission number is set in the session
if (isset($_SESSION['username'])) {
    $admissionNo = $_SESSION['username'];

    // Delete from hostel_student_list
    $deleteHostelStudentListSQL = "DELETE FROM hostel_student_list WHERE admissionNo = '$admissionNo'";
    $conn->query($deleteHostelStudentListSQL);

    // Delete from login
    $deleteLoginSQL = "DELETE FROM login WHERE username = '$admissionNo'";
    $conn->query($deleteLoginSQL);

    // Check for errors
    if ($conn->error) {
        echo "Error: " . $conn->error;
    } else {
        // echo "Rows deleted successfully.";
        echo "<script>alert('Account Deleted.');</script>";
    
      
        echo "<script>window.location.href = 'student_dashboard.php';</script>";
    }
} else {
    echo "Admission number not set in session.";
}

// Close the database connection
$conn->close();
?>
