<!DOCTYPE html>
<html lang="en">
<?php
include_once('connection.php');
$prodquery = "SELECT * FROM products";
$result = mysqli_query($conn, $prodquery);
require_once 'vendor/autoload.php';
$stripe = new \Stripe\StripeClient('sk_test_51HHs77FFoTJBoywrmWCzxFLswci8wTZwDhOdupA9ufkSbeqEAHQ4TYevwleDzy2IoyWeVaEiujpIfjKgTjo6YHSr00RSyKnZVz');


require "header.php";
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
            <form method="POST">
                <!-- Text Input -->
                <div class="form-group">
                    <label class="text-muted" for="text-input">Product Name</label>
                    <input class="form-control" type="text" id="text-input" name="prodname">
                    <input style="display:none" type="text" id="<?php $_GET['update']; ?>" name="prodid" value="<?php echo $_GET['update'] ?>">
                    <input style="display:none" type="text" id="<?php $_GET['stripeid']; ?>" name="stripeid" value="<?php echo $_GET['stripeid'] ?>">
                    <input style="display:none" type="text" id="<?php $_GET['stripeprice']; ?>" name="stripeprice" value="<?php echo $_GET['stripeprice'] ?>">
                    <input style="display:none" type="text" id="<?php $_GET['prodprice']; ?>" name="prodprice" value="<?php echo $_GET['prodprice'] ?>">
                    <input style="display:none" type="text" id="<?php $_GET['proddesc']; ?>" name="proddesc" value="<?php echo $_GET['proddesc'] ?>">
                </div>

                <div class="form-group">
                    <label class="text-muted" for="textarea-input">Product Description</label>
                    <textarea class="form-control" id="textarea-input" rows="5" name="proddesc"></textarea>
                </div>

                <div class="form-group">
                    <label class="text-muted" for="text-input">Product Price</label>
                    <input class="form-control" type="number" step="any" id="number-input" name="prodprice">
                </div>

                <button class="btn btn-info" type="submit" name="updateprod">UPDATE</button>
                <a class="btn btn-warning" name="updateprod" href="products.php">Go Back</a>
            </form>
            <?php if (isset($_POST['updateprod'])) {

                if (empty($_POST['prodname']) || empty($_POST['proddesc']) || empty($_POST['prodprice'])) {
                    echo "
                        <div class='alert alert-danger alert-dismissible fade show text-center'>
                            <span class='alert-close' data-dismiss='alert'></span>
                            <i class='fe-icon-slash'></i>
                            &nbsp;&nbsp;
                            <strong>Error:</strong> Empty Field(s)! 
                        </div>";
                    exit();
                }

                $id = $_POST['prodid'];
                $priceQuery = "SELECT stripeprice FROM products WHERE id=$id";
                $rPQuery = mysqli_query($conn, $priceQuery);
                $oldPrice = mysqli_fetch_assoc($rPQuery);
                $stripeid = $_POST['stripeid'];
                $stripeprice = $oldPrice['stripeprice'];
                $name = $_POST['prodname'];
                $desc = $_POST['proddesc'];
                $price = $_POST['prodprice'];

                if (preg_match("/^[0-9.]+$/", $a = $_POST['prodprice'])) {
                    $x = str_replace('.', '', $a);
                }


                $stripe->products->update(
                    $stripeid,
                    ['name' => $name, 'description' => $desc]
                );

                $stripe->prices->update(
                    $stripeprice,
                    ['active' => false]
                );

                $newprice = $stripe->prices->create([
                    'product' => $stripeid,
                    'unit_amount' => $x,
                    'currency' => 'eur',
                    'recurring' => ['interval' => 'month'],
                ]);

                $bla = "UPDATE `products` SET id=$id, stripeid='$stripeid', stripeprice='$newprice->id', prodname='$name', proddescription='$desc', `prodprice`=$price WHERE id = $id";
                $query = mysqli_query($conn, $bla);
                echo "
                        <div class='alert alert-success alert-dismissible fade show text-center'>
                            <span class='alert-close' data-dismiss='alert'></span>
                            <i class='fe-icon-check-square'></i>
                            &nbsp;&nbsp;
                            <strong>Success:</strong> Product updated! 
                        </div>";
            }
            ?>
        </div>
    </div>


</div>

</body>

</html>