<?php
    session_start();
    include "conn.php";

    if (!isset($_SESSION['username-user']))
    {
        header("location: ../../views/login.php?message=please_login");
    } else {
        $getID = $_GET['id_produk'];
        $query = mysqli_query($connect, "SELECT * FROM wishlist WHERE id_produk = '".$_GET['id_user']."' ");
        $cari = mysqli_num_rows($query);
    
        if ($cari == 0) {
            $generate = "WISH".uniqid();
            $sql = mysqli_query($connect, "INSERT INTO wishlist VALUES ('".$generate."', '".$_SESSION['id_user']."', '".$_GET['id_produk']."')");
            
            header("location: ../../views/page/productDetail.php?id_produk=".$_GET['id_produk']." ");
        } else if ($cari) {
            header("location: ../../views/page/productDetail.php?id_produk=".$_GET['id_produk']." ");
        }
    
        header("location: ../../views/page/productDetail.php?id_produk=".$_GET['id_produk']." ");
    }

?>