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

// Fetch data from the database
$query = "SELECT id, name, gender, degree, yearOfStudy, admissionNo, semester, branch, distance_metric, income_metric, p2 FROM hostel_student_list";
$result = mysqli_query($conn, $query);

// Separate students into categories
$p2Category = array();
$yearCategories = array('1' => array(), '2' => array(), '3' => array(), '4' => array(), '5' => array());
$pgCategory = array();

while ($row = mysqli_fetch_assoc($result)) {
    if ($row['p2'] == 1) {
        $p2Category[] = $row;
    } elseif ($row['degree'] == 'B.Tech' || $row['degree'] == 'B.Arch') {
        $yearCategories[$row['yearOfStudy']][] = $row;
    } elseif ($row['degree'] == 'MCA' || $row['degree'] == 'M.Tech') {
        $pgCategory[] = $row;
    }
}

// Function to sort the array by longest distance and smallest income
function sortByMetrics($a, $b) {
    // Distance metric out of 70 points, income metric out of 30 points
    $totalMetricA = ($a['distance_metric'] / 100) * 70 + ($a['income_metric'] / 100) * 30;
    $totalMetricB = ($b['distance_metric'] / 100) * 70 + ($b['income_metric'] / 100) * 30;

    return $totalMetricA - $totalMetricB;
}

// Add table to PDF for each category
function addCategoryToPDF($pdf, $category, $categoryName) {
    // Sort the category array by metrics
    usort($category, 'sortByMetrics');

    $html = '<h2 style="text-align: center;">' . $categoryName . '</h2><table border="1">';
    $html .= '<thead>
                <tr>
                  <th style="font-size: 10px; text-align: center;">SI No</th>
                  <th style="font-size: 10px; text-align: center;">Name</th>
                  <th style="font-size: 10px; text-align: center;">Course</th>
                  <th style="font-size: 10px; text-align: center;">Branch</th>
                  <th style="font-size: 10px; text-align: center;">Admn No</th>
                  <th style="font-size: 10px; text-align: center;">Distance Metric</th>
                  <th style="font-size: 10px; text-align: center;">Income Metric</th>
                  <th style="font-size: 10px; text-align: center;">Total Metric</th>
                </tr>
              </thead>';
    $html .= '<tbody>';

    // Initialize SI No
    $siNo = 1;

    foreach ($category as $row) {
        // Calculate total metric
        $totalMetric = ($row['distance_metric'] / 100) * 70 + ($row['income_metric'] / 100) * 30;

        $html .= '<tr>';
        $html .= '<td style="font-size: 10px; text-align: center;">' . $siNo++ . '</td>';
        $html .= '<td style="font-size: 10px;">&nbsp;' . $row['name'] . '</td>';
        $html .= '<td style="font-size: 10px;">&nbsp;' . $row['degree'] . '</td>';
        $html .= '<td style="font-size: 10px;">&nbsp;' . $row['branch'] . '</td>';
        $html .= '<td style="font-size: 10px; text-align: center;">' . $row['admissionNo'] . '</td>';
        $html .= '<td style="font-size: 10px; text-align: center;">' . $row['distance_metric'] . '</td>';
        $html .= '<td style="font-size: 10px; text-align: center;">' . $row['income_metric'] . '</td>';
        $html .= '<td style="font-size: 10px; text-align: center;">' . number_format($totalMetric, 2) . '</td>';
        $html .= '</tr>';
    }

    $html .= '</tbody>';
    $html .= '</table>';

    $pdf->writeHTML($html, true, false, true, false, '');
}

// Add each category to the PDF
addCategoryToPDF($pdf, $p2Category, 'PRIORITY II CATEGORY (SC/ST/BPL/PH)');
foreach ($yearCategories as $year => $category) {
    addCategoryToPDF($pdf, $category, 'B-TECH/B-ARCH YEAR ' . $year);
}
addCategoryToPDF($pdf, $pgCategory, 'PG (MCA/M.TECH)');

ob_end_clean();
$pdf->Output('student_list.pdf', 'D'); // 'D' means force download

mysqli_close($conn);
ob_end_flush(); // Flush the output buffer
?>
