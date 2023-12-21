<?php
include "../../../connection/connection.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve values from the form
    $matronValue = $_POST["matronValue"];
    $matronIssue = $_POST["matronIssue"];

    // Assuming you have a session or some way to identify the matron
    $id = 1; // Replace with the actual matron ID

    // Check if a row exists for the specified id
    $checkQuery = "SELECT * FROM mess_verify WHERE id = $id";
    $checkResult = mysqli_query($conn, $checkQuery);

    if (mysqli_num_rows($checkResult) > 0) {
        // Row exists, perform UPDATE
        $updateQuery = "UPDATE mess_verify SET warden = $matronValue, warden_issue = '$matronIssue' WHERE id = $id";

        if (mysqli_query($conn, $updateQuery)) {
            echo "<script>alert('Response Updated');</script>";
            echo "<script>window.location.href = 'mess_bill.php';</script>";
        } else {
            echo "Error updating matron: " . mysqli_error($conn);
        }
    } else {
        // Row does not exist, perform INSERT
        $insertQuery = "INSERT INTO mess_verify (id, matron, matron_issue) VALUES ($id, $matronValue, '$matronIssue')";

        if (mysqli_query($conn, $insertQuery)) {
            echo "<script>alert('Response Added');</script>";
            echo "<script>window.location.href = 'mess_bill.php';</script>";
        } else {
            echo "Error adding matron response: " . mysqli_error($conn);
        }
    }
}

mysqli_close($conn);
?>
