<!DOCTYPE html>
<html lang="en">
<?php
include_once('connection.php');
$prodquery = "SELECT * FROM users";
$result = mysqli_query($conn, $prodquery);
?>

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
  <!-- JavaScript (jQuery) libraries, plugins and custom scripts-->
  <script src="js/vendor.min.js"></script>
  <script src="js/theme.min.js"></script>

</head>
<!-- Body-->

<body>
  <?php
  require "header.php";
  if ($_SESSION['permission'] == "user") {
    header("location: index.php?permission=fail");
    exit();
  }
  ?>
  <!-- Main page -->
  <div class="container-fluid pb-5 mb-3 pt-5">
    <div class="row">
      <div class="col-xl-2 col-lg-3">
        <!-- Shop Sidebar-->
        <!-- Off-Canvas Toggle--><a class="offcanvas-toggle" href="#shop-sidebar" data-toggle="offcanvas"><i class="fe-icon-sidebar"></i></a>
        <!-- Off-Canvas Container-->
        <aside class="offcanvas-container" id="shop-sidebar">
          <div class="offcanvas-scrollable-area px-4 pt-5 px-lg-0 pt-lg-0"><span class="offcanvas-close"><i class="fe-icon-x"></i></span>
            <!-- Categories-->
            <div class="widget widget-categories">
              <h4 class="widget-title">BACKOFFICE </h4>
              <a class="btn btn-secondary btn-block" href="products.php">PRODUCTS</a>
              <a class="btn btn-secondary btn-block" href="#">EDIT USERS</a>
            </div>
          </div>
        </aside>
      </div>
      <div class="col-xl-10 col-lg-9">
        <!-- Shop Toolbar-->
        <div class="justify-content-between pb-2">
          <div class="form-inline pb-4">
            <button class="btn btn-info" type="button" data-toggle="modal" data-target="#modalDefault">Create a new user</button>
            <div class="modal fade" id="modalDefault" tabindex="-1" role="dialog">
              <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h4 class="modal-title">New User</h4>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  </div>
                  <form method="POST" action="regprocess.php">
                    <div class="modal-body">
                      <div class="form-group row align-items-center">
                        <!-- Addon on the Left -->
                        <div class="pl-3 pr-3 pt-3 pb-3" style="width:100%;">
                          <div class="input-group">
                            <div class="input-group-prepend">
                              <span class="input-group-text" style="width: 111px;">Username:</span>
                            </div>
                            <input class="form-control" type="text" placeholder="Name of the user" name="username">
                          </div>
                        </div>
                        <div class="pl-3 pr-3 pt-3 pb-3" style="width:100%;">
                          <div class="input-group">
                            <div class="input-group-prepend">
                              <span class="input-group-text" style="width: 111px;">User email:</span>
                            </div>
                            <input class="form-control" type="text" placeholder="Email of the user" name="email">
                          </div>
                        </div>
                        <!-- Addon on the Right -->
                        <div class="pl-3 pr-3 pt-3 pb-3" style="width:100%;">
                          <div class="input-group">
                            <div class="input-group-prepend">
                              <span class="input-group-text" style="width: 111px;">User Pass</span>
                            </div>
                            <input class="form-control" type="text" name="pass" placeholder="User Password">
                          </div>
                        </div>
                        <div class="pl-3 pr-3 pt-3 pb-3" style="width:100%;">
                          <div class="input-group">
                            <div class="input-group-prepend">
                              <span class="input-group-text" style="width: 111px;">Permissions</span>
                            </div>
                            <select class="form-control" id="select-input" name="select-permissions">
                              <option>admin</option>
                              <option>user</option>
                            </select>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button class="btn btn-secondary btn-sm" type="button" data-dismiss="modal">Close</button>
                      <button class="btn btn-primary btn-sm" type="submit" name="createuser">Create User</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- Shop Grid-->
        <div class="row">
          
          <!-- Product-->
          <section class="container" id="pricing">
          <?php
          if(isset($_GET['response'])){
            if ($_GET['response'] == "emptyFields") {
              echo "
                <div class='alert alert-danger alert-dismissible fade show text-center'>
                  <span class='alert-close' data-dismiss='alert'></span>
                  <i class='fe-icon-slash'></i>
                  &nbsp;&nbsp;
                  <strong>Error:</strong> Empty fields 
                </div>";
            } else if($_GET['response'] == "usertaken"){
              echo "
                <div class='alert alert-danger alert-dismissible fade show text-center'>
                  <span class='alert-close' data-dismiss='alert'></span>
                  <i class='fe-icon-slash'></i>
                  &nbsp;&nbsp;
                  <strong>Error:</strong> User Taken! 
                </div>";
            }else if($_GET['response'] == "sqlerror"){
              echo "
                <div class='alert alert-danger alert-dismissible fade show text-center'>
                  <span class='alert-close' data-dismiss='alert'></span>
                  <i class='fe-icon-slash'></i>
                  &nbsp;&nbsp;
                  <strong>Error:</strong> SQL Error! 
                </div>";
            }else if($_GET['response'] == "success"){
              echo "
                <div class='alert alert-success alert-dismissible fade show text-center'>
                  <span class='alert-close' data-dismiss='alert'></span>
                  <i class='fe-icon-check-square'></i>
                  &nbsp;&nbsp;
                  <strong>Success:</strong> User Created! 
                </div>";
            }else if($_GET['response'] == "deleted"){
              echo "
                <div class='alert alert-success alert-dismissible fade show text-center'>
                  <span class='alert-close' data-dismiss='alert'></span>
                  <i class='fe-icon-check-square'></i>
                  &nbsp;&nbsp;
                  <strong>Success:</strong> User Deleted! 
                </div>";
            }else if($_GET['response'] == "currentUser"){
              echo "
                <div class='alert alert-danger alert-dismissible fade show text-center'>
                  <span class='alert-close' data-dismiss='alert'></span>
                  <i class='fe-icon-slash'></i>
                  &nbsp;&nbsp;
                  <strong>Error:</strong> You cannot delete the user you are currently logged in! 
                </div>";
            }else if($_GET['response'] == "uUser"){
              echo "
                <div class='alert alert-danger alert-dismissible fade show text-center'>
                  <span class='alert-close' data-dismiss='alert'></span>
                  <i class='fe-icon-slash'></i>
                  &nbsp;&nbsp;
                  <strong>Error:</strong> You cannot Update the user you are currently logged in! 
                </div>";
            }
          }
          ?>
            <div class="pricing-plans pb-5">
              <div class="row">
                <!-- WHILE PHP -->
                <?php
                

                while ($rows = mysqli_fetch_assoc($result)) {
                ?>
                  <div class="col-lg-4 col-sm-6 mb-30 pb-3">
                    <div class="pricing-card" style="height:100%">
                      <form method="POST" action="deleteuser.php">
                        <div class="pricing-card-body"><img class="pricing-card-image" src="img/pricing/02.png" alt="Individual Plan">
                          <h5><?php echo $rows['username']; ?></h5>
                          <input type="hidden" name="username" value="<?php echo $rows['username']; ?>">
                          <ul class="list-icon d-table mx-auto pt-4 text-left">
                            <li><i class="fe-icon-check-circle text-muted"></i>Email: <?php echo $rows['email']; ?></li>
                          </ul>
                          <ul class="list-icon d-table mx-auto pt-4 text-left">
                            <li><i class="fe-icon-check-circle text-muted"></i>Permission level: <?php echo $rows['perm']; ?></li>
                          </ul>
                        </div>
                        <div class="pricing-card-button">
                          <button class="btn btn-style-5 btn-danger" type="submit" name="delete">
                            Delete
                          </button>
                          <a class="btn btn-style-5 btn-info" href="updateuser.php?userId=<?php echo $rows['id']; ?>&username=<?php echo $rows['username']; ?>&email=<?php echo $rows['email']; ?>&permission=<?php echo $rows['perm']; ?>">
                            Edit
                          </a>
                        </div>
                      </form>
                    </div>
                  </div>
                <?php
                }
                ?>
              </div>
            </div>
          </section>
        </div>
      </div>
    </div>
  </div>

</html>