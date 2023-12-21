<!DOCTYPE html>
<html lang="en">
<?php
include "../../../connection/connection.php";
include "../../data_fetch.php";
?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, 
				initial-scale=1.0">
    <title>RIT Hostel</title>
    <link rel="stylesheet" href="../../../style/dash-style.css">
    <link rel="stylesheet" href="../../../style/responsive.css">
    <style>
    .report-topic-heading {
        display: grid;
        grid-template-columns: 1fr 2fr 1fr 1fr 1fr 1fr;
        background-color: #f0f0f0;
        font-weight: bold;
        padding: 10px;
    }

    .t-op-nextlvl {
        padding: 10px;
        border: 1px solid #ccc;
    }

    .item1 {
        display: grid;
        grid-template-columns: 1fr 2fr 1fr 1fr 1fr 1fr;
        margin: 5px 0;
        padding: 5px;
    }
</style>

</head>

<body>

    <!-- for header part -->
    <header>

        <div class="logosec">
            <div class="logo">Warden Dashboard</div>
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
            <div class="report-container">
                <div class="report-header">
                    <h1 class="recent-Articles">Complaints</h1>
                    <button class="view">Download</button>
                </div>

                <div class="report-body">
                    <div class="report-topic-heading">
                        <h3 class="t-op">Complaint</h3>
                        <h3 class="t-op">Content</h3>
                        <h3 class="t-op">Admission_no</h3>
                        <h3 class="t-op">Student Name</h3>
                        <h3 class="t-op">branch</h3>
                        <h3 class="t-op">Degree</h3>
                    </div>

<!-- Add the following code after the existing PHP includes -->
<!-- Add the following code after the existing PHP includes -->
<?php
// Assuming $connssssection is your database connection variable

// Fetch data from the database
$query = "SELECT topic,content,admission_no,name,branch_name,degree FROM complaint_box";
$result = mysqli_query($conn, $query);

// Check if the query was successful
if ($result) {
    // Loop through each row in the result set
   // Loop through each row in the result set
while ($row = mysqli_fetch_assoc($result)) {
    echo '<div class="item1">';
    echo '<div class="t-op-nextlvl">' . htmlspecialchars($row['topic']) . '</div>';
    echo '<div class="t-op-nextlvl">' . htmlspecialchars($row['content']) . '</div>';
    echo '<div class="t-op-nextlvl">' . htmlspecialchars($row['admission_no']) . '</div>';
    echo '<div class="t-op-nextlvl">' . htmlspecialchars($row['name']) . '</div>';
    echo '<div class="t-op-nextlvl">' . htmlspecialchars($row['branch_name']) . '</div>';
    echo '<div class="t-op-nextlvl">' . htmlspecialchars($row['degree']) . '</div>';
    echo '</div>';
}

} else {
    // Handle the case where the query fails
    echo 'Error fetching data: ' . mysqli_error($connection);
}

// Close the database connection
// mysqli_close($connection);
?>



                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="../../../style/dashboard.js"></script>
</body>

</html>