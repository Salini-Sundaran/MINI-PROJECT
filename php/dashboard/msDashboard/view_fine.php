<!DOCTYPE html>
<html lang="en">
<?php
// Include necessary PHP files
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
        .report-topic-heading {
            display: grid;
            grid-template-columns: 1fr 1fr 1fr 1fr 1fr 1fr;
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
            grid-template-columns: 1fr 1fr 1fr 1fr 1fr 1fr;
            margin: 5px 0;
            padding: 5px;
        }
    </style>
</head>

<body>
    <!-- Header Section -->
    <header>
        <div class="logosec">
            <div class="logo">Mess secretary Dashboard</div>
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

    <!-- Main Container -->
    <div class="main-container">
        <?php
        // Include sidebar
        include "../../../component/sidebar/ms.php";
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
                    <h1 class="recent-Articles">Fine Records</h1>
                    <button class="view">Download</button>
                </div>

                <div class="report-body">
                    <div class="report-topic-heading">
                        <h3 class="t-op">Date</h3>
                        <h3 class="t-op">Admission No</h3>
                        <h3 class="t-op">Reason</h3>
                        <h3 class="t-op">Status</h3>
                        <h3 class="t-op">Amount</h3>
                        <!-- <h3 class="t-op">Type</h3> -->
                    </div>

                    <?php
                    // Fetch data from the 'fine' table with type 'hs_fine'
                    $query = "SELECT date, admission_no, reason, status, amount, type FROM fine WHERE type='Mess fine'";
                    $result = mysqli_query($conn, $query);

                    // Check if the query was successful
                    if ($result) {
                        // Loop through each row in the result set
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo '<div class="item1">';
                            echo '<div class="t-op-nextlvl">' . htmlspecialchars($row['date']) . '</div>';
                            echo '<div class="t-op-nextlvl">' . htmlspecialchars($row['admission_no']) . '</div>';
                            echo '<div class="t-op-nextlvl">' . htmlspecialchars($row['reason']) . '</div>';
                            echo '<div class="t-op-nextlvl">' . htmlspecialchars($row['status']) . '</div>';
                            echo '<div class="t-op-nextlvl">' . htmlspecialchars($row['amount']) . '</div>';
                            // echo '<div class="t-op-nextlvl">' . htmlspecialchars($row['type']) . '</div>';
                            echo '</div>';
                        }
                    } else {
                        // Handle the case where the query fails
                        echo 'Error fetching data: ' . mysqli_error($conn);
                    }

                    // Close the database connection
                    mysqli_close($conn);
                    ?>
                </div>
            </div>
        </div>
    </div>

    <script src="../../../style/dashboard.js"></script>
</body>

</html>
