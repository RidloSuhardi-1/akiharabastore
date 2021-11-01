<?php

    session_start();

    include "sistem/core/conn.php";

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Akiharaba Store - Anime Figure & Merchandise</title>
        <meta charset="utf-8">

        <link rel="icon" href="sistem/public/img/akiba-store-logo_ico.png" type="image/icon-img">
        <link rel="stylesheet" type="text/css" href="sistem/public/css/style.css">

    </head>
    <body>
        <?php
            if(isset($_GET['message'])) {
                if ($_GET['message'] == 'register_success') {
                    echo '<script>alert("Login Berhasil");</script>';
                    echo '<script>window.location.href = "index.php"</script> ';
                }
                else if ($_GET['message'] == 'product_not_found') {
                    echo '<script>alert("Produk ini sudah tidak lagi tersedia");</script>';
                    echo '<script>window.location.href = "index.php"</script> ';
                }
            }
        ?>

        <!-- Navigation -->

        <div class="nav">
            <div class="nav-content">
                <a href="./" class="title" title="Akiharaba Store">
                    <img src="sistem/public/img/akiba-store-logo_title.png" alt="akiba-store-logo_title">
                    <h3>Akiharaba Store</h3>
                </a>
            </div>

            <div class="nav-content">
                <form action="" method="GET">
                    <input type="text" name="search-hobbies" class="search-field" placeholder="Khilaf apa anda hari ini ?">
                </form>
            </div>

            <div class="nav-content">
                <ul>
                    <li><a href="#cart" onclick="alert('Masih dikembangkan')">Keranjang</a></li>
                    <li><a href="views/user/user/orderData.php">Transaksi</a></li>
                    <li><a href="views/user/user/wishlistDash.php">Wishlist</a></li>
                    <li>
                        <a href="views/user/user/accountDash.php" class="login-btn">My Account</a>
                    </li>
                </ul>   
            </div>
        </div>
        
        <!-- end Navigation -->

        <div class="bg"></div>
        
        <!-- Content start -->
        <div class="layout">

            <div class="cover">
                <div class="menu-request">
                    <form action="#request" method="GET">
                            <h2>REQUEST BARANG</h2>
                            <p>Masukkan request barang yang diinginkan</p>
                            <input type="text" name="request-form" placeholder="Cth. Action Figures Konosuba" style="margin-left: 0;">
                    </form>
                </div>
            </div>

            <!-- etalase -->
            <div class="cover">
                <h2 class="list-title">DAFTAR ITEM</h2>
                <div class="etalase-list">
                <?php

                if (isset($_GET['search-hobbies'])) {
                    $cari = $_GET['search-hobbies'];
                    $sql = mysqli_query($connect, "SELECT * FROM produk WHERE produk LIKE '%".$cari."%' ");
                } else {
                    $sql = mysqli_query($connect, "SELECT * FROM produk WHERE NOT stok = '0' ");
                }

                if (mysqli_num_rows($sql) > 0) {
                    while ($data = mysqli_fetch_assoc($sql)) {
                        ?>
    
                    <div class="gallery">
                        <a href="views/page/productDetail.php?id_produk=<?= $data['id_produk'] ?>">
                            <img src="sistem/upload/<?php if ($data['product_pic'] == "not-set") { echo "default-product.png"; } else { echo $data['product_pic']; } ?>" alt="<?= $data['produk'] ?>">
    
                            <div class="desc">
                                <?= $data['produk'] ?>
                                <p class="price-title">Rp. <?= $data['harga'] ?></p>
                            </div>
                        </a>
                    </div>
                        <?php
                    }
                } else {
                    echo "<div style='background: #F5F5F5; width: 100%; text-align: center; padding: 5px; color: #B0BEC5;border-radius: 5px; font-size: 13px;'>- Nantikan produk menarik dari kami ya ! -</div>";
                }
            ?>

                </div>
            </div>
            <!--  -->


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