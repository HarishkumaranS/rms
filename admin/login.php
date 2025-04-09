<?php
function login()
{
    global $con;
    if (isset($_GET['login'])) {
        if (isset($_POST['username']) && isset($_POST['password'])) {
            $invalid = null;
            $user_name = $_POST['username'];
            $password = $_POST['password'];
            $qry = "SELECT login,a_id from admin where user_name='$user_name' and password='$password'";
            $result = mysqli_query($con, $qry);
            $num = mysqli_num_rows($result);
            $row = mysqli_fetch_array($result);
            if ($num > 0) {
                if ($row['login'] == "admin") {
                    $_SESSION['admin'] = $row['a_id'];
                    if (isset($_SESSION['admin'])) {
                        echo "<script>window.location.href='index.php';</script>";
                    }
                } elseif ($row['login'] == "biller") {
                    $_SESSION['biller'] = $row['a_id'];
                    if (isset($_SESSION['biller'])) {
                        echo "<script>window.location.href='index.php';</script>";
                    }
                }
            } else {
                $invalid = "User Name and Password are invalide";
            }
        }
        ?>
        <div class="container d-flex justify-content-center align-items-center mt-5">
            <div class="blur p-4 rounded  col-12 col-md-4">
                <h2 class="text-center">Login</h2>
                <form action="" method="post">
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control" name="username" placeholder="Enter your username" required
                            value="<?php if (isset($_POST['username'])) {
                                echo $_POST['username'];
                            } ?>">
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control <?php if (isset($invalid)) {
                            echo 'is-invalid text-danger';
                        } ?>" name="password" placeholder="Enter your password" required>
                    </div>
                    <?php if (isset($invalid)): ?>
                        <div class='form-group text-danger mb-3'><?php echo $invalid; ?></div>
                    <?php endif; ?>
                    <input type="submit" class="btn btn-primary w-100" value="Login">
                </form>
            </div>
        </div>
        <?php
    } elseif (isset($_GET['logout'])) {
        unset($_SESSION['biller']);
        unset($_SESSION['admin']);
        session_destroy();
        echo "<script>window.location.href='index.php';</script>";
    }
}

?>