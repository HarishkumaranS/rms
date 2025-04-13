<style>


</style>
<?php
function bill()
{
    if (isset($_SESSION['admin']) || isset($_SESSION['biller'])) {
        global $con;
        ?>
        <!-- Modal -->
        <div id="qrModal" class="qr-modal">
            <div class="qr-content">
                <h3 id="paymentText" style="color: gray; margin-bottom: 15px;"></h3>
                <img class="qr-code" id="qrCodeImage" src="" alt="UPI Payment QR Code">
            </div>
        </div>
        <h4 align="center"><b>Counter Billing</b></h4>
        <div id="amount" class="alert alert-info d-none  form-outline m-3 ">
            <strong>Total amount : ₹ <span id="totalAmount_0"></span><span class="text-primary"> QR Code : Alt + Shift +
                    G</span></strong>
        </div>
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
                            $sql = "SELECT product_id, product_name, product_c_price, product_stock FROM product WHERE status = 1 and product_stock >0";
                            $result = mysqli_query($con, $sql);

                            $products = [];
                            while ($row = mysqli_fetch_assoc($result)) {
                                $products[] = $row;
                            }
                            ?>
                            <select id="product" name="product_id[]" class="productDropdown form-select" style="width: 180px;"
                                required onchange="updateTotal()">
                                <option value="">Select a product</option>
                                <?php
                                // Loop through products and create <option> elements
                                foreach ($products as $product) {
                                    echo "<option value='" . $product['product_id'] . "' data-price='" . $product['product_c_price'] . "' data-stock='" . $product['product_stock'] . "'>" . $product['product_name'] . "</option>";

                                }
                                ?>
                            </select>
                        </td>
                        <script>
                            $(document).ready(function () {

                                $("#product").select2({
                                    placeholder: "Search for a Product",
                                    allowClear: true
                                });
                            });
                        </script>
                        <!-- Quantity (positive number) -->
                        <td>
                            <input type="number" class="form-control" name="product_qty[]" id="product_qty_0" min="1" required
                                autocomplete="off" oninput="updateTotal()">
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
                    <strong>Alt + Enter</strong> to add a new product row,
                    <strong>Alt + Backspace</strong> to delete the last added row.
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
$sql = "SELECT product_id, product_name, product_c_price, product_stock FROM product WHERE status = 1 and product_stock >0";
$result = mysqli_query($con, $sql);

$products = [];
while ($row = mysqli_fetch_assoc($result)) {
    $products[] = $row;
}

// Prepare product options HTML
$productOptions = "";
foreach ($products as $product) {
    $productOptions .= "<option value='" . $product['product_id'] . "' data-price='" . $product['product_c_price'] . "' data-stock='" . $product['product_stock'] . "'>" . $product['product_name'] . "</option>";
}
?>
<script>
    let productCount = 1;
    // add row
    function addProductRow() {
        const table = document.getElementById('productTable');
        const row = table.insertRow(-1);
        row.setAttribute('id', `row_${productCount}`);

        row.innerHTML = `
        <td></td>
        <td></td>
        <td></td>
        <td>
            <select class="productDropdown" name="product_id[]" id="productDropdown_${productCount}" required onchange="updateTotal()">
                <option value="">Select a product</option>
                <?php echo $productOptions; ?>
            </select>
        </td>
        <td>
            <input type="number" class="form-control" name="product_qty[]" id="product_quantity_${productCount}" min="1" required oninput="updateTotal()">
        </td>
    `;

        productCount++;

        // Initialize select2 on the new dropdown
        // search box for product second row to last
        $(`#productDropdown_${productCount - 1}`).select2({
            placeholder: "Search for a product",
            allowClear: true
        });
    }
    // Remove a specific row
    function removeProductRow(rowId) {
        const table = document.getElementById("productTable");
        if (table.rows.length > 2) { // Ensure at least one row remains (excluding header)
            const row = document.getElementById(`row_${rowId}`);
            if (row) {
                row.parentNode.removeChild(row);
            }
        } else {
            alert("At least one row must remain in the table.");
        }
    }
    // Event listeners for shortcuts
    document.addEventListener('keydown', function (event) {

        if (event.altKey && event.key === 'Enter') {
            event.preventDefault(); // Prevent default browser action
            addProductRow();
        }

        // alt + Backspace to remove the last row
        if (event.altKey && event.key === 'Backspace') {
            event.preventDefault(); // Prevent default browser action
            removeLastRow();
        }
    });
</script>