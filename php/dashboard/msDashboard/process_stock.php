<?php
session_start();
include '../../../connection/connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the username from the session
    $username = $_SESSION['username'];

    // Handle file uploads
    $targetDir = __DIR__ . "/uploads/";
    $billImageName = $username . "_" . "Bill Image" . "_" . basename($_FILES["bill_image"]["name"]);
    $billImagePath = $targetDir . $billImageName;

    // Move uploaded file to destination
    if (move_uploaded_file($_FILES["bill_image"]["tmp_name"], $billImagePath)) {
        // Get other form data
        $productName = mysqli_real_escape_string($conn, $_POST['product_name']);
        $quantity = mysqli_real_escape_string($conn, $_POST['quantity']);
        $unitPrice = mysqli_real_escape_string($conn, $_POST['unit_price']);
        $dateAdded = mysqli_real_escape_string($conn, $_POST['date_added']);
        $notes = mysqli_real_escape_string($conn, $_POST['notes']);

        // Store data in the database
        $query = "INSERT INTO stock (product_name, quantity, unit_price, date_added, notes, bill_image) VALUES 
                  ('$productName', '$quantity', '$unitPrice', '$dateAdded', '$notes', '$billImagePath')";

        if ($conn->query($query) === TRUE) {
            echo "<script>
                  alert('Product added successfully.');
                  window.location.href = 'stock.php';
                  </script>";
        } else {
            echo "Error: " . $query . "<br>" . $conn->error;
        }
    } else {
        echo "Error uploading file.";
    }

    $conn->close();
}
?>
