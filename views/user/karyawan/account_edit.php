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
            <a href="barangData.php">Kelola Produk</a>
            <a href="transaksiData.php">Transaksi</a>
            <a href="account_detail.php" class="active">Akun Pribadi</a>
            <a href="../../../sistem/core/logout-peg.php" onclick="return confirm('Yakin ingin logout ?');" class="logout-btn">logout</a>
        </div>

        <!--  -->

        <div class="cover">
            <h2>Informasi Data Diri</h2>

            <div class="border-box">

            
            <?php
                $getID = $_GET['id_pgw'];
                $sql = mysqli_query($connect, "SELECT * FROM karyawan WHERE id_pgw ='$getID' ");

                while ($dt = mysqli_fetch_array($sql))
                {
                    ?>
                    
            <form action="../../../sistem/core/edit_kwnProses.php?id_pgw=<?= $dt['id_pgw'] ?>" method="POST" enctype="multipart/form-data">

                <div class="profil-box">
                <img src="../../../sistem/upload-data/profile-pic/<?php if ($dt['profil_pic'] == "not-set") { echo "default-profile.png"; } else { echo $dt['profil_pic']; } ?>" alt="profile_pic" height="180" width="200">
                    <h3><?php echo $_SESSION['nama']; ?></h3>
                    <p>(Anda perlu melakukan login kembali untuk memperbarui nama)</p>
                    <input type="file" name="profil_pic">
                    <p class="box-profile"><input type="checkbox" name="del_profil" <?php if ($dt['profil_pic'] == "not-set") { echo "disabled"; } else { echo $dt['profil_pic']; }  ?>> Hapus foto profil saat ini</p>
                </div>

                <div class="info-box">
                
                    
                    <table style="line-height: 0.3;">
                        <?php?>
                        <tr>
                            <td colspan="2"><h5>IDENTITAS PRIBADI</h5></td>
                        </tr>
                        <tr>
                            <td><p>Nama</p></td>
                            <td><p><input type="text" name="nama" value="<?= $dt['nama'] ?>" placeholder="<?= $dt['nama'] ?>" required></p></td>
                        </tr>
                        <tr>
                            <td><p>Alamat</p></td>
                            <td><p><input type="text" name="alamat" value="<?= $dt['alamat'] ?>" placeholder="<?= $dt['alamat'] ?>" required></p></td>
                        </tr>
                        <tr>
                            <td><p>Gender</p></td>
                            <td>
                                <p>
                                    <input type="radio" name="gender" value="pria" required> Pria
                                    <input type="radio" name="gender" value="wanita" required> Wanita
                                </p>
                            </td>
                        </tr>
                        <!-- info kontak -->
                        <tr>
                            <td colspan="2"><h5>INFO KONTAK</h5></td>
                        </tr>
                        <tr>
                            <td><p>Email</p></td>
                            <td><p><input type="email" name="email" value="<?= $dt['email'] ?>" placeholder="<?= $dt['email'] ?>" required></p></td>
                        </tr>
                        <tr>
                            <td><p>Telp</p></td>
                            <td><p><input type="tel" name="telp" maxlength="12" value="<?= $dt['telp'] ?>" placeholder="<?= $dt['telp'] ?>" required></p></td>
                        </tr>
                    </table>
            
                <hr><br>
                    <button type="submit" class="edit-btn">Simpan perubahan</button>
                    <a href="account_detail.php" class="edit-btn" style="background: #C62828;">Batalkan</a>
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