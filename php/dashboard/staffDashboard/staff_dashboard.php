<?php
session_start(); // Start the session
// Disable warning display
error_reporting(E_ERROR | E_PARSE);

    $username = $_SESSION['username'];
    $role = $_SESSION['role'];
    include "../../../connection/connection.php"; // Assuming you have a database connection established

// ... (your existing code)

// Select data from the time_setting table where id is 1
$queryTimeSetting = "SELECT * FROM time_setting WHERE id = 1";
$resultTimeSetting = mysqli_query($conn, $queryTimeSetting);

// Check if the query was successful
if ($resultTimeSetting) {
    // Fetch the data as an associative array
    $rowTimeSetting = mysqli_fetch_assoc($resultTimeSetting);

    // Access individual columns like this
    $m_start = $rowTimeSetting['m_start'];
    $m_end = $rowTimeSetting['m_end'];
    $n_start = $rowTimeSetting['n_start'];
    $n_end = $rowTimeSetting['n_end'];

    // echo  "$m_start";

    // Now you can use these variables wherever you need in your HTML or PHP code
} else {
    // Handle the case where the query fails
    echo 'Error fetching time setting data: ' . mysqli_error($conn);
}

// ... (your existing code)
?>
<!DOCTYPE html>
<html lang="en">

<head>
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

<script>
    $(document).ready(function() {
        // Show the modal when the button is clicked
        $('#updatePasswordModal').on('show.bs.modal', function(event) {
            // Clear input fields when the modal is opened
            $('#updatePasswordForm')[0].reset();
        });

        // Handle form submission
        $('#updatePasswordForm').submit(function(event) {
            event.preventDefault(); // Prevent the default form submission

            // Perform an AJAX request to submit the form data
            $.ajax({
                url: $(this).attr('action'),
                type: $(this).attr('method'),
                data: $(this).serialize(),
                dataType: 'json',
                success: function(response) {
                    // Show an alert based on the response
                    if (response.status === 'success') {
                        alert(response.message);
                        $('#updatePasswordModal').modal('hide'); // Close the modal on success
                    } else {
                        alert(response.message);
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error:', status, error);
                }
            });
        });
    });
</script>
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
            <?php
                    // Include your connection.php file
                    include '../../../connection/connection.php';

                    // Select data from the food_menu table
                    $query = "SELECT * FROM food_menu WHERE menu_id = 1";
                    $result = mysqli_query($conn, $query);

                    while ($row = mysqli_fetch_assoc($result)) {
                        ?>
            <div class="dashboard-items-container">
                <div class="food-card">
                    <h2 class="food-title">Today's Menu</h2>
                    <div class="food-details">
                        <div class="food-item">
                            <div class="food-title">
                                <i class="fas fa-utensils food-icon"></i>
                                <span class="food-label">Breakfast:</span>
                            </div>
                            <div class="food-name"> <?php echo  $row['breakfast_item']; ?></div>
                         

                            <div class="food-time">8:00 AM - 9:00 AM</div>
                        </div>
                        <div class="food-item">
                            <div class="food-title">
                                <i class="fas fa-utensils food-icon"></i>
                                <span class="food-label">Lunch:</span>
                            </div>
                            <div class="food-name"><?php echo  $row['lunch_item']; ?></div>
                           

                            <div class="food-time">12:00 AM - 01:30 PM</div>
                        </div>
                        <div class="food-item">
                            <div class="food-title">
                                <i class="fas fa-utensils food-icon"></i>
                                <span class="food-label">Evening:</span>
                            </div>
                            <div class="food-name"><?php echo  $row['evening_item']; ?></div>
                           

                            <div class="food-time">4:00 PM - 5:30 PM</div>
                        </div>
                        <div class="food-item">
                            <div class="food-title">
                                <i class="fas fa-utensils food-icon"></i>
                                <span class="food-label">Dinner:</span>
                            </div>
                            <div class="food-name"><?php echo  $row['dinner_item']; ?></div>
                            



                            <div class="food-time">8:00 PM - 9:30 PM</div>

                        </div>
                    </div>
                </div>
                <div>
                    <?php 
                    }
                    ?>
                    <!-- Attendence -->
                    <div class="attendance-section">
                        <h2 class="attendance-title">Mark Attendance</h2>
                        <div class="attendance-box">
                            <div class="time-show">
                                <p id="attendance-type"></p>
                                <h1 id="time-show"></h1>
                            </div>


                            <div class="mark-attendance">
                                <form id="morning-attendance-form" action="process_attendance.php" method="post">
                                    <input type="hidden" name="attendance_type" value="morning">

                                    <?php
require_once('../../../connection/connection.php'); // Include your connection.php file

$student_id = $_SESSION['username'];
// Replace with the actual student ID
$attendance_date = date("Y-m-d"); // Replace with the desired date

// SQL query to check if morning attendance is marked
$query = "SELECT morning FROM attendance WHERE name = '$student_id' AND date = '$attendance_date'";
$result = mysqli_query($conn, $query); 
// echo "Query: $query";
// echo $student_id;
    // Check if there is exactly one row for the given date

        $row = mysqli_fetch_assoc($result);
        if ($row['morning'] == 1) {
            // Morning attendance is already marked
            echo "Morning Attendance Marked";
        } else {
            // Morning attendance is not marked, display the button
            echo '<button id="morning-attendance-btn" type="submit" class="attendance-btn">Mark Morning Attendance</button>';
        }
?>

                                </form>
                            </div>
                            <div class="mark-attendance">
                                <form id="night-attendance-form" action="process_attendance.php" method="post">
                                    <input type="hidden" name="attendance_type" value="night">
                                    <?php
                                    require_once('../../../connection/connection.php'); // Include your connection.php file
                                    $student_id = $value = $_SESSION['username'];
                                    // Replace with the actual student ID
                                    $attendance_date = date("Y-m-d"); // Replace with the desired date

                                    $query = "SELECT night FROM attendance WHERE name = '$student_id' AND date = '$attendance_date'";
                                    // SQL query to check if morning attendance is marked
                                    $result = mysqli_query($conn, $query);
                                    // echo "Query: $query";
                                    // $student_id = $value = $_SESSION['username'];

                                    // echo $username;
                                
                                    $row = mysqli_fetch_assoc($result);
                                    if ($row['night'] == 1) {
                                       // Morning attendance is already marked
                                       echo "Night Attendance Marked";
                                    } else {
                                       // Morning attendance is not marked, display the button
                                       echo '<button id="night-attendance-btn" type="submit" class="attendance-btn">Mark Night Attendance</button>';
                                    }
                                            ?>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <script>
    // Get the current date and time
    var now = new Date();
    var hours = now.getHours();
    var minutes = now.getMinutes();

    // Check if the current time is within the allowed time intervals
    <?php
    echo "var m_start = " . json_encode($m_start) . ";"; // Embed PHP variable in JavaScript
    echo "var m_end = " . json_encode($m_end) . ";"; // Embed PHP variable in JavaScript
    echo "var n_start = " . json_encode($n_start) . ";"; // Embed PHP variable in JavaScript
    ?>
    
    if ((hours == m_start && minutes >= 0 && minutes < 60) || (hours == m_end && minutes <= 20)) {
        // Show the "attendance-section" div and the "Morning" button
        document.getElementById("time-show").innerHTML = m_start + ":00 AM - " + m_end + ":00 AM";
        document.getElementById("attendance-type").innerHTML = "Morning Attendance";
        document.querySelector(".attendance-section").style.display = "block";
        document.getElementById("morning-attendance-form").style.display = "block";
        document.getElementById("night-attendance-btn").style.display ="none"; // Hide the "Night" button
    } else if (hours == n_start && minutes >= 0 && minutes < 60) {
        // Show the "attendance-section" div and the "Night" button
        document.getElementById("morning-attendance-btn").style.display ="none"; // Hide the "Morning" button
        document.getElementById("time-show").innerHTML = n_start + ":00 PM - " + m_end + ":30 PM";
        document.getElementById("attendance-type").innerHTML = "Night Attendance";
        document.querySelector(".attendance-section").style.display = "block";
        document.getElementById("night-attendance-btn").style.display = "block";
    } else {
        // Hide the "attendance-section" div
        document.querySelector(".attendance-section").style.display = "none";
    }
</script>



<script>
    // Use jQuery to handle modal events
    $(document).ready(function() {
        // Show the modal when the button is clicked
        $('#updateDetailsModal').on('show.bs.modal', function(event) {
            // Fetch details and populate form fields using AJAX
            // You need to replace 'get_details.php' with the actual file to retrieve details
            $.ajax({
                url: 'get_details.php',
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    // Populate form fields with retrieved details
                    $('#yearOfStudy').val(data.yearOfStudy);
                    $('#semester').val(data.semester);
                    $('#mobile').val(data.mobile);
                },
                error: function(xhr, status, error) {
                    console.error('Error fetching details:', status, error);
                }
            });
        });
    });
</script>


                    <!-- Complaint Box -->



                </div>

            </div>
        </div>
    </div>
    </div>

    

    <script>
    // Add a click event handler for the feedback buttons
    $(document).ready(function() {
        $('.feedback-btn').click(function() {
            // Get the meal type and meal details from the data attributes
            var mealType = $(this).data('meal-type');
            var mealDetails = JSON.parse($(this).data('meal'));

            // Populate the modal with the meal type and meal details
            $('#exampleModal .modal-title').text(mealType + ' Feedback');
            $('#exampleModal textarea[name="feedback"]').val(''); // Clear any previous feedback
            $('#exampleModal .modal-body .food-details').html(
                '<p><strong>' + mealType + ':</strong> ' + mealDetails[mealType.toLowerCase() +
                    '_item'] + '</p>'
            );
        });
    });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">


    </script>
    <script src="../../../style/dashboard.js"></script>
</body>

</html>