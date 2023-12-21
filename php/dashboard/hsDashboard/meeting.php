<!DOCTYPE html>
<html lang="en">
<?php
include "../../../connection/connection.php";
include "../../data_fetch.php";

// Handle meeting insertion
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'addMeeting') {
    $title = $_POST['title'];
    $date = $_POST['date'];
    $time = $_POST['time'];
    $location = $_POST['location'];
    $agenda = $_POST['agenda'];

    $insertQuery = "INSERT INTO meetings (title, date, time, location, agenda) VALUES ('$title', '$date', '$time', '$location', '$agenda')";
    $insertResult = mysqli_query($conn, $insertQuery);

    if ($insertResult) {
        echo "Meeting added successfully";
        exit;
    } else {
        echo "Error adding meeting: " . mysqli_error($conn);
        exit;
    }
}

// Handle meeting deletion
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'deleteMeeting') {
    $meetingId = $_POST['meetingId'];

    $deleteQuery = "DELETE FROM meetings WHERE id = $meetingId";
    $deleteResult = mysqli_query($conn, $deleteQuery);

    if ($deleteResult) {
        echo "Meeting deleted successfully";
        exit;
    } else {
        echo "Error deleting meeting: " . mysqli_error($conn);
        exit;
    }
}
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
        /* background-color: #f0f0f0; */
        font-weight: bold;
        height: 40px;
        background-color: white;
        color: black;
    }
    /* ... (Other styles remain unchanged) */



.meeting-form textarea {
    height: 80px; /* Adjust the height of the textarea if needed */
}

/* ... (Other styles remain unchanged) */

    .meeting-form {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 10px;
        margin-top: 1px;
        
    }

    .meeting-form input,
    .meeting-form textarea,
    .meeting-form select {
        width: 100%;
        padding: 8px;
        margin-top: 5px;
        margin-bottom: 10px;
        border: 1px solid #ccc;
        box-sizing: border-box;
    }

    .toast-message {
        display: none;
        background-color: #4CAF50;
        color: white;
        text-align: center;
        padding: 10px;
        position: fixed;
        top: 5px;
        left: 50%;
        transform: translateX(-50%);
        z-index: 1;
    }

    .edit-delete-buttons {
        display: flex;
        gap: 10px;
        margin-top: 10px;
    }



    .meeting-form label {
        font-weight: bold;
        margin-bottom: 5px;
    }

    .meeting-form button {
        background-color: #4CAF50;
        color: white;
        border: none;
        padding: 10px 20px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 16px;
        margin-top: 10px;
        cursor: pointer;
    }

    .meeting-form button:hover {
        background-color: #45a049;
    }

   

    .edit-delete-buttons button {
        background-color: #f44336;
        color: white;
        border: none;
        padding: 8px 12px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 14px;
        margin-top: 5px;
        cursor: pointer;
    }

    .edit-delete-buttons button:hover {
        background-color: #d32f2f;
    }

    .edit-delete-buttons button:nth-child(2) {
        background-color: #2196F3;
        margin-left: 5px;
    }

    .edit-delete-buttons button:nth-child(2):hover {
        background-color: #0d47a1;
    }
    table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            /* border: 1px solid black; */
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }


    </style>

</head>

<body>

    <!-- for header part -->
    <header>

        <div class="logosec">
            <div class="logo">Hostel secretary Dashboard</div>
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
        include "../../../component/sidebar/hs.php";
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
</br>
 <font color="blue" size="5px" style><b>+ Add Meeting</b></font>          
 <br> <br>     <!-- Meeting Form -->
                <form id="meetingForm" class="meeting-form" onsubmit="return addMeeting()">
                    <div class="meeting-form">
                        <label for="title">Title:</label>
                        <input type="text" id="title" name="title" required>

                        <label for="date">Date:</label>
                        <input type="date" id="date" name="date" required>

                        <label for="agenda">Agenda:</label>
                        <input type="text" id="agenda" name="agenda" required>

                        <label for="time">Time:</label>
                        <input type="time" id="time" name="time" required>

                        <label for="location">Location:</label>
                        <input type="text" id="location" name="location" required>

                        <button type="submit">Add Meeting</button>
                    </div>
                </form>   
                <br>
            </div>
            <br>
            <div class="report-container">

<br>
     
<!-- Fetch and display meeting data from the database -->
<?php
$fetchMeetingsQuery = "SELECT * FROM meetings";
$meetingsResult = mysqli_query($conn, $fetchMeetingsQuery);
?>
<table>
                <tr>
                    <!-- <th>Meeting ID</th> -->
                    <th>Title</th>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Location</th>
                    <th>Agenda</th>
                    <th>Actions</th>
                </tr>
                <?php
if ($meetingsResult) {
    while ($meeting = mysqli_fetch_assoc($meetingsResult)) {
?>
            
                <tr>
                    <!-- <td><?php echo $meeting['id']; ?></td> -->
                    <td><?php echo $meeting['title']; ?></td>
                    <td><?php echo $meeting['date']; ?></td>
                    <td><?php echo $meeting['time']; ?></td>
                    <td><?php echo $meeting['location']; ?></td>
                    <td><?php echo $meeting['agenda']; ?></td>
                    <td class="edit-delete-buttons">
                        <button onclick="deleteMeeting(<?php echo $meeting['id']; ?>)">Delete</button>
                    </td>
                </tr>
        </div>
<?php
    }
}

?>
            </table>




                    <!-- Toast Message -->
                    <div id="toastMessage" class="toast-message"></div>

            </div>
        </div>
    </div>

    <script>
    // Define the showToastMessage function
    function showToastMessage(message) {
        var toastMessage = document.getElementById('toastMessage');
        toastMessage.innerText = message;
        toastMessage.style.backgroundColor = '#4CAF50';
        toastMessage.style.display = 'block';
        setTimeout(function() {
            toastMessage.style.display = 'none';
            location.reload();

        }, 3000); // Hide the message after 3 seconds
    }

    function addMeeting() {
        var title = document.getElementById('title').value;
        var date = document.getElementById('date').value;
        var time = document.getElementById('time').value;
        var location = document.getElementById('location').value;
        var agenda = document.getElementById('agenda').value;

        // Use AJAX to submit the form data to the server
        var xhr = new XMLHttpRequest();
        xhr.open('POST', '<?php echo $_SERVER['PHP_SELF']; ?>');
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onload = function() {
            if (xhr.status === 200) {
                showToastMessage(xhr.responseText);
            } else {
                showToastMessage('Error adding meeting');
            }
        };
        xhr.send('action=addMeeting&title=' + title + '&date=' + date + '&time=' + time + '&location=' + location +
            '&agenda=' + agenda);

        return false; // Prevent the form from submitting normally
    }

    function deleteMeeting(meetingId) {
        // Use AJAX to send a request to delete the meeting
        var xhr = new XMLHttpRequest();
        xhr.open('POST', '<?php echo $_SERVER['PHP_SELF']; ?>');
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onload = function() {
            if (xhr.status === 200) {
                showToastMessage(xhr.responseText);
                // Remove the meeting details from the UI if deletion is successful
                var meetingElement = document.getElementById('meeting_' + meetingId);
                if (meetingElement) {
                    meetingElement.remove();
                }
            } else {
                showToastMessage('Error deleting meeting');
            }
        };
        xhr.send('action=deleteMeeting&meetingId=' + meetingId);
    }
    </script>
    <script src="../../../style/dashboard.js"></script>
</body>

</html>