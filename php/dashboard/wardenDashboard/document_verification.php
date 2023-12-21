<?php
// Include your database connection
include "../../../connection/connection.php";

// Fetch documents and student details
$query = "SELECT s.*, f.* FROM hostel_student_list s
          LEFT JOIN files f ON s.admissionNo = f.username";
$result = $conn->query($query);

// Check if there are documents for the users
if ($result->num_rows > 0) {
    $documents = $result->fetch_all(MYSQLI_ASSOC);
} else {
    $documents = array(); // No documents found
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RIT Hostel</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="../../../style/dash-style.css">
    <link rel="stylesheet" href="../../../style/responsive.css">
    <style>
        .document-list {
            list-style: none;
            padding: 0;
        }

        .document-item {
            margin-bottom: 10px;
        }
    </style>
</head>

<body>

    <!-- Include your header and sidebar here -->
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
        <!-- Include your sidebar file -->
        <?php include "../../../component/sidebar/warden.php"; ?>


        <div class="main">
            <div class="dashboard-items-container" style="display:block">
                <?php foreach ($documents as $document) : ?>
                    <div class="user-box">
                        <h2>User: <?php echo $document['admissionNo']; ?></h2>
                        <!-- Display student details -->
                        <ul class="student-details">
                            <li><strong>Name:</strong> <?php echo $document['name']; ?></li>
                            <li><strong>Gender:</strong> <?php echo $document['gender']; ?></li>
                            <li><strong>Degree:</strong> <?php echo $document['degree']; ?></li>
                            <!-- Add more student details as needed -->
                        </ul>

                        <!-- Display document details -->
                        <ul class="document-list">
                            <?php if ($document['file_name']) : ?>
                                <li class="document-item">
                                    <strong>Document Name:</strong> <?php echo $document['file_name']; ?><br>
                                    <strong>Upload Time:</strong> <?php echo $document['upload_time']; ?><br>
                                    <?php if ($document['verified'] == 1) : ?>
                                        <span style="color: green;">Verified</span>
                                    <?php else : ?>
                                        <a href="verify_document.php?id=<?php echo $document['id']; ?>">Verify</a>
                                    <?php endif; ?> |
                                    <a href="../studentDashboard/uploads/<?php echo $document['file_name']; ?>">Download Document</a>
                                </li>
                            <?php else : ?>
                                <li>No documents uploaded for this student.</li>
                            <?php endif; ?>
                        </ul>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
    <script src="../../../style/dashboard.js"></script>
</body>

</html>
