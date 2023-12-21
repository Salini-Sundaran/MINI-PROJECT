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
            <div class="dashboard-items-container" style="display:block">
                <div class="food-card" style="width:100%;">
                    <h2 class="food-title">Today's Menu</h2>
                    <div class="food-details row gap-0">
                        <div class="col-6">
                            <div class="food-item">
                                <div class="food-title">
                                    <i class="fas fa-utensils food-icon"></i>
                                    <span class="food-label">Breakfast:</span>
                                </div>
                                <div class="food-name">Uppumavu</div>
                                <div class="food-time">8:00 AM - 10:00 AM</div>
                            </div>  
                        </div>
                        <div class="col-6">
                            <div class="food-item">
                                <div class="food-title">
                                    <i class="fas fa-utensils food-icon"></i>
                                    <span class="food-label">Breakfast:</span>
                                </div>
                                <div class="food-name">Uppumavu</div>
                                <div class="food-time">8:00 AM - 10:00 AM</div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="food-item">
                                <div class="food-title">
                                    <i class="fas fa-utensils food-icon"></i>
                                    <span class="food-label">Breakfast:</span>
                                </div>
                                <div class="food-name">Uppumavu</div>
                                <div class="food-time">8:00 AM - 10:00 AM</div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="food-item">
                                <div class="food-title">
                                    <i class="fas fa-utensils food-icon"></i>
                                    <span class="food-label">Breakfast:</span>
                                </div>
                                <div class="food-name">Uppumavu</div>
                                <div class="food-time">8:00 AM - 10:00 AM</div>
                            </div>
                        </div>
                    </div>
                 </div>
                
    </div>

    <script src="../../../style/dashboard.js"></script>
</body>

</html>