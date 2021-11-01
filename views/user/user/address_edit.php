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
        <link rel="stylesheet" type="text/css" href="../../../sistem/public/css/style2.css">

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

                <div class="menu-pgw">
                    <ul>
                        <li class="a"><a href="orderData.php">Semua Pesanan</a></li>
                        <li class="b"><a href="wishlistDash.php">&hearts; Wishlist</a></li>
                        <li class="c"><a href="addressData.php">Daftar Alamat</a></li>
                        <li class="d"><a href="accountDash.php">AKUN <?= $_SESSION['nama-user'] ?></a></li>
                    </ul>
                    <hr>

                    <h5>Perbarui Alamat</h5>
                        <table>
                        <?php
                        $sql = mysqli_query($connect, "SELECT * FROM address WHERE id_alamat ='".$_GET['id_alamat']."' ");
                        
                        while ($dt = mysqli_fetch_array($sql))
                        {

                                ?>

                    <form action="../../../sistem/core/editAddress.php?id_alamat=<?= $dt['id_alamat'] ?> " method="POST">
                            <tr>
                                <td><p>Alamat</p></td>
                                <td><p><input type="text" name="alamat" value="<?= $dt['alamat'] ?>" placeholder="<?= $dt['alamat'] ?>" required></p></td>
                            </tr>
                        </table>
                    
                </div><hr><br>
                        <button class="save-btn">Perbarui alamat</button>
                    </form>
                    <button class="save-btn" style="background: #E53935;"><a href="../../../sistem/core/deleteAddress.php?id_alamat=<?= $dt['id_alamat'] ?>" onclick="return confirm('Ingin menghapus alamat ini ?')">Hapus alamat ini</a></button>
                    <button class="save-btn" style="background: #00897B;"><a href="addressData.php">Kembali</a></button>
                                 <?php
                            }
                    ?>
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