<?php
// Include your database connection file
include "../../../connection/connection.php";

// Check if the 'id' parameter is set in the URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // SQL query to delete data from the staff table for the given ID
    $query = "DELETE FROM staff WHERE id = $id";

    // Execute the query
    $result = mysqli_query($conn, $query);

    // Check if the query was successful
    if ($result) {
        // Redirect to the staff list page or handle accordingly
        header("Location: staff.php");
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
    }
} else {
    // If 'id' parameter is not set, redirect to the staff list page or handle accordingly
    header("Location: staff.php");
    exit();
}

// Close the database connection
mysqli_close($conn);
?>
