<?php
include '../../../connection/connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if 'product_id' is set in the POST data
    if (isset($_POST['product_id'])) {
        $productId = $_POST['product_id'];

        // Perform the update query to set 'hs' to 1
        $updateQuery = "UPDATE stock SET hs = 1 WHERE product_id = $productId";
        $result = mysqli_query($conn, $updateQuery);

        if ($result) {
            // Successful update
            header("Location: stock.php");
        } else {
            // Failed to update
            echo "Error updating verification status: " . mysqli_error($conn);
        }
    } else {
        // 'product_id' is not set in POST data
        echo "Product ID not provided.";
    }
} else {
    // Invalid request method
    echo "Invalid request method.";
}

// Close the database connection
mysqli_close($conn);
?>
