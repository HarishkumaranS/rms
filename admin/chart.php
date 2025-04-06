<style>
    #salesChart {
        background-color: white;
        margin-bottom: 3rem;
    }
</style>
<?php
function chart()
{
    if (isset($_POST['submit'])) {
        // Include database connection
        include './../database.php';

        // Get the lowest available date from both `user_order` and `order_off`
        $query_min_date = "SELECT MIN(date_value) as min_date FROM (
                        SELECT MIN(o_date) AS date_value FROM user_order 
                        UNION 
                        SELECT MIN(order_date) FROM order_off
                    ) as combined";
        $result_min_date = mysqli_query($con, $query_min_date);
        $row_min_date = mysqli_fetch_assoc($result_min_date);
        $default_start_date = $row_min_date['min_date'] ? $row_min_date['min_date'] : date("Y-m-01"); // If no data, use the 1st of current month

        // Current date for default end date
        $current_date = date("Y-m-d");

        // Get user input for date range
        $start_date = isset($_POST['start_date']) && $_POST['start_date'] !== "" ? $_POST['start_date'] : $default_start_date;
        $end_date = isset($_POST['end_date']) && $_POST['end_date'] !== "" ? $_POST['end_date'] : $current_date;

        // Extract month names for heading
        $start_month = date("M", strtotime($start_date));
        $end_month = date("M", strtotime($end_date));
        $report_heading = ($start_month === $end_month) ? "Report Analysis for $start_month" : "Report Analysis for $start_month - $end_month";

        // Generate date labels for X-axis (day + month) and tooltips (full date)
        $days = [];
        $tooltips = [];
        $current_date_ts = strtotime($start_date);
        $end_date_ts = strtotime($end_date);

        while ($current_date_ts <= $end_date_ts) {
            $days[] = date("j M", $current_date_ts); // "1 Feb" for X-axis
            $tooltips[] = date("j M Y", $current_date_ts); // "1 Feb 2024" for tooltip
            $current_date_ts = strtotime("+1 day", $current_date_ts);
        }

        // Initialize sales arrays
        $user_order_sales = array_fill(0, count($days), 0);
        $order_off_sales = array_fill(0, count($days), 0);

        // Fetch sales data from `user_order`
        $query1 = "SELECT DATE(o.o_date) AS order_date, SUM(o.total_price) AS total_sales 
           FROM user_order o 
           WHERE o.o_date BETWEEN '$start_date' AND '$end_date'
           GROUP BY DATE(o.o_date)";
        $result1 = mysqli_query($con, $query1);

        while ($row = mysqli_fetch_assoc($result1)) {
            $day_month = date("j M", strtotime($row['order_date'])); // "1 Feb"
            $index = array_search($day_month, $days);
            if ($index !== false) {
                $user_order_sales[$index] = $row['total_sales'];
            }
        }

        // Fetch sales data from `order_off`
        $query2 = "SELECT DATE(o.order_date) AS order_date, SUM(o.total_price) AS total_sales 
           FROM order_off o 
           WHERE o.order_date BETWEEN '$start_date' AND '$end_date'
           GROUP BY DATE(o.order_date)";
        $result2 = mysqli_query($con, $query2);

        while ($row = mysqli_fetch_assoc($result2)) {
            $day_month = date("j M", strtotime($row['order_date'])); // "1 Feb"
            $index = array_search($day_month, $days);
            if ($index !== false) {
                $order_off_sales[$index] = $row['total_sales'];
            }
        }
        ?>

        <h2 align="center"><?php echo $report_heading; ?></h2>
        <canvas id="salesChart"></canvas>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            var ctx = document.getElementById('salesChart').getContext('2d');
            var chart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: <?php echo json_encode($days); ?>,
                    datasets: [
                        {
                            label: 'Online Order Sales (₹)',
                            data: <?php echo json_encode($user_order_sales); ?>,
                            borderColor: 'rgba(75, 192, 192, 1)',
                            backgroundColor: 'rgba(75, 192, 192, 0.2)',
                            borderWidth: 2,
                            fill: true
                        },
                        {
                            label: 'Direct Order Sales (₹)',
                            data: <?php echo json_encode($order_off_sales); ?>,
                            borderColor: 'rgba(255, 99, 132, 1)',
                            backgroundColor: 'rgba(255, 99, 132, 0.2)',
                            borderWidth: 2,
                            fill: true
                        }
                    ]
                },
                options: {
                    responsive: true,
                    scales: {
                        x: {
                            title: {
                                display: true,
                                text: 'Day of the Month'
                            }
                        },
                        y: {
                            beginAtZero: true,
                            title: {
                                display: true,
                                text: 'Sales Amount (₹)'
                            }
                        }
                    },
                    plugins: {
                        tooltip: {
                            callbacks: {
                                title: function (tooltipItems) {
                                    var index = tooltipItems[0].dataIndex;
                                    return <?php echo json_encode($tooltips); ?>[index]; // Show full date on hover
                                }
                            }
                        }
                    }
                }
            });
        </script>
        <?php
    }
    else
    {
        echo "<script>window.history.back();</script>";
    }
} ?>