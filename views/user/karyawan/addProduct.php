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
            <h2>Tambah data barang</h2>

            <div class="border-box">
            <?php
                $category_list = mysqli_query($connect, "SELECT * FROM kategori");
            ?>
            <form action="../../../sistem/core/addProduct.php" method="POST" enctype="multipart/form-data">

                <div class="profil-box">
                <img src="../../../sistem/upload/default-product.png" alt="product_pic" height="180" width="200">
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
                            <td><p><input type="text" name="produk" placeholder="Nama produk.." maxlength="100" required></p></td>
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
                                </p>
                            </td>
                        </tr>
                        <tr>
                            <td><p>Stok</p></td>
                            <td><p><input type="number" name="stok" placeholder="0" min="1" max="99" required></p></td>
                        </tr>
                        <!-- info kontak -->
                        <tr>
                            <td><p>Harga</p></td>
                            <td><p><input type="text" name="harga" placeholder="Harga produk.." required></p></td>
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
                                </p>
                            </td>
                        </tr>
                        <tr>
                            <td><p>Keterangan</p></td>
                            <td>
                                <p>
                                    <textarea name="ket" name="ket" placeholder="Keterangan Produk.." cols="30" rows="10"></textarea>
                                </p>
                            </td>
                        </tr>
                    </table>
            
                <hr><br>
                    <button type="submit" class="edit-btn">Tambahkan produk</button>
                    <a href="barangData.php" class="edit-btn" style="background: #C62828;">Batalkan</a>
            </div>

            </form>
            </div>
        </div>
            
        </div>

    </body>
</html>