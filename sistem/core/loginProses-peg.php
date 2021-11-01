<?php

    session_start();
    include "conn.php";

    $username = addslashes($_POST['username']);
    $password = md5($_POST['password']);
    // $check = $_POST['remember-me'];

    $query = mysqli_query($connect, "SELECT * FROM karyawan WHERE username = '$username' AND password = '$password' ");
    $cek = mysqli_num_rows($query);
    $row = mysqli_fetch_assoc($query);

    if (empty($username)) {
        header("location: ../../views/login-portal.php?message=empty_username");
    }
    else if (empty($password)) {
        header("location: ../../views/login-portal.php?message=empty_password");
    }
    else {
        if ($cek > 0) {
            if ($row['status'] == "verified") {
                if (empty($_POST['remember-me'])) {

                    $_SESSION['id_pgw'] = $row['id_pgw'];
                    $_SESSION['nama'] = $row['nama'];
                    $_SESSION['username'] = $row['username'];
                    $_SESSION['level'] = $row['level'];

                    if ($row['level'] == "admin")
                    {
                        $_SESSION['nama'] = $row['nama'];
                        $_SESSION['username'] = $username;
                        $_SESSION['level'] = "admin";
                        $_SESSION['status'] = "admin";

                        header("location: ../../views/user/admin/");
                    }
                    else if ($row['level'] == "karyawan")
                    {
                        $_SESSION['nama'] = $row['nama'];
                        $_SESSION['username'] = $username;
                        $_SESSION['level'] = "karyawan";
                        $_SESSION['status'] = "karyawan";

                        header("location: ../../views/user/karyawan/");
                    }
                    else
                    {
                        header("location: ../../views/index-portal.php?message=user_not_available");
                    }

                } 
                // Jika tidak remember me
                else {
                    setcookie("user_pegawai", $username, time()+3600, "/");

                    $_SESSION['id_pgw'] = $row['id_pgw'];
                    $_SESSION['nama'] = $row['nama'];
                    $_SESSION['username'] = $row['username'];
                    $_SESSION['level'] = $row['level'];

                    if ($row['level'] == "admin")
                    {
                        $_SESSION['nama'] = $row['nama'];
                        $_SESSION['username'] = $username;
                        $_SESSION['level'] = "admin";
                        $_SESSION['status'] = "admin";

                        header("location: ../../views/user/admin/");
                    }
                    else if ($row['level'] == "karyawan")
                    {
                        $_SESSION['nama'] = $row['nama'];
                        $_SESSION['username'] = $username;
                        $_SESSION['level'] = "karyawan";
                        $_SESSION['status'] = "karyawan";

                        header("location: ../../views/user/karyawan/");
                    }
                    else
                    {
                        header("location: ../../views/index-portal.php?message=user_not_available");
                    }
                }
            }
            // user belum terverifikasi
            else if ($row['status'] == "unverified") {
                header("location: ../../views/login-portal.php?message=account_unverified");
            }

        } else {
            echo mysqli_error($connect);
            header("location: ../../views/login-portal.php?message=fail");
        }
    }


?>