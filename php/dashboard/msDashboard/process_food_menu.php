<?php
session_start(); // Start the session

// Include the database connection file
include '../../../connection/connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if the admission number exists and is valid
    // Get the input data from the form
    $menu_id = 1; // Get the menu_id from the hidden input field
    $breakfast_item = $_POST['breakfast_item'];
    $lunch_item = $_POST['lunch_item'];
    $evening_item = $_POST['evening_item'];
    $dinner_item = $_POST['dinner_item'];

    if (is_numeric($menu_id)) {
        // Update the food menu items in the database
        $updateSql = "UPDATE food_menu SET breakfast_item = ?, lunch_item = ?, evening_item = ?, dinner_item = ? WHERE menu_id = ?";
        $updateStmt = $conn->prepare($updateSql);
        $updateStmt->bind_param("ssssi", $breakfast_item, $lunch_item, $evening_item, $dinner_item, $menu_id);

        if ($updateStmt->execute()) {
            // Display a success pop-up message
            echo "<script>alert('Food menu items updated successfully.');</script>";
            
            // Redirect back to food_menu.php
            echo "<script>window.location.href = 'food_menu.php';</script>";
        } else {
            // Display an error pop-up message
            echo "<script>alert('Error updating food menu items: " . $updateStmt->error . "');</script>";
            
            // Redirect back to food_menu.php
            echo "<script>window.location.href = 'food_menu.php';</script>";
        }

        $updateStmt->close();
    } else {
        // Display an error pop-up message for an invalid menu_id
        echo "<script>alert('Invalid menu_id provided.');</script>";
        
        // Redirect back to food_menu.php
        echo "<script>window.location.href = 'food_menu.php';</script>";
    }
} else {
    // Display an error pop-up message for an invalid request method
    echo "<script>alert('Invalid request method.');</script>";
    
    // Redirect back to food_menu.php
    echo "<script>window.location.href = 'food_menu.php';</script>";
}
?>
