<?php
$query = "SELECT COUNT(*) as total_students FROM hostel_student_registration";
$result = mysqli_query($conn, $query);

// Check if the query was successful
if ($result) {
    $row = mysqli_fetch_assoc($result);
    $totalStudents = $row['total_students'];
} else {
    // Handle the error, if any
    $totalStudents = "Error fetching data";
}

$query1 = "SELECT COUNT(*) as total_students FROM hostel_student_list";
$result1 = mysqli_query($conn, $query1);

// Check if the query was successful
if ($result1) {
    $row1 = mysqli_fetch_assoc($result1);
    $totalStudents1 = $row1['total_students'];
} else {
    // Handle the error, if any
    $totalStudents1 = "Error fetching data";
}



// Close the database connection
// mysqli_close($conn);
?>




