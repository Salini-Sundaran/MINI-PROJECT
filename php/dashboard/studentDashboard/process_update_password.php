<?php
session_start();
include '../../../connection/connection.php';

$username = $_SESSION['username'];

$newPassword = mysqli_real_escape_string($conn, $_POST['newPassword']);
$confirmPassword = mysqli_real_escape_string($conn, $_POST['confirmPassword']);

// Verify the new password is different from the existing one
$verifyQuery = "SELECT password FROM login WHERE username = '$username'";
$verifyResult = mysqli_query($conn, $verifyQuery);

if ($verifyResult) {
    $row = mysqli_fetch_assoc($verifyResult);
    $existingPassword = $row['password'];

    if (password_verify($newPassword, $existingPassword)) {
        // New password matches the existing one
        $response = array('status' => 'error', 'message' => 'New Password must be different from the existing one.');
        echo json_encode($response);
        echo '<script>alert("New Password must be different from the existing one.");</script>';
        // Redirect after the alert is shown
        echo '<script>window.location.href = "student_dashboard.php";</script>';
        exit();
    } else {
        // Hash the new password before updating
        // $hashedNewPassword = password_hash($newPassword, PASSWORD_DEFAULT);

        $updateQuery = "UPDATE login SET password = '$newPassword' WHERE username = '$username'";
        $updateResult = mysqli_query($conn, $updateQuery);

        if ($updateResult) {
            // Password updated successfully
            $response = array('status' => 'success', 'message' => 'Password updated successfully.');
            echo json_encode($response);
            echo '<script>alert("Password updated successfully.");</script>';
            // Redirect after the alert is shown
            echo '<script>window.location.href = "student_dashboard.php";</script>';
            exit();
        } else {
            // Handle the case where the update fails
            $response = array('status' => 'error', 'message' => 'Error updating password. Please try again.');
            echo json_encode($response);
            echo '<script>alert("Error updating password. Please try again.");</script>';
            // Redirect after the alert is shown
            echo '<script>window.location.href = "student_dashboard.php";</script>';
            exit();
        }
    }
} else {
    // Handle the case where the verification query fails
    $response = array('status' => 'error', 'message' => 'Error verifying existing password.');
    echo json_encode($response);
    echo '<script>alert("Error verifying existing password.");</script>';
    // Redirect after the alert is shown
    echo '<script>window.location.href = "student_dashboard.php";</script>';
    exit();
}
?>
