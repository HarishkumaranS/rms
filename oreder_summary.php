<?php
if (isset($_GET['order_summary'])) {
    $order_id = $_GET['order_summary'];
    function order_summary()
    {
        global $user_id, $con, $order_id;
        // user_order table
        $select_order = "SELECT * FROM user_order where o_id= $order_id";
        $result_order = mysqli_query($con, $select_order);
        $row_order = mysqli_fetch_array($result_order);
        $product_id = $row_order['product_id'];
        $order_price = $row_order['total_price'];
        $order_date = $row_order['o_date'];
        $delivered_date = $row_order['d_date'];
        $order_qty = $row_order['qty'];
        $status = $row_order['status'];
        $select_qry = "SELECT product_name,product_scale,product_img FROM product where product_id=$product_id";
        $result_qry = mysqli_query($con, $select_qry);
        $row_product = mysqli_fetch_array($result_qry);
        $product_name = $row_product['product_name'];
        $product_scale = $row_product['product_scale'];
        $product_img = $row_product['product_img'];
        ?>
        <!-- Product Image -->
        <div class="col-12 col-md-4 text-center condent">
            <a href='second page.php?view=<?php echo $product_id; ?>'><img
                    src="./admin/product_image/<?php echo $product_img; ?>" alt="Product Image"
                    class="img-fluid product-image"></a>
        </div>

        <!-- Product Details -->
        <div class="col-12 col-md-8 condent">
            <h4><?php echo $product_name; ?></h4>
            <p><?php echo $product_scale; ?></p>

            <p><strong>Price:</strong> ₹<?php echo $order_price / $order_qty; ?></p>
            <p><strong>Quantity:</strong> <?php echo $order_qty; ?></p>

            <!-- Total Price under Quantity -->
            <p class="total-price">Total Price: ₹<?php echo $order_price; ?></p>

            <p><strong>Order Date:</strong> <?php echo $order_date; ?></p> <!-- Added Order Date -->
            <!-- <p><strong>Payment Type:</strong> <?php /*echo $payment_type; */ ?></p> -->
            <!-- Status Badge -->
            <div class="d-flex align-items-center">
                <?php if ($status == 1) {
                    echo "<span class='badge  status-badge text-light' style='background-color:green;'>Delivered</span>";
                } else {
                    echo "<span class='badge  status-badge text-light' style='background-color:red;'>Pending</span>";
                } ?>
            </div>

            <!-- Delivery Information -->
            <div class="delivery-info">
                <p><strong>Delivery Date <?php if ($status == 0) {
                    echo '(Expected)';
                } ?>:</strong>
                    <?php echo $delivered_date; ?></p>
            </div>

            <!-- Shipping Address
            <div class="mt-3">
                <h5>Shipping Address</h5>
                <p><?php /* echo $address;*/ ?></p>
            </div> -->
        </div>

        <?php
    }
}
?>