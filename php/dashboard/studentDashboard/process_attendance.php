<?php
session_start(); // Start the session
$admission = $_SESSION['username'];
session_start();
$_SESSION['attendance_message'] = "Attendance has been marked successfully.";

// Include the database connection file
include '../../../connection/connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $attendanceType = $_POST['attendance_type']; // 'morning' or 'night'
    $currentDate = date('Y-m-d'); // Get the current date (ignoring time for daily attendance)

    // Retrieve student details based on the admission number
    $sql = "SELECT * FROM hostel_student_list WHERE admissionNo = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $admission);

    if ($stmt->execute()) {
        $result = $stmt->get_result();
        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            $name = $row['name'];
            $branch = $row['branch'];
            $semester = $row['semester'];

            // Check if attendance record already exists for the current date and admission ID
            $checkSql = "SELECT * FROM attendance WHERE admission_no = ? AND date = ?";
            $checkStmt = $conn->prepare($checkSql);
            $checkStmt->bind_param("ss", $admission, $currentDate);
            $checkStmt->execute();
            $checkResult = $checkStmt->get_result();

            if ($checkResult->num_rows > 0) {
                // Attendance record exists, update morning or night field
                $updateSql = "UPDATE attendance SET $attendanceType = 1 WHERE admission_no = ? AND date = ?";
                $updateStmt = $conn->prepare($updateSql);
                $updateStmt->bind_param("ss", $admission, $currentDate);

                if ($updateStmt->execute()) {
                    echo "Attendance updated successfully.";
                    header("Location: student_dashboard.php"); // Redirect to the page where the toast will be displayed
                } else {
                    echo "Error updating attendance: " . $updateStmt->error;
                }

                $updateStmt->close();
            } else {
                // Attendance record does not exist, insert a new record
                $insertSql = "INSERT INTO attendance (name, admission_no, branch, semester, $attendanceType, date) VALUES (?, ?, ?, ?, 1, ?)";
                $insertStmt = $conn->prepare($insertSql);
                $insertStmt->bind_param("sssds", $name, $admission, $branch, $semester, $currentDate);

                if ($insertStmt->execute()) {
                    echo "Attendance marked successfully.";
                    header("Location: student_dashboard.php"); // Redirect to the page where the toast will be displayed
                } else {
                    echo "Error inserting attendance: " . $insertStmt->error;
                }

                $insertStmt->close();
            }
        } else {
            echo "Student with admission number $admission not found.";
        }
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "Invalid request method.";
}
?>
