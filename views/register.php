<html>
    <head>
        <title>Daftarkan Akun Kamu | Selamat Datang Akiharaba Store</title>
        
        <link rel="icon" href="../sistem/public/img/akiba-store-logo_ico.png" type="image/icon-img">
        <link rel="stylesheet" href="../sistem/public/css/style-register.css">
    </head>
    <body>
        <div class="container">
            <div class="register-layout">
                <div class="cover">
                    <h2>REGISTRASI</h2> 
                    <p>
                        Daftarkan akun anda dan bergabunglah dengan akihabara.<br>
                        Udah punya akun ? <a href="login.php" class="redirect-login">Login Disini</a>
                    </p>

                    <?php
                        if (isset($_GET['message'])) {
                            if ($_GET['message'] == 'empty_name') {
                                echo "<div class='error-msg' style='background: #f1c40f;'>
                                <p>Nama harus diisi</p>
                                </div>";
                            }
                            else if ($_GET['message'] == 'empty_username') {
                                echo "
                                <div class='error-msg' style='background: #f1c40f;'>
                                <p>Format email yang anda masukkan salah</p>
                                </div>
                                ";
                            }
                            else if ($_GET['message'] == 'empty_password') {
                                echo "
                                <div class='error-msg' style='background: blue;'>
                                <p>Format email yang anda masukkan salah</p>
                                </div>
                                ";
                            }
                            else if ($_GET['message'] == 'empty_password_retry') {
                                echo "
                                <div class='error-msg' style='background: #c0392b;'>
                                <p>Format email yang anda masukkan salah</p>
                                </div>
                                ";
                            }
                            else if ($_GET['message'] == 'wrong_email') {
                                echo "
                                <div class='error-msg' style='background: blue;'>
                                <p>Format email yang anda masukkan salah</p>
                                </div>
                                ";
                            }
                            else if ($_GET['message'] == 'incorrect_password') {
                                echo "
                                <div class='error-msg' style='background: #c0392b;'>
                                <p>Password anda berbeda dari sebelumnya</p>
                                </div>
                                ";
                            }
                            else if ($_GET['message'] == 'gagal_simpan') {
                                echo "
                                <div class='error-msg' style='background: #c0392b;'>
                                <p>Gagal menyimpan akun anda</p>
                                </div>
                                ";
                            }
                            else if ($_GET['message'] == 'user_not_available') {
                                echo "
                                <div class='error-msg' style='background: #f1c40f;'>
                                <p style='color: black;'>Username sudah ada yang pakai</p>
                                </div>
                                ";
                            }
                        }
                    ?>

                    <form action="../sistem/core/registerProses-user.php" method="POST">
                        <table>
                            <tr>
                                <td><label for="nama"></label> Nama anda</td>
                                <td><input type="text" name="nama" placeholder="Nama anda.." autofocus></td>
                            </tr>
                            <tr>
                                <td>Email anda</td>
                                <td><input type="email" name="email" placeholder="Email anda.."></td>
                            </tr>
                            <tr>
                                <td>Telepon anda</td>
                                <td><input type="text" name="telp" maxlength="12" placeholder="Telepon anda.."></td>
                            </tr>
                            <tr>
                                <td>Username baru</td>
                                <td><input type="text" name="username" placeholder="Username anda.."></td>
                            </tr>
                            <tr>
                                <td>Password anda</td>
                                <td><input type="password" name="password" placeholder="Password anda.."></td>
                            </tr>
                            <tr>
                                <td>Ulangi Password anda</td>
                                <td><input type="password" name="retry-password" placeholder="Ulangi password anda.."></td>
                            </tr>
                            <tr>
                                <td colspan="2"><button class="daftar-btn">Daftar Sekarang !</button></td>
                            </tr>
                        </table>
                    </form>
                    
                    <button class="btn"><a href="../">Kembali</a></button>
                    <button class="btn register-peg" style="float: right;"><a href="login-portal.php" target="_blank">Portal Karyawan</a></button>
                </div>
            </div>
        </div>

    </body>
</html>