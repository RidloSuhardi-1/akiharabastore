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
            <a href="barangData.php">Kelola Produk</a>
            <a href="transaksiData.php" class="active">Transaksi</a>
            <a href="account_detail.php">Akun Pribadi</a>
            <a href="../../../sistem/core/logout-peg.php" onclick="return confirm('Yakin ingin logout ?');" class="logout-btn">logout</a>
        </div>

        <div class="cover">
            <h2>Data Transaksi</h2>
            <hr>
            <div class="menu-pgw">
                <ul>
                    <li class="a"><a href="transaksiData.php">Semua Transaksi</a></li>
                </ul>
            </div>
        <form action="transaksiData.php" method="GET">
            <div class="search">
                <h5>Cari Transaksi &nbsp;<input type="text" name="cari_trx" placeholder="cari id, nama produk"></h5>
            </div>
        </form>
            <table>
                <tr>
                    <th>ID Produk</th>
                    <th>ID User</th>
                    <th>ID Produk</th>
                    <th>Jumlah</th>
                    <th>Total Harga</th>
                    <th>Jenis Pembayaran</th>
                    <th>Alamat</th>
                    <th>Kurir</th>
                    <th>Tanggal</th>
                </tr>
                <?php
                    if (isset($_GET['cari_trx'])) {
                        $cari = $_GET['cari_trx'];
                        $sql = mysqli_query($connect, "SELECT * FROM transaksi WHERE id_transaksi LIKE '%".$cari."%' ");
                    } else {
                        $sql = mysqli_query($connect, "SELECT * FROM transaksi");
                    }

                    if (mysqli_num_rows($sql) > 0) {
                        while ($data = mysqli_fetch_assoc($sql))
                        {
                            ?>
                                <tr>
                                    <td align="center"><?= $data['id_transaksi'] ?></td>
                                    <td align="center"><?= $data['id_user'] ?></td>
                                    <td align="center"><?= $data['id_produk'] ?></td>
                                    <td align="center"><?= $data['jumlah'] ?></td>
                                    <td align="center"><?= $data['total'] ?></td>
                                    <td align="center"><?= $data['bayar'] ?></td>
                                    <td align="center"><?= $data['alamat'] ?></td>
                                    <td align="center"><?= $data['kurir'] ?></td>
                                    <td align="center"><?= $data['tgl_transaksi'] ?></td>
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