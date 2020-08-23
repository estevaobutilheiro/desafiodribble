<?php

include_once('connection.php');

if (isset($_POST['createuser'])) {
    $username = $_POST['username'];
    $password = $_POST['pass'];
    $email = $_POST['email'];
    $permision = $_POST['select-permissions'];

    $sql = "SELECT username FROM users WHERE username=?";
    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: editusers.php?error=sqlerror");
        exit();
    } else {
        mysqli_stmt_bind_param($stmt, "s", $username);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);
        $resultCheck = mysqli_stmt_num_rows($stmt);
        if (empty($username) || empty($password) || empty($email)) {
            header("location: editusers.php?response=emptyFields");
            exit();
        } else {
            if ($resultCheck > 0) {
                header("location: editusers.php?response=usertaken");
                exit();
            } else {
                $sql = "INSERT INTO users (username, email, pwd, perm) VALUES (?, ?, ?, ?)";
                $stmt = mysqli_stmt_init($conn);
                if (!mysqli_stmt_prepare($stmt, $sql)) {
                    header("location: editusers.php?response=sqlerror");
                    exit();
                } else {
                    $hashedPwd = password_hash($password, PASSWORD_DEFAULT);

                    mysqli_stmt_bind_param($stmt, "ssss", $username, $email, $hashedPwd, $permision);
                    mysqli_stmt_execute($stmt);
                    session_start();
                    $query = "SELECT perm FROM users WHERE username='$username'";
                    $rquery = mysqli_query($conn, $query);
                    $permission = mysqli_fetch_assoc($rquery);
                    header("location: editusers.php?response=success");
                    exit();
                }
            }
        }
    }
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}

if (isset($_POST['signup-submit'])) {
    $username = $_POST['user'];
    $email = $_POST['email'];
    $password = $_POST['pass'];
    $passwordRepeat = $_POST['pass-repeat'];
    $type = "user";

    $sql = "SELECT username FROM users WHERE username=?";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: index.php?response=sqlerror");
        exit();
    } else {
        mysqli_stmt_bind_param($stmt, "s", $username);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);
        $resultCheck = mysqli_stmt_num_rows($stmt);
        if (empty($username) || empty($password) || empty($email) || $password !== $passwordRepeat) {
            header("location: account-login.php?response=emptyFields");
            exit();
        }
        if ($resultCheck > 0) {
            header("location: index.php?response=usertaken");
            exit();
        } else {
            $sql = "INSERT INTO users (username, email, pwd, perm) VALUES (?, ?, ?, ?)";
            $stmt = mysqli_stmt_init($conn);
            if (!mysqli_stmt_prepare($stmt, $sql)) {
                header("location: index.php?response=sqlerror");
                exit();
            } else {
                $hashedPwd = password_hash($password, PASSWORD_DEFAULT);

                mysqli_stmt_bind_param($stmt, "ssss", $username, $email, $hashedPwd, $type);
                mysqli_stmt_execute($stmt);
                session_start();
                $query = "SELECT perm FROM users WHERE username='$username'";
                $rquery = mysqli_query($conn, $query);
                $permission = mysqli_fetch_assoc($rquery);
                $_SESSION['permission'] = "user";
                $_SESSION['userUId'] = $username;
                $_SESSION['logged_in'] = true;
                header("location: index.php?response=success");
                exit();
            }
        }
    }
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}
