<?php
function edit_profile()
{
  global $con;
  if (isset($_SESSION['biller'])) {
    $id = $_SESSION['biller'];
  } elseif (isset($_SESSION['admin'])) {
    $id = $_SESSION['admin'];
  }
  if (isset($_POST['change'])) {
    $old_pass = $_POST['old_pass'];
    $new_pass = $_POST['new_pass'];
    $select_qry = "SELECT a_id from admin where password='$old_pass' and a_id='$id'";
    $result_qry = mysqli_query($con, $select_qry);
    $num = mysqli_num_rows($result_qry);
    if ($num > 0) {
      $update_qry = "UPDATE admin SET password = '$new_pass'  WHERE a_id = '$id'";
      $result_qry = mysqli_query($con, $update_qry);
      if ($result_qry) {
        echo "<script>alert('Successfully  your Password is updated')</script>";
        echo "<script>window.location.href='index.php';</script>";
      }
    }
    else{
      $invalide="Please enter your old password correctly.";
    }
  }
  if (isset($_GET['edit_profile'])) {
    $select_qry = "SELECT name,user_name,ph_no from admin where a_id='$id'";
    $result_qry = mysqli_query($con, $select_qry);
    $row = mysqli_fetch_array($result_qry);
    $name = $row['name'];
    $user_name = $row['user_name'];
    $ph_no = $row['ph_no'];
    if (isset($_POST['update'])) {
      $p_name = $_POST['name'];
      $p_user_name = $_POST['user_name'];
      $p_ph_no = $_POST['ph_no'];
      $update_qry = "UPDATE admin SET name = '$p_name', user_name = '$p_user_name', ph_no = '$p_ph_no' WHERE a_id = '$id'";
      $result_qry = mysqli_query($con, $update_qry);
      if ($result_qry) {
        echo "<script>alert('Successfully  your Profile is updated')</script>";
        echo "<script>window.location.href='index.php';</script>";
      }
    }
    ?>
    <div class="container d-flex justify-content-center align-items-center mt-5">
      <div class="blur p-4 rounded  col-12 col-md-4">
        <h2 class="text-center">Update Profile</h2>
        <form action="" method="post">
          <div class="mb-3">
            <label for="username" class="form-label">Name</label>
            <input type="text" class="form-control" name="name" placeholder="Enter your Name" required
              value="<?php echo $name; ?>">
          </div>
          <div class="mb-3">
            <label for="username" class="form-label">User Name</label>
            <input type="text" class="form-control" name="user_name" placeholder="Enter your Username" required
              value="<?php echo $user_name; ?>">
          </div>
          <div class="mb-1">
            <label for="phone number" class="form-label">Phone Number</label>
            <input type="text" class="form-control" name="ph_no" placeholder="Enter the  Name" autocomplete="off"
              pattern="^[6-9]\d{9}$" title="Validates a 10-digit Indian phone number starting with 6-9." required
              value="<?php echo $ph_no; ?>">
          </div>
          <div class=" mb-3">
            <a href="index.php?change_pass" class="forgot-password">Change Password?</a>
          </div>
          <input type="submit" class="btn btn-primary w-100" name="update" value="Update">
        </form>
      </div>
    </div>
    <?php
  }
  if (isset($_GET['change_pass'])) {
    ?>
    <div class="container d-flex justify-content-center align-items-center mt-5">
      <div class="blur p-4 rounded col-12 col-md-4">
        <h2 class="text-center">Change Password</h2>
        <form action="" method="post" onsubmit="return validatePassword()">
          <div class="mb-3">
            <label for="old_pass" class="form-label">Old Password</label>
            <input type="password" class="form-control" id="old_pass" name="old_pass" placeholder="Enter your Old Password"
              required>
          </div>
          <div class="mb-3">
            <label for="new_pass" class="form-label">New Password</label>
            <input type="password" class="form-control" id="new_pass" name="new_pass" placeholder="Enter your New Password"
              pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{6,}$" required minlength="6"
              title="At least 6 characters long, one uppercase letter, one lowercase letter, one number, and one special character.">
          </div>
          <div class="mb-3">
            <label for="con_pass" class="form-label">Confirm Password</label>
            <input type="password" class="form-control" id="con_pass" name="con_pass"
              placeholder="Confirm your New Password" autocomplete="off"
              pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{6,}$" required minlength="6"
              title="At least 6 characters long, one uppercase letter, one lowercase letter, one number, and one special character."
              oninput="checkPasswordMatch()">
            <small id="passwordHelp" class="text-danger"><?php if(isset($invalide)){ echo $invalide ;} ?></small>
          </div>
          <input type="submit" class="btn btn-primary w-100" name="change" value="Change">
        </form>
      </div>
    </div>
    <?php
  }
} ?>
<script>
  // validation for new pass and confirm pass
  function checkPasswordMatch() {
    var newPassword = document.getElementById("new_pass").value;
    var confirmPassword = document.getElementById("con_pass").value;
    var passwordHelp = document.getElementById("passwordHelp");

    if (newPassword !== confirmPassword) {
      passwordHelp.textContent = "Passwords do not match!";
    } else {
      passwordHelp.textContent = "";
    }
  }

  function validatePassword() {
    var newPassword = document.getElementById("new_pass").value;
    var confirmPassword = document.getElementById("con_pass").value;

    if (newPassword !== confirmPassword) {
      alert("New Password and Confirm Password must be the same!");
      return false; // Prevent form submission
    }
    return true; // Allow form submission
  }
</script>