<?php
include_once('connection.php');
$prodquery = "SELECT * FROM products";
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
            <a class="btn btn-secondary btn-block" href="editusers.php">EDIT USERS</a>
          </div>
        </div>
      </aside>
    </div>
    <div class="col-xl-10 col-lg-9">
      <!-- Shop Toolbar-->
      <div class="justify-content-between pb-2">
        <div class="form-inline pb-4">
          <button class="btn btn-info" type="button" data-toggle="modal" data-target="#modalDefault">Create a new product</button>
          <div class="modal fade" id="modalDefault" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-lg" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h4 class="modal-title">New Product</h4>
                  <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <form method="POST" action="newprod.php">
                  <div class="modal-body">
                    <div class="form-group row align-items-center">
                      <!-- Addon on the Left -->
                      <div class="pl-3 pr-3 pt-3 pb-3" style="width:100%;">
                        <div class="input-group">
                          <div class="input-group-prepend">
                            <span class="input-group-text" style="width: 111px;">Name:</span>
                          </div>
                          <input class="form-control" type="text" placeholder="Name of the product" name="prodname">
                        </div>
                      </div>

                      <div class="pl-3 pr-3 pt-3 pb-3" style="width:100%;">
                        <div class="input-group">
                          <div class="input-group-prepend">
                            <span class="input-group-text">Description:</span>
                          </div>
                          <textarea class="form-control" type="text" rows="5" name="proddesc" placeholder="Description of the product"></textarea>
                        </div>
                      </div>

                      <!-- Addon on the Right -->
                      <div class="pl-3 pr-3 pt-3 pb-3" style="width:100%;">
                        <div class="input-group">
                          <div class="input-group-prepend">
                            <span class="input-group-text" style="width: 111px;"><i class="fe-icon-dollar-sign"></i></span>
                          </div>
                          <input class="form-control" type="text" name="prodval" placeholder="Amount">
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button class="btn btn-secondary btn-sm" type="button" data-dismiss="modal">Close</button>
                    <button class="btn btn-primary btn-sm" type="submit" name="save">Save changes</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- Shop Grid-->
        <?php
        if (isset($_GET['response'])) {
          if ($_GET['response'] == "emptyFields") {
            echo "
                <div class='alert alert-danger alert-dismissible fade show text-center'>
                  <span class='alert-close' data-dismiss='alert'></span>
                  <i class='fe-icon-slash'></i>
                  &nbsp;&nbsp;
                  <strong>Error:</strong> Empty fields 
                </div>";
          } else if ($_GET['response'] == "deleted") {
            echo "
                <div class='alert alert-danger alert-dismissible fade show text-center'>
                  <span class='alert-close' data-dismiss='alert'></span>
                  <i class='fe-icon-slash'></i>
                  &nbsp;&nbsp;
                  <strong>Error:</strong> Product Deleted!
                </div>";
          }
        }
        ?>
      <div class="row">
        <!-- Product-->
        <section class="container" id="pricing">
          <div class="pricing-plans pb-5">
            <div class="row">
              <!-- WHILE PHP -->
              <?php
              while ($rows = mysqli_fetch_assoc($result)) {
              ?>
                <div class="col-lg-4 col-sm-6 mb-30 pb-3">
                  <div class="pricing-card" style="height:100%">
                    <form method="POST" action="deleteprod.php">
                      <input type="hidden" name="id" value="<?php echo $rows['id']; ?>">
                      <input type="hidden" name="stripeid" value="<?php echo $rows['stripeid']; ?>">
                      <input type="hidden" name="stripeprice" value="<?php echo $rows['stripeprice']; ?>">
                      <div class="pricing-card-body"><img class="pricing-card-image" src="img/pricing/03.png" alt="Individual Plan">
                        <h5><?php echo $rows['prodname']; ?></h5>
                        <div class="pricing-card-price monthly active"><span>$</span><?php echo $rows['prodprice']; ?></div>
                        <ul class="list-icon d-table mx-auto pt-4 text-left">
                          <li><i class="fe-icon-check-circle text-muted"></i><?php echo $rows['proddescription']; ?></li>
                        </ul>
                      </div>
                      <div class="pricing-card-button">
                        <button class="btn btn-style-5 btn-danger" type="submit" name="delete">
                          Delete
                        </button>
                        <a class="btn btn-style-5 btn-info testtt" href="updateprod.php?update=<?php echo $rows['id']; ?>&stripeid=<?php echo $rows['stripeid']; ?>&stripeprice=<?php echo $rows['stripeprice']; ?>&prodname=<?php echo $rows['prodname']; ?>&prodprice=<?php echo $rows['prodprice']; ?>&proddesc=<?php echo $rows['proddescription']; ?>">
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