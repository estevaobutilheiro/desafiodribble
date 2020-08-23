<?php
require_once "connection.php";
session_start();
if(isset($_POST['delete'])){
    $username = $_POST['username'];

    if($_SESSION['logged_user'] == $username){
        header("location: editusers.php?response=currentUser");
        exit();
    }
    $query = mysqli_query($conn, "DELETE FROM users WHERE username='$username'");
    header('location: editusers.php?response=deleted');
}