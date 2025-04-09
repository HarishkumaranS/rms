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
        <select class="productDropdown" name="product_id[]" id="productDropdown_${productCount}" style="width: 300px;" required>
            <option value="">Select a product</option>
            <?php echo $productOptions; ?>
        </select>
    </td>
    <td>
        <input type="number" class="form-control" name="product_qty[]" id="product_quantity_${productCount}" min="1" required>
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

// Remove the last added row
function removeLastRow() {
    const table = document.getElementById("productTable");
    if (table.rows.length > 2) { // Ensure at least one row remains (excluding header)
        table.deleteRow(-1); // Delete the last row
        productCount--; // Decrement the counter
    } else {
        alert("At least one row must remain in the table.");
    }
}
// Event listeners for shortcuts
document.addEventListener('keydown', function (event) {
    // Ctrl + Enter to add a row
    if (event.ctrlKey && event.key === 'Enter') {
        event.preventDefault(); // Prevent default browser action
        addProductRow();
    }

    // Ctrl + Backspace to remove the last row
    if (event.ctrlKey && event.key === 'Backspace') {
        event.preventDefault(); // Prevent default browser action
        removeLastRow();
    }
});
// search box for product first row
$(document).ready(function () {

    $("#productDropdown").select2({
        placeholder: "Search for a product",
        allowClear: true
    });
});