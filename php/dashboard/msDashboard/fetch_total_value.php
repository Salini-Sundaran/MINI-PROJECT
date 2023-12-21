<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Include your database connection
    include "../../../connection/connection.php";

    // Get the selected month from the POST data
    $selectedMonth = $_POST['selected_month'];

    // Query to fetch the total value for the selected month
    $queryTotalValue = "SELECT SUM(total_value) as totalValue FROM stock WHERE MONTH(date_added) = $selectedMonth";
    $resultTotalValue = mysqli_query($conn, $queryTotalValue);
    $rowTotalValue = mysqli_fetch_assoc($resultTotalValue);
    $totalValue = $rowTotalValue['totalValue'];

    // Close the database connection
    $conn->close();

    // Return the total value as a JSON response
    header('Content-Type: application/json');
    echo json_encode(['totalValue' => $totalValue]);
} else {
    // If the script is accessed through a different method, return an error
    header('HTTP/1.1 400 Bad Request');
    echo 'Invalid request';
}
?>
