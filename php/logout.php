<!DOCTYPE html>
<html>
<head>
    <style>
        /* CSS for the popup */
        .popup {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            padding: 20px;
            background: #fff; /* White background */
            border: 1px solid #ccc;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            z-index: 1000;
            width: 300px; /* Set the width to your desired size */
        }

        /* CSS for the background overlay */
        .overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(255, 255, 255, 0.7); /* White background with some transparency */
            z-index: 999;
        }
    </style>
</head>
<body>

<?php
session_start(); // Start the session

if (isset($_SESSION['username'])) {
    // Unset and destroy the session variables
    unset($_SESSION['username']);
    unset($_SESSION['role']);
    session_destroy();
    ?>
    
    <!-- HTML for the popup and overlay -->
    <div class="overlay" id="overlay"></div>
    <div class="popup" id="popup">
        <h2>Logging out...</h2>
        <!-- <img src="loading.gif" alt="Loading"> -->
    </div>

    <script>
        // Show the overlay and popup
        document.getElementById('overlay').style.display = 'block';
        document.getElementById('popup').style.display = 'block';

        // Redirect to the login page or any other page you want after logout after a delay
        setTimeout(function() {
            window.location.href = "../login.php"; // Change "login.php" to the desired destination page
        }, 3000); // Adjust the delay as needed
    </script>
    
    <?php
} else {
    // If the user is not logged in, you can handle this case accordingly
    // For example, redirect them to the login page
    header("Location: ../login.php"); // Change "login.php" to the login page URL
    exit();
}
?>
</body>
</html>
