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

            



<br>
            <!-- Add this form below your existing HTML code -->
<div class="time-setting-form-container">
<!-- ... your existing HTML code ... -->

<!-- Add this form below your existing HTML code -->
<div class="add-staff-form-container">
    <form action="add_staff.php" method="post">
        <h2>Add New Staff</h2>
        <br>

        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required>
        </div>

        <div class="form-group">
            <label for="address">Address:</label>
            <input type="text" id="address" name="address" required>
        </div>

        <div class="form-group">
            <label for="phone">Phone:</label>
            <input type="text" id="phone" name="phone" required>
        </div>

        <div class="form-group">
            <label for="email">Email:</label>
            <input type="text" id="email" name="email" required>
        </div>

        <div class="form-group">
            <label for="dob">Date of Birth:</label>
            <input type="date" id="dob" name="dob" required>
        </div>
<br>
        <div class="form-group">
            <input type="submit" value="Add">
        </div>
    </form>
</div>

<!-- ... your existing HTML code ... -->
<br>
   
</div>
<!-- Add this table below your existing HTML code -->
<div class="staff-table-container">
    <h2>Staff List</h2>
    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Address</th>
                <th>Phone</th>
                <th>Email</th>
                <th>Date of Birth</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <!-- Fetch and display staff data from the database -->
            <?php
            // Include your database connection file
            include "../../../connection/connection.php";

            // SQL query to select data from the staff table
            $query = "SELECT * FROM staff";
            $result = mysqli_query($conn, $query);

            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $row['name'] . "</td>";
                echo "<td>" . $row['address'] . "</td>";
                echo "<td>" . $row['phone'] . "</td>";
                echo "<td>" . $row['email'] . "</td>";
                echo "<td>" . $row['dob'] . "</td>";
                echo "<td>
                        <a href='delete_staff.php?id=" . $row['id'] . "'>Delete</a>
                    </td>";
                echo "</tr>";
            }

            // Close the database connection
            mysqli_close($conn);
            ?>
        </tbody>
    </table>
</div>
     

        </div>
    </div>

    <script src="../../../style/dashboard.js"></script>

</body>

</html>