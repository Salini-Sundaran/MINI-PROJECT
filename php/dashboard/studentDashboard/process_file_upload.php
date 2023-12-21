<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the username from the session
    $username = $_SESSION['username'];

    // Handle file uploads for each document type
    // $targetDir = "uploads/";
    $targetDir = __DIR__ . "/uploads/";
  

    // Income Certificate
    $incomeCertificateName = $username . "_" . "Income Certificate" . "_" . basename($_FILES["incomeCertificate"]["name"]);
    $incomeCertificatePath = $targetDir . $incomeCertificateName;
    move_uploaded_file($_FILES["incomeCertificate"]["tmp_name"], $incomeCertificatePath);

    // Community Certificate
    $communityCertificateName = $username . "_" . "Community Certificate" . "_" .basename($_FILES["communityCertificate"]["name"]);
    $communityCertificatePath = $targetDir . $communityCertificateName;
    move_uploaded_file($_FILES["communityCertificate"]["tmp_name"], $communityCertificatePath);

    // Aadhar Card
    $aadharCardName = $username . "_" . "Aadhar Card" . "_" .basename($_FILES["aadharCard"]["name"]);
    $aadharCardPath = $targetDir . $aadharCardName;
    move_uploaded_file($_FILES["aadharCard"]["tmp_name"], $aadharCardPath);

    // Ration Card
    $rationCardName = $username . "_" . "Ration Card" . "_" .basename($_FILES["rationCard"]["name"]);
    $rationCardPath = $targetDir . $rationCardName;
    move_uploaded_file($_FILES["rationCard"]["tmp_name"], $rationCardPath);

    // Store file information in the database
    // $conn = new mysqli("localhost", "root", "", "file_upload");
    include '../../../connection/connection.php';
    $username = $_SESSION['username'];

    $query = "INSERT INTO files (username, file_name, file_path) VALUES 
              ('$username', '$incomeCertificateName', '$incomeCertificatePath'),
              ('$username', '$communityCertificateName', '$communityCertificatePath'),
              ('$username', '$aadharCardName', '$aadharCardPath'),
              ('$username', '$rationCardName', '$rationCardPath')";

    $conn->query($query);
    $conn->close();

    // echo "Documents uploaded successfully.";
    echo "<script>
    alert('Documents uploaded successfully..');
    window.location.href = 'file_upload.php';
  </script>";
}
?>
