<?php
include '../../../connection/connection.php';

if (isset($_POST['submit'])) {
    $totalRooms = $_POST['rooms'];

    // Get the current maximum room_id
    $maxRoomQuery = "SELECT MAX(room_id) AS max_room_id FROM rooms";
    $maxRoomResult = mysqli_query($conn, $maxRoomQuery);
    $row = mysqli_fetch_assoc($maxRoomResult);
    $maxRoomId = $row['max_room_id'];

    for ($i = $maxRoomId + 1; $i <= $maxRoomId + $totalRooms; $i++) {
        $roomName = "Room " . $i;
        $capacity = 4; // Default capacity

        // Insert the room into the rooms table
        $insertQuery = "INSERT INTO rooms (room_id, room_name, capacity) VALUES ('$i', '$roomName', '$capacity')";
        $insertResult = mysqli_query($conn, $insertQuery);

        if (!$insertResult) {
            // Handle the case where the insert fails
            echo "Error inserting room $i into the database. Please try again.";
            exit();
        }
    }

    // Redirect back to the Matron Dashboard or any other appropriate page
    header('Location: matron_dashboard.php');
    exit();
}
?>
