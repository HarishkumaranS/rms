<?php
session_start();
// database connection
include 'database.php';
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
  <link rel="icon" href="././image/logo.png" type="image/x-icon">
  <!-- css link -->
  <link rel="stylesheet" href="food.css">
  <!-- font-awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
    integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
  <!-- bootstrap css -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <!-- page loder css -->
  <link rel="stylesheet" href="./page loder/style.css">
  <!-- bootstrap js -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>
  <style>
    *::-webkit-scrollbar {
      display: none;
    }

    /* user in navbar */
    .user-name {
      display: none;
    }

    /* product card des */
    .product-scale {
      display: -webkit-box;
      -webkit-line-clamp: 1;
      -webkit-box-orient: vertical;
      overflow: hidden;
    }

    body {
      font-family: Calibri, serif;
    }

    /* aero cursor  */
    p,
    h1,
    h2,
    h3,
    h4,
    h5,
    h6,
    .secondary_navbar {
      cursor: default;
    }

    /* search box start */
    /* From Uiverse.io by joe-watson-sbf */
    .search {
      /* margin-top: 13px; */
      display: flex;
      align-items: center;
      justify-content: space-between;
      text-align: center;
    }

    .search__input {
      font-family: inherit;
      font-size: inherit;
      background-color: #f4f2f2;
      border: none;
      color: #646464;
      padding: 0.7rem 1rem;
      border-radius: 30px;
      width: 13em;
      transition: all ease-in-out .5s;
      margin-right: -2rem;
    }

    .search__input:hover,
    .search__input:focus {
      box-shadow: 0 0 1em #00000013;
    }

    .search__input:focus {
      outline: none;
      background-color: #f0eeee;
    }

    .search__input::-webkit-input-placeholder {
      font-weight: 100;
      color: #ccc;
    }

    .search__input:focus+.search__button {
      background-color: #f0eeee;
    }

    .search__button {
      border: none;
      background-color: #f4f2f2;
      margin-top: .1em;
    }

    .search__button:hover {
      cursor: pointer;
    }

    .search__icon {
      height: 1.3em;
      width: 1.3em;
      background-color: #f4f2f2;
      fill: #b4b4b4;
      margin-left: -5px;
    }

    /* search box end */

    /* category nav bar start */
    .popup {
      /* nav */
      --nav-padding-x: 0.25em;
      --nav-padding-y: 0.625em;
      --nav-border-radius: 0.375em;
      --nav-border-color: #ccc;
      --nav-border-width: 0.0625em;
      --nav-shadow-color: rgba(0, 0, 0, .2);
      --nav-shadow-width: 0 1px 5px;
      --nav-bg: #eee;
      --nav-font-family: Menlo, Roboto Mono, monospace;
      --nav-default-scale: .8;
      --nav-active-scale: 1;
      --nav-position-left: 0;
      --nav-position-right: unset;
      /* if you want to change sides just switch one property */
      /* from properties to "unset" and the other to 0 */
      /* title */
      --nav-title-size: 0.625em;
      --nav-title-color: #777;
      --nav-title-padding-x: 1rem;
      --nav-title-padding-y: 0.25em;
      /* nav button */
      --nav-button-padding-x: 1rem;
      --nav-button-padding-y: 0.375em;
      --nav-button-border-radius: 0.375em;
      --nav-button-font-size: 12px;
      --nav-button-hover-bg: #6495ed;
      --nav-button-hover-text-color: #fff;
      --nav-button-distance: 0.875em;
      /* underline */
      --underline-border-width: 0.0625em;
      --underline-border-color: #ccc;
      --underline-margin-y: 0.3125em;
    }

    /* popup settings 👆 */

    .popup {
      display: inline-block;
      text-rendering: optimizeLegibility;
      position: relative;
    }

    .popup input {
      display: none;
    }

    .popup-window {
      transform: scale(var(--nav-default-scale));
      visibility: hidden;
      opacity: 0;
      position: absolute;
      padding: var(--nav-padding-y) var(--nav-padding-x);
      background: var(--nav-bg);
      font-family: var(--nav-font-family);
      color: var(--nav-text-color);
      border-radius: var(--nav-border-radius);
      box-shadow: var(--nav-shadow-width) var(--nav-shadow-color);
      border: var(--nav-border-width) solid var(--nav-border-color);
      /* top: calc(var(--burger-diameter) + var(--burger-enable-outline-width) + var(--burger-enable-outline-offset)); */
      top: 50px;
      /* left: var(--nav-position-left); */
      /* right: var(--nav-position-right); */
      transition: var(--burger-transition);
      right: 20px;


    }

    .popup-window legend {
      padding: var(--nav-title-padding-y) var(--nav-title-padding-x);
      margin: 0;
      color: var(--nav-title-color);
      font-size: var(--nav-title-size);
      text-transform: uppercase;
    }

    .popup-window ul {
      margin: 0;
      padding: 0;
      list-style-type: none;
    }

    .popup-window ul a {
      outline: none;
      width: 100%;
      border: none;
      background: none;
      display: flex;
      align-items: center;
      color: var(--burger-color);
      font-size: var(--nav-button-font-size);
      padding: var(--nav-button-padding-y) var(--nav-button-padding-x);
      white-space: nowrap;
      border-radius: var(--nav-button-border-radius);
      cursor: pointer;
      column-gap: var(--nav-button-distance);
    }

    .popup-window ul li:nth-child(7) svg {
      color: red;
    }

    .popup-window hr {
      margin: var(--underline-margin-y) 0;
      border: none;
      border-bottom: var(--underline-border-width) solid var(--underline-border-color);
    }

    /* actions */

    .popup-window ul a:hover,
    .popup-window ul a:focus-visible,
    .popup-window ul a:hover svg,
    .popup-window ul a:focus-visible svg {
      color: var(--nav-button-hover-text-color);
      background: var(--nav-button-hover-bg);
    }

    .popup input:checked~nav {
      transform: scale(var(--nav-active-scale));
      visibility: visible;
      opacity: 1;
    }

    .cat {
      border: none;
      color: #fff;
      background-image: linear-gradient(30deg, #0400ff, #4ce3f7);
      border-radius: 20px;
      background-size: 100% auto;
      font-family: inherit;
      font-size: 17px;
      padding: 0.6em 1.5em;
      cursor: pointer;
      margin-right: 1rem;
    }

    .cat:hover {
      background-position: right center;
      background-size: 200% auto;
      -webkit-animation: pulse 2s infinite;
      animation: pulse512 1.5s infinite;
    }

    @keyframes pulse512 {
      0% {
        box-shadow: 0 0 0 0 #05bada66;
      }

      70% {
        box-shadow: 0 0 0 10px rgb(218 103 68 / 0%);
      }

      100% {
        box-shadow: 0 0 0 0 rgb(218 103 68 / 0%);
      }
    }

    .cat_icon {
      padding: 3px;
    }

    /* category nav bar end */
    
  </style>
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
          <p class="display-6"><img class="logo" src="././image/logo.png">
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
  <script>
    // logout yes or no button 
    document.addEventListener('DOMContentLoaded', function () {
      var logout = document.getElementById('logout');
      logout.addEventListener('click', function () {
        var button = confirm("Do you want to logout.....!");
        if (button) {
          window.location.href = "login_logout.php?logout";
        }
      });
    });
  </script>
  <!-- page loder js -->
  <script src="./page loder/script.js"></script>
</body>
</html>