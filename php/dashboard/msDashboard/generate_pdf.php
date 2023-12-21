<?php
require_once('../../tcpdf/tcpdf.php');
include "../../../connection/connection.php"; // Include your database connection file

// Function to generate PDF
function generatePDF($conn) {
    $pdf = new TCPDF();
    $pdf->setPrintHeader(false);
    $pdf->setPrintFooter(false);

    ob_start();

    // Include the HTML content that you want in the PDF
    include 'mess_bill.php'; // Replace with the actual name of your file

    $content = ob_get_clean();

    $pdf->AddPage();
    $pdf->writeHTML($content, true, false, true, false, '');

    // Output the PDF to the browser with the necessary headers
    header('Content-Type: application/pdf');
    header('Content-Disposition: attachment; filename="report.pdf"');
    $pdf->Output('report.pdf', 'D');
}

// Call the function to generate the PDF
generatePDF($conn);
?>
