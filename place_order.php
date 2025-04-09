<?php
if (isset($_GET['order_product'])) {
    $product_id = $_GET['order_product'];
    if (isset($user_id)) {
        function place_order()
        {
            global $user_id, $con, $product_id;
            $select_qry = "SELECT product_c_price,product_img,product_name,product_price,product_stock from product where product_id=$product_id";
            $resulr_qry = mysqli_query($con, $select_qry);
            $row = mysqli_fetch_array($resulr_qry);
            $img = $row['product_img'];
            $product_name = $row['product_name'];
            $product_price_c = $row['product_c_price'];
            $product_price = $row['product_price'];
            $product_stock = $row['product_stock'];
            if (!isset($_SESSION['cart'][$product_id]['quantity'])) {
                $_SESSION['cart'][$product_id] = ['productId' => $product_id, 'quantity' => 1];
            }
            if ($_SESSION['cart'][$product_id]['quantity'] <= $product_stock) {
                $qty = $_SESSION['cart'][$product_id]['quantity'];
            } else {
                $_SESSION['cart'][$product_id] = ['productId' => $product_id, 'quantity' => $product_stock];
                $qty = $_SESSION['cart'][$product_id]['quantity'];
            }
            if (isset($_POST['submit']) && $qty != 0 && $qty <= $product_stock) {

                // $mob_num2 = $_POST['num2'];
                // $address = $_POST['addres'];
                // $payment_type = $_POST['payment_type'];
                // $update_qry = "UPDATE user SET mob_num2=$mob_num2,address='$address' where user_id=$user_id";
                // $result_update = mysqli_query($con, $update_qry);
                $insert_qry = "INSERT INTO user_order(product_id,user_id,qty,total_price,o_date,d_date)values($product_id,$user_id,$qty, $product_price_c*$qty,now(),DATE_ADD(NOW(),INTERVAL 1 HOUR))";
                $result_insert = mysqli_query($con, $insert_qry);
                // to display the delivered date and time in order Confirmed page 
                $last_id = mysqli_insert_id($con);
                // update stock
                $update_qry = "UPDATE product SET product_stock=product_stock- $qty where product_id=$product_id";
                $result_update = mysqli_query($con, $update_qry);
                if ($result_insert) {
                    // delivered date
                    $select_qry = "SELECT d_date from user_order Where o_id=$last_id";
                    $result_qry = mysqli_query($con, $select_qry);
                    $row = mysqli_fetch_array($result_qry);
                    ?>
                    <div class="svg">
                        <div class="confirmation-container">
                            <div class="checkmark-container">
                                <div class="checkmark"></div>
                            </div>
                            <h1 class="order_heading">Order Confirmed!</h1>
                            <p class="order_detailes">Your order has been successfully placed and will be delivered on
                                <?php echo $row['d_date']; ?>. <br>Thank you
                                for choosing us.</p>
                            <a href="second page.php?order" class=" nav-link order-button">Go to My Order</a>
                        </div>
                    </div>
                    <?php
                }
            } else { ?>
                <div class="container my-3">
                    <div class="row">
                        <!-- Dynamic Product Cards (Main Content) -->
                        <div class="col-lg-8 col-md-7 col-sm-12 mb-3" id="product-cards">
                            <div class="card md-3">
                                <div class="row g-0">
                                    <div class="col-md-4">
                                        <img src="./admin/assets/image/product_image/<?php echo $img; ?>" class="img-fluid rounded-start p-2"
                                            alt="<?php echo $product_name; ?>">
                                    </div>
                                    <div class="col-md-8">
                                        <div class="card-body">
                                            <h5 class="card-title"><?php echo $product_name; ?></h5>
                                            <table>
                                                <tr>
                                                    <th class='p-2'>
                                                        Price
                                                    </th>
                                                    <th>
                                                        <spam id="product_price"><?php echo $product_price * $qty; ?></spam>/-
                                                    </th>
                                                </tr>
                                                <tr>
                                                    <th class='p-2'>
                                                        Discound
                                                    </th>
                                                    <th class='text-success'>-
                                                        <spam id="product_discount">
                                                            <?php echo ($product_price - $product_price_c) * $qty; ?>
                                                        </spam>
                                                        /-
                                                    </th>
                                                </tr>
                                                <tr>
                                                    <th class='p-2'>
                                                        Total Amount
                                                    </th>
                                                    <th>
                                                        <spam id="total_price"><?php echo $product_price_c * $qty; ?></spam>/-
                                                    </th>
                                                </tr>
                                                <tr>
                                                    <th class='p-2'>
                                                        Quantity
                                                    </th>
                                                    <th>
                                                        <div class='quantity'>
                                                            <a href='second page.php?dec_view=<?php echo $product_id; ?>' class='dec'><i
                                                                    class='fa-solid fa-circle-minus'></i></a>
                                                            <span><?php echo $qty; ?></span>
                                                            <a href='second page.php?inc_view=<?php echo $product_id; ?>' class='inc'><i
                                                                    class='fa-solid fa-circle-plus'></i></a>
                                                        </div>
                                                    </th>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Order Summary & Checkout (Sidebar) -->
                        <div class="col-lg-4 col-md-5 col-sm-12">
                            <div class="card mb-3">
                                <div class="card-header bg-success text-white">
                                    <h5>Order Summary</h5>
                                </div>
                                <div class="card-body">
                                    <p>Total Items: <span id="count"><?php echo $qty; ?></span></p>
                                    <p>Total Price: ₹<spam id="total_price"><?php echo $product_price_c * $qty; ?></spam>/-</p>
                                </div>
                            </div>

                            <!-- Checkout Form -->
                            <?php
                            $select_qry = "SELECT user_name,mob_num1,mob_num2 FROM user where user_id=$user_id";
                            $resulr_qry = mysqli_query($con, $select_qry);
                            $row = mysqli_fetch_array($resulr_qry);
                            $user_name = $row['user_name'];
                            $user_mob1 = $row['mob_num1'];
                            $user_mob2 = $row['mob_num2'];
                            // $user_addres = $row['address'];
                            ?>
                            <div class="card">
                                <div class="card-header bg-secondary text-white">
                                    <h5>Checkout</h5>
                                </div>
                                <div class="card-body">
                                    <form id="order-form" action="" method="post">
                                        <div class="mb-3">
                                            <label for="name" class="form-label">Full Name: </label>
                                            <h5><?php echo $user_name; ?></h5>
                                        </div>
                                        <div class="mb-3">
                                            <label for="mobile" class="form-label">Mobile Number 1:</label>
                                            <h5><?php echo $user_mob1; ?></h5>
                                        </div>
                                        <?php
                                        $select_qry = "SELECT MIN(qty) AS min_qty from fav WHERE user_id=$user_id";
                                        $result_qry = mysqli_query($con, $select_qry);
                                        $row = mysqli_fetch_array($result_qry);
                                        $min_qty = $row['min_qty'];
                                        ?>
                                        <input type="submit" name="submit" class="btn btn-info" value="Place Order" <?php if ($qty >= $product_stock) {
                                            echo 'id="disabled"';
                                        } ?>>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
            }
        }
    } else {
        echo "<script>window.location.href='login_logout.php?login';</script>";
    }
}
?>