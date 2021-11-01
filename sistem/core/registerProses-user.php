<?php

    include "conn.php";

    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $telp = $_POST['telp'];
    $username = addslashes($_POST['username']);
    $password = md5($_POST['password']);
    $retry_pass = md5($_POST['retry-password']);

    if(empty($nama)) {
        header("location: ../../views/register.php?message=empty_name");
    }

    else if(empty($username)) {
        header("location: ../../views/register.php?message=empty_username");
    }

    else if(empty($password)) {
        header("location: ../../views/register.php?message=empty_password");
    }

    else if(empty($retry_pass)) {
        header("location: ../../views/register.php?message=empty_password_retry");
    }

    else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("location: ../../views/register.php?message=wrong_email");
    }

    else if ($password != $retry_pass) {
        header("location: ../../views/register.php?message=incorrect_password");
    }
    else {
        $cek_duplicate = mysqli_query($connect, "SELECT * FROM user WHERE username = '$username' ");
        $count = mysqli_num_rows($cek_duplicate);

        if ($count==0) {
            $generateID = "USER".uniqid();
            $generateImageName = "not-set";
            $changeName = strtoupper($nama);
            $query = mysqli_query($connect, "INSERT INTO user (id_user, nama, email, telp, username, password, profil_pic) VALUES
            ('$generateID', '$changeName', '$email','$telp', '$username', '$password', '$generateImageName')");

            if ($query) {
                header("location: ../../views/login.php?message=register_success");
            } else {
                header("location: ../../views/register.php?message=gagal_simpan");
            }
            
        } else {
            header("location: ../../views/register.php?message=user_not_available");
        }
    }

?>