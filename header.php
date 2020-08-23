<?php session_start(); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Bandify
  </title>
  <!-- Favicon and Touch Icons-->
  <link rel="apple-touch-icon" sizes="180x180" href="apple-touch-icon.png">
  <link rel="icon" type="image/png" sizes="32x32" href="favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="favicon-16x16.png">
  <link rel="manifest" href="site.webmanifest">
  <link rel="mask-icon" color="#343b43" href="safari-pinned-tab.svg">
  <meta name="msapplication-TileColor" content="#603cba">
  <meta name="theme-color" content="#ffffff">
  <!-- Vendor Styles including: Font Icons, Plugins, etc.-->
  <link rel="stylesheet" media="screen" href="css/vendor.min.css">
  <!-- Main Theme Styles + Bootstrap-->
  <link rel="stylesheet" media="screen" href="css/theme.min.css">
  <!-- Modernizr-->
  <script src="js/modernizr.min.js"></script>
  <script src="https://js.stripe.com/v3/"></script>
</head>
<!-- Body-->

<body>
  <header class="navbar-wrapper navbar-sticky">
    <div class="d-table-cell align-middle pr-md-3"><a class="navbar-brand mr-1" href="index.php"><img src="img/logo/logo-new.png" alt="Bandify"></a></div>
    <div class="d-table-cell w-100 align-middle pl-md-3">

      <div class="navbar justify-content-end justify-content-lg-between">
        <!-- Search-->
        <!-- Main Menu-->
        <ul class="navbar-nav d-none d-lg-block">
          <!-- Home-->
          <li class="nav-item mega-dropdown-toggle"><a class="nav-link" href="index.php">Home</a>
            <div class="dropdown-menu mega-dropdown">
              <div class="d-flex">

              </div>
            </div>
          </li>
        </ul>
        <div>
          <?php if (isset($_SESSION['logged_in'])) { ?>
            <ul class="navbar-buttons d-inline-block align-middle mr-lg-2">
              <li><a href="backoffice.php"><i class="fe-icon-user"></i></a></li>
            <a class="btn btn-gradient ml-3 d-none d-xl-inline-block" href="logout.php">Logout</a>
          <?php } else { ?>
            <a class="btn btn-gradient ml-3 d-none d-xl-inline-block" href="account-login.php">Login / Register</a>
          <?php } ?>
        </div>
      </div>
    </div>
  </header>