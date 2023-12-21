
<?php
session_start();
$admission_no = $_SESSION['username']; 
// Include your database connection
include "../../../connection/connection.php";

// Fetch data from the home_register table
$query = "SELECT * FROM home_register WHERE admission_no = $admission_no AND 'return' = 0";
$result = mysqli_query($conn, $query);

// Check if there are records
if ($result) {
    $homeRegisterData = mysqli_fetch_all($result, MYSQLI_ASSOC);
} else {
    $homeRegisterData = array(); // No records found
}

$conn->close();
?>
<?php
// session_start(); // Start the session
// Disable warning display
error_reporting(E_ERROR | E_PARSE);

    $username = $_SESSION['username'];
    $role = $_SESSION['role'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
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
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, 
				initial-scale=1.0">
    <title>RIT Hostel</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="../../../style/dash-style.css">
    <link rel="stylesheet" href="../../../style/responsive.css">
</head>

<body>

    <!-- for header part -->
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
 
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#updateDetailsModal">
    <img src="https://media.geeksforgeeks.org/wp-content/uploads/20221210180014/profile-removebg-preview.png"
        class="dpicn" alt="dp">
    </button>
</div>

        </div>

    </header>
<!-- Modal for Updating Details -->
<div class="modal fade" id="updateDetailsModal" tabindex="-1" aria-labelledby="updateDetailsModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateDetailsModalLabel">Update Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Add your form elements for updating details here -->
                <form id="updateDetailsForm" action="process_update_details.php" method="post">
                    <!-- Include input fields for yearOfStudy, semester, and mobile -->
                    <label for="yearOfStudy">Year of Study:</label>
                    <input type="text" name="yearOfStudy" id="yearOfStudy" class="form-control" required>
                    
                    <label for="semester">Semester:</label>
                    <input type="text" name="semester" id="semester" class="form-control" required>
                    
                    <label for="mobile">Mobile:</label>
                    <input type="text" name="mobile" id="mobile" class="form-control" required>
                    <br>
                    <button type="submit" class="btn btn-primary">Update Details</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Update Password Modal -->
<div class="modal fade" id="updatePasswordModal" tabindex="-1" aria-labelledby="updatePasswordModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updatePasswordModalLabel">Update Password</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="updatePasswordForm" action="process_update_password.php" method="post">
                    <div class="mb-3">
                        <label for="newPassword" class="form-label">New Password</label>
                        <input type="password" class="form-control" id="newPassword" name="newPassword" required>
                    </div>
                    <div class="mb-3">
                        <label for="confirmPassword" class="form-label">Confirm Password</label>
                        <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Update Password</button>
                </form>
            </div>
        </div>
    </div>
</div>


    <div class="main-container">
        
    <?php
       include "../../../component/sidebar/student.php";
       ?>


        <div class="main">

            <div class="searchbar2">
                <input type="text" name="" id="" placeholder="Search">
                <div class="searchbtn">
                    <img src="https://media.geeksforgeeks.org/wp-content/uploads/20221210180758/Untitled-design-(28).png"
                        class="icn srchicn" alt="search-button">
                </div>
            </div>



                    <!-- Complaint Box -->

                   <!-- Complaint Box -->
<div class="complaint-section">
    <h2 class="complaint-title">Home Register</h2>
    <form id="home-register-form" action="process_home_register.php" method="post">
        <label for="date" class="input-title">Date</label>
        <input class="complaint-input" type="date" name="date" required>

        <label for="place">Place</label>
        <input class="complaint-input" type="text" name="place" placeholder="Enter the place" required>

        <label for="time">Time</label>
        <input class="complaint-input" type="text" name="time" placeholder="Enter the time" required>

        <button type="submit" class="inform-button">Submit</button>
    </form>
</div><br>
<h1 class="recent-Articles">Return Home Register</h1>
                <table>
                    <tr>
                        <!-- <th>Name</th> -->
                        <!-- <th>Admission No</th> -->
                        <!-- <th>Room No</th> -->
                        <th>Date</th>
                        <th>Place</th>
                        <th>Time</th>
                        <th>Return Status</th>
                        <th>Matron</th>
                        <th>HS</th>
                        <!-- <th>Confirm</th> -->
                    </tr>
                    <?php foreach ($homeRegisterData as $data) : ?>
                        <tr>
                            <!-- <td><?= $data['name']; ?></td> -->
                            <!-- <td><?= $data['admission_no']; ?></td> -->
                            <!-- <td><?= $data['room_no']; ?></td> -->
                            <td><?= $data['date']; ?></td>
                            <td><?= $data['place']; ?></td>
                            <td><?= $data['time']; ?></td>
                 <!-- Inside your foreach loop -->
<form action="update_matron_field.php" method="post">
    <input type="hidden" name="admission_no" value="<?= $data['admission_no']; ?>">
    <!-- <input type="hidden" name="date" value="<?= $data['date']; ?>"> -->
    <td>
        <?php if ($data['return'] == 0) : ?>
            <button type="submit" class="confirmButton">Return</button>
        <?php else : ?>
            <span>Return added</span>
        <?php endif; ?>
    </td>
</form>


                            <!-- <td><?= $data['m']; ?></td> -->
                            <!-- <td><?= $data['hs']; ?></td> -->
                            <td>
                                <?php if ($data['hs'] == 0) : ?>
                                    <span>Not verified</span>
                                <?php else : ?>
                                    <span>Verified</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php if ($data['matron'] == 0) : ?>
                                    <span>Not verified</span>
                                <?php else : ?>
                                    <span>Verified</span>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </table>   
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


                </div>

            </div>
        </div>
    </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Food Feedback</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="complaint-form" action="../process_feedback.php" method="post">
                        <label for="description">Describe</label>
                        <textarea class="complaint-textarea" name="feedback" placeholder="Enter your Feedback"
                            required></textarea>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Send Feedback</button>
                </div>
                </form>
            </div>
        </div>
    </div>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">


    </script>
    <script src="../../../style/dashboard.js"></script>
   
</body>

</html>