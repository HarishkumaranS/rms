<style>
    .blur {
        border: 2px solid silver;
        backdrop-filter: blur(2px);
        /* Blur effect */
        box-shadow: 5px 5px 15px rgba(192, 192, 192, 0.8),
            -5px -5px 15px rgba(255, 255, 255, 0.5);
    }
</style>
<?php
function book_event()
{
    if (isset($_SESSION['admin']) || isset($_SESSION['biller'])) {
        global $con;
        ?>
        <!-- heading -->
        <div class=" p-3 mb-5 rounded blur">
            <h4 align="center"><b>Book Event</b></h4>
            <form action="" method="post" class="mb-2">
                <div class="form-outline m-3">
                    <label for="customer name" class="form-label">Name</label>
                    <input type="text" class="form-control w-100" name="cust_name" placeholder="Enter Customer Name"
                        pattern="[A-Za-z\s]+" title="Only Letters are allowed" autocomplete="off" required="required">
                </div>
                <div class="form-outline m-3">
                    <label for="Phone Number" class="form-label">Phone Number</label>
                    <input type="text" class="form-control w-100" pattern="[0-9]{10}" title="Please Enter correct Phone Number"
                        name="number" placeholder="Enter Customer Name" autocomplete="off" required="required">
                </div>
                <div class="form-outline m-3">
                    <label for="date" class="form-label">Booking Date</label>
                    <input type="date" class="form-control" id="date" name="date" required>
                </div>
                <div class="form-outline m-3">
                    <label for="time" class="form-label">Time Period</label>
                    <!-- <label for="time">Choose Delivery Time:</label> -->
                    <select class="form-select" id="time" name="time" required>
                        <option value="" disabled selected>Select a time slot</option>
                        <option value="morning">Morning to Afternoon</option>
                        <option value="evening">Evening to Night</option>
                    </select>
                </div>
                <div class="form-outline m-3">
                    <label for="Select Event" class="form-label">Event</label>
                    <select id="event" name="event_id" class="form-select" required onchange="fetchEventCost()">
                        <option value="">--Choose an Event--</option>
                        <?php
                        $sql = "SELECT e_id, e_name, e_cost FROM event where status=1";
                        $result = mysqli_query($con, $sql);
                        // Populate dropdown with event data
                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                $e_id = $row['e_id'];
                                $e_name = $row['e_name'];
                                $e_cost = $row['e_cost'];
                                echo "<option value='$e_id' data-cost='$e_cost'>$e_name</option>";
                            }
                        } else {
                            echo "<option value=''>No events available</option>";
                        }
                        ?>
                    </select>
                </div>
                <div id="output" class="alert alert-info  d-none form-outline m-3 ">
                    <strong>Event Cost:</strong> <span id="eventCost"></span>
                </div>
                <!-- submit button -->
                <div class="input-group w-10 m-3">
                    <input type="submit" class="btn btn-info" value="Submit" name="submit">
                </div>
            </form>
        </div>
        <!-- code for insert into database -->
        <?php
        // database connection
        include './../database.php';
        if (!empty($_POST["submit"])) {
            $cust_name = $_POST['cust_name'];
            $number = $_POST['number'];
            $event_id = $_POST['event_id'];
            $b_date = $_POST['date'];
            $time = $_POST['time'];
            $date = date("Y-m-d");
            $select_qry = "SELECT * FROM event_booking WHERE b_date='$b_date' and time='$time'";
            $reslut_qry = mysqli_query($con, $select_qry);
            if (mysqli_num_rows($reslut_qry) == 1) {
                echo "<script>alert('The Event Hall is not available');</script>";
            } else {
                $select_qry = "SELECT cust_id FROM customer WHERE cust_num=$number";
                $result = mysqli_query($con, $select_qry);
                $num = mysqli_fetch_row($result);
                $cust_id = null;
                if ($num == 0) {
                    $insert_qry = "INSERT INTO customer (cust_name, cust_num) VALUES ('$cust_name', '$number')";
                    $result_qry = mysqli_query($con, $insert_qry);
                    $cust_id = mysqli_insert_id($con);
                } else {
                    $select_qry = "SELECT cust_id FROM customer WHERE cust_num=$number";
                    $result = mysqli_query($con, $select_qry);
                    $row = mysqli_fetch_array($result);
                    $cust_id = $row['cust_id'];
                }
                $insert_qry = "INSERT INTO event_booking (date, b_date, e_id, cust_id, time) VALUES('$date','$b_date','$event_id','$cust_id','$time')";
                $result_qry = mysqli_query($con, $insert_qry);
                if ($reslut_qry) {
                    echo "<script>alert('The Event Hall is Booked');</script>";
                }
            }
        }
    } else {
        echo "<script>window.location.href='index.php?login';</script>";
    }
}
?>
<script>
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
</script>