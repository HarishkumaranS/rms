

    function updateTotal() {
        let total = 0;

        // Loop through each row and calculate the total for each product
        let rows = document.querySelectorAll('#productTable tr');
        rows.forEach((row, index) => {
            let productDropdown = row.querySelector('.productDropdown');
            let quantityInput = row.querySelector('input[type="number"]');

            if (productDropdown && quantityInput) {
                let selectedOption = productDropdown.options[productDropdown.selectedIndex];
                if (selectedOption.value === "") return; // Skip empty selections

                let price = parseFloat(selectedOption.getAttribute('data-price')) || 0;
                let stock = parseInt(selectedOption.getAttribute('data-stock')) || 0;
                let quantity = parseInt(quantityInput.value) || 0;

                // Check if quantity exceeds stock
                if (quantity > stock) {
                    alert(`Quantity exceeds available stock (${stock}). It has been adjusted automatically.`);
                    quantity = stock;
                    quantityInput.value = stock; // Update the input field
                }

                // Calculate the total for the current row
                total += price * quantity;
                console.log("Row total: " + (price * quantity)); // Debugging line
            }
        });

        // qrcode image start
        const upi_id = "8838263645@ptaxis";
        const name = "FOOD WORLD";
        const amount = total;
        const currency = "INR";
        const note = "Thanks for the meal - Food World";
        const upi_url = `upi://pay?pa=${upi_id}&pn=${encodeURIComponent(name)}&am=${amount}&cu=${currency}&tn=${encodeURIComponent(note)}`;
        const qr_url = `https://api.qrserver.com/v1/create-qr-code/?data=${encodeURIComponent(upi_url)}&size=300x300`;
        document.getElementById("paymentText").textContent = `Make a ₹${amount} Payment by Scanning`;
        document.getElementById("qrCodeImage").src = qr_url;
        // qrcode image End
        // Update the total amount display
        let totalAmountDisplay = document.getElementById('totalAmount_0');
        if (totalAmountDisplay) {
            totalAmountDisplay.textContent = "₹" + total.toFixed(2);
        }
        console.log("Total: ₹" + total.toFixed(2)); // Debugging line

        // Show or hide the amount div based on total
        let amountDiv = document.getElementById('amount');
        if (total > 0) {
            amountDiv.classList.remove('d-none');  // Show the amount div
        } else {
            amountDiv.classList.add('d-none');  // Hide the amount div
        }
    }


    // Remove the last added row
    function removeLastRow() {
        const table = document.getElementById("productTable");
        if (table.rows.length > 2) {
            table.deleteRow(-1);
            productCount--;
            updateTotal();
        } else {
            alert("At least one row must remain in the table.");
        }
    }
    // Open QR modal with Shift + G
    document.addEventListener('keydown', function (e) {
        if (e.altKey && e.shiftKey && e.key.toLowerCase() === 'g') {
            document.getElementById('qrModal').style.display = 'flex';
        } else if (e.key === 'Escape') {
            document.getElementById('qrModal').style.display = 'none';
        }
    })