<html>
    <head>
        <title>Portal Registrasi | Portal Akihabara</title>
        
        <link rel="icon" href="../sistem/public/img/akiba-store-logo_ico.png" type="image/icon-img">
        <link rel="stylesheet" href="../sistem/public/css/style-register-portal.css">
    </head>
    <body>
        <div class="container">
            <div class="register-layout">
                <div class="cover">
                    <h2>REGISTRASI PORTAL</h2> 
                    <p>
                        Daftarkan akun anda dan bergabunglah dengan akihabara.<br>
                        Udah punya akun ? <a href="login-portal.php" class="redirect-login">Login Disini</a>
                    </p>

                    <?php
                        if (isset($_GET['message'])) {
                            if ($_GET['message'] == 'empty_name') {
                                echo "<div class='error-msg' style='background: #f1c40f;'>
                                <p>Nama harus diisi</p>
                                </div>";
                            }
                            else if ($_GET['message'] == 'empty_address') {
                                echo "<div class='error-msg' style='background: #f1c40f;'>
                                <p>Alamat harus diisi</p>
                                </div>";
                            }
                            else if ($_GET['message'] == 'empty_number') {
                                echo "<div class='error-msg' style='background: #f1c40f;'>
                                <p>Nomor harus diisi</p>
                                </div>";
                            }
                            else if ($_GET['message'] == 'empty_username') {
                                echo "
                                <div class='error-msg' style='background: #f1c40f;'>
                                <p>Username anda harus diisi</p>
                                </div>
                                ";
                            }
                            else if ($_GET['message'] == 'empty_password') {
                                echo "
                                <div class='error-msg' style='background: blue;'>
                                <p>Password anda harus diisi</p>
                                </div>
                                ";
                            }
                            else if ($_GET['message'] == 'empty_password_retry') {
                                echo "
                                <div class='error-msg' style='background: #c0392b;'>
                                <p>Mohon isi password anda kembali</p>
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
                            else if ($_GET['message'] == 'wrong_minat') {
                                echo "
                                <div class='error-msg' style='background: #D32F2F; color: white;'>
                                <p>Anda memilih minat yang salah</p>
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
                            else if ($_GET['message'] == 'identity_notset') {
                                echo "
                                <div class='error-msg' style='background: #C62828;'>
                                <p>Mohon lengkapi data ktp anda untuk verifikasi</p>
                                </div>
                                ";
                            }
                            else if ($_GET['message'] == 'image_tolarge') {
                                echo "
                                <div class='error-msg' style='background: #C62828;'>
                                <p>Pastikan gambar tidak melebih 2MB</p>
                                </div>
                                ";
                            }
                            else if ($_GET['message'] == 'image_invalid') {
                                echo "
                                <div class='error-msg' style='background: #C62828;'>
                                <p>Format gambar hanya diperbolehkan <b>jpg</b>/<b>png</b></p>
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

                    <form action="../sistem/core/registerProses-peg.php" method="POST" enctype="multipart/form-data">
                        <table>
                            <tr>
                                <td><label for="nama"></label>Nama anda</td>
                                <td><input type="text" name="nama" placeholder="Nama anda.." autofocus></td>
                            </tr>
                            <tr>
                                <td><label for="alamat"></label>Alamat anda</td>
                                <td><input type="text" name="alamat" placeholder="Alamat anda.." autofocus></td>
                            </tr>
                            <tr>
                                <td><label for="gender"></label>Gender anda</td>
                                <td>
                                    <div class="gender-cont">
                                        <div class="gender-box">
                                            <input type="radio" name="gender" value="pria" required>
                                            Pria
                                        </div>
                                        <div class="gender-box">
                                            <input type="radio" name="gender" value="wanita" required>
                                            Wanita
                                        </div>
                                    </div>
                                </td>
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
                                <td>Upload KTP</td>
                                <td><input type="file" name="ktp_data"></td>
                            </tr>
                            <tr>
                                <td colspan="2" style="text-align: center; font-size: 12px; cursor: default;">
                                    <b style="color: red;">Perhatian</b><br>
                                    pastikan anda mengirimkan berkas lain yang dibutuhkan ke alamat/email perusahaan<br>
                                    <a href="term.html" target="_blank">Syarat dan Ketentuan</a>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2"><hr></td>
                            </tr>
                            <tr>
                                <td><label for="minat"></label>Minat Anda</td>
                                <td>
                                    <select name="minat" class="select-minat">
                                        <option value="null" selected> -- Pilih minat anda -- </option>
                                        <optgroup label="minat">
                                            <option value="admin">Admin</option>
                                            <option value="karyawan">Karyawan</option>
                                        </optgroup>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2"><button class="daftar-btn">Daftar Sekarang !</button></td>
                            </tr>
                        </table>
                    </form>
                    
                    <button class="btn"><a href="login-portal.php">Kembali ke login</a></button>
                    <button class="btn register-peg" style="float: right;"><a href="term.html" target="_blank">Syarat dan Ketentuan ></a></button>
                </div>
            </div>
        </div>

    </body>
</html>