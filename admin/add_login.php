<style>
  .blur {
    border: 2px solid silver;
    backdrop-filter: blur(2px);
    box-shadow: 5px 5px 15px rgba(192, 192, 192, 0.8),
      -5px -5px 15px rgba(255, 255, 255, 0.5);
  }
</style>
<?php
function add_login()
{
  global $con;
  if (isset($_SESSION['admin'])) {
    if (isset($_POST['submit'])) {
      $user_name = $_POST['user_name'];
      $name=$_POST['name'];
      $ph_no=$_POST['ph_no'];
      $pass = $_POST['pass'];
      $c_pass = $_POST['c_pass'];
      $roll = $_POST['roll'];
      if ($pass != $c_pass) {
        $wrong = "Please enter confirm password as password";
      } else {
        $select_qry = "SELECT a_id from admin where user_name='$user_name'";
        $result = mysqli_query($con, $select_qry);
        $num = mysqli_num_rows($result);
        if ($num > 0) {
          $wrong = "User Name is already exists..!";
        } else {
          $insert_qry = "INSERT INTO admin (user_name, password, login,name,ph_no) VALUES ('$user_name', '$pass', '$roll','$name','$ph_no')";
          $result = mysqli_query($con, $insert_qry);
          if ($result) {
            echo "<script>alert('Successfully Login is created');</script>";
          }
        }
      }
    }
    ?>
    <!-- heading -->
    <div class=" p-3 mb-5 rounded blur">
      <h4 align="center"><b>Add Admin Login</b></h4>
      <form action="" method="post" class="mb-2">
        <div class="form-outline m-3">
          <label for="Name" class="form-label">Name</label>
          <input type="text" class="form-control w-100" name="name" placeholder="Enter the  Name" autocomplete="off"
            required="required">
        </div>
        <div class="form-outline m-3">
          <label for="Name" class="form-label">User Name</label>
          <input type="text" class="form-control w-100" name="user_name" placeholder="Enter the User Name"
            autocomplete="off" required="required">
        </div>
        <div class="form-outline m-3">
          <label for="Name" class="form-label">Phone Number</label>
          <input type="text" class="form-control w-100" name="ph_no" placeholder="Enter the  Name" autocomplete="off"
           pattern="^[6-9]\d{9}$" 
            title="Validates a 10-digit Indian phone number starting with 6-9."
            required minlength="6"
            >
        </div>
        <div class="form-outline m-3">
          <label for="Password" class="form-label">Password</label>
          <input type="password" class="form-control w-100" name="pass" placeholder="Enter the Password"
            pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{6,}$" required minlength="6"
            title="least 6 characters long,one uppercase letter, one lowercase letter, one number, and one special character."
            autocomplete="off" required="required">
        </div>
        <div class="form-outline m-3">
          <label for="Password" class="form-label">Confirm Password</label>
          <input type="password" class="form-control w-100" name="c_pass" placeholder="Enter the Confirm Password"
            pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{6,}$" required minlength="6"
            title="least 6 characters long,one uppercase letter, one lowercase letter, one number, and one special character."
            autocomplete="off" required="required">
        </div>
        <?php if (isset($wrong)) {
          echo "<div class='form-outline m-3'>
        <p style='color:red;''>$wrong</p>
        </div>";
        }
        ?>
        <div class="form-outline m-3">
          <label for="RollType" class="form-label">Roll Type</label><br>
          <input class="form-check-input" type="radio" name="roll" id="radio2" value="admin" required>
          <label class="form-check-label" for="radio2">
            Admin
          </label>
          <input class="form-check-input" type="radio" name="roll" id="radio2" value="biller" required>
          <label class="form-check-label" for="radio2">
            Biller
          </label>
        </div>
        <!-- submit button -->
        <div class="input-group w-10 m-3">
          <input type="submit" class="btn btn-info" value="Submit" name="submit">
        </div>
      </form>
    </div>
    <?php
  } else {
    echo "<script>window.location.href='index.php?login';</script>";
  }
}
?>