<?php
require "header.php";
?>
<!-- Page Title-->
<div class="page-title d-flex" aria-label="Page title" style="background-image: url(img/page-title/shop-pattern.jpg);">
  <div class="container text-left align-self-center">
    <h1 class="page-title-heading">Login / Register Account</h1>
  </div>
</div>
<!-- Page Content-->
<div class="container mb-3">
  <?php
  if (isset($_GET['response'])) {
    if ($_GET['response'] == "wrongPwd") {
      echo "
                <div class='alert alert-danger alert-dismissible fade show text-center'>
                  <span class='alert-close' data-dismiss='alert'></span>
                  <i class='fe-icon-slash'></i>
                  &nbsp;&nbsp;
                  <strong>Error:</strong> Wrong Password! 
                </div>";
    }else if($_GET['response'] == "nouser"){
      echo "
                <div class='alert alert-danger alert-dismissible fade show text-center'>
                  <span class='alert-close' data-dismiss='alert'></span>
                  <i class='fe-icon-slash'></i>
                  &nbsp;&nbsp;
                  <strong>Error:</strong> That User doesn't Exist! 
                </div>";
    }else if($_GET['response'] == "emptyFields"){
      echo "
                <div class='alert alert-danger alert-dismissible fade show text-center'>
                  <span class='alert-close' data-dismiss='alert'></span>
                  <i class='fe-icon-slash'></i>
                  &nbsp;&nbsp;
                  <strong>Error:</strong> Empty Fields or Passwords don't match! 
                </div>";
    }
  }
  ?>
  <div class="row">

    <div class="col-md-6 pb-5">
      <form class="needs-validation wizard" method="POST" action="process.php">
        <div class="wizard-body pt-2">
          <h3 class="h5 pt-1 pb-2">Login</h3>
          <div class="input-group form-group">
            <div class="input-group-prepend"><span class="input-group-text"><i class="fe-icon-user"></i></span></div>
            <input class="form-control" type="username" placeholder="Username" id="username" name="username" required>
            <div class="invalid-feedback">Please enter your username!</div>
          </div>
          <div class="input-group form-group">
            <div class="input-group-prepend"><span class="input-group-text"><i class="fe-icon-lock"></i></span></div>
            <input class="form-control" type="password" placeholder="Password" id="pass" name="pass" required>
            <div class="invalid-feedback">Please enter valid password!</div>
          </div>
          <div class="d-flex flex-wrap justify-content-between">
            <div class="custom-control custom-checkbox">
              <input class="custom-control-input" type="checkbox" checked id="remember-me">
              <label class="custom-control-label" for="remember-me">Remember me</label>
            </div>
          </div>
        </div>
        <div class="wizard-footer text-right">
          <button class="btn btn-primary" type="submit" name="login">Login</button>
        </div>
      </form>
    </div>
    <div class="col-md-6 pb-5">
      <h3 class="h4 pb-1">No Account? Register</h3>
      <form class="needs-validation" method="POST" action="regprocess.php">
        <div class="row">
          <div class="col-sm-6">
            <div class="form-group">
              <label for="reg-fn">Username</label>
              <input class="form-control" name="user" type="text" required id="reg-fn">
              <div class="invalid-feedback">Please enter your username!</div>
            </div>
          </div>
          <div class="col-sm-6">
            <div class="form-group">
              <label for="reg-email">E-mail Address</label>
              <input class="form-control" type="email" name="email" required id="reg-email">
              <div class="invalid-feedback">Please enter valid email address!</div>
            </div>
          </div>
          <div class="col-sm-6">
            <div class="form-group">
              <label for="reg-password">Password</label>
              <input class="form-control" type="password" name="pass" required id="reg-password">
              <div class="invalid-feedback">Please enter password!</div>
            </div>
          </div>
          <div class="col-sm-6">
            <div class="form-group">
              <label for="reg-password-confirm">Confirm Password</label>
              <input class="form-control" type="password" name="pass-repeat" required id="reg-password-confirm">
              <div class="invalid-feedback">Passwords do not match!</div>
            </div>
          </div>
        </div>
        <div class="text-right">
          <button class="btn btn-primary" name="signup-submit" type="submit">Register</button>
        </div>
      </form>
    </div>
  </div>
</div>
</body>

</html>
