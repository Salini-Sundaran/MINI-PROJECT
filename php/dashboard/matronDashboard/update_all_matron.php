<?php
// Include your connection.php file
include '../../../connection/connection.php';

// Get the current date
$currentDate = date("Y-m-d");

// Update the 'hs' field to 1 for all records with the current date
$updateAllQuery = "UPDATE attendance SET matron = 1 WHERE date = '$currentDate'";
$result = mysqli_query($conn, $updateAllQuery);

if ($result) {
    // Return a success message
    echo "Successfully confirmed all rows for the current date";
} else {
    // Return an error message
    echo "Error confirming all rows: " . mysqli_error($conn);
}
?>
