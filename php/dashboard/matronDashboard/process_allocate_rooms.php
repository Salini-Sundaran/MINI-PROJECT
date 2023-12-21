<?php
include '../../../connection/connection.php';

// Function to allocate rooms to students
function allocateRooms($degree, $capacity, $students)
{
    global $conn;

    // Fetch available rooms for the given degree
    $roomQuery = "SELECT * FROM rooms WHERE capacity >= $capacity";
    $roomResult = mysqli_query($conn, $roomQuery);

    if ($roomResult) {
        $rooms = mysqli_fetch_all($roomResult, MYSQLI_ASSOC);

        foreach ($students as $student) {
            // Check if the student is already assigned a room
            $existingAllocationQuery = "SELECT * FROM allocations WHERE admission_no = '{$student['admissionNo']}'";
            $existingAllocationResult = mysqli_query($conn, $existingAllocationQuery);

            if (!$existingAllocationResult || mysqli_num_rows($existingAllocationResult) === 0) {
                // Assign a room to the student
                $room = array_shift($rooms);

                if ($room) {
                    $room_id = $room['room_id'];
                    $admission_no = $student['admissionNo'];

                    // Insert the allocation into the allocations table
                    $insertQuery = "INSERT INTO allocations (room_id, admission_no) VALUES ('$room_id', '$admission_no')";
                    $insertResult = mysqli_query($conn, $insertQuery);

                    if (!$insertResult) {
                        // Handle the case where the insertion fails
                        echo "Error inserting allocation for student $admission_no. Please try again.";
                        exit();
                    }
                } else {
                    // Handle the case where there are not enough available rooms
                    echo "Not enough available rooms for students in degree $degree.";
                    exit();
                }
            }
        }
    } else {
        // Handle the case where fetching rooms fails
        echo "Error fetching rooms for degree $degree. Please try again.";
        exit();
    }

    // Display completion message
echo "Room allocation for $degree completed successfully.";
echo '<script>alert("Error verifying existing password.");</script>';
    // Use JavaScript to show an alert
    echo '<script>alert("Room allocation for ' . $degree . ' completed successfully.");</script>';
}

// Fetch students by degree
$degrees = ['B.Tech', 'M.Tech', 'B.Arch', 'MCA'];

foreach ($degrees as $degree) {
    $studentQuery = "SELECT * FROM hostel_student_list WHERE degree = '$degree' LIMIT 4";
    $studentResult = mysqli_query($conn, $studentQuery);

    if ($studentResult) {
        $students = mysqli_fetch_all($studentResult, MYSQLI_ASSOC);
        $capacity = count($students);

        // Allocate rooms for the current degree
        allocateRooms($degree, $capacity, $students);
    } else {
        // Handle the case where fetching students fails
        echo "Error fetching students for degree $degree. Please try again.";
        exit();
    }
}

// Redirect back to the Matron Dashboard or any other appropriate page
header('Location: matron_dashboard.php');
exit();
?>
