<?php
include '../../../connection/connection.php';

if (isset($_POST['delete']) && isset($_POST['delete_rooms'])) {
    $roomsToDelete = $_POST['delete_rooms'];

    foreach ($roomsToDelete as $roomId) {
        // Delete the selected room from the rooms table
        $deleteQuery = "DELETE FROM rooms WHERE room_id = '$roomId'";
        $deleteResult = mysqli_query($conn, $deleteQuery);

        if (!$deleteResult) {
            // Handle the case where the deletion fails
            echo "Error deleting room $roomId from the database. Please try again.";
            exit();
        }
    }

    // Redirect back to the Matron Dashboard or any other appropriate page
    header('Location: matron_dashboard.php');
    exit();
}
?>
