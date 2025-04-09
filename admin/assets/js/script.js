// logout yes or no button 
document.addEventListener('DOMContentLoaded', function () {
    var logout = document.getElementById('logout');
    logout.addEventListener('click', function () {
        var button = confirm("Do you want to logout.....!");
        if (button) {
            window.location.href = "index.php?logout";
        }
    });
});

// Sidebar Script
const toggleBtn = document.getElementById('toggleBtn');
const closeBtn = document.getElementById('closeBtn');
const sidebar = document.getElementById('sidebar');
const mainContent = document.getElementById('mainContent');

toggleBtn.addEventListener('click', () => {
    sidebar.classList.toggle('open');
    if (sidebar.classList.contains('open')) {
        mainContent.style.zIndex = "0";
    } else {
        mainContent.style.zIndex = "1";
    }
});

closeBtn.addEventListener('click', () => {
    sidebar.classList.remove('open');
    mainContent.style.zIndex = "1";
});

// Event Booking
// Function to display event cost dynamically
function fetchEventCost() {
    const eventSelect = document.getElementById('event');
    const selectedOption = eventSelect.options[eventSelect.selectedIndex];
    const eventCost = selectedOption.getAttribute('data-cost');
    const outputDiv = document.getElementById('output');
    const eventCostSpan = document.getElementById('eventCost');

    if (eventCost) {
        eventCostSpan.textContent = `Rs ${eventCost}`;
        outputDiv.classList.remove('d-none');
    } else {
        outputDiv.classList.add('d-none');
    }
}
//  search box for Event
$(document).ready(function () {

    $("#event").select2({
        placeholder: "Search for a Event",
        allowClear: true
    });
});

// Daily sales (Direct Or Online) Button
function delayedSubmit() {
    setTimeout(function() {
        document.getElementById('orderForm').submit();
    }, 400);
}

// Report Page
function submit() {
    // Get form values
    var select = document.querySelector('select[name="select"]').value;
    var value = document.querySelector('input[name="value"]').value;
    var fDate = document.querySelector('input[name="f_date"]').value;
    var tDate = document.querySelector('input[name="t_date"]').value;
    alert("l");
    // Check if select, value, and dates are filled but no valid value is provided
    if (select && value === '' && fDate === '' && tDate === '') {
        alert("Please provide either the username, product name, or date.");

    }
}

// graph ctrl + g
document.addEventListener("keydown", function (event) {
    if (event.ctrlKey && event.key === "g") {
        event.preventDefault(); // Prevents any default browser behavior
        document.getElementById("graph").click(); // Triggers the submit button
    }
});