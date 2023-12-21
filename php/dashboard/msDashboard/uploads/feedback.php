<?php
// Assuming you have a database connection in connection.php
include "../../../connection/connection.php";

// Function to fetch student details based on admission number
function getStudentDetails($admissionNo, $conn) {
    $query = "SELECT name, semester, branch, yearOfStudy, degree FROM hostel_student_list WHERE admissionNo = '$admissionNo'";
    $result = mysqli_query($conn, $query);

    if ($result) {
        return mysqli_fetch_assoc($result);
    } else {
        return false;
    }
}

// Function to display food feedback details in table format
function displayFeedbackDetails($conn) {
    $query = "SELECT * FROM food_feedback";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        echo '<table border="1">';
        echo '<thead>';
        echo '<tr>';
        echo '<th>Name</th>';
        echo '<th>Semester</th>';
        echo '<th>Branch</th>';
        echo '<th>Year of Study</th>';
        echo '<th>Degree</th>';
        echo '<th>Feedback</th>';
        echo '<th>Food</th>';
        echo '<th>Food Item</th>';
        echo '</tr>';
        echo '</thead>';
        echo '<tbody>';

        while ($row = mysqli_fetch_assoc($result)) {
            $admissionNo = $row['admission_no'];
            $studentDetails = getStudentDetails($admissionNo, $conn);

            if ($studentDetails) {
                echo '<tr>';
                echo '<td>' . $studentDetails['name'] . '</td>';
                echo '<td>' . $studentDetails['semester'] . '</td>';
                echo '<td>' . $studentDetails['branch'] . '</td>';
                echo '<td>' . $studentDetails['yearOfStudy'] . '</td>';
                echo '<td>' . $studentDetails['degree'] . '</td>';
                echo '<td>' . $row['feedback'] . '</td>';
                echo '<td>' . $row['food'] . '</td>';
                echo '<td>' . $row['fooditem'] . '</td>';
                echo '</tr>';
            }
        }

        echo '</tbody>';
        echo '</table>';
    } else {
        echo 'No feedback found.';
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
        /* border-bottom: 1px solid #ddd; */
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
