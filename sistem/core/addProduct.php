<?php

    include "conn.php";

    $nama = $_POST['produk'];
    $cat = $_POST['kategori'];
    $stok = $_POST['stok'];
    $price = $_POST['harga'];
    $status = $_POST['status'];
    $produc_pic = $_POST['product_pic'];
    $ket = $_POST['ket'];

    // image validation
    $allowedFormat = array('png','jpg','jpeg');
    $fileName = $_FILES['product_pic']['name'];
    $x = explode(".", $fileName);
    $format = strtolower(end($x));
    $fileSize =  $_FILES['product_pic']['size'];
    $fileTmp = $_FILES['product_pic']['tmp_name'];
    
    // generate id product
    $generateProductID = "PRD".rand();
    
    if (empty($fileName)) {

        $generateImageName = "not-set";
        // mulai simpan data jika memenuhi
        $changeName = strtoupper($nama);
        $query = mysqli_query($connect, "INSERT INTO produk (id_produk, produk, id_kategori, stok, harga, status, ket, product_pic) VALUES
        ('$generateProductID', '$changeName', '$cat', '$stok', '$price', '$status', '$ket','$generateImageName')");

        if ($query) {
            header("location: ../../views/user/karyawan/barangData.php");
        } else {
            header("location: ../../views/user/karyawan/barangData.php");
        }
    }
    else {
        $generateImageName = "PRD".uniqid().$fileName;

        if (in_array($format, $allowedFormat) === true) {
            if ($fileSize < 2044070) {
                move_uploaded_file($fileTmp, "../upload/".$generateImageName);
                
                // mulai simpan data jika memenuhi
    
                $changeName = strtoupper($nama);
                $query = mysqli_query($connect, "INSERT INTO produk (id_produk, produk, id_kategori, stok, harga, status, ket, product_pic) VALUES
                ('$generateProductID', '$changeName', '$cat', '$stok', '$price', '$status', '$ket', '$generateImageName')");
    
                if ($query) {
                    header("location: ../../views/user/karyawan/barangData.php");
                } else {
                    header("location: ../../views/user/karyawan/barangData.php");
                }
            
            // jika gambar terlalu besar
            } else {
                header("location: ../../views/user/karyawan/barangData.php");
            }
    
        // jika format salah
        } else {
            header("location: ../../views/user/karyawan/barangData.php");
        }
    }

?>