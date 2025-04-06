<?php
// Database connection
include '../Config/db_connection.php';
// Check Availability form data
if (isset($_POST['submit'])) {
    $date = $_POST['date'];
    $time = $_POST['time'];
    $select_qry = "SELECT * FROM event_booking WHERE b_date='$date' and time='$time'";
    $reslut_qry = mysqli_query($con, $select_qry);
    $timestamp = strtotime($date);
    $formattedDate = date('d-m-Y', $timestamp);
    if (mysqli_num_rows($reslut_qry) == 0) {
        $status = "Available";
        $message = "The Event Hall is available on $formattedDate.";
    } else {
        $status = "Not Available";
        $message = "The Event Hall is not available on $formattedDate.";
    }
    $showModal = true;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../image/logo.png" type="image/x-icon">
    <title>Event Hall Booking</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Select2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
    <!-- Select2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
    <!-- page loder -->
    <link rel="stylesheet" href="../page loder/style.css">
    <!-- Include CSS File -->
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>
    <!-- Page Loader start  -->
    <div class="loader-container" id="loader">
        <div class="loader">
            <div class="loader-square"></div>
            <div class="loader-square"></div>
            <div class="loader-square"></div>
            <div class="loader-square"></div>
            <div class="loader-square"></div>
            <div class="loader-square"></div>
            <div class="loader-square"></div>
        </div>
    </div>
    <!-- Page Loader end  -->
    <header class="  p-3">
        <img class="logo" src="../image/logo.png">
        <h1 class="title text-light d-flex justify-content-center align-items-center">Event Booking</h1>
    </header>
    <div id="hallCarousel" class="carousel slide p-3" data-bs-ride="carousel">
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img src="assets/image/image(1).png" class="d-block w-100 img-fluid" alt="Event Hall 1">
        </div>
        <div class="carousel-item">
            <img src="assets/image/image(2).png" class="d-block w-100 img-fluid" alt="Event Hall 2">
        </div>
        <div class="carousel-item">
            <img src="assets/image/image(2).png" class="d-block w-100 img-fluid" alt="Event Hall 3">
        </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#hallCarousel" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#hallCarousel" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>

    <div class="container mt-1 mt-md-4">
        <div class="row w-100 ">
            <div class="col-md-6 mb-3 w-100 ">
                <button type="button" class="btn btn-primary w-100 d-flex justify-content-center align-items-center" data-bs-toggle="modal" data-bs-target="#popupModal">Check
                    Availability</button>
            </div>
        </div>

        <div class="row mt-1 mt-md-4">
            <div class="col-md-8">
                <h2>Hall Description</h2>
                <p style=" text-align: justify;">An event hall is a spacious venue designed for hosting various events
                    such as weddings, conferences, and parties. It features flexible layouts, modern amenities, and
                    customizable décor to suit any occasion. The hall is equipped with sound systems and lighting to
                    enhance the atmosphere. Professional assistance is available to ensure the event runs smoothly.
                </p>
            </div>
            <div class="col-md-4">
                <h2>Contact Us</h2>
                <p>Phone: <a href="tel:9876543210" class="text-decoration-none">9876543210</a></p>
                <p>Email: <a href="mailto:info@eventhall.com" class="text-decoration-none">info@eventhall.com</a></p>
            </div>
        </div>
        <div class="mb-3">
            <h2>Select Event</h2>
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
        <div id="output" class="alert alert-info mt-3 d-none">
            <strong>Event Cost:</strong> <span id="eventCost"></span>
        </div>
    </div>
    <!-- Check Availability form -->
    <form method="post" action="">
        <div class="modal fade" id="popupModal" tabindex="-1" aria-labelledby="popupModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="popupModalLabel">Check Availability</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="mb-3">
                                <label for="date" class="form-label">Select Date</label>
                                <input type="date" class="form-control" id="date" name="date" required>
                            </div>
                            <div class="mb-3">
                                <label for="time" class="form-label">Select Time Period</label>
                                <label for="time">Choose Delivery Time:</label>
                                <select class="form-select" id="time" name="time" required>
                                    <option value="" disabled selected>Select a time slot</option>
                                    <option value="morning">Morning to Afternoon</option>
                                    <option value="evening">Evening to Night</option>
                                </select>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <!-- Check Availability result -->
    <div class="modal fade <?php if ($showModal)
        echo 'show d-block'; ?>" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><?php echo $status; ?></h5>
                </div>
                <div class="modal-body">
                    <p><?php echo $message; ?></p>
                </div>
                <div class="modal-footer">
                    <a href="index.php" class="btn btn-secondary">OK</a>
                </div>
            </div>
        </div>
    </div>
    <footer class="text-white text-center py-3 mt-5">
        <p>&copy; All right reserved - Designed by Harish-2025</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
<!-- Bootstrap JS (optional, for responsive features) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<!-- Include JavaScript file -->
<script src="assets/js/script.js"></script>
<!-- page loder -->
<script src="../page loder/script.js" defer></script>

</html>
<?php
?>