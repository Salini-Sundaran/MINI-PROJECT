<?php
include "../connection/connection.php"; // Include your database connection file

// Query to retrieve values from the 'points' table where id = 1
$sql = "SELECT * FROM points WHERE id = 1";
$result = $conn->query($sql);

// Check if there are results
if ($result->num_rows > 0) {
    // Fetch and print the data
    while ($row = $result->fetch_assoc()) {
        // Access the values using column names
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

        // Do something with the retrieved values
        // echo "p_y1: $p_y1, p_y2: $p_y2, p_y3: $p_y3, p_y4: $p_y4, pg: $pg, total: $total, t_y1: $t_y1, t_y2: $t_y2, t_y3: $t_y3, t_y4: $t_y4, t_pg: $t_pg";
    }
} else {
    echo "No results found";
}

// Function to insert data into the student list table
function insertIntoStudentList($conn, $data)  
{
    // Escape values to prevent SQL injection
    foreach ($data as $key => $value) {
        $data[$key] = $conn->real_escape_string($value);
    }

    // Formulate the SQL query
    $sql = "INSERT IGNORE INTO hostel_student_list (
        `name`, `gender`, `degree`, `yearOfStudy`, `admissionNo`, `semester`, `branch`,
        `pAddress`, `gAddress`, `pincode`, `mobile`, `distance_metric`, `income_metric`,
        `p1`, `p2`, `other`,`obcOrOec`, 
        `sgpa1`, `sgpa2`, `sgpa3`, `sgpa4`, `sgpa5`, `sgpa6`, `sgpa7`, `sgpa8`,
        `rank`, `dAction`, `created_at`, `updated_at`,`email`
    ) VALUES (
        '$data[name]', '$data[gender]', '$data[degree]', '$data[yearOfStudy]',
        '$data[admissionNo]', '$data[semester]', '$data[branch]', '$data[pAddress]',
        '$data[gAddress]', '$data[pincode]', '$data[mobile]', '$data[distance]',
        '$data[aIncome]', '$data[p1]', '$data[p2]', '$data[other]',
        '$data[obcOrOec]',
        '$data[sgpa1]', '$data[sgpa2]', '$data[sgpa3]', '$data[sgpa4]',
        '$data[sgpa5]', '$data[sgpa6]', '$data[sgpa7]', '$data[sgpa8]',
        '$data[rank]', '$data[dAction]', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP,'$data[email]'
    )";
    include "message.php";
    $sql1 = "INSERT IGNORE INTO login (`username`,`password`,`user_type`) VALUES ('$data[admissionNo]','$data[admissionNo]','student')";

    // Execute the query
    $conn->query($sql);
    $conn->query($sql1);

    // Check for errors
    if ($conn->error) {
        echo "Error: " . $conn->error;
    }
}

// Function to insert data into the waiting list table
function insertIntoWaitingList($conn, $data)
{
    // Escape values to prevent SQL injection
    foreach ($data as $key => $value) {
        $data[$key] = $conn->real_escape_string($value);
    }

    // Formulate the SQL query
    $sql = "INSERT IGNORE INTO waiting_list (
        `name`, `gender`, `degree`, `yearOfStudy`, `admissionNo`, `semester`, `branch`,
        `pAddress`, `gAddress`, `pincode`, `mobile`, `distance_metric`, `income_metric`,
        `p1`, `p2`, `other`,`obcOrOec`, 
        `sgpa1`, `sgpa2`, `sgpa3`, `sgpa4`, `sgpa5`, `sgpa6`, `sgpa7`, `sgpa8`,
        `rank`, `dAction`, `created_at`, `updated_at`,`email`
    ) VALUES (
        '$data[name]', '$data[gender]', '$data[degree]', '$data[yearOfStudy]',
        '$data[admissionNo]', '$data[semester]', '$data[branch]', '$data[pAddress]',
        '$data[gAddress]', '$data[pincode]', '$data[mobile]', '$data[distance]',
        '$data[aIncome]', '$data[p1]', '$data[p2]', '$data[other]',
        '$data[obcOrOec]',
        '$data[sgpa1]', '$data[sgpa2]', '$data[sgpa3]', '$data[sgpa4]',
        '$data[sgpa5]', '$data[sgpa6]', '$data[sgpa7]', '$data[sgpa8]',
        '$data[rank]', '$data[dAction]', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP,'$data[email]'
    )";

    // Execute the query
    $conn->query($sql);

    // Check for errors
    if ($conn->error) {
        echo "Error: " . $conn->error;
    }
}

// Set the maximum limit for student insertion
$maxStudentLimit = $total; // Change this to your desired limit

// Initialize counter variable
$insertedStudentsCount = 0;

// Fetch data from the hostel_student_registration table
$sql = "SELECT * FROM hostel_student_registration";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        if ($row['p1'] == 1) {
            // If p1 is 1, store the student details directly into the student list table
            insertIntoStudentList($conn, $row);
            $insertedStudentsCount++;

            // Check if the maximum limit is reached
            if ($insertedStudentsCount >= $maxStudentLimit) {
                break;
            }
        }
    }

    // Move the result pointer back to the beginning of the result set
    $result->data_seek(0);

    while ($row = $result->fetch_assoc()) {
        if ($row['p2'] == 1) {
            // If p2 is 1, store the student details into the student list table
            insertIntoStudentList($conn, $row);
            $insertedStudentsCount++;

            // Check if the maximum limit is reached
            if ($insertedStudentsCount >= $maxStudentLimit) {
                break;
            }
        }
    }

    // Move the result pointer back to the beginning of the result set
    $result->data_seek(0);

    // Initialize counter for waiting list
    $waitingListCount = 0;

    while ($row = $result->fetch_assoc()) {
        if ($row['p1'] != 1 && $row['p2'] != 1) {
            // For other students, check conditions based on year of study and branch
            $yearOfStudy = $row['yearOfStudy'];
            $branch = $row['branch'];
            $randomChance = rand(1, 100); // Generate a random number between 1 and 100

            // Implement the probability conditions
            if ($yearOfStudy == 1 && $randomChance <= $p_y1) {
                insertIntoStudentList($conn, $row);
                $insertedStudentsCount++;

                // Check if the maximum limit is reached
                if ($insertedStudentsCount >= $maxStudentLimit) {
                    break;
                }
            } elseif ($yearOfStudy == 2 && $randomChance <= $p_y2) {
                insertIntoStudentList($conn, $row);
                $insertedStudentsCount++;

                // Check if the maximum limit is reached
                if ($insertedStudentsCount >= $maxStudentLimit) {
                    break;
                }
            } elseif ($yearOfStudy == 3 && $randomChance <= $p_y3) {
                insertIntoStudentList($conn, $row);
                $insertedStudentsCount++;

                // Check if the maximum limit is reached
                if ($insertedStudentsCount >= $maxStudentLimit) {
                    break;
                }
            } elseif (($yearOfStudy == 4 && $randomChance <= 10) || // For year 4
            (($branch == 'MCA' || $branch == 'M.Tech') && $randomChance <= $p_y4)) { // For 'mca' or 'mtech'
       // Additional conditions for branch 'mca' or 'mtech'
                insertIntoStudentList($conn, $row);
                $insertedStudentsCount++;

                // Check if the maximum limit is reached
                if ($insertedStudentsCount >= $maxStudentLimit) {
                    break;
                }
            } else {
                // If conditions are not met, insert into waiting list
                insertIntoWaitingList($conn, $row);
                $waitingListCount++;
            }
        }
    }

    // Display a message with the count of students added to the waiting list
    // echo "Added $waitingListCount students to the waiting list.";

} else {
    echo "0 results";
}

// Close the database connection
$conn->close();

// JavaScript code to display an alert and redirect
echo '<script type="text/javascript">';
echo 'alert("List Generated Successfully.");';
echo 'window.location = "dashboard/wardenDashboard/finalized_students.php";'; // Replace "another_page.php" with the URL of the page you want to redirect to.
echo '</script>';
?>
