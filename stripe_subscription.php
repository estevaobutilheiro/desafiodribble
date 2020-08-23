<html>

<head>
    <script src="https://js.stripe.com/v3/"></script>
</head>

</html>

<?php

session_start();
require_once 'vendor/autoload.php';
if (isset($_SESSION['logged_in'])) {
    \Stripe\Stripe::setApiKey('sk_test_51HHs77FFoTJBoywrmWCzxFLswci8wTZwDhOdupA9ufkSbeqEAHQ4TYevwleDzy2IoyWeVaEiujpIfjKgTjo6YHSr00RSyKnZVz');


    $stripe = new \Stripe\StripeClient("sk_test_51HHs77FFoTJBoywrmWCzxFLswci8wTZwDhOdupA9ufkSbeqEAHQ4TYevwleDzy2IoyWeVaEiujpIfjKgTjo6YHSr00RSyKnZVz");

    if (preg_match("/^[0-9.]+$/", $a = $_POST['prodprice'])) {
        $x = str_replace('.', '', $a);
    }

    $session = \Stripe\Checkout\Session::create([
        'success_url' => 'http://localhost/desafio/checkout-complete.php?checkout_id={CHECKOUT_SESSION_ID}',
        'cancel_url' => 'http://localhost/desafio/index.php?response=paymenterror',
        'payment_method_types' => ['card'],

        'line_items' => [[
            'price' => $_POST['stripeprice'],
            'quantity' => 1,
        ]],
        'mode' => 'subscription'

    ]);
    $sessionId = $session->id;
?>
    <script>
        var stripe = Stripe('pk_test_51HHs77FFoTJBoywrskYOdKgpfyM2ZU8zRdYuB3JVKSXN1TfKMDu5dvtKsOjSzilsEpdg49rajTZHL2jKNG7GwLER005B5OlzEX');
        stripe.redirectToCheckout({
            sessionId: '<?php echo $session->id; ?>'
        })
    </script>
<?php
} else {
    header('location: index.php?error=notloggedin');
}
?>
