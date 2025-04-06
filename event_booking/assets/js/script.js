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
        // Ensure Select2 is available before initializing
        if ($.fn.select2) {
            $('#event').select2({
                placeholder: "Search for an Event",
                allowClear: true,
                width: "100%" // Ensures it adapts to Bootstrap styles
            });
        } else {
            console.error("Select2 is not loaded. Check your CDN links.");
        }
    });