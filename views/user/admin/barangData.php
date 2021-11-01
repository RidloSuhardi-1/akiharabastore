<?php

    session_start();

    include "../../../sistem/core/conn.php";

    if (!isset($_SESSION['username']))
    {
        header("location: ../../login-portal.php?message=please_login");
    }

    if ($_SESSION['level'] != "admin")
    {
        echo "<script>alert('Anda bukan admin, kembali ke halaman anda');</script>";
        
        if ($_SESSION['level'] == 'karyawan') {
            header("location: ../karyawan");
        }
        else if (!isset($_SESSION['level'])) {
            header("location: ../../login-portal.php?message=please_login");
        }

    }
?>


<!DOCTYPE html>
<html>
    <head>
        <title>Portal Dashboard | Portal Akiharaba</title>
        
        <link rel="icon" href="../../../sistem/public/img/akiba-store-logo_ico.png" type="image/icon-img">
        <link rel="stylesheet" href="../../../sistem/public/css/style-table-portal.css">
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
            <a href="barangData.php" class="active">Data Barang</a>
            <a href="pegawaiData.php">Data Pegawai</a>
            <a href="account_detail.php">Akun Pribadi</a>
            <a href="../../../sistem/core/logout-peg.php" onclick="return confirm('Yakin ingin logout ?');" class="logout-btn">logout</a>
        </div>

        <div class="cover">
            <h2>Data Barang - Semua</h2>
            <hr>
            <div class="menu-pgw">
                <ul>
                    <li class="a"><a href="barangData.php">Semua Produk</a></li>
                </ul>
            </div>
        <form action="barangData.php" method="GET">
            <div class="search">
                <h5>Cari pegawai &nbsp;<input type="text" name="cari_barang" placeholder="cari id, nama produk"></h5>
            </div>
        </form>
            <table>
                <tr>
                    <th>ID Produk</th>
                    <th>Produk</th>
                    <th>Kategori</th>
                    <th>Stok</th>
                    <th>Harga</th>
                    <th>Status</th>
                </tr>
                <?php
                    if (isset($_GET['cari_barang'])) {
                        $cari = $_GET['cari_barang'];
                        $sql = mysqli_query($connect, "SELECT * FROM produk WHERE id_produk LIKE '%".$cari."%' OR produk LIKE '%".$cari."%'  ");
                    } else {
                        $sql = mysqli_query($connect, "SELECT * FROM produk");
                    }

                    if (mysqli_num_rows($sql) > 0) {
                        while ($data = mysqli_fetch_assoc($sql))
                        {
                            ?>
                                <tr>
                                    <td style="text-align: center;"><?= $data['id_produk'] ?></td>
                                    <td><?= $data['produk'] ?></td>
                                    <td><?= $data['id_kategori'] ?></td>
                                    <td><?= $data['stok'] ?></td>
                                    <td><?= $data['harga'] ?></td>
                                    <td><?= $data['status'] ?></td>
                                </tr>
                            <?php
                        }
                    } else {
                        echo "<tr>
                                <td colspan='7' style='text-align: center;'>0 Data</td>
                            </tr>";
                    }

                ?>
            </table>

        </div>
        </div>

    </body>
</html>