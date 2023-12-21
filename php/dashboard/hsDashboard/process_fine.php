<?php
include "../../../connection/connection.php"; // Include your database connection file

// Function to sanitize input data
function sanitizeInput($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize input data
    $date = sanitizeInput($_POST["date"]);
    $admissionNo = sanitizeInput($_POST["admission_no"]);
    $reason = sanitizeInput($_POST["reason"]);
    $status = sanitizeInput($_POST["status"]);
    $amount = sanitizeInput($_POST["amount"]);
    $type = sanitizeInput($_POST["type"]);

    // Insert data into the database
    $sql = "INSERT INTO fine (date, admission_no, reason, status, amount, type)
            VALUES ('$date', '$admissionNo', '$reason', '$status', '$amount', '$type')";

    if ($conn->query($sql) === TRUE) {
        // echo "Fine added successfully";
        echo "<script>alert('Fine added successfully.');</script>";
    
        // Redirect back to food_menu.php
        echo "<script>window.location.href = 'fine.php';</script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
