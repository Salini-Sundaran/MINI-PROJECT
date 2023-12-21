<?php
// Check if the PHPMailer\Exception class is already defined
if (!class_exists('PHPMailer\PHPMailer\Exception')) {
    // Include the PHPMailer files only if the Exception class is not defined
    require 'PHPMailer/src/Exception.php';
    require 'PHPMailer/src/PHPMailer.php';
    require 'PHPMailer/src/SMTP.php';
}

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Create a PHPMailer instance
$mail = new PHPMailer();
$mail->isSMTP();
$mail->Host = 'smtp.gmail.com';
$mail->SMTPAuth = true;
$mail->Username = 'ritstudent123@gmail.com'; 
$mail->Password = 'ecbayegvmtnjtzxv'; 
$mail->SMTPSecure = 'ssl';
$mail->Port = 465;
$mail->setFrom('ritstudent123@gmail.com');
$mail->isHTML(true);

// Define the email subject
$subject = 'Important Notice: Admission Confirmation and Fee Payment Details';
$mail->Subject = $subject;

// Assuming $data is an array with an 'email' key
if (isset($data['email'])) {
    $mail->addAddress($data['email']);
    
    // Define the email body with styling
    $message = "
        <html>
        <head>
            <style>
                body {
                    font-family: 'Arial', sans-serif;
                    background-color: #f4f4f4;
                    color: #333;
                    margin: 0;
                    padding: 0;
                }

                .container {
                    max-width: 600px;
                    margin: 20px auto;
                    background-color: #fff;
                    padding: 20px;
                    border-radius: 10px;
                    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                }

                h1, h2, p, li {
                    margin: 0;
                    padding: 0;
                }

                h1 {
                    color: #0066cc;
                    margin-bottom: 20px;
                }

                ol, ul {
                    list-style: none;
                    margin: 10px 0;
                }

                ol li, ul li {
                    margin-bottom: 5px;
                }

                p {
                    line-height: 1.5;
                    margin-bottom: 10px;
                }

                .footer {
                    margin-top: 20px;
                    padding-top: 10px;
                    border-top: 1px solid #ddd;
                    text-align: left;
                    color:white;
                    background-color:blue;
                }
            </style>
        </head>
        <body>
            <div class='container'>
                <h1>Important Notice: Admission Confirmation and Fee Payment Details</h1>

                <p>Dear [Student's Name],</p>

                <p>Greetings from R.I.T. Kottayam!</p>
                <br>

                We hope this email finds you well. We are pleased to inform you that you have been allotted a spot in the Ladies Hostel at our institution for the upcoming academic year.
<br><br>
                Please carefully review the following details to ensure a smooth transition:
                <br><br>
                <b>1. *Hostel Admission Confirmation:*</b>
                   - You have successfully secured admission to the Ladies Hostel .
                -Please make the fee payment and confirm your seats .<br><br>
                
                <b> 2. *Fee Payment Information:*</b>
                   - Hostel Admission Fee: 10000 for students except students belonging to sc/st category.
                   - Payment Deadline: Please complete the payment by 7-12-2023.
                   - Payment Method: Visit the College Office, RIT Pampady to make the payment. Accepted methods include [ cash only].
                   - Reference Information: When making the payment, mention your [Specify any reference number or details required for identification].
                   <br><br>
                   <b>  3. *Special Notice for SC/ST/OEC/OBCH Categories:*</b>
                   - Students falling under these categories are advised to complete their admission process between 5.12.2023 and 6.12.2023.
                   - The office will be open from 9:30 AM to 3:00 PM during this period.
                   <br><br>
                
                
                Please make note of the relevant dates and deadlines to ensure a hassle-free process. If you have any queries or require assistance, feel free to contact the office.
                <br><br>
                We look forward to welcoming you to R.I.T. Kottayam and wish you a successful academic year.

                <div class='footer'>
                    <p>Best regards,<br>
                    [Your Name]<br>
                    [Your Title/Position]<br>
                    R.I.T. Kottayam<br>
                    [Contact Information]</p>
                </div>
            </div>
        </body>
        </html>
    ";

    $mail->Body = $message;

    // Send email
    if ($mail->send()) {
        echo "<script>
            alert('Message sent successfully');
            // window.location.replace('/');
        </script>";
    } else {
        echo "Error sending email: " . $mail->ErrorInfo;
    }
} else {
    echo "Error: Email address not found in the data.";
}
?>