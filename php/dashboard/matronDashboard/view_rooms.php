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
        body {
            font-family: Arial, sans-serif;
        }

        .room-container {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
        }

        .room {
            background-color: #f5f5f5;
            border: 1px solid #ccc;
            padding: 10px;
            border-radius: 5px;
            width: 300px;
            margin-bottom: 20px;
        }

        .room h3 {
            margin: 0;
            font-size: 20px;
            text-decoration: underline;
        }

        .students {
            margin-top: 10px;
            list-style-type: none;
            padding: 0;
        }

        .student {
            margin-bottom: 5px;
        }

        .program {
            font-weight: bold;
        }
    </style>
</head>

<body>

<header>

<div class="logosec">
    <div class="logo">Matron Dashboard</div>
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
        include "../../../component/sidebar/matron.php";
        ?>
        <div class="main">
            <div class="searchbar2">
                <input type="text" name="" id="" placeholder="Search">
                <div class="searchbtn">
                    <img src="https://media.geeksforgeeks.org/wp-content/uploads/20221210180758/Untitled-design-(28).png"
                        class="icn srchicn" alt="search-button">
                </div>
            </div>

           
    <h1>Room Allocation View</h1>

<?php
// Include the PHP script here
include 'room_allocation_script.php';

// Get and display room allocations
$roomAllocations = getRoomAllocations();

echo '<div class="room-container">';
foreach ($roomAllocations as $roomDetails) {
    echo '<div class="room">';
    echo '<h3>Room: ' . $roomDetails['Room Name'] . '</h3>';
    // echo '<p>Capacity: ' . $roomDetails['Capacity'] . '</p>';

    echo '<ul class="students">';
    foreach ($roomDetails['Allocations'] as $allocation) {
        echo '<li class="student">';
        echo '<ul style="background-color:rgb(255,255,255)">';
        echo '<li>Name: ' . $allocation['name'] . '</li>';
        echo '<li>Admission No: ' . $allocation['admissionNo'] . '</li>';
        echo '<li>Branch: ' . $allocation['degree'] . '</li>';
        echo '</ul>';
        echo '</li>';
    }
    echo '</ul>';

    echo '</div>';
}
echo '</div>';
?>

            <script src="../../../style/dashboard.js"></script>
</body>

</html>
