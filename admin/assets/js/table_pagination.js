document.addEventListener("DOMContentLoaded", function () {
    const tableElement = document.getElementById("orderTable");
    const prevBtn = document.getElementById("prevPage");
    const nextBtn = document.getElementById("nextPage");
    const pageNumberElement = document.getElementById("pageNumber");

    if (!tableElement || !prevBtn || !nextBtn || !pageNumberElement) {
        console.error("Error: Missing required elements!");
        return;
    }

    let data = [];
    try {
        data = JSON.parse(tableElement.getAttribute("data-products")) || [];
    } catch (error) {
        console.error("Error parsing JSON data:", error);
    }

    let currentPage = 1;
    const rowsPerPage = 8;
    const totalPages = Math.max(1, Math.ceil(data.length / rowsPerPage));

    function displayTable(page) {
        const tableBody = document.querySelector("#orderTable tbody");
        if (!tableBody) {
            console.error("Error: Table body not found!");
            return;
        }

        tableBody.innerHTML = ""; // Clear table

        const start = (page - 1) * rowsPerPage;
        const end = start + rowsPerPage;
        const paginatedData = data.slice(start, end);

        if (paginatedData.length === 0) {
            tableBody.innerHTML = `<tr><td colspan="6" style="text-align:center;">No records found</td></tr>`;
        } else {
            paginatedData.forEach((order, index) => {
                const row = `<tr>
                    <td>${start + index + 1}</td>
                    ${order.map(col => `<td>${col ?? "-"}</td>`).join("")}
                </tr>`;
                tableBody.innerHTML += row;
            });
        }

        pageNumberElement.textContent = `Page ${currentPage} of ${totalPages}`;
        updatePaginationButtons();
    }

    function updatePaginationButtons() {
        prevBtn.disabled = currentPage === 1;
        nextBtn.disabled = currentPage >= totalPages;
    }

    prevBtn.addEventListener("click", function (event) {
        event.preventDefault();
        if (currentPage > 1) {
            currentPage--;
            displayTable(currentPage);
        }
    });

    nextBtn.addEventListener("click", function (event) {
        event.preventDefault();
        if (currentPage < totalPages) {
            currentPage++;
            displayTable(currentPage);
        }
    });

    displayTable(currentPage);
});
