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
            <a href="barangData.php">Data Barang</a>
            <a href="pegawaiData.php" class="active">Data Pegawai</a>
            <a href="account_detail.php">Akun Pribadi</a>
            <a href="../../../sistem/core/logout-peg.php" onclick="return confirm('Yakin ingin logout ?');" class="logout-btn">logout</a>
        </div>

        <div class="cover">
            <h2>Data Pegawai - Belum terverifikasi</h2>
            <hr>
            <div class="menu-pgw">
                <ul>
                    <li class="a"><a href="pegawaiData.php">Semua Pegawai</a></li>
                    <li class="b"><a href="pegawaiData_verified.php">Terverifikasi</a></li>
                    <li class="c"><a href="pegawaiData_unverified.php">Belum Verifikasi</a></li>
                </ul>
            </div>
        <form action="pegawaiData.php" method="GET">
            <div class="search">
                <h5>Cari pegawai &nbsp;<input type="text" name="cari_pegawai" placeholder="cari id, nama, telepon.."></h5>
            </div>
        </form>
            <table>
                <tr>
                    <th>ID Pegawai</th>
                    <th>Nama</th>
                    <th>Gender</th>
                    <th>Email</th>
                    <th>Telp</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
                <?php
                    if (isset($_GET['cari_pegawai'])) {
                        $cari = $_GET['cari_pegawai'];
                        $sql = mysqli_query($connect, "SELECT * FROM karyawan WHERE id_pgw LIKE '%".$cari."%' OR nama LIKE '%".$cari."%' OR telp LIKE '".$cari."'  ");
                    } else {
                        $sql = mysqli_query($connect, "SELECT * FROM karyawan WHERE status = 'unverified' AND NOT id_pgw='".$_SESSION['id_pgw']."'  ");
                    }

                    if (mysqli_num_rows($sql) > 0) {
                        while ($data = mysqli_fetch_assoc($sql))
                        {
                            ?>
                                <tr>
                                    <td style="text-align: center;"><?= $data['id_pgw'] ?></td>
                                    <td><?= $data['nama'] ?></td>
                                    <td><?= $data['gender'] ?></td>
                                    <td><?= $data['email'] ?></td>
                                    <td><?= $data['telp'] ?></td>
                                    <td><img src="../../../sistem/public/img/<?php if ($data['status'] == 'verified') { echo 'verified.png'; } else { echo 'unverified.png'; } ?>" alt="status-check.png" width="10">&nbsp;&nbsp;<?= $data['status'] ?></td>
                                    <td><button class="btn-view"><a href="pegawaiData_detail.php?id_pgw=<?= $data['id_pgw'] ?> ">lihat</a></button></td>
                                </tr>
                            <?php
                        }
                    } else {
                        echo "<tr>
                                <td colspan='7' style='text-align: center;'>0 Data belum terverifikasi</td>
                            </tr>";
                    }

                ?>
            </table>

        </div>
        </div>

    </body>
</html>