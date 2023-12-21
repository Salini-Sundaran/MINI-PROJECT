<?php
include '../../../connection/connection.php';

if (isset($_POST['product_id'])) {
    $productId = $_POST['product_id'];

    // Perform the delete operation
    $deleteQuery = "DELETE FROM stock WHERE product_id = $productId";
    mysqli_query($conn, $deleteQuery);
}

// Redirect back to the main page after deletion
header("Location: stock.php");
exit();
?>
