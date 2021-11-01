<?php

    session_start();

    include "../../../sistem/core/conn.php";

    if (!isset($_SESSION['username-user']))
    {
        header("location: ../../login.php?message=please_login");
    }

?>

<html lang="en">
    <head>
        <title>Akiharaba Store - Anime Figure & Merchandise</title>
        <meta charset="utf-8">

        <link rel="icon" href="../../../sistem/public/img/akiba-store-logo_ico.png" type="image/icon-img">
        <link rel="stylesheet" type="text/css" href="../../../sistem/public/css/style.css">

    </head>
    <body>
        <!-- Navigation -->

        <div class="nav">
            <div class="nav-content">
                <a href="../../../" class="title" title="Akiharaba Store">
                    <img src="../../../sistem/public/img/akiba-store-logo_title.png" alt="akiba-store-logo_title">
                    <h3>Akiharaba Store</h3>
                </a>
            </div>

            <div class="nav-content">
                <form action="../../../" method="GET">
                    <input type="text" name="search-hobbies" class="search-field" placeholder="Khilaf apa anda hari ini ?">
                </form>
            </div>

            <div class="nav-content">
                <ul>
                    <li><a href="#cart" onclick="alert('Masih dikembangkan')">Keranjang</a></li>
                    <li><a href="orderData.php">Transaksi</a></li>
                    <li><a href="wishlistDash.php">Wishlist</a></li>
                    <li>
                        <a href="../../../sistem/core/logout-user.php" onclick="return confirm('Ingin logout ?')" class="login-btn">Logout</a>
                    </li>
                </ul>   
            </div>
        </div>
        
        <!-- end Navigation -->

        <!-- Content start -->
        <div class="layout">

            <!-- etalase -->
            <div class="cover">
                <h2 class="list-title">SELAMAT DATANG <?= $_SESSION['nama-user'] ?></h2>
                <?php
                        $getID = $_SESSION['id_user'];
                        $sql = mysqli_query($connect, "SELECT * FROM user WHERE id_user ='$getID' ");
                        $profileCheck;
                        while ($dt = mysqli_fetch_array($sql))
                        {

                        ?>
                <div class="menu-pgw">
                    <ul>
                        <li class="a"><a href="orderData.php">Semua Pesanan</a></li>
                        <li class="b"><a href="wishlistDash.php">&hearts; Wishlist</a></li>
                        <li class="c"><a href="addressData.php">Daftar Alamat</a></li>
                        <li class="d"><a href="accountDash.php">AKUN <?= $dt['nama'] ?></a></li>
                        
                    </ul>
                    <hr>

                    <!-- account dash -->
                <form action="../../../sistem/core/edit_userProses.php?id_user=<?= $dt['id_user'] ?>" method="POST" enctype="multipart/form-data">

                    <div class="border-box" style="margin-top: 20px;">
                        <div class="profil-box">

                            <img src="../../../sistem/upload-data/profile-pic/<?php if ($dt['profil_pic'] == "not-set") { echo "default-profile.png"; } else { echo $dt['profil_pic']; } ?>" alt="profile_pic" height="180" width="200">
                            <h3><?php echo $dt['nama']; ?></h3>
                            <input type="file" name="profil_pic">
                            <p class="box-profile"><input type="checkbox" name="del_profil" <?php if ($dt['profil_pic'] == "not-set") { echo "disabled"; } else { echo $dt['profil_pic']; }  ?>> Hapus foto profil saat ini</p>
                        </div>

                        <div class="info-box">

                            <table>
                                <?php?>
                                <tr>
                                    <td><h5>INFO AKUN</h5></td>
                                </tr>
                                <tr>
                                    <td><p>Nama</p></td>
                                    <td><p><input type="text" name="nama" value="<?= $dt['nama'] ?>" placeholder="<?= $dt['nama'] ?>" required></p></td>
                                </tr>
                                <!-- info kontak -->
                                <tr>
                                    <td colspan="2"><h5>INFO KONTAK</h5></td>
                                </tr>
                                <tr>
                                    <td><p>Email</p></td>
                                    <td><p><input type="email" name="email" value="<?= $dt['email'] ?>" placeholder="<?= $dt['email'] ?>" required></p></td>
                                </tr>
                                <tr>
                                    <td><p>Telepon</p></td>
                                    <td><p><input type="tel" name="telp" value="<?= $dt['telp'] ?>" placeholder="<?= $dt['telp'] ?>" maxlength="12" required></p></td>
                                </tr>
                            </table>
                            
                            <hr><br>
                            
                            <!-- button aksi -->
                            <button type="submit" class="edit-btn">Simpan perubahan</button>
                            <a href="accountDash.php" class="edit-btn" style="background: #C62828;">Batalkan</a>
                        </div>
                                <?php
                            }
                        ?>
                 </form>       
                    </div>
                </div>

                    <!-- end profile -->
                </div>
            </div>

        </div>
        <!-- footer  -->
        <div class="footer">
            <h5>Akiharaba Store</h5>
            <p class="identity">
                Make with &hearts; by <span>Ahmad Ridlo Suhardi</span> | 1931710137 <br>MI 1C
            </p>

            <div class="footer-content">
            
                <div class="contact">
                    <label>Kenalan dengan kami</label>
                    <ul>
                        <li><a href="#">Facebook</a></li>
                        <li><a href="#">Instagram</a></li>
                        <li><a href="#">Email</a></li>
                        <li><a href="#">Telp</a></li>
                    </ul>
                </div>

                <div class="features">
                    <label>Fitur</label>
                    <ul>
                        <li><a  href="#">Request Item</a></li>
                        <li><a href="#">Feedback</a></li>
                    </ul>
                </div>

            </div>
        </div>
    </body>
</html>