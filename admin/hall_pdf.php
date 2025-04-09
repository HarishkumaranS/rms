<?php
// Database Connection
require('./assets/fpdf/fpdf.php');
include '../Config/db_connection.php';
// Fetch Data from Database
$add_qry = "";
if (isset($_POST['f_date']) && isset($_POST['t_date']) && !empty($_POST['t_date']) && !empty($_POST['f_date'])) {
    $f_date = $_POST['f_date'];
    $t_date = $_POST['t_date'];
    $add_qry = "WHERE b_date BETWEEN '$f_date' AND '$t_date' order by b_date ASC ";
} elseif (isset($_POST['f_date']) && !empty($_POST['f_date'])) {
    $f_date = $_POST['f_date'];
    $add_qry = "WHERE b_date BETWEEN '$f_date' AND (SELECT MAX(b_date) FROM event_booking) order by b_date ASC";
} elseif (isset($_POST['t_date']) && !empty($_POST['t_date'])) {
    $t_date = $_POST['t_date'];
    $add_qry = "WHERE b_date <= '$t_date' order by b_date ASC";
}

$select_qry = "SELECT eb.b_id, eb.date, eb.b_date, eb.e_id, eb.cust_id, 
                      c.cust_name, e.e_name,
                      CASE eb.time
                        WHEN 'morning' THEN 'Morning to Afternoon'
                        WHEN 'evening' THEN 'Evening to Night'
                      END AS time_of_day
               FROM event_booking eb
               JOIN customer c ON eb.cust_id = c.cust_id
               JOIN event e ON eb.e_id = e.e_id 
               $add_qry";

$result_select = mysqli_query($con, $select_qry);

class PDF extends FPDF
{
    function Header()
    {
        $this->SetFont('Arial', 'B', 16);
        $this->Cell(0, 10, 'Event Booking Details', 0, 1, 'C');
        $this->Ln(5);
    }

    function Footer()
    {
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 10);
        $this->Cell(0, 10, 'Page ' . $this->PageNo(), 0, 0, 'C');
    }
}

$pdf = new PDF('L', 'mm', 'A3');
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 12);

// Table Caption
$pdf->Ln(5);
// $pdf->Cell(0, 10, 'Hall booked from [start date] to [end date]', 0, 1, 'C');
// $pdf->Ln(8);

// Table Headers
$header = ['S.No', 'Date', 'Booked Date', 'Customer Name', 'Event Name', 'Timing'];
$widths = [20, 40, 40, 80, 80, 80];

// Calculate Table Width for Centering
$tableWidth = array_sum($widths);
$pageWidth = $pdf->GetPageWidth();
$startX = ($pageWidth - $tableWidth) / 2;

// Header Background Color
$pdf->SetFillColor(200, 200, 200);
$pdf->SetTextColor(0);
$pdf->SetDrawColor(0, 0, 0);

// Set X position for table centering
$pdf->SetX($startX);

// Print Table Headers
foreach ($header as $key => $col) {
    $pdf->Cell($widths[$key], 12, $col, 1, 0, 'C', true);
}
$pdf->Ln();

// Fetch Data from Database and Populate Table
$pdf->SetFont('Arial', '', 12);
$s_no = 1;
while ($row = mysqli_fetch_array($result_select)) {
    $pdf->SetX($startX);
    $pdf->Cell($widths[0], 12, $s_no, 1, 0, 'C');
    $pdf->Cell($widths[1], 12, $row['date'], 1, 0, 'C');
    $pdf->Cell($widths[2], 12, $row['b_date'], 1, 0, 'C');
    $pdf->Cell($widths[3], 12, $row['cust_name'], 1, 0, 'C');
    $pdf->Cell($widths[4], 12, $row['e_name'], 1, 0, 'C');
    $pdf->Cell($widths[5], 12, $row['time_of_day'], 1, 0, 'C');
    $pdf->Ln();
    $s_no++;
}

$pdf->Output();
?>