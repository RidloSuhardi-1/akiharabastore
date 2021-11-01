<?php

    session_start();

    include "../../sistem/core/conn.php";

    if (!isset($_SESSION['username-user']))
    {
        header("location: ../login.php?message=please_login");
    }

?>

<html lang="en">
    <head>
        <title>Akiharaba Store - Anime Figure & Merchandise</title>
        <meta charset="utf-8">

        <link rel="icon" href="../../sistem/public/img/akiba-store-logo_ico.png" type="image/icon-img">
        <link rel="stylesheet" type="text/css" href="../../sistem/public/css/style-transaksi-dash.css">

    </head>
    <body>
        <!-- Navigation -->

        <div class="nav">
            <div class="nav-content">
                <a href="../../" class="title" title="Akiharaba Store">
                    <img src="../../sistem/public/img/akiba-store-logo_title.png" alt="akiba-store-logo_title">
                    <h3>Akiharaba Store</h3>
                </a>
            </div>

            <div class="nav-content">
                <form action="../../" method="GET">
                    <input type="text" name="search-hobbies" class="search-field" placeholder="Khilaf apa anda hari ini ?">
                </form>
            </div>

            <div class="nav-content">
                <ul>
                    <li><a href="#cart" onclick="alert('Masih dikembangkan')">Keranjang</a></li>
                    <li><a href="#transaction">Transaksi</a></li>
                    <li><a href="../user/user/wishlistDash.php">Wishlist</a></li>
                    <li>
                    <a href="../user/user/accountDash.php" class="login-btn">My Account</a>
                    </li>
                </ul>   
            </div>
        </div>
        
        <!-- end Navigation -->

        <!-- Content start -->
        <div class="layout">

            <!-- etalase -->
        <?php
            $ID = $_POST['produkID'];
            $qty = $_POST['qty'];
            $sql = mysqli_query($connect, "SELECT * FROM produk WHERE id_produk = '$ID' ");

            while ($dt = mysqli_fetch_array($sql))
            {

            ?>     
            <div class="cover">
                <h4>Checkout Produk <br><hr> <p>PRODUCT ID <span style="color: #FF7043;">'<?= $dt['id_produk'] ?>'</span></p></h4>
                <div class="border">
                    
                    <div class="image-container">
                        <img src="../../sistem/upload/<?php if ($dt['product_pic'] == 'not-set') { echo 'default-product.png'; } else { echo $dt['product_pic']; } ?>" alt="<?= $dt['produk'] ?>">
                    </div>

                <form action="../../sistem/core/addTransaksi.php" method="POST">
                        <table>
                            <tr>
                                <th>Nama Produk</th>
                                <th>Harga</th>
                                <th>Qty</th>
                                <th>Total Harga</th>
                            </tr>
                            <tr>
                                <td><?= $dt['produk'] ?></td>
                                <input type="text" name="id_user" value="<?= $_SESSION['id_user'] ?>" hidden>
                                <input type="text" name="id_produk" value="<?= $dt['id_produk'] ?>" hidden>

                                <td align="center">IDR <?= $dt['harga'] ?></td>
                                <input type="text" name="harga" value="<?= $dt['harga'] ?>" hidden>

                                <td align="center"><?= $qty ?></td>
                                <input type="text" name="qty" value="<?= $qty ?>" hidden>

                                <td align="center">IDR <?php echo $dt['harga']*$qty ?></td>
                                <input type="text" name="total" value="<?= $dt['harga']*$qty ?>" hidden>
                            </tr>
                        </table>
                </div>

                    <div class="info-border">
                        <table>
                            <tr>
                                <th align="center">Alamat</th>
                                <th align="center">Pembayaran</th>
                                <th align="center">Kurir</th>
                            </tr>
                            <tr>
                                <td align="center">
                                    <?= $_POST['alamat'] ?>
                                    <input type="text" name="alamat" value="<?= $_POST['alamat'] ?>" hidden>
                                </td>
                                <td align="center">
                                    <select name="bayar" class="select-minat">
                                        <optgroup label="Pilih jenis pembayaran">
                                            <option value="TRANSFER">Transfer Bank</option>
                                            <option value="COD">Cash On Delivery</option>
                                            <option value="PULSA">Pulsa</option>
                                        </optgroup>
                                    </select>
                                </td>
                                <td align="center">
                                    <select name="kurir" class="select-minat">
                                        <optgroup label="Pilih kurir">
                                            <option value="JNE">JNE</option>
                                            <option value="SICEPAT">Si Cepat</option>
                                            <option value="JNT">JNT Express</option>
                                        </optgroup>
                                    </select>
                                </td>
                            </tr>
                        </table>
                        
                    </div>

                    <div class="button">
                        <button class="btn-b" type="submit">Check Out ></button>
                        </form>

                        <button class="btn-a"><a href="productDetail.php?id_produk=<?= $dt['id_produk'] ?> ">Kembali ke produk</a></button>
                    </div>
                

            </div>
            <?php
            }
        ?>
            
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