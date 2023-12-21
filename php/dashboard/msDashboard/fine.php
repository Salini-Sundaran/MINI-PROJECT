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

    </style>
</head>

<body>

    <!-- for header part -->
    <header>

        <div class="logosec">
            <div class="logo">Mess secretary Dashboard</div>
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

            <div class="box-container">


            </div>
            
            <form action="process_fine.php" method="post">
            <h2> Add Fine </h2><br>

                <!-- Date input -->
                <label for="date">Date:</label>
                <input type="date" name="date" id="date" placeholder="YYYY-MM-DD" required><br><br>

                <!-- Admission Number input -->
                <label for="admission_no">Admission Number:</label>
                <input type="text" name="admission_no" id="admission_no" required><br><br>

                <!-- Reason input -->
                <label for="reason">Reason:</label>
                <input type="text" name="reason" id="reason" required><br><br>

                <!-- Status input -->
                <!-- <label for="status">Status:</label> -->
                <input type="hidden" name="status"  value="unpaid" id="status" required><br><br>

                <!-- Amount input -->
                <label for="amount">Amount:</label>
                <input type="number" name="amount" id="amount" required><br><br>

                <!-- Type input -->
                <!-- <label for="type">Type:</label> -->
                <input type="hidden" name="type" value="Mess fine" id="type" required><br><br>

                <input type="submit" value="Add/Update">

            </form>

    <script src="../../../style/dashboard.js"></script>
</body>

</html>