<?php

    session_start();
    include "conn.php";

    $username = addslashes($_POST['username']);
    $password = md5($_POST['password']);
    $check = $_POST['remember-me'];

    $query = mysqli_query($connect, "SELECT * FROM user WHERE username = '$username' AND password = '$password' ");
    $cek = mysqli_num_rows($query);
    $row = mysqli_fetch_assoc($query);

    if (empty($username)) {
        header("location: ../../views/login.php?message=empty_username");
    }
    else if (empty($password)) {
        header("location: ../../views/login.php?message=empty_password");
    }
    else {
        if ($cek > 0) {
            if (isset($check)) {
                setcookie("user", $username, time()+3600, "/");

                $_SESSION['id_user'] = $row['id_user'];
                $_SESSION['nama-user'] = $row['nama'];
                $_SESSION['username-user'] = $row['username'];

                header("location: ../../views/user/user/accountDash.php");
            } else {

                $_SESSION['id_user'] = $row['id_user'];
                $_SESSION['nama-user'] = $row['nama'];
                $_SESSION['username-user'] = $row['username'];

                header("location: ../../views/user/user/accountDash.php");
            }
        } else {
            echo mysqli_error($connect);
            header("location: ../../views/login.php?message=fail");
        }
    }


?>