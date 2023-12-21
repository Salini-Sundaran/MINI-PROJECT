<?php
// Include your connection.php file
include '../../connection/connection.php';

if (isset($_POST['id'])) {
    $id = $_POST['id'];

    // Update the 'morning' and 'night' fields to 1 (verified)
    $updateQuery = "UPDATE attendance SET morning = 1, night = 1 WHERE id = $id";
    mysqli_query($conn, $updateQuery);
}
?>
