<?php
function customer()
{
    global $con;
    if (isset($_SESSION['admin'])) {
        ?>
        <style>
            a {
                text-decoration: none;
                color: black;
            }
        </style>
        <!-- heading -->
        <h4 align="center"><b>Customer List</b></h4>
        <form action="" method="post">
            <table align='center' class='table table-striped table-light'>
                <thead class='thead-dark'>
                    <tr>
                        <th>Select</th>
                        <th>Value</th>
                        <th>Sort List</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <div class="form-outline w-10 m-1">
                                <select name="select" class="form-select w-100" required>
                                    <option value="">-Select Categories-</option>
                                    <option value="name">Name</option>
                                    <option value="p_number">Phone Number</option>
                            </div>
                        </td>
                        <td>
                            <div class="form-outline w-10 m-1">
                                <input type="text" name="value" class="form-control w-100" placeholder="Enter the value" value="<?php if (isset($_POST['value'])) {
                                    echo $_POST['value'];
                                } ?>" required>
                            </div>
                        </td>
                        <td>
                            <div class="form-outline w-10 m-1">
                                <input type="submit" name="submit" class="btn btn-info" value="Sort List">
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </form>
        <?php
        if (isset($_POST['select']) && isset($_POST['value'])) {
            if ($_POST['select'] == 'name') {
                $name = $_POST['value'];
                $select_qry = "SELECT * FROM customer Where cust_name like '$name%' ";
            } elseif ($_POST['select'] == 'p_number') {
                $number = $_POST['value'];
                $select_qry = "SELECT * FROM customer Where cust_num=$number ";
            }
        } else {
            $select_qry = "SELECT * FROM customer";
        }
        $result_qry = mysqli_query($con, $select_qry);
        $data = [];
        while ($row = mysqli_fetch_array($result_qry)) {
            $cust_id = $row['cust_id'];
            $cust_name = $row['cust_name'];
            $cust_num = $row['cust_num'];
            $data[] = [$cust_name, $cust_num];
        }
        ?>
        <div class="container mt-4">
            <table id="orderTable" class="table table-striped table-light" data-products='<?php echo json_encode($data); ?>'>
                <thead class="bg-light">
                    <tr>
                        <th scope='col'>S.NO</th>
                        <th scope='col'>Name</th>
                        <th scope='col'>Number</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
            <div class="d-flex justify-content-between mt-3">
                <button class="next_btn" id="prevPage">
                    <span class="main-text"><span>← </span>Previous</span>
                </button>
                <span id="pageNumber" class="align-self-center">Page 1</span>
                <button class="next_btn" id="nextPage">
                    <span class="main-text">Next<span> →</span></span>
                </button>
            </div>
        </div>
        <?php
    } else {
        echo "<script>window.location.href='index.php?login';</script>";
    }
}
?>