<?php
session_start();
// database connection
include 'Config/db_connection.php';
// code for favoruit  
include 'fav.php';
// code for product
include 'product.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Food World</title>
  <!-- logo in title bar -->
  <link rel="icon" href="assets/image/logo.png" type="image/x-icon">
  <!-- font-awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
    integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
  <!-- bootstrap css -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <!-- Include page loder css -->
  <link rel="stylesheet" href="assets/page-loader/style.css">
  <!-- Include CSS File -->
  <link rel="stylesheet" href="assets/css/style.css">
  <!-- Include component CSS File -->
  <link rel="stylesheet" href="assets/css/component.css">
  <!-- bootstrap js -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>
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
  <header class="sticky-top">
    <div class="container-fluid  p-0" style="background-color: #2F4F4F;">
      <nav class="navbar navbar-expand-lg ">
        <div class="container-fluid ">
          <!-- logo  image-->
          <p class="display-6"><img class="logo" src="assets/image/logo.png">
            <!-- title -->
            <b class="title text-light">Food World</b>
          </p>
          <!-- menu-button -->
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
            data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
            aria-label="Toggle navigation">
            <i class="fa-solid fa-bars"></i>
          </button>
          <!-- menu-item -->
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
              <!-- Home -->
              <li class="nav-item">
                <a class="nav-link active text-light" aria-current="page" href="index.php">Home</a>
              </li>
              <!-- Favorite -->
              <li class="nav-item">
                <a class="nav-link active text-light" href="second page.php?favorite"><i class="fa-regular fa-heart"
                    title="Favorite"></i><sup><?php num_card(); ?></sup></a>
              </li>
              <!-- my order -->
              <li class="nav-item">
                <a class="nav-link active text-light" aria-current="page" href="second page.php?order">My Order</a>
              </li>
              <!-- about -->
              <li class="nav-item">
                <a class="nav-link active text-light" href="#">About</a>
              </li>
              <!-- login and logout -->
              <li class="nav-item">
                <?php if (!isset($_SESSION['user_id'])) {
                  echo "<a class='nav-link active text-light' href='login_logout.php?login'>Login</a>";
                } else {
                  echo "<a class='nav-link active text-light' id ='logout' style='cursor: pointer;'>Logout</a>";
                }
                ?>
              </li>
              <!-- admin page -->
              <li class="nav-item">
                <a class="nav-link active text-light" href="./event_booking/" target="_blank">Hall Booking</a>
              </li>
            </ul>
          </div>
          <!-- search product -->
          <form class="col-12 sm-12 col-lg-2 mt-2 mt-lg-0 d-flex " role="search" action="second page.php" method="get">
            <div class="search">
              <input type="text" class="search__input" placeholder="Type your Food" name="user_serch" required>
              <button class="search__button" type="submit">
                <svg class="search__icon" aria-hidden="true" viewBox="0 0 24 24">
                  <g>
                    <path
                      d="M21.53 20.47l-3.66-3.66C19.195 15.24 20 13.214 20 11c0-4.97-4.03-9-9-9s-9 4.03-9 9 4.03 9 9 9c2.215 0 4.24-.804 5.808-2.13l3.66 3.66c.147.146.34.22.53.22s.385-.073.53-.22c.295-.293.295-.767.002-1.06zM3.5 11c0-4.135 3.365-7.5 7.5-7.5s7.5 3.365 7.5 7.5-3.365 7.5-7.5 7.5-7.5-3.365-7.5-7.5z">
                    </path>
                  </g>
                </svg>
              </button>
            </div>
          </form>
        </div>
      </nav>
    </div>
    <!-- secondary-navbar -->
    <nav class="navbar navbar-expand bg-secondary secondary-navbar">
      <ul class="navbar-nav me-auto">
        <li class="nav-item">
          <a class="nav-link active secondary_navbar" aria-current="page" href="#">Welcome&nbsp;<?php if (isset($_SESSION['user_name']/*referance in login_logout.php*/)) {
            echo $_SESSION['user_name'];
          } else {
            echo "Gust";
          } ?></a>
        </li>
      </ul>
      <label class="popup">
        <input type="checkbox">
        <div tabindex="0">
          <span class="cat"><span class="cat_icon"><i class="fa-solid fa-bowl-food"></i></span>Category</span>
        </div>
        <nav class="popup-window">
          <ul>
            <?php
            $select_cat = "SELECT * FROM categories where status=1";
            $result = mysqli_query($con, $select_cat);
            while ($row = mysqli_fetch_array($result)) {
              $cat_id = $row['cat_id'];
              $cat_type = $row['cat_title'];
              echo "<hr><li>
            <span><a class='nav-link text-dark' aria-current='page' href='second page.php?cat=$cat_type'>$cat_type</a></span>
        </li>";
            }
            ?>
          </ul>
        </nav>
      </label>
    </nav>
  </header>
  <div class="container-fluid">
    <div class="row">
      <!-- product -->
      <div class="col-12 col-sm-12 col-lg-12">
        <div class="row">
          <!-- display dynamic product -->
          <?php
          all_product();
          ?>
        </div>
      </div>
    </div>
  </div>

  <footer class="mt-3">
    <div class="p-3" style="background-color: #2F4F4F;">
      <p align="center" class="text-light">All right reserved - Designed by Harish-2025</p>
    </div>
  </footer>
  <!-- Include Js File -->
  <script src="assets/js/script.js"></script>
  <!-- page loder js -->
  <script src="assets/page-loader/script.js"></script>
</body>

</html>