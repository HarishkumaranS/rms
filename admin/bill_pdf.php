<?php
// Database Connection
include '../Config/db_connection.php';
use Dba\Connection;
if (isset($_POST['submit']) && isset($_POST['cust_name'])) {
    require('./assets/fpdf/fpdf.php');
    $items = [];
    // Date, Time, Bill Number (Left) and Name, Phone Number (Right) at the Same Vertical Level
    $date = date('Y-m-d'); // Current date
    $time = date('H:i:s'); // Current time
    $customerName = $_POST['cust_name']; // Replace with dynamic data
    $customerPhone = $_POST['cust_no']; // Replace with dynamic data
    $serviceType = $_POST['service'];
    $select_qry="SELECT cust_id FROM customer WHERE cust_num=$customerPhone";
    $result=mysqli_query($con,$select_qry);
    $num=mysqli_fetch_row($result);
    $cust_id=null;
    if($num==0)
    {
        $insert_qry="INSERT INTO customer (cust_name, cust_num) VALUES ('$customerName', '$customerPhone')";
        $result_qry=mysqli_query($con,$insert_qry);
        $cust_id= mysqli_insert_id($con);
    }
    else
    {
        $select_qry="SELECT cust_id FROM customer WHERE cust_num=$customerPhone";
        $result=mysqli_query($con,$select_qry);
        $row=mysqli_fetch_array($result);
        $cust_id=$row['cust_id'];
    }
    for ($i = 0; $i < count($_POST['product_id']); $i++) {
        $product_id = $_POST['product_id'][$i];
        $qty= $_POST['product_qty'][$i];
        $update_qry = "UPDATE product SET product_stock=product_stock- $qty where product_id=$product_id";
        $result_update = mysqli_query($con, $update_qry);
        $select_qry = "SELECT product_name,product_c_price FROM product WHERE product_id=$product_id";
        $result_qry = mysqli_query($con, $select_qry);
        $row = mysqli_fetch_array($result_qry);
        $total_price=$qty* $row['product_c_price'];
        $insert_qry = "INSERT INTO order_off ( order_date, order_time, cust_id, product_id,qty,total_price,service)
        VALUES ( '$date', '$time', '$cust_id', '$product_id', '$qty','$total_price','$serviceType')";
        $result=mysqli_query($con,$insert_qry);
        array_push($items, ['id' => $i + 1, 'name' => $row['product_name'], 'qty' =>$qty, 'price' => $row['product_c_price']]);
    }
    // Create a new instance of the FPDF class
    $pdf = new FPDF();
    $pdf->AddPage();
    $pdf->SetFont('Arial', 'B', 16);

    // Restaurant Details
    $pdf->Cell(190, 10, 'FOOD WORLD', 0, 1, 'C');
    $pdf->SetFont('Arial', '', 12);
    $pdf->Cell(190, 8, '56/9, Kumaran Street, RKV Road, Erode-638145', 0, 1, 'C');
    $pdf->Cell(190, 8, 'Phone: +919876543210', 0, 1, 'C');
    $pdf->Ln(10);
    // You can change this to 'Take Away' dynamically

    $pdf->SetFont('Arial', '', 12);

    // Row 1: Date and Name
    $pdf->Cell(95, 8, "Date: $date", 0, 0, 'L'); // Date on the left
    $pdf->Cell(95, 8, "Name: $customerName", 0, 1, 'L'); // Name on the right

    // Row 2: Time and Phone
    $pdf->Cell(95, 8, "Time: $time", 0, 0, 'L'); // Time on the left
    $pdf->Cell(95, 8, "Phone: $customerPhone", 0, 1, 'L'); // Phone on the right

    // Row 3: Bill Number (Aligned with the rest)
    // $pdf->Cell(95, 8, "Bill No: $billNo", 0, 0, 'L'); // Bill Number on the left
    $pdf->Cell(95, 8, "Service: $serviceType", 0, 1, 'L'); // Service Type (Take Away or Dining) on the right
    $pdf->Ln(5);

    // Bill Header (with borders)
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(10, 10, 'S No', 1, 0, 'C');
    $pdf->Cell(90, 10, 'Item', 1, 0, 'C');
    $pdf->Cell(30, 10, 'Qty', 1, 0, 'C');
    $pdf->Cell(30, 10, 'Price', 1, 0, 'C');
    $pdf->Cell(30, 10, 'Total', 1, 1, 'C');


    // Add items to the bill
    $pdf->SetFont('Arial', '', 12);
    $totalAmount = 0;
    foreach ($items as $item) {
        $total = $item['qty'] * $item['price'];
        $totalAmount += $total;
        $pdf->Cell(10, 10, $item['id'], 1, 0, 'C');
        $pdf->Cell(90, 10, $item['name'], 1, 0, 'L');
        $pdf->Cell(30, 10, $item['qty'], 1, 0, 'C');
        $pdf->Cell(30, 10, number_format($item['price'], 2), 1, 0, 'R'); // Format price to 2 decimal places
        $pdf->Cell(30, 10, number_format($total, 2), 1, 1, 'R'); // Format total to 2 decimal places
    }

    // Total
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(160, 10, 'Grand Total', 1, 0, 'R');
    $pdf->Cell(30, 10, number_format($totalAmount, 2), 1, 1, 'R'); // Format grand total to 2 decimal places

    // Footer
    $pdf->Ln(10);
    $pdf->SetFont('Arial', '', 10);
    $pdf->Cell(190, 8, 'Thank you for dining with us!', 0, 1, 'C');
    $pdf->Cell(190, 8, 'Visit Again!', 0, 1, 'C');

    // Output PDF (Display in Browser)
    $pdf->Output('I', 'restaurant_bill.pdf');
}
else
{
    echo "<script>window.history.back();</script>";
}
?>