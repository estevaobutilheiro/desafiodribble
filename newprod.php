<?php
    include_once('connection.php');

    require_once 'vendor/stripe/stripe-php/init.php';
    $stripe = new \Stripe\StripeClient("sk_test_51HHs77FFoTJBoywrmWCzxFLswci8wTZwDhOdupA9ufkSbeqEAHQ4TYevwleDzy2IoyWeVaEiujpIfjKgTjo6YHSr00RSyKnZVz");
    
    if(isset($_POST['save'])){
        // var_dump($_FILES);
        if(!empty($_POST['prodname'])&& !empty($_POST['proddesc'])&& !empty($_POST['prodval'])){
            // $icon = $_FILES['prodicon'];
            // $iconname =$_FILES['prodicon']['name'];

            $product = $stripe->products->create([
                'name' => $_POST['prodname'],
                'description' => $_POST['proddesc'],
              ]);


            if(preg_match("/^[0-9.]+$/", $a = $_POST['prodval'])) {
                $x = str_replace('.', '', $a);
            }

            $price = $stripe->prices->create([
                'product' => $product->id,
                'unit_amount' => $x,
                'currency' => 'eur',
                'recurring' => ['interval' => 'month'],
              ]);

            $name = $_POST['prodname'];
            $desc = $_POST['proddesc'];
            $result = mysqli_query($conn, "INSERT INTO `products`(`stripeid`, `stripeprice` , `prodname`, `proddescription`, `prodprice`) VALUES ('$product->id','$price->id','$name','$desc', '$a')");
            header('location: products.php?response=prodcreated');
        }else{
            header('location: products.php?response=emptyFields');
        }
    }
