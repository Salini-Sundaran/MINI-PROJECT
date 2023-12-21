<?php
// Include your connection.php file
include '../../../connection/connection.php';
session_start(); 
// Assuming you have a session variable for student ID
$student_id = $_SESSION['username'];

// Get updated details from the form
$updatedYearOfStudy = mysqli_real_escape_string($conn, $_POST['yearOfStudy']);
$updatedSemester = mysqli_real_escape_string($conn, $_POST['semester']);
$updatedMobile = mysqli_real_escape_string($conn, $_POST['mobile']);

// Update details in the database
$updateQuery = "UPDATE hostel_student_list SET yearOfStudy = '$updatedYearOfStudy', semester = '$updatedSemester', mobile = '$updatedMobile' WHERE admissionNo = '$student_id'";
$updateResult = mysqli_query($conn, $updateQuery);

if ($updateResult) {
    // Handle success, e.g., redirect to a success page
    echo "Profile Updated Successfully.";
    header('Location: student_dashboard.php');
    exit();
} else {
    // Handle failure, e.g., redirect to an error page
    header('Location: error.php');
    exit();
}
?>
