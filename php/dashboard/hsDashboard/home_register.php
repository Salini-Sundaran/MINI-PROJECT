<?php
session_start();

// Include your database connection
include "../../../connection/connection.php";

// Fetch data from the home_register table
$query = "SELECT * FROM home_register";
$result = mysqli_query($conn, $query);

// Check if there are records
if ($result) {
    $homeRegisterData = mysqli_fetch_all($result, MYSQLI_ASSOC);
} else {
    $homeRegisterData = array(); // No records found
}

$conn->close();
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
        /* Style for the new table */
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

        .confirmButton {
            background-color: #4caf50;
            color: white;
            padding: 5px 10px;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }
    </style>
</head>

<body>
    <!-- Include your header and sidebar here -->

    <!-- Your existing header code -->
    <header>

<div class="logosec">
    <div class="logo">Hostel Scereatory Dashboard</div>
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
        <!-- Include your sidebar file -->
        <?php include "../../../component/sidebar/hs.php"; ?>

        <div class="main">
            <div class="new-table-container">
                <h1 class="recent-Articles">Home Register Data</h1>
                <table>
                    <tr>
                        <th>Name</th>
                        <th>Admission No</th>
                        <th>Room No</th>
                        <th>Date</th>
                        <th>Place</th>
                        <th>Time</th>
                        <th>Return Status</th>
                        <!-- <th>Matron</th> -->
                        <!-- <th>HS</th> -->
                        <th>Confirm</th>
                    </tr>
                    <?php foreach ($homeRegisterData as $data) : ?>
                        <tr>
                            <td><?= $data['name']; ?></td>
                            <td><?= $data['admission_no']; ?></td>
                            <!-- <td><?= $data['room_no']; ?></td> -->
                            <td>Room 1</td>

                            <td><?= $data['date']; ?></td>
                            <td><?= $data['place']; ?></td>
                            <td><?= $data['time']; ?></td>
                            <td>
                                <?php if ($data['return'] == 0) : ?>
                                    <span>Not Return</span>
                                <?php else : ?>
                                    <span>Return</span>
                                <?php endif; ?>
                            </td>
                            <!-- <td><?= $data['m']; ?></td> -->
                            <!-- <td><?= $data['hs']; ?></td> -->
                            <td>
                                <?php if ($data['hs'] == 0) : ?>
                                    <button class="confirmButton" data-id="<?= $data['admission_no']; ?>">Confirm</button>
                                <?php else : ?>
                                    <span>Marked</span>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </table>
            </div>
        </div>
    </div>

    <script src="../../../style/dashboard.js"></script>
    <script>
        // JavaScript code for the "Confirm" button
        const confirmButtons = document.querySelectorAll('.confirmButton');

        confirmButtons.forEach(button => {
            button.addEventListener('click', function () {
                // Get the admission number from the data-id attribute
                const admissionNo = button.getAttribute('data-id');

                // Send an AJAX request to update the 'matron' field to 1
                const xhr = new XMLHttpRequest();
                xhr.open('POST', 'update_matron_field.php'); // Create a PHP script to handle the update
                xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                xhr.onload = function () {
                    if (xhr.status === 200) {
                        // Reload the page to reflect the updated data
                        location.reload();
                    }
                };
                xhr.send('admission_no=' + admissionNo);
            });
        });
    </script>
</body>

</html>
