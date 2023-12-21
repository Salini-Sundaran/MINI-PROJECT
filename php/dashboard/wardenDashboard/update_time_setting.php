<?php
// Include your database connection file
include "../../../connection/connection.php";

// Get values from the form
$m_start = $_POST['m_start'];
$m_end = $_POST['m_end'];
$n_start = $_POST['n_start'];
$n_end = $_POST['n_end'];
$id = $_POST['id'];

// SQL query to update data in the time_setting table for the given id
$query = "UPDATE time_setting SET m_start='$m_start', m_end='$m_end', n_start='$n_start', n_end='$n_end' WHERE id = $id";

// Execute the query
$result = mysqli_query($conn, $query);

if ($result) {
    // echo "Data updated successfully.";

    echo "<script>alert('Time Updated .');</script>";
    
      
        echo "<script>window.location.href = 'points.php';</script>";
} else {
    echo "Error: " . mysqli_error($conn);
}

// Close the database connection
mysqli_close($conn);
?>
