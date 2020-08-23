<?php
require_once('connection.php');

require "header.php";
require "vendor/autoload.php";
include_once("connection.php");
$stripe = new \Stripe\StripeClient(
  'sk_test_51HHs77FFoTJBoywrmWCzxFLswci8wTZwDhOdupA9ufkSbeqEAHQ4TYevwleDzy2IoyWeVaEiujpIfjKgTjo6YHSr00RSyKnZVz'
);
$order = $stripe->checkout->sessions->retrieve(
  $_GET['checkout_id'],
  []
);
$username = $_SESSION['userUId'];
$queryorder = "INSERT INTO orders (`username`, `item_price`, `customer_id`, `subscription_id`, `checkout_id`) VALUES ('$username', '$order->amount_total', '$order->customer', '$order->subscription', '$order->id')";
$result = mysqli_query($conn, $queryorder);

?>
<!-- Page Title-->
<div class="page-title d-flex" aria-label="Page title" style="background-image: url(img/page-title/shop-pattern.jpg);">
  <div class="container text-left align-self-center">
    <h1 class="page-title-heading">Checkout</h1>
  </div>
</div>
<!-- Page Content-->
<div class="container pb-5 mb-3">
  <!-- Checkout: Complete-->
  <div class="wizard pb-3">
    <div class="wizard-body pt-2 text-center">
      <h3 class="h4 pb-3">Thank you for your order!</h3>
      <p class="mb-2">Your order has been placed and will be processed as soon as possible.</p>
      <p class="mb-2">Make sure you make note of your order number, which is <strong><?php echo $_GET['checkout_id']; ?></strong></p>
    </div>
  </div>
</div>
</body>

</html>