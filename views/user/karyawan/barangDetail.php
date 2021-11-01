<?php

    session_start();

    include "../../../sistem/core/conn.php";

    if (!isset($_SESSION['username']))
    {
        header("location: ../../login-portal.php?message=please_login");
    }

    if ($_SESSION['level'] != "karyawan")
    {
        echo "<script>alert('Anda bukan karyawan, kembali ke halaman anda');</script>";
        
        if ($_SESSION['level'] == 'admin') {
            header("location: ../admin");
        }
        else if (!isset($_SESSION['level'])) {
            header("location: ../../login-portal.php?message=please_login");
        } else {
            header("location: ../../login.php?message=please_login");
        }

    }
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Portal Dashboard | Portal Akiharaba</title>
        
        <link rel="icon" href="../../../sistem/public/img/akiba-store-logo_ico.png" type="image/icon-img">
        <link rel="stylesheet" href="../../../sistem/public/css/style-dash-portal.css">
    </head>
    <body>
                <!-- Navigation -->

        <div class="nav">
            <div class="nav-content">
                <a href="../../../" target="_blank" class="title" title="Akiharaba Store">
                    <img src="../../../sistem/public/img/akiba-store-logo_title.png" alt="akiba-store-logo_title">
                    <h3>Akiharaba Store</h3>
                </a>
            </div>

            <div class="nav-content">
                <hr>
            </div>

            <div class="nav-content introduce">
                <p>Selamat datang <b><?php echo $_SESSION['nama']; ?></b></p>
            </div>
        </div>
        
        <!-- end Navigation -->

        <!-- Menu -->
        <div class="side-menu">
            <a href="index.php">Home</a>
            <a href="barangData.php" class="active">Kelola Produk</a>
            <a href="transaksiData.php">Transaksi</a>
            <a href="account_detail.php">Akun Pribadi</a>
            <a href="../../../sistem/core/logout-peg.php" onclick="return confirm('Yakin ingin logout ?');" class="logout-btn">logout</a>
        </div>

        <!--  -->

        <div class="cover">
            <h2>Perbarui Info Produk</h2>

            <div class="border-box">
            <?php
                $category_list = mysqli_query($connect, "SELECT * FROM kategori");
            ?>

            <?php
                $getID = $_GET['id_produk'];
                $sql = mysqli_query($connect, "SELECT * FROM produk WHERE id_produk ='$getID' ");

                while ($dt = mysqli_fetch_array($sql))
                {

                ?>
            <form action="../../../sistem/core/editProduct.php?id_produk=<?= $dt['id_produk'] ?> " method="POST" enctype="multipart/form-data">

                <div class="profil-box">
                <img src="../../../sistem/upload/<?php if ($dt['product_pic'] == "not-set") { echo "default-product.png"; } else { echo $dt['product_pic']; } ?>" alt="product_pic" height="180" width="200">
                    <p>(format gambar JPG/PNG - maksimal 2mb)</p>
                    <input type="file" name="product_pic">
                </div>

                <div class="info-box">
                    <table style="line-height: 0.3;">
                        <?php?>
                        <tr>
                            <td colspan="2"><h5>PRODUK</h5></td>
                        </tr>
                        <tr>
                            <td><p>Nama</p></td>
                            <td><p><input type="text" name="produk" value="<?= $dt['produk'] ?>" placeholder="<?= $dt['produk'] ?>" required></p></td>
                        </tr>
                        <tr>
                            <td><p>Kategori</p></td>
                            <td>
                                <p>
                                    <select name="kategori" class="select-minat">
                                        <optgroup label="category">
                                        <!-- dapatkan data kategori dari tabel -->
                                            <?php
                                                while($catList = mysqli_fetch_array($category_list))
                                                {
                                                    ?>
                                                        <option value="<?= $catList['id_kategori'] ?>"><?= $catList['kategori'] ?> - [<?= $catList['id_kategori'] ?>]</option>
                                                    <?php
                                                }
                                            ?>
                                        </optgroup>
                                    </select>
                                    &nbsp; * kategori sekarang <b><?= $dt['id_kategori'] ?></b>
                                </p>
                            </td>
                        </tr>
                        <tr>
                            <td><p>Stok</p></td>
                            <td><p><input type="number" name="stok" value="<?= $dt['stok'] ?>" placeholder="<?= $dt['stok'] ?>" min="0" max="99" required></p></td>
                        </tr>
                        <!-- info kontak -->
                        <tr>
                            <td><p>Harga</p></td>
                            <td><p><input type="text" name="harga" value="<?= $dt['harga'] ?>" placeholder="<?= $dt['harga'] ?>" required></p></td>
                        </tr>
                        <tr>
                            <td><p>Status</p></td>
                            <td>
                                <p>
                                    <select name="status" class="select-minat">
                                        <optgroup label="Status barang">
                                            <option value="ready_stock">Ready stock</option>
                                            <option value="back_order">Back order</option>
                                            <option value="pre_order">Pre Order</option>
                                        </optgroup>
                                    </select>
                                     &nbsp;* status sekarang <b><?= $dt['status'] ?></b>
                                </p>
                            </td>
                        </tr>
                        <tr>
                            <td><p>Keterangan</p></td>
                            <td>
                                <p>
                                    <textarea name="ket" name="ket" cols="30" rows="10"><?= $dt['ket'] ?></textarea>
                                </p>
                            </td>
                        </tr>
                    </table>
            
                <hr><br>
                    <button type="submit" class="edit-btn">Perbarui Info Produk</button>
                    <a href="../../../sistem/core/delete_produk.php?id_produk=<?= $dt['id_produk'] ?>" onclick="return confirm('Hapus produk <?= $dt['id_produk'] ?> ?')" class="edit-btn" style="background: #E53935;">Hapus produk ini</a>
                    <a href="barangData.php" class="edit-btn" style="background: #1E88E5;">Kembali ke produk</a>
            </div>
                    <?php
                }
            ?>
            </form>
            </div>
        </div>
            
        </div>

    </body>
</html>