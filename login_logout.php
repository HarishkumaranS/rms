<?php
// database connection
include 'Config/db_connection.php';
session_start();
// login php code
if (isset($_GET['login'])) {
    if (isset($_POST['phone'])) {
        $num = $_POST['phone'];
        $pass = $_POST['password'];
        $select_qry = "SELECT user_name,user_id FROM user WHERE mob_num1='$num' and user_pass='$pass'";
        $result_select = mysqli_query($con, $select_qry);
        $num = mysqli_num_rows($result_select);
        if ($num == 1) {
            $row = mysqli_fetch_array($result_select);
            $user_name = $row['user_name'];
            $user_id = $row['user_id'];
            if (isset($user_name) && isset($user_id)) {
                $_SESSION['user_name'] = $user_name;
                $_SESSION['user_id'] = $user_id;
                if (isset($_SESSION['user_name']) && isset($_SESSION['user_id'])) {
                    // header('Location:Food World.php');
                    echo "<script>window.location.href='index.php';</script>";
                }
            }
        } else {
            $incorrect_pass = "User Name and Password incorrect";
        }
    }
}
// logout php code
if (isset($_GET['logout'])) {
    unset($_SESSION['user_name']);
    unset($_SESSION['cart']);
    session_destroy();
    header('Location:login_logout.php?login');
}
// create php code
if (isset($_GET['create_account'])) {
    if (isset($_POST['username'])) {

        $number_1 = $_POST['phone1'];
        $user_qry = "SELECT 1 FROM user WHERE mob_num1 = $number_1 LIMIT 1";
        $result_select = mysqli_query($con, $user_qry);
        $num = mysqli_num_rows($result_select);
        if ($_POST['password'] != $_POST['confirm_password']) {
            $invlide_confirm_password = "Please enter the same Password";
        } elseif ($num >= 1) {
            $invlide_phone1 = "The Phone is already exists";
        } else {
            $user_name = $_POST['username'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $num1 = $_POST['phone1'];
            $num2 = $_POST['phone2'];
            $insert_qry = "INSERT INTO user(user_name,user_email,user_pass,mob_num1,mob_num2)VALUES('$user_name','$email','$password',$num1,$num2)";
            $reslut_qry = mysqli_query($con, $insert_qry);
            if ($reslut_qry) {

                echo "<script>alert('Succesfully Registered');
            window.location.href='login_logout.php?login';</script>";
            }
        }

    }
}
if (isset($_GET['forgot_pass'])) {
    if (isset($_POST['submit'])) {
        $email = $_POST['email'];
        $num1 = $_POST['phone1'];
        $num2 = $_POST['phone2'];
        $select_qry = "SELECT * from user where user_email='$email' and mob_num1=$num1 and mob_num2=$num2";
        $result_qry = mysqli_query($con, $select_qry);
        $row_cust = mysqli_fetch_array(result: $result_qry);
        print_r($row_cust);
        $num = mysqli_num_rows(result: $result_qry);
        if ($num == 1 && isset($row_cust['user_id'])) {
            $user_id = $row_cust['user_id'];
            echo "<script>window.location.href='login_logout.php?new_password=$user_id';</script>";
        } else {
            $invalid = "No match found ";
        }

    }
}
if (isset($_GET['new_password'])) {
    $user_id = $_GET['new_password'];
    if (isset($_POST['newpassword'])) {
        if ($_POST['newpassword'] != $_POST['confirm_password']) {
            $invlide_confirm_password = "Please enter the same Password";
        } else {
            $pass = $_POST['newpassword'];
            $update_qry = "UPDATE user SET user_pass='$pass' where user_id=$user_id";
            $result_qry = mysqli_query($con, $update_qry);
            if ($result_qry) {
                echo "<script>alert('Succesfully Password Updated');
            window.location.href='login_logout.php?login';</script>";
            }
        }


    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <!-- logo in title bar -->
    <link rel="icon" href="assets/image/logo.png" type="image/x-icon">
    <!-- css link -->
    <link rel="stylesheet" href="food.css">
    <!-- Include CSS File -->
    <link rel="stylesheet" href="assets/css/login_logout.css">
    <!-- Particals CSS File -->
    <link rel="stylesheet" href="assets/css/particals.css">
    <!-- font-awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- bootstrap link -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- font-awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/particles.js/2.0.0/particles.min.js"></script>

</head>

<body>
    <div id="particles-js"></div>
    <header class="sticky-top">
        <!-- nav bar -->
        <nav class="navbar navbar-light ">
            <!-- Image and text -->
            <a class="navbar-brand" href="#">
                <!-- back button -->
                <i class="fas fa-arrow-left text-light" id="back"></i>
                <img class="logo" src="assets/image/logo.png">
                <!-- title -->
                <b class="title text-light">Food World</b>
            </a>
        </nav>
    </header>
    <div class="container p-5">
        <!-- login  -->
        <?php if (isset($_GET['login'])) { ?>
            <div class="container d-flex justify-content-center align-items-center">
                <div class="login-form  p-4 rounded shadow  blur">
                    <h2 class="text-center text-light">Login</h2>
                    <form action="" method="post">
                        <div class="mb-3">
                            <label for="phone" class="form-label text-light">Phone Number</label>
                            <input type="tel" class="form-control" name="phone" placeholder="Enter your phone number" value="<?php if (isset($_POST['phone'])) {
                                echo htmlspecialchars($_POST['phone']);
                            } ?>" required>
                        </div>

                        <div class="">
                            <label for="password" class="form-label text-light">Password</label>
                            <input type="password" class="form-control <?php if (isset($incorrect_pass) && isset($_GET['login'])) {
                                echo 'is-invalid text-danger';
                            } ?>" name="password" required placeholder="Enter your Password">
                        </div>

                        <div class="form-group mb-3">
                            <a href="login_logout.php?forgot_pass" class="forgot-password">Forgot Password?</a>
                        </div>

                        <?php if (isset($incorrect_pass) && isset($_GET['login'])): ?>
                            <div class='form-group text-danger mb-3'><?php echo htmlspecialchars($incorrect_pass); ?></div>
                        <?php endif; ?>

                        <button type="submit" class="btn btn-primary btn-block">Login</button>

                        <div class="form-group ">
                            <a href="login_logout.php?create_account" class="create-account">Create an Account</a>
                        </div>
                    </form>
                </div>
            </div>



        <?php } ?>
        <!--  create account -->
        <?php if (isset($_GET['create_account'])) { ?>
            <div class="form-container">
                <h2 class="text-center text-light">User Registration</h2>
                <form class="mt-4" action="" method="post">
                    <div class="form-group">
                        <label for="username" class="text-light">User Name</label>
                        <input type="text" class="form-control" name="username" placeholder="Enter your name" required
                            value="<?php if (isset($_POST['username'])) {
                                echo $_POST['username'];
                            } ?>" autocomplete="off">
                        <?php if (isset($_POST['submit'])) {
                            echo '<div class="invalid-feedback">Please enter your name.</div>';
                        } ?>
                    </div>
                    <div class="form-group">
                        <label for="email" class="text-light">Email</label>
                        <input type="email" class="form-control" name="email" placeholder="Enter your email" required value="<?php if (isset($_POST['email'])) {
                            echo $_POST['email'];
                        } ?>" autocomplete="off">
                        <?php if (isset($_POST['submit'])) {
                            echo '<div class="invalid-feedback">Please enter a valid email address.</div>';
                        } ?>
                    </div>
                    <div class="form-group">
                        <label for="password" class="text-light">Password</label>
                        <input type="password" class="form-control" name="password" placeholder="Enter your password"
                            pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{6,}$" required
                            minlength="6" value="<?php if (isset($_POST['password'])) {
                                echo $_POST['password'];
                            } ?>">
                        <div class="invalid-feedback">Password must be at least 6 characters long, contain at least one
                            uppercase letter, one lowercase letter, one number, and one special character.</div>
                    </div>
                    <div class="form-group">
                        <label for="confirm-password" class="text-light">Confirm Password</label>
                        <input type="password" class="form-control <?php if (isset($invlide_confirm_password)) {
                            echo "is-invalid text-danger";
                        } ?>" name="confirm_password" placeholder="Confirm your password" required value="<?php if (isset($_POST['confirm_password'])) {
                             echo $_POST['confirm_password'];
                         } ?>">

                        <?php if (isset($invlide_confirm_password)) {
                            echo "<div class='text-danger'>$invlide_confirm_password</div>";
                        }
                        // if (isset($_POST['submit'])) { echo'<div class="invalid-feedback">Please confirm your password.</div>';
                        // } ?>
                    </div>
                    <div class="form-group">
                        <label for="phone1" class="text-light">Phone Number 1</label>
                        <input type="tel" class="form-control <?php if (isset($invlide_phone1)) {
                            echo "is-invalid text-danger";
                        } ?>" name="phone1" placeholder="Enter your phone number" required pattern="[0-9]{10}" value="<?php if (isset($_POST['phone1'])) {
                             echo $_POST['phone1'];
                         } ?>" autocomplete="off">
                        <?php if (isset($invlide_phone1)) {
                            echo "<div class='text-danger'>$invlide_phone1</div>";
                        }
                        ?>
                    </div>
                    <div class="form-group">
                        <label for="phone2" class="text-light">Phone Number 2</label>
                        <input type="tel" class="form-control" name="phone2" placeholder="Enter your second phone number"
                            required pattern="[0-9]{10}" value="<?php if (isset($_POST['phone2'])) {
                                echo $_POST['phone2'];
                            } ?>" autocomplete="off">
                        <?php if (isset($_POST['submit'])) {
                            echo '<div class="invalid-feedback">Please enter a valid 10-digit phone number.</div>';
                        } ?>
                    </div>

                    <button type="submit" name="submit" class="btn btn-primary btn-block">Submit</button>
                </form>
            </div>
        <?php } ?>
        <!-- forgot password  -->
        <?php if (isset($_GET['forgot_pass'])) { ?>
            <div class="container p-0 blur rounded">
                <!-- Responsive form with border, shadow, and validation using Bootstrap classes -->
                <div class="row justify-content-center ">
                    <div class="col-12 col-md-8 col-lg-12">
                        <div class="p-4 shadow">
                            <h2 class="text-center mb-4 text-light">User Form</h2>
                            <form id="userForm" action="" method="POST">
                                <div class="form-group">
                                    <label for="email" class="text-light">Email</label>
                                    <input type="email" class="form-control" id="email" name="email"
                                        placeholder="Enter your email" required value="<?php if (isset($_POST['email'])) {
                                            echo $_POST['email'];
                                        } ?>" autocomplete="off">
                                    <div class="invalid-feedback">Please enter a valid email address.</div>
                                </div>

                                <div class="form-group">
                                    <label for="phone1" class="text-light">Phone 1</label>
                                    <input type="tel" class="form-control" id="phone1" name="phone1"
                                        placeholder="Enter primary phone number" pattern="[0-9]{10}" required value="<?php if (isset($_POST['phone1'])) {
                                            echo $_POST['phone1'];
                                        } ?>" autocomplete="off">
                                    <div class="invalid-feedback">Please enter a valid 10-digit phone number.</div>
                                </div>

                                <div class="form-group">
                                    <label for="phone1" class="text-light">Phone 2</label>
                                    <input type="tel" class="form-control" id="phone1" name="phone2"
                                        placeholder="Enter Secondary phone number" pattern="[0-9]{10}" required value="<?php if (isset($_POST['phone2'])) {
                                            echo $_POST['phone2'];
                                        } ?>" autocomplete="off">
                                    <div class="invalid-feedback">Please enter a valid 10-digit phone number.</div>
                                </div>
                                <?php
                                if (isset($invalid)) {
                                    echo "<div class='form-group text-danger'>$invalid</div>";
                                }
                                ?>


                                <button type="submit" class="btn btn-primary btn-block" name="submit">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
        <?php if (isset($_GET['new_password'])) {
            $user_id = $_GET['new_password'];
            $select_qry = "SELECT user_name from user where user_id=$user_id";
            $result_qry = mysqli_query($con, $select_qry);
            $row = mysqli_fetch_array(result: $result_qry);
            $user_name = $row['user_name'];
            ?>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-6">
                        <div class="form-container">
                            <form action="" method="post">
                                <h2 class="text-center mb-4"><?php echo $user_name; ?> Account</h2>

                                <div class="form-group">
                                    <label for="password">New Password</label>
                                    <input type="password" class="form-control" name="newpassword"
                                        placeholder="Enter your password"
                                        pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{6,}$"
                                        required minlength="6" value="<?php if (isset($_POST['newpassword'])) {
                                            echo $_POST['newpassword'];
                                        } ?>">
                                    <div class="invalid-feedback">Password must be at least 6 characters long, contain at
                                        least one uppercase letter, one lowercase letter, one number, and one special
                                        character.</div>
                                </div>

                                <div class="form-group">
                                    <label for="confirm-password">Confirm Password</label>
                                    <input type="password" class="form-control <?php if (isset($invlide_confirm_password)) {
                                        echo "is-invalid text-danger";
                                    } ?>" name="confirm_password"
                                        pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{6,}$"
                                        placeholder="Confirm your password" required minlength="6" value="<?php if (isset($_POST['confirm_password'])) {
                                            echo $_POST['confirm_password'];
                                        } ?>">

                                    <?php if (isset($invlide_confirm_password)) {
                                        echo "<div class='text-danger'>$invlide_confirm_password</div>";
                                    } else {
                                        echo '<div class="invalid-feedback">Please confirm your password.</div>';
                                    } ?>
                                </div>

                                <button type="submit" class="btn btn-primary w-100">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>

        <script>
            let back = document.getElementById('back');
            back.addEventListener('click', function () {
                window.history.back();
            });
        </script>
        <!-- Paricals Js File -->
        <script src="assets/js/particals.js"></script>
</body>

</html>