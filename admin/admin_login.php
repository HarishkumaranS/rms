<?php
function admin_list()
{
    global $con;
    if (isset($_SESSION['admin'])) {
        ?>
        <!-- heading -->
        <h4 align="center"><b>Login List</b></h4>
        <?php
        $select_qry="SELECT *, 
    CASE 
        WHEN status = 1 THEN 'Active' 
        WHEN status = 0 THEN 'Inactive' 
    END AS s 
FROM admin";
        $result_cat = mysqli_query($con, $select_qry);
        $data = [];
        while ($row = mysqli_fetch_array($result_cat)) {
            $a_id = $row['a_id'];
            $name=$row['name'];
            $a_name = $row['user_name'];
            $ph_no=$row['ph_no'];
            $a_roll = $row['login'];
            $status=$row['s'];
            $data[] = [$name,$a_name,$ph_no, $a_roll,$status, "<a onclick='change($a_id)'><i class='fa-solid fa-person-booth status'></i></i></a>"];
        }
        ?>
        <div class="container mt-4">
            <table id="orderTable" class="table table-striped table-light" data-products='<?php echo json_encode($data, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP); ?>'>
                <thead class="bg-light">
                    <tr>
                        <th scope='col'>S.NO</th>
                        <th scope='col'>Name</th>
                        <th scope='col'>User Name</th>
                        <th scope='col'>Phone Number</th>
                        <th scope='col'>Roll</th>
                        <th scope='col'>Status</th>
                        <th scope='col'>Change Status</th>
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
if(isset($_GET['ADid']))
{
    $a_id =$_GET['ADid'];
    $update_qry="UPDATE admin 
SET status = CASE 
    WHEN status = 1 THEN 0 
    WHEN status = 0 THEN 1 
END WHERE a_id ='$a_id'";
$result_qry = mysqli_query($con, $update_qry);
if($result_qry)
{
    echo "<script>window.location.href = 'index.php?admin_list';</script>"; 
}
}
?>