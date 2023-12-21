<?php
require_once '../connection/connection.php'; // Include your database connection file
session_start(); // Start the session
$username = $_SESSION['username'];
$role = $_SESSION['role'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize the user input (you should implement more robust validation)
    $feedback = htmlspecialchars($_POST['feedback']);

    // Fetch additional data from the `hostel_student_list` table
    $sql_fetch_data = "SELECT name, branch, degree FROM hostel_student_list WHERE admissionNo = ?";
    $stmt_fetch_data = $conn->prepare($sql_fetch_data);
    $stmt_fetch_data->bind_param("s", $username);
    $stmt_fetch_data->execute();
    $stmt_fetch_data->store_result();

    // Check if a matching record is found
    if ($stmt_fetch_data->num_rows > 0) {
        $stmt_fetch_data->bind_result($student_name, $student_branch, $student_degree);
        $stmt_fetch_data->fetch();

        // Insert the complaint into the `complaint_box` table
        $sql_insert_complaint = "INSERT INTO food_feedback (feedback, admission_no, name, branch_name, degree) VALUES (?, ?, ?, ?, ?)";
        $stmt_insert_complaint = $conn->prepare($sql_insert_complaint);
        $stmt_insert_complaint->bind_param("sssss", $feedback, $username, $student_name, $student_branch, $student_degree);

        if ($stmt_insert_complaint->execute()) {
            // Successfully added the complaint to the database
            echo "Feedback Added.";
        } else {
            // Error handling if the complaint couldn't be added
            echo "Error: " . $conn->error;
        }
        
        // Close the statement for inserting the complaint
        $stmt_insert_complaint->close();
    } else {
        echo "Student data not found in the database.";
    }

    // Close the statement for fetching data
    $stmt_fetch_data->close();
} else {
    // Redirect the user if they try to access this script directly
    header('Location: complaint_form.php'); // Replace with the actual path to your complaint form page
}

// Close the database connection
$conn->close();
?>
