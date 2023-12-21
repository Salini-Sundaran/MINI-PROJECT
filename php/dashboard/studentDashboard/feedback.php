<?php
session_start();
error_reporting(E_ERROR | E_PARSE);

$admission_no = $_SESSION['username'];
$role = $_SESSION['role'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    include '../../../connection/connection.php';

    $food = $_POST['food'];
    $foodType = $_POST['foodType'];
    $content = $_POST['content'];
    $admissionNo = $admission_no; // Assuming $username contains admission_no

    // Insert feedback into food_feedback table
    $query = "INSERT INTO food_feedback (feedback, admission_no, food, fooditem) VALUES ('$content', '$admissionNo', '$foodType', '$food')";
    $result = mysqli_query($conn, $query);

    if ($result) {
        // Feedback successfully inserted, redirect to prevent form resubmission
        echo '<script>alert("Feedback submitted successfully!"); window.location.href = window.location.href;</script>';
        exit();
    } else {
        // Display an error message if the insertion fails
        echo '<script>alert("Error submitting feedback. Please try again.");</script>';
    }
}
?>

<?php
session_start();
error_reporting(E_ERROR | E_PARSE);

$username = $_SESSION['username'];
$role = $_SESSION['role'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RIT Hostel</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="../../../style/dash-style.css">
    <link rel="stylesheet" href="../../../style/responsive.css">
    <style>
        .food-item {
            transition: background-color 0.3s ease;
            cursor: pointer;
            margin-bottom: 20px;

        }

        .food-item:hover {
            background-color: rgb(63,0,151); /* Add your desired hover background color */
            color:white;
            
        }

        .food-card {
            width: 1300px;
            /* max-width: 100%; Set the maximum width of the food card */
            margin: 0 auto; /* Center the food card */
        }

        .food-details {
            padding: 20px;
        }
    </style>

</head>

<body>

    <header>
        <div class="logosec">
            <div class="logo">Student Dashboard</div>
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
        include "../../../component/sidebar/student.php";
        ?>

        <div class="main">
            <div class="searchbar2">
                <input type="text" name="" id="" placeholder="Search">
                <div class="searchbtn">
                    <img src="https://media.geeksforgeeks.org/wp-content/uploads/20221210180758/Untitled-design-(28).png"
                        class="icn srchicn" alt="search-button">
                </div>
            </div>

            <?php
            include '../../../connection/connection.php';

            $query = "SELECT * FROM food_menu WHERE menu_id = 1";
            $result = mysqli_query($conn, $query);

            while ($row = mysqli_fetch_assoc($result)) {
            ?>
                <div class="dashboard-items-container">
                    <div class="food-card">
                        <h2 class="food-title">Select food for feedback</h2>
                        <div class="food-details">
                            <div class="row">
                                <div class="col food-item food-clickable" data-meal-type="breakfast"
                                    data-food-type="Breakfast" data-food-item="<?php echo $row['breakfast_item']; ?>">
                                    <div class="food-title">
                                        <i class="fas fa-utensils food-icon"></i>
                                        <span class="food-label">Breakfast:</span>
                                    </div>
                                    <div class="food-name"><?php echo $row['breakfast_item']; ?></div>
                                    <div class="food-time">8:00 AM - 9:00 AM</div>
                                </div>

                                <div class="col food-item food-clickable" data-meal-type="lunch"
                                    data-food-type="Lunch" data-food-item="<?php echo $row['lunch_item']; ?>">
                                    <div class="food-title">
                                        <i class="fas fa-utensils food-icon"></i>
                                        <span class="food-label">Lunch:</span>
                                    </div>
                                    <div class="food-name"><?php echo $row['lunch_item']; ?></div>
                                    <div class="food-time">12:00 PM - 1:30 PM</div>
                                </div>

                                <div class="col food-item food-clickable" data-meal-type="evening"
                                    data-food-type="Evening" data-food-item="<?php echo $row['evening_item']; ?>">
                                    <div class="food-title">
                                        <i class="fas fa-utensils food-icon"></i>
                                        <span class="food-label">Evening:</span>
                                    </div>
                                    <div class="food-name"><?php echo $row['evening_item']; ?></div>
                                    <div class="food-time">4:00 PM - 5:30 PM</div>
                                </div>

                                <div class="col food-item food-clickable" data-meal-type="dinner"
                                    data-food-type="Dinner" data-food-item="<?php echo $row['dinner_item']; ?>">
                                    <div class="food-title">
                                        <i class="fas fa-utensils food-icon"></i>
                                        <span class="food-label">Dinner:</span>
                                    </div>
                                    <div class="food-name"><?php echo $row['dinner_item']; ?></div>
                                    <div class="food-time">8:00 PM - 9:30 PM</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php
            }
            ?>
    <div class="complaint-section">
        <h2 class="complaint-title">Feedback</h2>
        <form id="complaint-form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <label for="food" class="input-title">Food</label>
            <input class="complaint-input" type="text" name="food" id="food" readonly>

            <label for="foodType">Food Type</label>
            <input class="complaint-input" type="text" name="foodType" id="foodType" readonly>

            <label for="description">Feedback</label>
            <textarea class="complaint-textarea" name="content" placeholder="Enter your Feedback" required></textarea>

            <button type="submit" class="inform-button">Inform</button>
        </form>
    </div>

        </div>
    </div>

    <input type="hidden" id="selectedFoodDetails">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="../../../style/dashboard.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const foodItems = document.querySelectorAll('.food-clickable');

            foodItems.forEach(function (foodItem) {
                foodItem.addEventListener('click', function () {
                    const mealType = foodItem.getAttribute('data-meal-type');
                    const foodType = foodItem.getAttribute('data-food-type');
                    const foodDetails = foodItem.getAttribute('data-food-item');

                    document.getElementById('food').value = foodDetails;
                    document.getElementById('foodType').value = foodType;

                    const feedbackContent = `Selected Food Details for ${mealType}:\n
                        ${foodDetails}`;

                    document.getElementById('selectedFoodDetails').value = feedbackContent;
                });
            });
        });
    </script>
</body>

</html>
