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

                <!-- mulai dari sini data akan ditampilkan -->
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
                        <li class="d"><a href="accountDash.php">AKUN <?= $_SESSION['nama-user'] ?></a></li>
                        
                    </ul>
                    <hr>

                    <!-- account dash -->

                    <div class="border-box" style="margin-top: 20px;">
                        <div class="profil-box">

                            <img src="../../../sistem/upload-data/profile-pic/<?php if ($dt['profil_pic'] == "not-set") { echo "default-profile.png"; } else { echo $dt['profil_pic']; } ?>" alt="profile_pic" height="180" width="200">
                            <h3><?php echo $dt['nama']; ?></h3>
                        </div>

                        <div class="info-box">

                            <table>
                                <?php?>
                                <tr>
                                    <td><h5>INFO AKUN</h5></td>
                                </tr>
                                <tr>
                                    <td><p>Nama</p></td>
                                    <td><p><?= $dt['nama'] ?></p></td>
                                </tr>
                                <!-- info kontak -->
                                <tr>
                                    <td colspan="2"><h5>INFO KONTAK</h5></td>
                                </tr>
                                <tr>
                                    <td><p>Email</p></td>
                                    <td><p><?= $dt['email'] ?></p></td>
                                </tr>
                                <tr>
                                    <td><p>Telepon</p></td>
                                    <td><p><?= $dt['telp'] ?></p></td>
                                </tr>
                                <!-- info akun -->
                                <tr>
                                    <td colspan="2"><h5>INFO AKUN</h5></td>
                                </tr>
                                <tr>
                                    <td><p>ID User</p></td>
                                    <td><p><?= $dt['id_user'] ?></p></td>
                                </tr>
                                <tr>
                                    <td><p>Username</p></td>
                                    <td><p><?= $dt['username'] ?></p></td>
                                </tr>
                                <tr>
                                    <td><p>Waktu bergabung</p></td>
                                    <td><p><?= $dt['tgl_daftar'] ?></p></td>
                                </tr>
                            </table>
                            
                            <hr><br>
                            
                            <!-- button aksi -->
                            <a href="accountEdit.php?id_user=<?= $dt['id_user'] ?>" onclick="return confirm('Ingin mengedit data anda  ?')" class="edit-btn" style="background: #1976D2;">Ubah data pribadi</a>
                        </div>
                                <?php
                            }
                        ?>
                        
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