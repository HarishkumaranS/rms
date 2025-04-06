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
function insert_event()
{
  if (isset($_SESSION['admin'])) {
    global $con;
    ?>
    <!-- heading -->
    <div class=" p-3 mb-5 rounded blur">
      <h4 align="center"><b>Add Event</b></h4>
      <form action="" method="post" class="mb-2">
        <div class="form-outline m-3">
          <label for="product name" class="form-label">Event Name</label>
          <input type="text" class="form-control w-100" name="event_name" placeholder="Enter Event Name"
            pattern="[A-Za-z\s]+" title="Only Letters are allowed" autocomplete="off" required="required">
        </div>
        <div class="form-outline m-3">
          <label for="product name" class="form-label">Event Cost</label>
          <input type="text" class="form-control w-100" pattern="[0-9]+" title="Only numbers are allowed" name="event_cost"
            placeholder="Enter Event Cost" autocomplete="off" required="required">
        </div>
        <!-- submit button -->
        <div class="input-group w-10 m-3">
          <input type="submit" class="btn btn-info" value="Submit" name="submit">
        </div>
      </form>
    </div>
    <!-- code for insert into database -->
    <?php
    if (!empty($_POST["submit"])) {
      $event_name = $_POST['event_name'];
      $event_cost = $_POST['event_cost'];
      $result_select = "SELECT * FROM event WHERE e_name='$event_name'";
      $number = mysqli_query($con, $result_select);
      // to check already exists or not
      $result = mysqli_num_rows($number);
      if ($result > 0) {
        echo "<script>alert('$event_name is alredy add into Event')</script>";
      } else {
        $qry = "INSERT INTO event(e_name,e_cost)VALUE('$event_name','$event_cost')";
        $result = mysqli_query($con, $qry);
        if ($result) {
          echo "<script>alert('Successfully $event_name is add into Event table');</script>";
        }
      }

    }
  } else {
    echo "<script>window.location.href='index.php?login';</script>";
  }
}
?>