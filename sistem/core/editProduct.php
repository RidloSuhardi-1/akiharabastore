<?php

    session_start();

    include "conn.php";

    if (!isset($_SESSION['username']))
    {
        header("location: ../../views/login-portal.php?message=please_login");
    }

    if ($_SESSION['level'] != "karyawan")
    {
        echo "<script>alert('Anda bukan karyawan, kembali ke halaman anda');</script>";
        
        if ($_SESSION['level'] == 'admin') {
            header("location: ../../views/user/admin/");
        }
        else if (!isset($_SESSION['level'])) {
            header("location: ../../views/login-portal.php?message=please_login");
        }

    }

    // mulai terima data
    $produk = $_POST['produk'];
    $cat = $_POST['kategori'];
    $stok = $_POST['stok'];
    $price = $_POST['harga'];
    $status = $_POST['status'];
    $product_pic = $_POST['product_pic'];
    $ket = $_POST['ket'];

    // image validation
    $allowedFormat = array('png','jpg','jpeg');
    $fileName = $_FILES['product_pic']['name'];
    $x = explode(".", $fileName);
    $format = strtolower(end($x));
    $fileSize =  $_FILES['product_pic']['size'];
    $fileTmp = $_FILES['product_pic']['tmp_name'];

    $generateImageName = "PRD".uniqid().$fileName;

    // eksekusi
    if (empty($fileName)) {

        $changeName = strtoupper($produk);
        $sql = mysqli_query($connect, "UPDATE produk SET produk = '".$changeName."', id_kategori = '".$cat."', stok = '".$stok."', harga = '".$price."', status = '".$status."', ket = '".$ket."' WHERE id_produk = '".$_GET['id_produk']."' ");

        if ($sql) {
            header("location: ../../views/user/karyawan/barangData.php");
            echo "<script>alert('Data berhasil diperbarui');</script>";
        } else {
            header("location: ../../views/user/karyawan/barangData.php");
            echo "<script>alert('Data gagal diperbarui');</script>";
        }


    } else {
        // jika gambar tidak kosong
        if (in_array($format, $allowedFormat) == true) {
            if ($fileSize < 2044070) {
                move_uploaded_file($fileTmp, "../upload/".$generateImageName);
                
                // mulai simpan data jika memenuhi
                $changeName = strtoupper($produk);
                $sql = mysqli_query($connect, "UPDATE produk SET produk = '".$changeName."', id_kategori = '".$cat."', stok = '".$stok."', harga = '".$price."', status = '".$status."', ket = '".$ket."', product_pic = '".$generateImageName."' WHERE id_produk = '".$_GET['id_produk']."' ");
    
                if ($sql) {
                    header("location: ../../views/user/karyawan/barangData.php");
                } else {
                    echo $product_pic;
                    // header("location: ../../views/user/karyawan/barangData.php");
                }
            
            // jika gambar terlalu besar
            } else {
                header("location: ../../views/user/karyawan/barangData.php ");
            }
    
        // jika format salah
        } else {
            header("location: ../../views/user/karyawan/barangData.php");
        }
    }  
    // eksekusi
    
?>