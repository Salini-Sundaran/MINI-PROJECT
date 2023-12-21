<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RIT Hostel - Mess Secretary Dashboard</title>
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

    <!-- Header -->
    <header>
        <div class="logosec">
            <div class="logo">Hostel Scereatory Dashboard</div>
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
        <!-- Include your sidebar file -->
        <?php include "../../../component/sidebar/hs.php"; ?>

        <div class="main">
            <div class="searchbar2">
                <input type="text" name="" id="" placeholder="Search">
                <div class="searchbtn">
                    <img src="https://media.geeksforgeeks.org/wp-content/uploads/20221210180758/Untitled-design-(28).png"
                        class="icn srchicn" alt="search-button">
                </div>
            </div>

            <div class="box-container">
                <!-- Add your content here -->
            </div>

            
            <!-- Display Stock Table -->
            <h2>Stock Data</h2>
            <table>
                <tr>
                    <th>Product Name</th>
                    <th>Quantity</th>
                    <th>Unit Price</th>
                    <th>Total Value</th>
                    <th>Date Added</th>
                    <th>Notes</th>
                    <th>BILL</th>
                    <th>Action</th> <!-- New column for delete button -->

                </tr>
                <?php
                                include '../../../connection/connection.php';

                $query = "SELECT * FROM stock";
                $result = mysqli_query($conn, $query);

                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . $row['product_name'] . "</td>";
                    echo "<td>" . $row['quantity'] . "</td>";
                    echo "<td>" . $row['unit_price'] . "</td>";
                    echo "<td>" . ($row['quantity'] * $row['unit_price']) . "</td>";
                    echo "<td>" . $row['date_added'] . "</td>";
                    echo "<td>" . $row['notes'] . "</td>";
                    // $imagePath = $row['bill_image'];
                    $imageName = basename($row['bill_image']);

                    $imagePath = '../msDashboard/uploads'.'/'. $imageName;


                // echo ''. $imagePath .'';
                if (file_exists($imagePath)) {
                    echo "<td><img src='" . $imagePath . "'  style='max-width: 1000px; max-height: 100px;'></td>";
                } else {
                    echo "<td>Image not found</td>";
                }
               // Add delete button with a form
    
            
               if ($row['hs'] == 0) {
                   echo "<td>";
                   echo "<form action='update_stock.php' method='post'>";
                   echo "<input type='hidden' name='product_id' value='" . $row['product_id'] . "'>";
                   echo "<input type='submit' value='Confirm'>";
                   echo "</form>";
                   echo "</td>";
               } else {
                   echo "<td><span>Marked</span></td>";
               }
               ?>
               

 echo "</tr>";
 <?php
                }
                ?>
            </table>

        </div>
    </div>

    <script src="../../../style/dashboard.js"></script>
</body>

</html>
