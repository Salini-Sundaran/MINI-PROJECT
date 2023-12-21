<?php
// Include your database connection
include "../../../connection/connection.php";

// Check if the admission number is provided
if (isset($_POST['admission_no'])) {
    $admissionNo = $_POST['admission_no'];

    // Update the 'matron' field to 1 for the provided admission number
    $updateQuery = "UPDATE home_register SET matron = 1 WHERE admission_no = $admissionNo";
    $updateResult = mysqli_query($conn, $updateQuery);

    if ($updateResult) {
        // Return a success message if the update is successful
        echo "Update successful";
    } else {
        // Return an error message if the update fails
        echo "Error updating the record: " . mysqli_error($conn);
    }
} else {
    // Return an error message if the admission number is not provided
    echo "Admission number not provided";
}

// Close the database connection
$conn->close();
?>
