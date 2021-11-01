<?php
    session_start();
    include "../../sistem/core/conn.php";
    

?>

<html lang="en">
    <head>
        <title>Akiharaba Store - Anime Figure & Merchandise</title>
        <meta charset="utf-8">

        <link rel="icon" href="../../sistem/public/img/akiba-store-logo_ico.png" type="image/icon-img">
        <link rel="stylesheet" type="text/css" href="../../sistem/public/css/style-product-dash.css">

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
                    <li><a href="../user/user/orderData.php">Transaksi</a></li>
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
            $sql = mysqli_query($connect, "SELECT * FROM produk WHERE id_produk ='".$_GET['id_produk']."' ");


            while ($dt = mysqli_fetch_array($sql))
            {
                if ($dt['stok'] != 0) {
                    
            ?>

            <div class="cover">
                <div class="border">
                    <div class="image-container">
                        <img src="../../sistem/upload/<?php if ($dt['product_pic'] == 'not-set') { echo 'default-product.png'; } else { echo $dt['product_pic']; } ?>" alt="<?= $dt['produk'] ?>">
                    </div>

                    <div class="info">
                        <div class="status-title" style="background: <?php if ($dt['status'] == 'ready_stock') { echo '#26A69A'; } else if ($dt['status'] == 'back_order') { echo '#AB47BC'; } else if ($dt['status'] == 'pre_order') { echo '#78909C'; } ?>;">
                            <?php if ($dt['status'] == 'ready_stock') { echo 'Ready Stock'; } else if ($dt['status'] == 'back_order') { echo 'Back Order'; } else if ($dt['status'] == 'pre_order') { echo 'Pre Order'; } ?>
                        </div>

                        <!-- kirim data -->
                        <form action="transaksiProduk.php" method="POST">
                            <!-- nama produk -->
                            <h3><?= $dt['produk'] ?></h3>
                            <hr>
                            <input type="text" name="produkID" value="<?= $dt['id_produk'] ?>" hidden>

                            <!-- harga produk -->
                            <p class="price">IDR <?= $dt['harga'] ?></p>
                            <input type="text" name="harga" value="<?= $dt['harga'] ?>" hidden>

                            <p style="<?php if ($dt['stok'] <= 20) { echo 'color: #4CAF50;'; } else if ($dt['stok'] < 5) { echo "color: #F44336;"; } else { echo "color: #F44336;"; } ?>" class="stok-info"><?php if ($dt['stok'] <= 20) { echo 'Tersisa '.$dt['stok'].' produk lagi'; } else if ($dt['stok'] < 5) { echo "Tersisa ".$dt['stok']." produk lagi"; } else { echo "Tersisa : ".$dt['stok']." Produk"; } ?></p>
                            Qty: &nbsp; <input type="number" name="qty" placeholder="0" min="1" max="<?= $dt['stok'] ?>" style="width: 100px;" required><br>
                            
                            <p style="font-size: 13px;">Pilih alamat anda</p>

                            
                            <?php
                            // mencari alamat sesuai user
                                if (isset($_SESSION['id_user'])) {
                                    $addressList = mysqli_query($connect, "SELECT * FROM address WHERE id_user = '".$_SESSION['id_user']."' ");
                                    $hitung = mysqli_num_rows($addressList);

                                    if ($hitung > 0) {
                                        ?><select name="alamat" class="select-minat"><?php
                                        while ($listAddress = mysqli_fetch_array($addressList))
                                        {
                                            ?>
                                            
                                                <option value="<?= $listAddress['alamat'] ?>"><?= $listAddress['alamat'] ?></option>
                                            
                                            <?php
                                        }
                                        ?></select><?php
                                    } else {
                                        echo "<input type='text' name='alamat' placeholder='Anda belum menyimpan alamat, isi alamat anda..' required>";
                                    }
                                    
                                } else {
                                    ?>
                                        <select name="alamat" class="select-minat" disabled>
                                            <option>- Alamat tidak tersedia, login dulu -</option>
                                        </select>
                                    <?php
                                }
                            ?>
                            

                            <!-- tombol beli -->
                            <div class="btn-buy">
                                <button type="submit" class="wish"><a href="../../sistem/core/wishlistProses.php?id_produk=<?= $dt['id_produk'] ?>">&hearts; Wishlist</a></button>
                                <button type="submit" class="buy" style="color: white;">Beli</button>
                            </div>
                        </form>

                        <hr>
                        <div class="product-detail">
                            <?= $dt['ket'] ?>
                        </div>
                    </div>

                </div>
            </div>
            <?php
                } else {
                    header("location: ../../?message=product_not_found");
                }
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