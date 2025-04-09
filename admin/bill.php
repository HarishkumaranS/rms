<?php
function bill()
{
    if (isset($_SESSION['admin']) || isset($_SESSION['biller'])) {
        global $con;
        ?>
        <h4 align="center"><b>Counter Billing</b></h4>
        <form action="bill_pdf.php" method="post">
            <table id="productTable" align="center" class="table table-striped table-light">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col" align="center">Customer Name</th>
                        <th scope="col" align="center">Customer Number</th>
                        <th scope="col" align="center">Service Type</th>
                        <th scope="col" align="center">Product Name</th>
                        <th scope="col" align="center">Quantity</th>
                    </tr>
                    <tr id="row_0">
                        <!-- Customer Name (only alphabetic characters) -->
                        <td scope="row">
                            <input type="text" class="form-control" name="cust_name" id="cust_name_0" pattern="[A-Za-z\s]+"
                                required autocomplete="off">
                        </td>

                        <!-- Phone Number (must be exactly 10 digits) -->
                        <td>
                            <input type="tel" class="form-control" name="cust_no" id="cust_no_0" pattern="^\d{10}$" required
                                autocomplete="off">
                        </td>

                        <td>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="service" id="flexRadioDefault1"
                                    value="Dining" checked>
                                <label class="form-check-label" for="flexRadioDefault1">
                                    Dining
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="service" id="flexRadioDefault2"
                                    value=" Takeaway">
                                <label class="form-check-label" for="flexRadioDefault2">
                                    Takeaway
                                </label>
                            </div>
                        </td>

                        <!-- Product ID (only numbers) -->
                        <td>
                            <?php

                            $sql = "SELECT product_id, product_name FROM product WHERE status = 1";
                            $result = mysqli_query($con, $sql);

                            $products = [];
                            while ($row = mysqli_fetch_assoc($result)) {
                                $products[] = $row;
                            }
                            ?>
                            <select id="productDropdown" name="product_id[]" class="productDropdown form-select"
                                style="width: 300px;" required>
                                <option value="">Select a product</option>
                                <?php
                                // Loop through products and create <option> elements
                                foreach ($products as $product) {
                                    echo "<option value='" . $product['product_id'] . "'>" . $product['product_name'] . "</option>";
                                }
                                ?>
                            </select>
                        </td>

                        <!-- Quantity (positive number) -->
                        <td>
                            <input type="number" class="form-control" name="product_qty[]" id="product_qty_0" min="1" required
                                autocomplete="off">
                        </td>
                    </tr>
                    </tbody>
            </table>
            <div class="center">
                <!-- <button type="button"  onclick="deleteAllRows()">Delete All Rows</button> -->
                <input type="submit" class="action-btn" value="Generate Bill" name="submit">
            </div>
            <h5>
                <p style="margin-top: 10px; color:white;" align="center">
                    Shortcuts:
                    <strong>Ctrl + Enter</strong> to add a new product row,
                    <strong>Ctrl + Backspace</strong> to delete the last added row.
                </p>
            </h5>
        </form>
        <?php
    } else {
        echo "<script>window.location.href='index.php?login';</script>";
    }
?>
<?php
}
?>
<?php
// Fetch products from the database
$sql = "SELECT product_id, product_name FROM product WHERE status = 1";
$result = mysqli_query($con, $sql);

$products = [];
while ($row = mysqli_fetch_assoc($result)) {
    $products[] = $row;
}

// Prepare product options HTML
$productOptions = "";
foreach ($products as $product) {
    $productOptions .= "<option value='" . $product['product_id'] . "'>" . $product['product_name'] . "</option>";
}
?>