<?php
// Assuming $conn is your database connection variable
include "../../../connection/connection.php";

if (isset($_GET['date']) && isset($_GET['admission_no'])) {
    $date = $_GET['date'];
    $admission_no = $_GET['admission_no'];

    // Update the status to 'Paid'
    $updateQuery = "UPDATE fine SET status = 'Paid' WHERE date = '$date' AND admission_no = '$admission_no'";
    $updateResult = mysqli_query($conn, $updateQuery);

    if ($updateResult) {
        echo 'Status updated successfully!';
    } else {
        echo 'Error updating status: ' . mysqli_error($conn);
    }
} else {
    echo 'Invalid parameters.';
}
?>
