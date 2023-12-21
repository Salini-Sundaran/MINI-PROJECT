<?php
session_start(); // Start the session
error_reporting(E_ERROR | E_PARSE);

// Include your database connection
include '../../../connection/connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get data from the form
    $admission_no = $_SESSION['username']; // Get the admission number from the session
    $date = $_POST['date'];
    $place = $_POST['place'];
    $time = $_POST['time'];

    // Retrieve student details based on admission number
    $studentQuery = "SELECT name, room_no, degree, semester, branch FROM hostel_student_list WHERE admissionNo = '$admission_no'";
    $studentResult = mysqli_query($conn, $studentQuery);

    if ($studentResult) {
        // Fetch the student details
        $studentDetails = mysqli_fetch_assoc($studentResult);

        if ($studentDetails) {
            $name = $studentDetails['name'];
            $room_no = $studentDetails['room_no'];
            $degree = $studentDetails['degree'];
            $semester = $studentDetails['semester'];
            $branch = $studentDetails['branch'];

            // Insert data into home_register table
            $insertHomeRegisterQuery = "INSERT INTO home_register (admission_no, name, room_no, date, place, time) 
                                        VALUES ('$admission_no', '$name', '$room_no', '$date', '$place', '$time')";
            $insertHomeRegisterResult = mysqli_query($conn, $insertHomeRegisterQuery);

            // Insert data into attendance table
            $insertAttendanceQuery = "INSERT INTO attendance (name, admission_no, branch, semester, morning, night, date, matron, hs) 
                                      VALUES ('$name', '$admission_no', '$branch', '$semester', 2, 2, '$date', 0, 0)";
            $insertAttendanceResult = mysqli_query($conn, $insertAttendanceQuery);

            if ($insertHomeRegisterResult && $insertAttendanceResult) {
                // Data inserted successfully
                echo "<script>
                        alert('Home register entry and attendance submitted successfully.');
                        window.location.href = 'home_register.php';
                      </script>";
            } else {
                // Handle the case where the insert fails
                echo "<script>
                        alert('Error submitting entry. Please try again.');
                        window.location.href = 'home_register.php';
                      </script>";
            }
        } else {
            // Student details not found
            echo "<script>
                    alert('Error: Student details not found.');
                    window.location.href = 'home_register.php';
                  </script>";
        }
    } else {
        // Handle the case where the query fails
        echo "<script>
                alert('Error: Unable to retrieve student details.');
                window.location.href = 'home_register.php';
              </script>";
    }
}
?>
