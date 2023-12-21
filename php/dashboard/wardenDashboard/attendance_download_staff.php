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

// Fetch attendance data from the database for the current date
$currentDate = date('Y-m-d');
$query = "SELECT id, name, admission_no, branch, semester, morning, night, date, matron, hs FROM attendance WHERE date = '$currentDate' AND staff=1";
$result = mysqli_query($conn, $query);

// Add table to PDF for attendance
$html = '<h2 style="text-align: center;">Staff Attendance for ' . $currentDate . '</h2><table border="1">';
$html .= '<thead>
            <tr>
              <th style="font-size: 10px; text-align: center;">Name</th>
              <th style="font-size: 10px; text-align: center;">Morning</th>
              <th style="font-size: 10px; text-align: center;">Night</th>
        
            </tr>
          </thead>';
$html .= '<tbody>';

// Loop through each row in the result set
while ($row = mysqli_fetch_assoc($result)) {
    $html .= '<tr>';
    // $html .= '<td style="font-size: 10px; text-align: center;">' . $row['id'] . '</td>';
    $html .= '<td style="font-size: 10px;">&nbsp;' . $row['name'] . '</td>';
    // $html .= '<td style="font-size: 10px; text-align: center;">' . $row['admission_no'] . '</td>';
    // $html .= '<td style="font-size: 10px;">&nbsp;' . $row['branch'] . '</td>';
    // $html .= '<td style="font-size: 10px; text-align: center;">' . $row['semester'] . '</td>';
    $html .= '<td style="font-size: 10px; text-align: center;">' . $row['morning'] . '</td>';
    $html .= '<td style="font-size: 10px; text-align: center;">' . $row['night'] . '</td>';
    // $html .= '<td style="font-size: 10px; text-align: center;">' . $row['matron'] . '</td>';
    // $html .= '<td style="font-size: 10px; text-align: center;">' . $row['hs'] . '</td>';
    $html .= '</tr>';
}

$html .= '</tbody>';
$html .= '</table>';

$pdf->writeHTML($html, true, false, true, false, '');

ob_end_clean();
$pdf->Output('attendance_report.pdf', 'D'); // 'D' means force download

mysqli_close($conn);
ob_end_flush(); // Flush the output buffer
?>
