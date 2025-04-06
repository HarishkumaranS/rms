<?php
// database connection
include './../database.php';
function editdel_event()
{
  if (isset($_SESSION['admin'])) {
    global $con;
    ?>
    <?php
    if (isset($_GET['EEid']) || isset($_GET['EDid'])) {
      if (isset($_GET['EDid'])) {
        $d_id = $_GET['EDid'];
        // del qry
        $del_qry = "UPDATE event SET status=0 WHERE e_id='$d_id'";
        $result_del = mysqli_query($con, $del_qry);
        // php href link
        echo "<script>window.location.href='index.php?view_event';</script>";
      }
      if (isset($_GET['EEid'])) {
        $e_id = $_GET['EEid'];
        // select qry
        $select_qry = "SELECT * FROM Event WHERE e_id='$e_id'";
        $result_select = mysqli_query($con, $select_qry);
        $row = mysqli_fetch_array($result_select);
        $e_name = $row['e_name'];
        $e_cost = $row['e_cost'];
        ?>
        <div class=" p-3 mb-5 rounded blur">
          <h4 align="center"><b>Edit Event</b></h4>
          <form action="" method="post" class="mb-2">
            <div class="form-outline m-3">
              <label for="product name" class="form-label">Event Name</label>
              <input type="text" class="form-control w-100" name="event_name" placeholder="Enter Event Name"
                pattern="[A-Za-z\s]+" title="Only Letters are allowed" autocomplete="off" required="required"
                value="<?php echo $e_name; ?>">
            </div>
            <div class="form-outline m-3">
              <label for="product name" class="form-label">Event Cost</label>
              <input type="text" class="form-control w-100" pattern="[0-9]+" title="Only numbers are allowed" name="event_cost"
                placeholder="Enter Event Cost" autocomplete="off" required="required" value="<?php echo $e_cost; ?>">
            </div>
            <!-- submit button -->
            <div class="input-group w-10 m-3">
              <input type="submit" class="btn btn-info" value="Submit" name="submit">
            </div>
          </form>
        </div>
        <?php
        // update qry
        if (isset($_POST['submit'])) {
          $update_event = $_POST['event_name'];
          $update_cost = $_POST['event_cost'];
          $update_qry = "UPDATE event SET e_name='$update_event',e_cost='$update_cost' WHERE e_id='$e_id'";
          $result_update = mysqli_query($con, $update_qry);
          //    alert box for sucessfully updated
          if ($result_update) {
            // alert box
            echo "<script>alert('Sucessfully Updated')</script>";
            // js href link
            echo "<script>window.location.href='index.php?view_event';</script>";
          }
        }
      }

    }
  } else {
    echo "<script>window.location.href='index.php?login';</script>";
  }
}
?>