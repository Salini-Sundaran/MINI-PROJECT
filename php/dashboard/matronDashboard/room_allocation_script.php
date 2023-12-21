<?php
// Include your database connection
include '../../../connection/connection.php';

// Function to get room allocations based on room_id
function getRoomAllocationsByRoomId($room_id)
{
    global $conn;

    // Fetch room details
    $roomQuery = "SELECT * FROM rooms WHERE room_id = '$room_id'";
    $roomResult = mysqli_query($conn, $roomQuery);

    if ($roomResult) {
        $roomDetails = mysqli_fetch_assoc($roomResult);

        // Fetch room allocations
        $allocationQuery = "SELECT hostel_student_list.name, hostel_student_list.admissionNo, hostel_student_list.degree
                            FROM allocations
                            JOIN hostel_student_list ON allocations.admission_no = hostel_student_list.admissionNo
                            WHERE allocations.room_id = '$room_id'";
        $allocationResult = mysqli_query($conn, $allocationQuery);

        if ($allocationResult) {
            $allocations = mysqli_fetch_all($allocationResult, MYSQLI_ASSOC);

            // Organize data
            $roomAllocations = [
                'Room Name' => $roomDetails['room_name'],
                'Capacity' => $roomDetails['capacity'],
                'Allocations' => $allocations
            ];

            return $roomAllocations;
        } else {
            // Handle the case where fetching allocations fails
            echo "Error fetching room allocations for Room ID: $room_id. Please try again.";
            exit();
        }
    } else {
        // Handle the case where fetching room details fails
        echo "Error fetching room details for Room ID: $room_id. Please try again.";
        exit();
    }
}

// Function to get all room allocations
function getAllRoomAllocations()
{
    global $conn;

    // Fetch all room IDs
    $roomIdsQuery = "SELECT DISTINCT room_id FROM allocations";
    $roomIdsResult = mysqli_query($conn, $roomIdsQuery);

    if ($roomIdsResult) {
        $roomIds = mysqli_fetch_all($roomIdsResult, MYSQLI_ASSOC);

        // Initialize an array to store all room allocations
        $allRoomAllocations = [];

        foreach ($roomIds as $roomId) {
            $room_id = $roomId['room_id'];

            // Get allocations for each room
            $roomAllocations = getRoomAllocationsByRoomId($room_id);

            // Add room allocations to the main array
            $allRoomAllocations[] = $roomAllocations;
        }

        return $allRoomAllocations;
    } else {
        // Handle the case where fetching room IDs fails
        echo "Error fetching room IDs. Please try again.";
        exit();
    }
}

// Fetch and return all room allocations
function getRoomAllocations()
{
    // Call the function to get all room allocations
    return getAllRoomAllocations();
}
?>
