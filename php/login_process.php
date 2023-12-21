<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "hostel";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    // Perform SQL query
    $sql = "SELECT COUNT(*) as total FROM login WHERE username = '$username' AND password = '$password' AND user_type = '$role'";
    $result = mysqli_query($conn, $sql);

    if (!$result) {
        die("Query failed: " . mysqli_error($conn));
    }

    // Fetch the result
    $row = mysqli_fetch_assoc($result);
    $total = $row['total'];

    if ($total > 0) {
        // Successful login
        $_SESSION['username'] = $username;
        $_SESSION['role'] = $role;

        // Return "success" to indicate successful login
        echo "success";
    } else {
        // Invalid login
        // Return an error message
        echo "Login failed. Please check your credentials.";
    }

    mysqli_close($conn);
}
?>
