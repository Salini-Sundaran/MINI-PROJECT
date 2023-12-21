<?php
session_start(); // Start the session

// Include the database connection file
include '../../../connection/connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the input data from the form
    $id = $_POST['id'];
    $p_y1 = $_POST['p_y1'];
    $p_y2 = $_POST['p_y2'];
    $p_y3 = $_POST['p_y3'];
    $p_y4 = $_POST['p_y4'];
    $pg = $_POST['pg'];
    $total = $_POST['total'];
    $t_y1 = $_POST['t_y1'];
    $t_y2 = $_POST['t_y2'];
    $t_y3 = $_POST['t_y3'];
    $t_y4 = $_POST['t_y4'];
    $t_pg = $_POST['t_pg'];

    // Update the data in the database
    $updateSql = "UPDATE points SET 
                    p_y1 = ?, p_y2 = ?, p_y3 = ?, p_y4 = ?, pg = ?, 
                    total = ?, t_y1 = ?, t_y2 = ?, t_y3 = ?, t_y4 = ?, t_pg = ? 
                  WHERE id = 1";
    $updateStmt = $conn->prepare($updateSql);
    $updateStmt->bind_param("iiiiiiiiiii", 
                            $p_y1, $p_y2, $p_y3, $p_y4, $pg, 
                            $total, $t_y1, $t_y2, $t_y3, $t_y4, $t_pg,);

    if ($updateStmt->execute()) {
        // Display a success pop-up message
        echo "<script>alert('Point Allocation and Number of Seats updated successfully.');</script>";
        
        // Redirect back to the form page
        echo "<script>window.location.href = 'points.php';</script>";
    } else {
        // Display an error pop-up message
        echo "<script>alert('Error updating data: " . $updateStmt->error . "');</script>";
        
        // Redirect back to the form page
        echo "<script>window.location.href = 'points.php';</script>";
    }

    $updateStmt->close();
} else {
    // Display an error pop-up message for an invalid request method
    echo "<script>alert('Invalid request method.');</script>";
    
    // Redirect back to the form page
    echo "<script>window.location.href = 'points.php';</script>";
}
?>
