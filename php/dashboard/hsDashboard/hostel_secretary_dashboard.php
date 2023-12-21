<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, 
				initial-scale=1.0">
    <title>RIT Hostel</title>
    <link rel="stylesheet" href="../../../style/dash-style.css">
    <link rel="stylesheet" href="../../../style/responsive.css">
    <style>


    .box-container {
        display: flex;
        justify-content: space-between;
    }
    .report-body {
    display: flex;
    justify-content: space-around;
    align-items: center;
    height: 100vh;
}

.white-box-container {
    display: flex;
}

.white-box {
    flex: 1;
    max-width: 400px;
    height: 300px;
    margin: 20px;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    background-color: #fff;
    text-align: center;
}

/* Add this if you want a responsive layout */
@media (max-width: 768px) {
    .report-body {
        flex-direction: column;
        align-items: stretch;
    }

    .white-box {
        width: 100%;
    }
}




.white-box h2 {
    color: #333;
}

.white-box p {
    font-size: 90px;
    color: #3498db;
    margin: 10px 0;
}



    </style>
</head>

<body>

    <!-- for header part -->
    <header>

        <div class="logosec">
            <div class="logo">Hostel secretary Dashboard</div>
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
       include "../../../component/sidebar/hs.php";
       ?>
        <div class="main">

            <div class="searchbar2">
                <input type="text" name="" id="" placeholder="Search">
                <div class="searchbtn">
                    <img src="https://media.geeksforgeeks.org/wp-content/uploads/20221210180758/Untitled-design-(28).png"
                        class="icn srchicn" alt="search-button">
                </div>
            </div>

            <?php
// Assuming you have a database connection established
include "../../../connection/connection.php";

// Step 1: Count Morning and Night Attendance
$currentDate = date("Y-m-d");
$queryMorning = "SELECT COUNT(*) as morningCount FROM attendance WHERE date = '$currentDate' AND morning = 1";
$queryNight = "SELECT COUNT(*) as nightCount FROM attendance WHERE date = '$currentDate' AND night = 1";

$resultMorning = mysqli_query($conn, $queryMorning);
$resultNight = mysqli_query($conn, $queryNight);

$rowMorning = mysqli_fetch_assoc($resultMorning);
$rowNight = mysqli_fetch_assoc($resultNight);

// Step 2: Count Complaints Belonging to HS
$queryComplaints = "SELECT COUNT(*) as hsComplaintCount FROM complaint_box WHERE role = 'hostel_secretary'";
$resultComplaints = mysqli_query($conn, $queryComplaints);
$rowComplaints = mysqli_fetch_assoc($resultComplaints);
?>

<div class="white-box-container">
    <div class="white-box">
        <h2>Morning Attendance</h2>
        <p><?php echo $rowMorning['morningCount']; ?></p>
    </div>

    <div class="white-box">
        <h2>Night Attendance</h2>
        <p><?php echo $rowNight['nightCount']; ?></p>
    </div>

    <div class="white-box">
        <h2>HS Complaints</h2>
        <p><?php echo $rowComplaints['hsComplaintCount']; ?></p>
    </div>
</div>

                
              
<div class="report-body">
    
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
            xhr.open('POST', 'update_hs.php'); // Create a PHP script to handle the update
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
</script>