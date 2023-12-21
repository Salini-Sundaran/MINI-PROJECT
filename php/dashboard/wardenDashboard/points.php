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
    /* ... your existing CSS styles ... */
    form {
        max-width: 800px;
        margin: 0 auto;
        padding: 20px;
        background-color: #fff;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
    }

    label {
        display: block;
        margin-bottom: 8px;
        font-weight: bold;
        color: #333;
    }

    input[type="text"] {
        width: 100%;
        padding: 10px;
        margin-bottom: 15px;
        border: 1px solid #ccc;
        border-radius: 5px;
    }

    input[type="submit"] {
        background-color: #007BFF;
        color: #fff;
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-size: 16px;
    }

    input[type="submit"]:hover {
        background-color: #0056b3;
    }

    /* Add media queries for responsiveness if needed */

    @media (max-width: 600px) {
        form {
            padding: 10px;
        }
    }

    .container {
        display: flex;
    }

    .left {
        flex: 1;
        /* Left side takes 1/2 of the space */
        padding: 20px;
        background-color: #fff;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
    }

    .right {
        flex: 1;
        /* Right side takes 1/2 of the space */
        padding: 20px;
        background-color: #fff;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
    }

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

    .attendance-container {
        display: flex;
        flex-direction: column;
    }

    .attendance-box {
        background-color: #f2f2f2;
        border: 1px solid #ccc;
        padding: 10px;
        border-radius: 5px;
        margin: 10px;
        text-align: center;
    }

    .morning-attendance {
        flex: 1;
    }

    .night-attendance {
        flex: 1;
    }

    form {
        max-width: 100%;
        margin: 0 auto;
        padding: 20px;
        background-color: #fff;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
    }

    .flex-container {
        display: flex;
        justify-content: space-between;
        flex-wrap: wrap;
        margin-bottom: 15px;
    }

    .flex-item {
        flex: 1;
        box-sizing: border-box;
        padding: 0 10px;
    }

    /* Add any additional styles for form elements if needed */
    </style>
</head>

<body>

    <!-- ... your existing HTML code ... -->
    <header>

        <div class="logosec">
            <div class="logo">Warden Dashboard</div>
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
        include "../../../component/sidebar/warden.php";
        ?>

        <div class="main">
            <div class="searchbar2">
                <input type="text" name="" id="" placeholder="Search">
                <div class="searchbtn">
                    <img src="https://media.geeksforgeeks.org/wp-content/uploads/20221210180758/Untitled-design-(28).png"
                        class="icn srchicn" alt="search-button">
                </div>
            </div>

            <div class="box-container">
                <!-- Add any additional content if needed -->
            </div>

            <form action="process_points.php" method="post">
                <?php
                // Include your connection.php file
                include '../../../connection/connection.php';

                // Check if an id is provided, and retrieve data from the database
                $query = "SELECT * FROM points WHERE id = 1";
                $result = mysqli_query($conn, $query);

                if ($row = mysqli_fetch_assoc($result)) {
                    $p_y1 = $row['p_y1'];
                    $p_y2 = $row['p_y2'];
                    $p_y3 = $row['p_y3'];
                    $p_y4 = $row['p_y4'];
                    $pg = $row['pg'];
                    $total = $row['total'];
                    $t_y1 = $row['t_y1'];
                    $t_y2 = $row['t_y2'];
                    $t_y3 = $row['t_y3'];
                    $t_y4 = $row['t_y4'];
                    $t_pg = $row['t_pg'];
                    $id = $row['id'];

                }
                ?>
                <h2>Point Allocation</h2>
                <br>
                <div class="flex-container">
                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                    <div class="flex-item">
                        <label for="p_y1">Points for first year:</label>
                        <input type="text" name="p_y1" id="p_y1" value="<?php echo $p_y1; ?>" required><br><br>
                    </div>
                    <div class="flex-item">
                        <label for="p_y2">Points for second year:</label>
                        <input type="text" name="p_y2" id="p_y2" value="<?php echo $p_y2; ?>" required><br><br>
                    </div>
                    <div class="flex-item">
                        <label for="p_y3">Points for third year:</label>
                        <input type="text" name="p_y3" id="p_y3" value="<?php echo $p_y3; ?>" required><br><br>
                    </div>
                    <div class="flex-item">
                        <label for="p_y4">Points for fourth year:</label>
                        <input type="text" name="p_y4" id="p_y4" value="<?php echo $p_y4; ?>" required><br><br>
                    </div>
                    <div class="flex-item">
                        <label for="pg">Points for MCA/M.Tech:</label>
                        <input type="text" name="pg" id="pg" value="<?php echo $pg; ?>" required><br><br>
                    </div>
                </div>
                <!-- <div class="flex-item"> -->
                <label for="total">Total No of seats:</label>
                <input type="text" name="total" id="total" value="<?php echo $total; ?>" required><br><br>
                <!-- </div> -->
                <h2>Number of Seats</h2>
                <br>
                <div class="flex-container">
                    <div class="flex-item">
                        <label for="t_y1">First years:</label>
                        <input type="text" name="t_y1" id="t_y1" value="<?php echo $t_y1; ?>" required><br><br>
                    </div>
                    <div class="flex-item">
                        <label for="t_y2">Second years:</label>
                        <input type="text" name="t_y2" id="t_y2" value="<?php echo $t_y2; ?>" required><br><br>
                    </div>
                    <div class="flex-item">
                        <label for="t_y3">Third years:</label>
                        <input type="text" name="t_y3" id="t_y3" value="<?php echo $t_y3; ?>" required><br><br>
                    </div>
                    <div class="flex-item">
                        <label for="t_y4">Fourth years:</label>
                        <input type="text" name="t_y4" id="t_y4" value="<?php echo $t_y4; ?>" required><br><br>
                    </div>
                    <div class="flex-item">
                        <label for="t_y4">MCA/M.Tech student:</label>
                        <input type="text" name="t_pg" id="t_pg" value="<?php echo $t_pg; ?>" required><br><br>
                    </div>
                </div>
                <input type="submit" value="Add/Update">
                <!-- </div> -->
            </form>



<br>
            <!-- Add this form below your existing HTML code -->
<div class="time-setting-form-container">

    <?php
    // Include your database connection file
    include "../../../connection/connection.php";

    // Assume $id is the specific id you want to retrieve data for
    $id = 1; // You can replace this with the actual id you want to edit

    // SQL query to select data from the time_setting table for the given id
    $querySelect = "SELECT * FROM time_setting WHERE id = $id";
    $resultSelect = mysqli_query($conn, $querySelect);

    // Check if the query was successful
    if ($resultSelect && mysqli_num_rows($resultSelect) > 0) {
        // Fetch the data as an associative array
        $rowData = mysqli_fetch_assoc($resultSelect);
    ?>
        <form action="update_time_setting.php" method="post">
        <h2>Time Setting Form (use 24 hour format)</h2>
        <br>

            <div class="form-group">
                <label for="m_start">Morning Start:</label>
                <input type="text" id="m_start" name="m_start" value="<?php echo $rowData['m_start']; ?>" required>
            </div>

            <div class="form-group">
                <label for="m_end">Morning End:</label>
                <input type="text" id="m_end" name="m_end" value="<?php echo $rowData['m_end']; ?>" required>
            </div>

            <div class="form-group">
                <label for="n_start">Night Start:</label>
                <input type="text" id="n_start" name="n_start" value="<?php echo $rowData['n_start']; ?>" required>
            </div>

            <div class="form-group">
                <label for="n_end">Night End:</label>
                <input type="text" id="n_end" name="n_end" value="<?php echo $rowData['n_end']; ?>" required>
            </div>

            <input type="hidden" name="id" value="<?php echo $id; ?>">
            
            <div class="form-group">
                <input type="submit" value="Update">
            </div>
        </form>
    <?php
    } else {
        echo 'Error fetching data: ' . mysqli_error($conn);
    }

    // Close the database connection
    mysqli_close($conn);
    ?>
</div>

<br>
  <!-- Add this form below your existing HTML code -->
  <div class="time-setting-form-container">



    <form action="update_time_setting.php" method="post">
    <h2>Backup - Clear - Restore</h2>
    <br>

    
        <div class="form-group">
            <!-- <input type="submit" value="Update"> -->
            <a href="backup.php">--> Click here to Backup</a><br><br>
            <a href="restore.php">-->Click here to Restore</a><br><br>
            <a href="clear.php">-->Click here to Clear</a><br><br>
        </div>
    </form>

        </div>
    </div>

    <script src="../../../style/dashboard.js"></script>
    <script>
    document.addEventListener("DOMContentLoaded", function () {
        // Function to check if the sum of seats matches the total
        function checkSeats() {
            var t_y1 = parseInt(document.getElementById("t_y1").value) || 0;
            var t_y2 = parseInt(document.getElementById("t_y2").value) || 0;
            var t_y3 = parseInt(document.getElementById("t_y3").value) || 0;
            var t_y4 = parseInt(document.getElementById("t_y4").value) || 0;
            var t_pg = parseInt(document.getElementById("t_pg").value) || 0;

            var totalSeats = parseInt(document.getElementById("total").value) || 0;
            var sum = t_y1 + t_y2 + t_y3 + t_y4 + t_pg;

            if (sum !== totalSeats) {
                alert("The sum of allocated seats does not match the total number of seats.");
                return false; // Prevent form submission
            }

            return true; // Allow form submission
        }

        // Attach the checkSeats function to the form's onsubmit event
        document.querySelector("form").onsubmit = checkSeats;
    });
</script>

</body>

</html>