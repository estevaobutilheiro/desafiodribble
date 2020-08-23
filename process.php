<?php
include_once('connection.php');


if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['pass'];
    if (empty($username) || empty($password)) {
        header("location: index.php?response=emptyfields");
        exit();
    } else {

        $sql = "SELECT * FROM users WHERE username=?";
        $stmt = mysqli_stmt_init($conn);

        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("location: index.php?response=sqlerror");
            exit();
        } else {

            mysqli_stmt_bind_param($stmt, "s", $username);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);

            if ($row = mysqli_fetch_assoc($result)) {
                $pwdCheck = password_verify($password, $row['pwd']);

                if ($pwdCheck == false) {
                    header("location: account-login.php?response=wrongPwd");
                    exit();
                    var_dump($password);
                } elseif ($pwdCheck == true) {
                    session_start();
                    $_SESSION['userId'] = $row['id'];
                    $_SESSION['userUId'] = $row['username'];
                    $_SESSION['logged_in'] = true;
                    $_SESSION['logged_user'] = $row['username'];
                    $query = "SELECT perm FROM users WHERE username='$username'";
                    $rquery = mysqli_query($conn, $query);
                    $permission = mysqli_fetch_assoc($rquery);
                    if($permission['perm'] == "admin"){
                        $_SESSION['permission'] = $permission['perm'];

                    }else{
                        $_SESSION['permission'] = $permission['perm'];
                    }
                    header("location: index.php?response=successlogin");
                    exit();
                }
            } else {

                header("location: account-login.php?response=nouser");
                exit();
            }
        }
    }
} else {
    header("location: index.php");
    exit();
}
