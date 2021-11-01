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
            <a href="barangData.php">Data Barang</a>
            <a href="pegawaiData.php" class="active">Data Pegawai</a>
            <a href="account_detail.php">Akun Pribadi</a>
            <a href="../../../sistem/core/logout-peg.php" onclick="return confirm('Yakin ingin logout ?');" class="logout-btn">logout</a>
        </div>

        <!--  -->
        <?php
                    $getID = $_GET['id_pgw'];
                    $sql = mysqli_query($connect, "SELECT * FROM karyawan WHERE id_pgw ='$getID' ");
                    $profileCheck;
                    while ($dt = mysqli_fetch_array($sql))
                    {

                        ?>
        <div class="cover">
            <h2>INFORMASI KARYAWAN</h2>

            <div class="border-box">
                <div class="profil-box">

                    <img src="../../../sistem/upload-data/profile-pic/<?php if ($dt['profil_pic'] == "not-set") { echo "default-profile.png"; } else { echo $dt['profil_pic']; } ?>" alt="profile_pic" height="180" width="200">
                    <h3><?= $dt['nama'] ?></h3>
                </div>

                <div class="info-box">

                    <table style="line-height: 0.3;">
                        <?php?>
                        <tr>
                            <td colspan="2"><h5>IDENTITAS KARYAWAN</h5></td>
                        </tr>
                        <tr>
                            <td><p>Nama</p></td>
                            <td><p><?= $dt['nama'] ?></p></td>
                        </tr>
                        <tr>
                            <td><p>Alamat</p></td>
                            <td><p><?= $dt['alamat'] ?></p></td>
                        </tr>
                        <tr>
                            <td><p>Gender</p></td>
                            <td><p><?= $dt['gender'] ?></p></td>
                        </tr>
                        <tr>
                            <td><p>Data KTP</p></td>
                            <td><p><a href="../../../sistem/upload-data/<?= $dt['data_ktp'] ?>" style="font-weight: bold;" target="_blank">LIHAT KTP</a></p></td>
                        </tr>
                        <!-- info kontak -->
                        <tr>
                            <td colspan="2"><h5>INFO KONTAK</h5></td>
                        </tr>
                        <tr>
                            <td><p>Email</p></td>
                            <td><p><?= $dt['email'] ?></p></td>
                        </tr>
                        <tr>
                            <td><p>Telp</p></td>
                            <td><p><?= $dt['telp'] ?></p></td>
                        </tr>
                        <!-- info akun -->
                        <tr>
                            <td colspan="2"><h5>INFO AKUN</h5></td>
                        </tr>
                        <tr>
                            <td><p>ID Pegawai</p></td>
                            <td><p><?= $dt['id_pgw'] ?></p></td>
                        </tr>
                        <tr>
                            <td><p>Username</p></td>
                            <td><p><?= $dt['username'] ?></p></td>
                        </tr>
                        <tr>
                            <td><p>Jabatan</p></td>
                            <td><p><?= $dt['level'] ?></p></td>
                        </tr>
                        <tr>
                            <td><p>Status</p></td>
                            <td><p><?= $dt['status'] ?> <img src="../../../sistem/public/img/<?php if ($dt['status'] == 'verified') { echo 'verified.png'; } else { echo 'unverified.png'; } ?>" alt="verify-check" width="10"></p></td>
                        </tr>
                        <tr>
                            <td><p>Waktu bergabung</p></td>
                            <td><p><?= $dt['tgl_daftar'] ?></p></td>
                        </tr>
                        <tr>
                            <td><p>Online Terakhir</p></td>
                            <td><p><?= $dt['last_online'] ?></p></td>
                        </tr>
                    </table>
                    
                    <hr><br>
                    
                     <!-- button aksi -->
                     <a href="../../../sistem/core/verify.php?id_pgw=<?= $dt['id_pgw'] ?>" onclick="return confirm('Verifikasi data <?= $dt['id_pgw'] ?>  ?')" class="edit-btn" style="<?php if ($dt['status'] == 'verified') { echo 'background: #43A047;'; } else if ($dt['status'] == 'unverified') { echo 'background: #FFB300;'; } ?>"><?php if ($dt['status'] == 'verified') { echo 'Terverifikasi'; } else { echo 'Verfikasi'; } ?></a>
                     <a href="../../../sistem/core/delete_peg.php?id_pgw=<?= $dt['id_pgw'] ?>" onclick="return confirm('Hapus data pengguna <?= $dt['id_pgw'] ?> ?, Tindakan ini akan menghapus seluruh data pengguna <?= $dt['id_pgw'] ?> ')" class="edit-btn" style="background: #D32F2F;">Hapus Pengguna</a>
                     <a href="pegawaiData.php" class="edit-btn" style="background: #1E88E5;">Kembali ke data</a>
                </div>
                        <?php
                    }
                ?>
                
            </div>
        </div>
            
        </div>

    </body>
</html>