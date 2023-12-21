<?php
// Include your connection.php file
include '../../../connection/connection.php';

// Assuming you have a session variable for student ID
$student_id = $_SESSION['username'];

// Replace the following query with the actual query to fetch details
$query = "SELECT yearOfStudy, semester, mobile FROM hostel_student_list WHERE admissionNO  = '$student_id'";
$result = mysqli_query($conn, $query);

// Check if the query was successful
if ($result) {
    $details = mysqli_fetch_assoc($result);
    // Return details as JSON
    echo json_encode($details);
} else {
    // Handle the case where the query fails
    echo json_encode(['error' => 'Failed to fetch details']);
}
?>
