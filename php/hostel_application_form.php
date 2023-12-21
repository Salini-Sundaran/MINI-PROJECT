<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Establish a connection to your MySQL database
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "hostel";

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check the connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Extract form data
    $admissionNo = $_POST['admissionNo'];

    // Check if admission number already exists
    $checkQuery = "SELECT * FROM hostel_student_registration WHERE admissionNo = '$admissionNo'";
    $result = $conn->query($checkQuery);

    if ($result->num_rows > 0) {
        ?>
        <script>
            if (window.confirm('You are already registered'))
            {
                window.location.href='../login.php';
            };
        </script>
        <?php
    } else {
        // Continue with the registration process

        // Extract the rest of the form data
        $name = $_POST['name'];
        $gender = $_POST['gender'];
        $degree = $_POST['degree'];
        $yearOfStudy = $_POST['yearOfStudy'];
        $semester = $_POST['semester'];
        $branch = $_POST['branch'];
        $pAddress = $_POST['pAddress'];
        $gAddress = $_POST['gAddress'];
        $pincode = $_POST['pincode'];
        $mobile = $_POST['mobile'];
        $gMobile = $_POST['gMobile'];
        $prAddress = $_POST['prAddress'];
        $p1 = isset($_POST['p1']) ? 1 : 0;
        $p2 = isset($_POST['p2']) ? 1 : 0;
        $other = isset($_POST['other']) ? 1 : 0;
        $aIncome = $_POST['aIncome'];
        $obcOrOec = $_POST['obcOrOec'];
        $distance = $_POST['distance'];
        $sgpa1 = $_POST['sgpa1'];
        $sgpa2 = $_POST['sgpa2'];
        $sgpa3 = $_POST['sgpa3'];
        $sgpa4 = $_POST['sgpa4'];
        $sgpa5 = $_POST['sgpa5'];
        $sgpa6 = $_POST['sgpa6'];
        $sgpa7 = $_POST['sgpa7'];
        $sgpa8 = $_POST['sgpa8'];
        $rank = $_POST['rank'];
        $dAction = $_POST['dAction'];
        $email = $_POST['email'];


        // Prepare and execute SQL query
        $sql = "INSERT INTO hostel_student_registration(name, gender, degree, yearOfStudy, admissionNo, semester, branch, pAddress, gAddress, pincode, mobile, gMobile, prAddress, p1, p2, other, aIncome, obcOrOec, distance, sgpa1, sgpa2, sgpa3, sgpa4, sgpa5, sgpa6, sgpa7, sgpa8, rank, dAction, email) VALUES 
        ('$name', '$gender', '$degree', '$yearOfStudy', '$admissionNo', '$semester', '$branch', '$pAddress', '$gAddress', '$pincode', '$mobile', '$gMobile', '$prAddress', '$p1', '$p2', '$other', '$aIncome', '$obcOrOec', '$distance', '$sgpa1', '$sgpa2', '$sgpa3', '$sgpa4', '$sgpa5', '$sgpa6', '$sgpa7', '$sgpa8', '$rank', '$dAction', '$email')";

        if ($conn->query($sql) === TRUE) {
            ?>
            <script>
                if (window.confirm('Registration successfully'))
                {
                    window.location.href='../login.php';
                };
            </script>
            <?php
        } else {
            ?>
            <script>
                if (window.confirm('Oops!!!!!  Registration  failed '))
                {
                    window.location.href='../login.php';
                };
            </script>
            <?php
        }
    }

    $conn->close(); // Close the database connection
}
?>
