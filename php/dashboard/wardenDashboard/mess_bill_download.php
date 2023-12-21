<?php
ob_start(); // Start output buffering

require_once('../../tcpdf/tcpdf.php');
include "../../../connection/connection.php"; // Assuming you have a database connection established

// Create instance of TCPDF
$pdf = new TCPDF();

// Add a page
$pdf->AddPage();

// Set font
$pdf->SetFont('times', 'normal', 12);

// Fetch data from the database for the new table `mess_bill`
$query = "SELECT id, admission_no, name, semester, branch, year_of_study, degree, room_id, fee_concession, total_attendance, fine_amount, stock_per_student, created_at FROM mess_bill";
$result = mysqli_query($conn, $query);

// Function to add table to PDF for the new data
function addMessBillToPDF($pdf, $messBillData) {
    $html = '<h2 style="text-align: center;">Mess Bill Details</h2><table border="1">';
    $html .= '<thead>
                <tr>
                  <th style="font-size: 10px; text-align: center;">ID</th>
                  <th style="font-size: 10px; text-align: center;">Admission No</th>
                  <th style="font-size: 10px; text-align: center;">Name</th>
                  <th style="font-size: 10px; text-align: center;">Semester</th>
                  <th style="font-size: 10px; text-align: center;">Branch</th>
                  <th style="font-size: 10px; text-align: center;">Year of Study</th>
                  <th style="font-size: 10px; text-align: center;">Degree</th>
                  <th style="font-size: 10px; text-align: center;">Room ID</th>
                  <th style="font-size: 10px; text-align: center;">Fee Concession</th>
                  <th style="font-size: 10px; text-align: center;">Total Attendance</th>
                  <th style="font-size: 10px; text-align: center;">Fine Amount</th>
                  <th style="font-size: 10px; text-align: center;">Amount Per Student</th>
                  <th style="font-size: 10px; text-align: center;">Created At</th>
                </tr>
              </thead>';
    $html .= '<tbody>';

    while ($row = mysqli_fetch_assoc($messBillData)) {
        $html .= '<tr>';
        $html .= '<td style="font-size: 10px; text-align: center;">' . $row['id'] . '</td>';
        $html .= '<td style="font-size: 10px; text-align: center;">' . $row['admission_no'] . '</td>';
        $html .= '<td style="font-size: 10px;">&nbsp;' . $row['name'] . '</td>';
        $html .= '<td style="font-size: 10px; text-align: center;">' . $row['semester'] . '</td>';
        $html .= '<td style="font-size: 10px;">&nbsp;' . $row['branch'] . '</td>';
        $html .= '<td style="font-size: 10px; text-align: center;">' . $row['year_of_study'] . '</td>';
        $html .= '<td style="font-size: 10px;">&nbsp;' . $row['degree'] . '</td>';
        $html .= '<td style="font-size: 10px; text-align: center;">' . $row['room_id'] . '</td>';
        $html .= '<td style="font-size: 10px; text-align: center;">' . $row['fee_concession'] . '</td>';
        $html .= '<td style="font-size: 10px; text-align: center;">' . $row['total_attendance'] . '</td>';
        $html .= '<td style="font-size: 10px; text-align: center;">' . $row['fine_amount'] . '</td>';
        $html .= '<td style="font-size: 10px; text-align: center;">' . $row['stock_per_student'] . '</td>';
        $html .= '<td style="font-size: 10px; text-align: center;">' . $row['created_at'] . '</td>';
        $html .= '</tr>';
    }

    $html .= '</tbody>';
    $html .= '</table>';

    $pdf->writeHTML($html, true, false, true, false, '');
}

// Add mess bill data to the PDF
addMessBillToPDF($pdf, $result);

ob_end_clean();
$pdf->Output('mess_bill_report.pdf', 'D'); // 'D' means force download

mysqli_close($conn);
ob_end_flush(); // Flush the output buffer
?>
