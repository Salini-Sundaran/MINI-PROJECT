<?php
// Assuming you have a database connection in connection.php
include "../../../connection/connection.php";

// Function to fetch student details based on admission number
function getStudentDetails($admissionNo, $conn) {
    $query = "SELECT name, admissionNo, semester, branch, yearOfStudy, degree, p2 FROM hostel_student_list WHERE admissionNo = '$admissionNo'";
    $result = mysqli_query($conn, $query);

    if ($result) {
        return mysqli_fetch_assoc($result);
    } else {
        return false;
    }
}

// Function to fetch room information based on admission number
function getRoomDetails($admissionNo, $conn) {
    $query = "SELECT room_id FROM allocations WHERE admission_no = '$admissionNo'";
    $result = mysqli_query($conn, $query);

    if ($result) {
        $row = mysqli_fetch_assoc($result);
        return $row['room_id'];
    } else {
        return false;
    }
}

// Function to display feedback details, total attendance, and fine information in table format
function displayFeedbackDetails($conn) {
    // Calculate total stock value for the current month
    $totalStockQuery = "SELECT SUM(total_value) AS total_stock_value FROM stock WHERE MONTH(date_added) = MONTH(CURRENT_DATE())";
    $totalStockResult = mysqli_query($conn, $totalStockQuery);
    $totalStockValue = 0;

    if ($totalStockResult) {
        $totalStockRow = mysqli_fetch_assoc($totalStockResult);
        $totalStockValue = $totalStockRow['total_stock_value'];
    }

    // Fetch common information from mess_verify
    $commonInfoQuery = "SELECT matron, warden, matron_issue, warden_issue FROM mess_verify LIMIT 1";
    $commonInfoResult = mysqli_query($conn, $commonInfoQuery);
    $commonInfo = mysqli_fetch_assoc($commonInfoResult);

    // Display common information
    echo '<div>';
    echo '<p>Matron Verified: ' . ($commonInfo['matron'] == 1 ? 'Verified' : 'Not Verified') . '</p>';
    echo '<p>Warden Verified: ' . ($commonInfo['warden'] == 1 ? 'Verified' : 'Not Verified') . '</p>';
    echo '<p>Comment form Matron: ' . $commonInfo['matron_issue'] . '</p>';
    echo '<p>Comment from Warden: ' . $commonInfo['warden_issue'] . '</p>';
    echo '</div>';

    // Adjust the SQL query based on your requirements, including the admission number, room information, fee concession, total attendance, and fine information
    $query = "SELECT hostel_student_list.admissionNo, hostel_student_list.name, hostel_student_list.semester, hostel_student_list.branch, hostel_student_list.yearOfStudy, hostel_student_list.degree, allocations.room_id, 
              CASE WHEN hostel_student_list.p2 = 1 THEN 'FC' ELSE '' END AS fee_concession,
              SUM(CASE WHEN MONTH(attendance.date) = MONTH(CURRENT_DATE()) THEN attendance.morning + attendance.night ELSE 0 END) AS total_attendance,
              fine.reason AS fine_reason,
              fine.status AS fine_status,
              fine.amount AS fine_amount
              FROM hostel_student_list
              LEFT JOIN allocations ON hostel_student_list.admissionNo = allocations.admission_no
              LEFT JOIN attendance ON hostel_student_list.admissionNo = attendance.admission_no
              LEFT JOIN fine ON hostel_student_list.admissionNo = fine.admission_no
              GROUP BY hostel_student_list.admissionNo";

    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        echo '<table border="1">';
        echo '<thead>';
        echo '<tr>';
        echo '<th>Admission No</th>';
        echo '<th>Name</th>';
        echo '<th>Semester</th>';
        echo '<th>Branch</th>';
        echo '<th>Year of Study</th>';
        echo '<th>Degree</th>';
        echo '<th>Room No</th>';
        echo '<th>Fee Concession</th>';
        echo '<th>Total Attendance</th>';
        echo '<th>Fine Amount</th>';
        echo '<th>Total amount</th>';
        echo '</tr>';
        echo '</thead>';
        echo '<tbody>';

        while ($row = mysqli_fetch_assoc($result)) {
            // Check if total attendance is zero to avoid Division by Zero error
            $attendance = $row['total_attendance'];
            $stockPerStudent = ($attendance > 0) ? ($totalStockValue / $attendance) * $attendance : 0;

            echo '<tr>';
            echo '<td>' . $row['admissionNo'] . '</td>';
            echo '<td>' . $row['name'] . '</td>';
            echo '<td>' . $row['semester'] . '</td>';
            echo '<td>' . $row['branch'] . '</td>';
            echo '<td>' . $row['yearOfStudy'] . '</td>';
            echo '<td>' . $row['degree'] . '</td>';
            echo '<td>' . $row['room_id'] . '</td>';
            echo '<td>' . $row['fee_concession'] . '</td>';
            echo '<td>' . $row['total_attendance'] . '</td>';
            echo '<td>' . $row['fine_amount'] . '</td>';
            echo '<td>' . $stockPerStudent . '</td>';
            echo '</tr>';
        }

        echo '</tbody>';
        echo '</table>';
    } else {
        echo 'No data found.';
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RIT Hostel</title>
    <link rel="stylesheet" href="../../../style/dash-style.css">
    <link rel="stylesheet" href="../../../style/responsive.css">
    <style>
        table {
            background-color: white;
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            border-radius: 10px;
            border: none;
        }

        th, td {
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        tbody tr:hover {
            background-color: #f5f5f5;
        }

        .main-container {
            display: flex;
        }

        .main {
            flex-grow: 1;
            padding: 20px;
        }

        .searchbar2 {
            margin-bottom: 20px;
        }

        .report-body {
            overflow-x: auto;
        }
    </style>

</head>

<body>
    <header>
        <div class="logosec">
            <div class="logo">Mess secretary Dashboard</div>
            <img src="https://media.geeksforgeeks.org/wp-content/uploads/20221210182541/Untitled-design-(30).png"
                class="icn menuicn" id="menuicn" alt="menu-icon">
        </div>

        <div class="message">
            <div class="circle"></div>
            <img src="https://media.geeksforgeeks.org/wp-content/uploads/20221210183322/8.png" class="icn" alt="">
            <div class="dp">
                <img src="https://media.geeksforgeeks.org/wp-content/uploads/20221210180014/profile-removebg-preview.png"
                    class="dpicn" alt="dp">
            </div>
        </div>

    </header>

    <div class="main-container">
        <?php
        // Include your sidebar file
        include "../../../component/sidebar/ms.php";
        ?>
        <div class="main">
            <div class="searchbar2">
                <!-- Your search bar content here -->
            </div>
            <div class="report-body">
                <?php
                // Display feedback details
                displayFeedbackDetails($conn);
                ?>
            </div>
            <script src="../../../style/dashboard.js"></script>
        </div>
    </div>
</body>

</html>
