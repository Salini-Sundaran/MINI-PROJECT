<?php
// Include your connection.php file
include '../../../connection/connection.php';

// Check if the 'id' parameter is set
if (isset($_POST['id'])) {
    $attendanceId = $_POST['id'];

    // Update the 'hs' field to 1 for the specified attendance ID
    $updateQuery = "UPDATE attendance SET hs = 1 WHERE id = $attendanceId";
    $result = mysqli_query($conn, $updateQuery);

    if ($result) {
        // Return a success message
        echo "Successfully updated 'hs' field for ID: $attendanceId";
    } else {
        // Return an error message
        echo "Error updating 'hs' field: " . mysqli_error($conn);
    }
} else {
    // Return an error message if 'id' parameter is not set
    echo "Error: 'id' parameter not set";
}
?>
