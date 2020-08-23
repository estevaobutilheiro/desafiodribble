<?php
    include_once('connection.php');
    require_once 'vendor/autoload.php';
    $stripe = new \Stripe\StripeClient('sk_test_51HHs77FFoTJBoywrmWCzxFLswci8wTZwDhOdupA9ufkSbeqEAHQ4TYevwleDzy2IoyWeVaEiujpIfjKgTjo6YHSr00RSyKnZVz');

    $id = $_POST['id'];
    $stripeid =  $_POST['stripeid'];

    // $stripe->products->delete(
    //     $stripeid,
    //     []
    //   );

    $stripe->products->update(
        $stripeid,
        ['active' => false]
    );

    if(isset($_POST['delete'])){
        $delquery = "DELETE FROM products WHERE id = $id";
        $resultdelete = mysqli_query($conn, $delquery);
        header('location: products.php?response=deleted');
    }
