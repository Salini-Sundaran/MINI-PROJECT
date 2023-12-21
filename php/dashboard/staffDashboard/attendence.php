<!DOCTYPE html>
<html lang="en">
<?php
session_start(); // Start the session
$admissionNo = $_SESSION['username'];
echo ''.$admissionNo.'';
?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RIT Hostel</title>
    <link rel="stylesheet" href="../../../style/dash-style.css">
    <link rel="stylesheet" href="../../../style/responsive.css">
    <style>
    /* Style for the table */
    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }

    th,
    td {
        border: 1px solid black;
        padding: 8px;
        text-align: left;
    }

    th {
        background-color: #f2f2f2;
    }

    .box-container {
        display: flex;
        justify-content: space-between;
    }
    </style>
</head>

<body>

    <!-- for header part -->
    <header>

        <div class="logosec">
            <div class="logo">Staff Dashboard</div>
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
       include "../../../component/sidebar/staff.php";
       ?>
        <div class="main">

            <div class="searchbar2">
                <input type="text" name="" id="" placeholder="Search">
                <div class="searchbtn">
                    <img src="https://media.geeksforgeeks.org/wp-content/uploads/20221210180758/Untitled-design-(28).png"
                        class="icn srchicn" alt="search-button">
                </div>
            </div>

            <div class="report-container">
                <div class="report-header">
                    <h1 class="recent-Articles">Attendance</h1>

                </div>
                <div class="search-container">
                    <br>
                    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="GET">
                        <input type="date" name="searchDate" id="searchDate" value="<?php echo $searchDate; ?>"
                            placeholder="Select a Date">
                        <button id="searchButton">Search</button>
                    </form>

                </div>


                <div class="report-body">
                    <table>
                        <tr>
                            <th>Date</th>
                            <th>Morning</th>
                            <th>Night</th>
                        </tr>
                        <?php
                            // Include your connection.php file
                            include '../../../connection/connection.php';

                            // Initialize the searchDate with the current date
                            $currentMonth = date("m");
                            $currentYear = date("Y");
                            
                            // Set the first day of the current month
                            $firstDayOfMonth = date("Y-m-01");
                            
                            // Set the last day of the current month
                            $lastDayOfMonth = date("Y-m-t");
                            
                            // Initialize the searchDate with the current date
                            $searchDate = $firstDayOfMonth;
                            
                            // Check if a date is provided in the search
                            if (isset($_GET['searchDate'])) {
                                $searchDate = $_GET['searchDate'];
                            }
                            // Check if a date is provided in the search
                            

                            // Select data from the attendance table based on the searchDate
                            $query = "SELECT * FROM attendance WHERE date BETWEEN '$firstDayOfMonth' AND '$lastDayOfMonth' AND hs = 1 AND matron = 1 AND name = '$admissionNo'";
                            $result = mysqli_query($conn, $query);
                            
                            if (isset($_GET['searchDate'])) {
                                $searchDate = $_GET['searchDate'];
                                $query = "SELECT * FROM attendance WHERE date = '$searchDate' AND hs = 1 AND matron = 1 AND name = '$admissionNo'";
                                $result = mysqli_query($conn, $query);

                            }

                            if ($result) {
                                if (mysqli_num_rows($result) > 0) {
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        echo "<tr>";
                                        echo "<td>" . $row['date'] . "</td>";
                                       
                                        // Check the 'morning' value
                                        if ($row['morning'] == 1) {
                                            echo "<td style='color: green;'>Present</td>";
                                        } else {
                                            echo "<td style='color: red;'>Absent</td>";
                                        }

                                        // Check the 'night' value
                                        if ($row['night'] == 1) {
                                            echo "<td style='color: green;'>Present</td>";
                                        } else {
                                            echo "<td style='color: red;'>Absent</td>";
                                        }

                                       
                                        echo "</tr>";
                                    }
                                } else {
                                    // No data found for the selected date
                                    echo "<tr><td colspan='7'>No attendance data found for the selected date.</td></tr>";
                                }
                            } else {
                                // Handle any query execution errors
                                echo "Error executing the query: " . mysqli_error($conn);
                            }
                        ?>
                    </table>
                </div>

                <script src="../../style/dashboard.js"></script>
                <script>
                // JavaScript code for the "Mark Confirmation" button
                const markConfirmationButtons = document.querySelectorAll('.markConfirmationButton');

                markConfirmationButtons.forEach(button => {
                    button.addEventListener('click', function() {
                        // Get the attendance record ID from the data-id attribute
                        const attendanceId = button.getAttribute('data-id');

                        // Send an AJAX request to update the 'hs' field to 1
                        const xhr = new XMLHttpRequest();
                        xhr.open('POST',
                        'update_matron.php'); // Create a PHP script to handle the update
                        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                        xhr.onload = function() {
                            if (xhr.status === 200) {
                                // Reload the page to reflect the updated data
                                location.reload();
                            }
                        };
                        xhr.send('id=' + attendanceId);
                    });
                });

                // JavaScript code for the "Confirm All" button
                const confirmAllButton = document.getElementById('confirmAllButton');
                confirmAllButton.addEventListener('click', function() {
                    // Send an AJAX request to update all 'hs' fields to 1
                    const xhr = new XMLHttpRequest();
                    xhr.open('POST',
                    'update_all_matron.php'); // Create a PHP script to handle the update for all
                    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                    xhr.onload = function() {
                        if (xhr.status === 200) {
                            // Reload the page to reflect the updated data
                            location.reload();
                        }
                    };
                    xhr.send();
                });
                </script>
            </div>
        </div>
    </div>
</body>

</html>