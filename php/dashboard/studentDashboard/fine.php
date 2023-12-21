<!DOCTYPE html>
<html lang="en">

<?php
// Assuming $conn is your database connection variable

// Start the session
session_start();

// Include necessary files (connection and data_fetch)
include "../../../connection/connection.php";
include "../../data_fetch.php";
?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RIT Hostel</title>
    <link rel="stylesheet" href="../../../style/dash-style.css">
    <link rel="stylesheet" href="../../../style/responsive.css">
    <style>
        /* Existing styles remain unchanged */

        .report-topic-heading {
            display: grid;
            /* width: 500p; */
            grid-template-columns: 1fr 1fr 1fr 1fr 1fr 1fr;
            background-color: #f0f0f0;
            font-weight: bold;
            padding: 10px;
        }
        .report-body{
            width: 100%;
        }

        .t-op-nextlvl {
            padding: 10px;
            border: 1px solid #ccc;
        }

        .item1 {
            display: grid;
            grid-template-columns: 1fr 1fr 1fr 1fr 1fr 1fr;
            margin: 5px 0;
            padding: 5px;
        }
    </style>
     <script>
        function markAsPaid(date, admission_no) {
            // Send asynchronous request to update the status
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function () {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    // Reload the page or update the UI as needed
                    location.reload();
                }
            };

            xhr.open("GET", "update_status.php?date=" + encodeURIComponent(date) + "&admission_no=" + encodeURIComponent(admission_no), true);
            xhr.send();
        }
    </script>
</head>

<body>

<header>

<div class="logosec">
    <div class="logo">Student Dashboard</div>
    <img src="https://media.geeksforgeeks.org/wp-content/uploads/20221210182541/Untitled-design-(30).png"
        class="icn menuicn" id="menuicn" alt="menu-icon">
</div>

<div class="searchbar">
    <input type="text" placeholder="Search">
    <div class="searchbtn">
        <img src="https://media.geeksforgeeks.org/wp-content/uploads/20221210180758/Untitled-design-(28).png"
            class="icn srchicn" alt="search-icon">
    </div>
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
        include "../../../component/sidebar/student.php";
        ?>

        <div class="main">
            <!-- Existing content remains unchanged -->

            <div class="searchbar2">
                <input type="text" name="" id="" placeholder="Search">
                <div class="searchbtn">
                    <img src="https://media.geeksforgeeks.org/wp-content/uploads/20221210180758/Untitled-design-(28).png"
                        class="icn srchicn" alt="search-button">
                </div>
            </div>
            <div class="report-container">
                <div class="report-header">
                    <h1 class="recent-Articles">Fines</h1>
                    <!-- <button class="view">Download</button> -->
                </div>

                <div class="report-body">
                    <div class="report-topic-heading">
                        <h3 class="t-op">Date</h3>
                        <h3 class="t-op">Reason</h3>
                        <h3 class="t-op">Status</h3>
                        <h3 class="t-op">Amount</h3>
                        <h3 class="t-op">Type</h3>
                        <h3 class="t-op">Action</h3> <!-- New column for the "Paid" button -->

                    </div>

                    <?php
                    // Fetch data from the database (fine table) based on the admission_no
                    $username = $_SESSION['username'];
                    $query = "SELECT date, admission_no, reason, status, amount, type FROM fine WHERE admission_no = '$username'";
                    $result = mysqli_query($conn, $query);

                    // Check if the query was successful
                    if ($result) {
                        // Loop through each row in the result set
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo '<div class="item1">';
                            echo '<div class="t-op-nextlvl">' . htmlspecialchars($row['date']) . '</div>';
                            // echo '<div class="t-op-nextlvl">' . htmlspecialchars($row['admission_no']) . '</div>';
                            echo '<div class="t-op-nextlvl">' . htmlspecialchars($row['reason']) . '</div>';
                            echo '<div class="t-op-nextlvl">' . htmlspecialchars($row['status']) . '</div>';
                            echo '<div class="t-op-nextlvl">' . htmlspecialchars($row['amount']) . '</div>';
                            echo '<div class="t-op-nextlvl">' . htmlspecialchars($row['type']) . '</div>';
                            echo '<div class="t-op-nextlvl"><button onclick="markAsPaid(\'' . htmlspecialchars($row['date']) . '\', \'' . htmlspecialchars($row['admission_no']) . '\')">Paid</button></div>';
                            echo '</div>';
                        }
                    } else {
                        // Handle the case where the query fails
                        echo 'Error fetching data: ' . mysqli_error($conn);
                    }
                    ?>


                </div>



                
            </div>

<br><br>



            <div class="report-container">
                <div class="report-header">
                    <h1 class="recent-Articles">Bill</h1>
                    <!-- <button class="view">Download</button> -->
                </div>

                <div class="report-body">
    <div class="report-topic-heading">
        <h3 class="t-op">Date & Time</h3>
        <!-- <h3 class="t-op">Admission No</h3> -->
        <!-- <h3 class="t-op">Name</h3> -->
        <!-- <h3 class="t-op">Semester</h3> -->
        <!-- <h3 class="t-op">Branch</h3> -->
        <!-- <h3 class="t-op">Year of Study</h3> -->
        <!-- <h3 class="t-op">Degree</h3> -->
        <!-- <h3 class="t-op">Room ID</h3> -->
        <!-- <h3 class="t-op">Fee Concession</h3> -->
        <h3 class="t-op">Total Attendance</h3>
        <h3 class="t-op">Fine Amount</h3>
        <h3 class="t-op">Amount Per Student</h3>
        <!-- <h3 class="t-op">Action</h3> New column for the "Paid" button -->
    </div>

    <?php
    // Fetch data from the database (mess_bill table) based on the admission_no
  // Fetch data from the database (mess_bill table) based on the admission_no and current month
// Fetch data from the database (mess_bill table) based on the admission_no and last day of the current month
$username = $_SESSION['username'];
$currentMonth = date('m');  // Get the current month
$lastDayOfMonth = date('Y-m-t');  // Get the last day of the current month
$query = "SELECT * FROM mess_bill
          WHERE admission_no = '$username' AND DATE(created_at) = '$lastDayOfMonth'";
$result = mysqli_query($conn, $query);


    // Check if the query was successful
    if ($result) {
        // Loop through each row in the result set
        while ($row = mysqli_fetch_assoc($result)) {
            echo '<div class="item1">';
            echo '<div class="t-op-nextlvl">' . htmlspecialchars($row['created_at']) . '</div>';
            // echo '<div class="t-op-nextlvl">' . htmlspecialchars($row['admission_no']) . '</div>';
            // echo '<div class="t-op-nextlvl">' . htmlspecialchars($row['name']) . '</div>';
            // echo '<div class="t-op-nextlvl">' . htmlspecialchars($row['semester']) . '</div>';
            // echo '<div class="t-op-nextlvl">' . htmlspecialchars($row['branch']) . '</div>';
            // echo '<div class="t-op-nextlvl">' . htmlspecialchars($row['year_of_study']) . '</div>';
            // echo '<div class="t-op-nextlvl">' . htmlspecialchars($row['degree']) . '</div>';
            // echo '<div class="t-op-nextlvl">' . htmlspecialchars($row['room_id']) . '</div>';
            // echo '<div class="t-op-nextlvl">' . htmlspecialchars($row['fee_concession']) . '</div>';
            echo '<div class="t-op-nextlvl">' . htmlspecialchars($row['total_attendance']) . '</div>';
            echo '<div class="t-op-nextlvl">' . htmlspecialchars($row['fine_amount']) . '</div>';
            echo '<div class="t-op-nextlvl">' . htmlspecialchars($row['stock_per_student']) . '</div>';
            // echo '<div class="t-op-nextlvl"><button onclick="markAsPaid(\'' . htmlspecialchars($row['created_at']) . '\', \'' . htmlspecialchars($row['admission_no']) . '\')">Paid</button></div>';
            echo '</div>';
        }
    } else {
        // Handle the case where the query fails
        echo 'Error fetching data: ' . mysqli_error($conn);
    }
    ?>
</div>

                
            </div> 
        </div>
    </div>

    <script src="../../../style/dashboard.js"></script>
</body>

</html>
