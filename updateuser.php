<!DOCTYPE html>
<html lang="en">
<?php
include_once('connection.php');
$prodquery = "SELECT * FROM products";
$result = mysqli_query($conn, $prodquery);

require "header.php";
?>
<?php
    $username = $_GET['username'];
    session_start();
    if($_SESSION['logged_user'] == $username){
        header("location: editusers.php?response=uUser");

        echo "
                        <div class='alert alert-danger alert-dismissible fade show text-center'>
                            <span class='alert-close' data-dismiss='alert'></span>
                            <i class='fe-icon-slash'></i>
                            &nbsp;&nbsp;
                            <strong>Error:</strong> You can't update the user you are currently logged in! 
                        </div>";

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
            <form method="POST">
                <!-- Text Input -->
                <div class="form-group">
                    <label class="text-muted" for="text-input">Username</label>
                    <input class="form-control" type="text" id="text-input" name="username">
                    <input style="display:none" type="text" id="<?php $_GET['userId']; ?>" name="userId" value="<?php echo $_GET['userId'] ?>">
                </div>
                <div class="form-group">
                    <label class="text-muted" for="text-input">Email</label>
                    <input class="form-control" id="text-input" name="email"></input>
                </div>

                <div class="form-group">
                    <label class="text-muted" for="text-input">Permission</label>
                    <select class="form-control" id="select-input" name="select-permissions">
                        <option>admin</option>
                        <option>user</option>
                    </select>
                </div>

                <button class="btn btn-info" type="submit" name="updateuser">UPDATE</button>
                <a class="btn btn-warning" href="editusers.php">Go Back</a>
            </form>
            <?php if (isset($_POST['updateuser'])) {
                $id = $_POST['userId'];
                $name = $_POST['username'];
                $email = $_POST['email'];
                $permission = $_POST['select-permissions'];
                if (empty($name) || empty($email)) {
                    echo "
                        <div class='alert alert-danger alert-dismissible fade show text-center'>
                            <span class='alert-close' data-dismiss='alert'></span>
                            <i class='fe-icon-slash'></i>
                            &nbsp;&nbsp;
                            <strong>Error:</strong> Empty fields 
                        </div>";
                    exit();
                } else{
                    $updateQuery = "UPDATE `users` SET id='$id', username='$name', email='$email', perm='$permission' WHERE id = '$id'";
                    $query = mysqli_query($conn, $updateQuery);
                    echo "
                        <div class='alert alert-success alert-dismissible fade show text-center'>
                            <span class='alert-close' data-dismiss='alert'></span>
                            <i class='fe-icon-check-square'></i>
                            &nbsp;&nbsp;
                            <strong>Success:</strong> User updated! 
                        </div>";
                }
            }
            ?>
        </div>
    </div>


</div>

</body>

</html>