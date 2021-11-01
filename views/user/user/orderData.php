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

                    <form action="addressData.php" method="GET">
                        <div class="search">
                            <h3>Transaksi anda</h5>
                        </div>
                    </form>
                    <table>
                        <tr>
                            <th>ID Transaksi</th>
                            <th>Produk</th>
                            <th>Jumlah</th>
                            <th>Total</th>
                            <th>Alamat</th>
                            <th>Pembayaran</th>
                            <th>Kurir</th>
                            <th>Tanggal Transaksi</th>

                        </tr>
                        <?php
                            $sql = mysqli_query($connect, "SELECT * FROM transaksi WHERE id_user = '".$_SESSION['id_user']."' ");

                            if (mysqli_num_rows($sql) > 0) {
                                while ($data = mysqli_fetch_assoc($sql))
                                {
                                    $query = mysqli_query($connect, "SELECT * FROM produk WHERE id_produk = '".$data['id_produk']."' ");
                                    while ($dt = mysqli_fetch_assoc($query)) 
                                    {
                                        ?>
                                        
                                            <tr>
                                                <td align="center"><?= $data['id_transaksi'] ?></td>
                                                <td align="center"><?= $dt['produk'] ?></td>
                                                <td align="center"><?= $data['jumlah'] ?></td>
                                                <td align="center"><?= $data['total'] ?></td>
                                                <td align="center"><?= $data['alamat'] ?></td>
                                                <td align="center"><?= $data['bayar'] ?></td>
                                                <td align="center"><?= $data['kurir'] ?></td>
                                                <td align="center"><?= $data['tgl_transaksi'] ?></td>

                                            </tr>
                                        <?php
                                    }
                                }
                            } else {
                                echo "<tr>
                                        <td  colspan='8' style='text-align: center;'>Anda belum melakukan transaksi apapun</td>
                                    </tr>";
                            }

                        ?>
                    </table>
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