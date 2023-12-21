<?php
// Include your database connection file
include "../../../connection/connection.php";

// Get values from the form
$name = $_POST['name'];
$address = $_POST['address'];
$phone = $_POST['phone'];
$email = $_POST['email'];
$dob = $_POST['dob'];

// SQL query to insert data into the staff table
$query = "INSERT INTO staff (name, address, phone, email, dob) VALUES ('$name', '$address', '$phone', '$email', '$dob')";
$q = "INSERT INTO login (username, password, user_type) VALUES ('$name', '$name','staff')";
$r = mysqli_query($conn, $q);

// Execute the query
$result = mysqli_query($conn, $query);

if ($result) {
    echo "<script>alert('Staff member added successfully.');</script>";
    echo "<script>window.location.href = 'staff.php';</script>";
} else {
    echo "Error: " . mysqli_error($conn);
}

// Close the database connection
mysqli_close($conn);
?>
