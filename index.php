<!DOCTYPE html>
<html lang="en">
<?php
include_once('connection.php');
$prodquery = "SELECT * FROM products";
$result = mysqli_query($conn, $prodquery);

require "header.php";
?>
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
  } else if ($_GET['response'] == "usertaken") {
    echo "
        <div class='alert alert-danger alert-dismissible fade show text-center'>
          <span class='alert-close' data-dismiss='alert'></span>
          <i class='fe-icon-slash'></i>
          &nbsp;&nbsp;
          <strong>Error:</strong> User Taken! 
        </div>";
  } else if ($_GET['response'] == "sqlerror") {
    echo "
        <div class='alert alert-danger alert-dismissible fade show text-center'>
          <span class='alert-close' data-dismiss='alert'></span>
          <i class='fe-icon-slash'></i>
          &nbsp;&nbsp;
          <strong>Error:</strong> SQL Error! 
        </div>";
  } else if ($_GET['response'] == "success") {
    echo "
        <div class='alert alert-success alert-dismissible fade show text-center'>
          <span class='alert-close' data-dismiss='alert'></span>
          <i class='fe-icon-check-square'></i>
          &nbsp;&nbsp;
          <strong>Success:</strong> User Created! 
        </div>";
  } else if ($_GET['response'] == "fail") {
    echo "
        <div class='alert alert-danger alert-dismissible fade show text-center'>
          <span class='alert-close' data-dismiss='alert'></span>
          <i class='fe-icon-slash'></i>
          &nbsp;&nbsp;
          <strong>Error:</strong> You do not have permission to access this page! 
        </div>";
  } else if ($_GET['response'] == "paymenterror") {
    echo "
        <div class='alert alert-danger alert-dismissible fade show text-center'>
          <span class='alert-close' data-dismiss='alert'></span>
          <i class='fe-icon-slash'></i>
          &nbsp;&nbsp;
          <strong>Error:</strong> Payment Error! 
        </div>";
  }else if ($_GET['response'] == "successlogin") {
    echo "
        <div class='alert alert-success alert-dismissible fade show text-center'>
          <span class='alert-close' data-dismiss='alert'></span>
          <i class='fe-icon-check-square'></i>
          &nbsp;&nbsp;
          <strong>Success:</strong> You are now logged in! 
        </div>";
  }
}
?>
<!-- Hero-->
<section class="bg-center bg-repeat-y box-shadow" style="background-image: url(img/homepages/freelancer-portfolio/hero-bg.png);">
  <div class="container">
    <div class="row">
      <div class="col-md-6 bg-secondary order-md-2 pt-md-5 overflow-hidden">
        <div class="mt-5 pt-5"><img class="d-block mx-auto" src="img/homepages/freelancer-portfolio/portrait.jpg" alt="Martin Garrix" data-parallax="{&quot;scale&quot; : 1.15}"></div>
      </div>
      <div class="col-md-6 bg-white order-md-1 py-md-5 overflow-hidden">
        <div class="mt-md-5 py-5 text-center text-md-left">
          <h2 class="h3 text-body pt-md-5 pb-3"><span class="d-block font-family-body font-weight-light pb-2">Listen to music.</span><span class="d-block font-family-body font-weight-light">Anywhere, <span class='font-weight-bold'>whenever you want.</span></span></h2>
          <div class="pt-3"><a class="scroll-to btn btn-style-4 btn-gradient btn-icon-right mb-3" href="#pricing" data-parallax="{&quot;y&quot; : -25}"><i class="fe-icon-arrow-down text-md"></i>See subscription plans.</a></div>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- Pricing-->
<section class="container pt-sm-5" id="pricing">
  <h2 class="h3 text-center"><span class="font-weight-normal">Subscription plans</span></h2>
  <div class="pricing-plans pb-5">
    <div class="row">
      <!-- WHILE PHP -->
      <?php
      while ($rows = mysqli_fetch_assoc($result)) {
      ?>
        <div class="col-lg-4 col-sm-6 mb-30 pb-3">
          <form method="POST" action="stripe_subscription.php">
            <div class="pricing-card" style="height:100%">
              <div class="pricing-card-body"><img class="pricing-card-image" src="img/pricing/03.png" alt="Individual Plan">
                <h5><?php echo $rows['prodname']; ?></h5>
                <input type="hidden" name="id" value="<?php echo $rows['id']; ?>">
                <input type="hidden" name="prodname" value="<?php echo $rows['prodname']; ?>">
                <input type="hidden" name="stripeid" value="<?php echo $rows['stripeid']; ?>">
                <input type="hidden" name="prodprice" value="<?php echo $rows['prodprice']; ?>">
                <input type="hidden" name="stripeprice" value="<?php echo $rows['stripeprice']; ?>">
                <input type="hidden" name="id" value="<?php echo $rows['id']; ?>">
                <div class="pricing-card-price monthly active"><span>€</span><?php echo $rows['prodprice']; ?></div>
                <ul class="list-icon d-table mx-auto pt-4 text-left">
                  <li><i class="fe-icon-check-circle text-muted"></i><?php echo $rows['proddescription']; ?></li>
                </ul>
              </div>
              <div class="pricing-card-button">
                <button class="btn btn-gradient" id="<?php echo $rows['prodname']; ?>">
                  Buy Now
                </button>
                <!-- <button class="btn btn-gradient" type="submit" name="buynow">
                    Buy Now
                  </button> -->
              </div>
            </div>
          </form>
        </div>

      <?php
      }
      ?>
    </div>
  </div>
</section>
<!-- Why-->
<section class="container pb-4">
  <h2 class="h3 block-title text-center pt-2">Why use bandify?</h2>
  <div class="row py-2">
    <div class="col-lg-3 col-sm-6">
      <!-- Step-->
      <div class="step step-with-icon">
        <div class="step-icon"><img src="img/icons/speaker.svg" alt="speaker"></div>
        <h3 class="step-title">The best music</h3>
        <p class="step-text text-sm">We here on Bandify don't care about copyright strikes. Every single music you can think of is in here. Every single one of them.</p>
      </div>
    </div>
    <div class="col-lg-3 col-sm-6">
      <!-- Step-->
      <div class="step step-with-icon">
        <div class="step-icon"><img src="img/icons/music.svg" alt="music"></div>
        <h3 class="step-title">Best audio quality</h3>
        <p class="step-text text-sm">With Bandify premium, you'll have the best audio quality available out there.</p>
      </div>
    </div>
    <div class="col-lg-3 col-sm-6">
      <!-- Step-->
      <div class="step step-with-icon">
        <div class="step-icon"><img src="img/icons/headphones.svg" alt="headphones"></div>
        <h3 class="step-title">Free Headphones!</h3>
        <p class="step-text text-sm">When you subscribe to Bandify Premium, you'll recieve free headphones! </br>(They might not be on the best audio quality, we do not take responsability for any hearing damages.)</p>
      </div>
    </div>
    <div class="col-lg-3 col-sm-6">
      <!-- Step-->
      <div class="step step-with-icon">
        <div class="step-icon"><img src="img/icons/download.svg" alt="Download"></div>
        <h3 class="step-title">Music Downloads</h3>
        <p class="step-text text-sm">With Bandify Premium, you'll be able to download any music you want, so you can listen to it anytime and anywhere you want.</p><a class="step-link" href="#">Learn more<i class="fe-icon-arrow-right"></i></a>
      </div>
    </div>
  </div>
</section>
<!-- Footer-->
<?php
require "footer.php";
?>
</body>

</html>