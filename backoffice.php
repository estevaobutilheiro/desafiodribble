<?php
require "header.php";
if ($_SESSION['permission'] == "user") {
  header("location: index.php?response=fail");
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
    <h2 class="pl-5 pt-5">Welcome to your backoffice.</h2>
  </div>
</div>

</html>