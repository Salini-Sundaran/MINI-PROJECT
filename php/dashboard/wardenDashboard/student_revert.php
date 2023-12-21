<!DOCTYPE html>
<html lang="en">

<?php
include "../../../connection/connection.php";
include "../../data_fetch.php";

// Function to fetch student details by admission number
function getStudentDetails($admissionNo, $conn) {
    $query = "SELECT * FROM hostel_student_list WHERE admissionNo = '$admissionNo'";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        return mysqli_fetch_assoc($result);
    } else {
        return false;
    }
}

// Function to update student details
function updateStudentDetails($admissionNo, $field, $value, $conn) {
    $query = "UPDATE hostel_student_list SET $field = '$value' WHERE admissionNo = '$admissionNo'";
    return mysqli_query($conn, $query);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the "searchAdmissionNo" key is set in the $_POST array
    $searchAdmissionNo = isset($_POST["searchAdmissionNo"]) ? $_POST["searchAdmissionNo"] : '';

    if (!empty($searchAdmissionNo)) {
        $studentDetails = getStudentDetails($searchAdmissionNo, $conn);
    }

    // Check if the form is submitted and the admission number is not empty
    if (isset($_POST["update"]) && !empty($searchAdmissionNo)) {
        // Update student details if the form is submitted
        foreach ($_POST as $field => $value) {
            // Exclude the submit button and admission number from the update
            if ($field !== "update" && $field !== "searchAdmissionNo") {
                $result = updateStudentDetails($searchAdmissionNo, $field, $value, $conn);
                echo "<script>alert('student reverted successfully.');</script>";
                echo "<script>window.location.href = 'student_revert.php';</script>";

                // Debugging: Output the result of the update query
                // echo "Update Result for $field: " . ($result ? "Success" : "Failed") . "<br>";
            }
        }

        // Refresh student details after update
        $studentDetails = getStudentDetails($searchAdmissionNo, $conn);
    }
}
?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RIT Hostel</title>
    <link rel="stylesheet" href="../../../style/dash-style.css">
    <link rel="stylesheet" href="../../../style/responsive.css">
    <style>
        /* Add styles for the form and inputs */
        form {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-top: 20px;
        }

        label {
            font-weight: bold;
            width: 150px;
            margin-bottom: 5px;
        }

        input {
            width: 200px;
            padding: 8px;
            box-sizing: border-box;
        }

        button {
            background-color: #4caf50;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button[type="reset"] {
            background-color: #f44336;
        }

        /* Additional style for the message */
        .message {
            margin-top: 10px;
            font-weight: bold;
        }
    </style>
</head>

<body>
    
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

        <div class="report-container">
            <div class="report-header">
                <h1 class="recent-Articles">Student Revert</h1>
            </div>

            <!-- Search Form -->
            <form method="post" action="">
                <label for="searchAdmissionNo">Search Admission Number:</label>
                <input type="text" name="searchAdmissionNo" id="searchAdmissionNo" required>
                <button type="submit">Search</button>
                <button type="reset">Clear</button>
            </form>

            <!-- <div class="report-body"> -->
                <!-- Display Student Details -->
                <?php if (isset($studentDetails) && $studentDetails) : ?>
                    <form method="post" action="">                           

                        <input type="hidden" name="searchAdmissionNo" value="<?php echo $searchAdmissionNo; ?>">
                        <input type="hidden" name="searchAdmissionNo" value="<?php echo $searchAdmissionNo; ?>">
                        <?php foreach ($studentDetails as $field => $value) : ?>
                                
                            <label for="<?php echo $field; ?>"><?php echo ucwords(str_replace('_', ' ', $field)); ?>:</label>
                            <input type="text" name="<?php echo $field; ?>" id="<?php echo $field; ?>" value="<?php echo $value; ?>">
                           
                        
                         <br>
                        <?php endforeach; ?>
                        <button type="submit" name="update">Update</button>
                    </form>
                    </table>

                <?php elseif (isset($studentDetails) && !$studentDetails) : ?>
                    <p>No student found with the provided admission number.</p>
                <?php endif; ?>
            <!-- </div> -->
        </div>
    </div>
    <script src="../../../style/dashboard.js"></script>

</body>

</html>
