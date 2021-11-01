<?php

    session_start();

    include "../sistem/core/conn.php";  

    if (isset($_SESSION['username-user'])) {
        header("location: user/user/accountDash.php");
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Masuk ke Akun Kamu | Selamat Datang Akiharaba Store</title>
        
        <link rel="icon" href="../sistem/public/img/akiba-store-logo_ico.png" type="image/icon-img">
        <link rel="stylesheet" href="../sistem/public/css/style-login.css">
    </head>
    <body>
        <div class="container">
            <div class="register-layout">
                <div class="cover">
                    <h2>LOGIN</h2> 
                    <p>
                        Masuk dengan akun yang sudah kamu punya<br>
                        belum punya akun ? <a href="register.php" class="redirect-register">Daftar disini</a>
                    </p>

                    <?php
                        if (isset($_GET['message'])) {
                            if ($_GET['message'] == 'empty_username') {
                                echo "
                                <div class='error-msg' style='background: #FF8F00;'>
                                <p>Lengkapi username anda</p>
                                </div>
                                ";
                            }
                            else if ($_GET['message'] == 'empty_password') {
                                echo "
                                <div class='error-msg' style='background: red;'>
                                <p>Lengkapi password anda</p>
                                </div>
                                ";
                            }
                            else if ($_GET['message'] == 'fail') {
                                echo "
                                <div class='error-msg' style='background: #C62828;'>
                                <p>Pengguna tidak ditemukan</p>
                                </div>
                                ";
                            }
                            else if ($_GET['message'] == 'register_success') {
                                echo "
                                <div class='error-msg' style='background: green; color: white;'>
                                <p>Registrasi berhasil, silahkan login !</p>
                                </div>
                                ";
                            }
                            else if ($_GET['message'] == 'please_login') {
                                echo "
                                <div class='error-msg' style='background: #C62828; color: white;'>
                                <p>Anda harus login dulu</p>
                                </div>
                                ";
                            }
                            else if ($_GET['message'] == 'logout_success') {
                                echo "
                                <div class='error-msg' style='background: green; color: white;'>
                                <p>Anda berhasil logout</p>
                                </div>
                                ";
                            }
                        }
                    ?>

                    <form action="../sistem/core/loginProses-user.php" method="POST">
                        <table>
                            <tr>
                                <td><label for="username">Username</label></td>
                                <td><input type="text" name="username" id="username" value="<?php if (isset($_COOKIE["user"])) { echo $_COOKIE["user"]; } else { ""; }; ?>" placeholder="Username anda.." autofocus></td>
                            </tr>
                            <tr>
                                <td><label for="password">Password anda</label></td>
                                <td><input type="password" name="password" id="password" placeholder="Password anda.."></td>
                            </tr>
                            <tr>
                                <td colspan="2" style="display: none; font-size: 11px; font-weight: bold; color: red;" id="caps-text">Capslock aktif !</td>
                            </tr>
                            <tr>
                                <td colspan="2"><hr style="border-top: 0.5px solid #F5F5F5"></td>
                            </tr>
                            <tr>
                                <td><label for="remember">Simpan username ?</label></td>
                                <td><input type="checkbox" name="remember-me" id="remember"></td>
                            </tr>
                            <tr>
                                <td colspan="2"><button class="login-btn">Masuk Sekarang !</button></td>
                            </tr>
                        </table>
                    </form>
                    
                    <button class="btn"><a href="../">Akiharaba Store</a></button>
                    <button class="btn register-peg" style="float: right;"><a href="login-portal.php" target="_blank">Portal Karyawan</a></button>
                </div>
            </div>
        </div>
        <?php
            echo '<script type="text/javascript" src="../sistem/public/js/caps.js"></script>';
        ?>
    </body>
</html>