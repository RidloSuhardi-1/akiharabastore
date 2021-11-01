<?php

    session_start();
    include "conn.php";


    $generatedTransaksiID = "TRX".uniqid();
    $sql = mysqli_query($connect, "INSERT INTO transaksi (id_transaksi, id_user, id_produk, jumlah, total, bayar, alamat, kurir) VALUES ('".$generatedTransaksiID."', '".$_POST['id_user']."', '".$_POST['id_produk']."', '".$_POST['qty']."', '".$_POST['total']."', '".$_POST['bayar']."', '".$_POST['alamat']."', '".$_POST['kurir']."') ");
    
    $select = mysqli_query($connect, "SELECT * FROM produk WHERE id_produk = '".$_POST['id_produk']."' ");

    while ($dt = mysqli_fetch_assoc($select))
    {
        $updateStok = $dt['stok'] - $_POST['qty'];
        $update = mysqli_query($connect, "UPDATE produk SET stok = '$updateStok' WHERE id_produk = '".$_POST['id_produk']."' ");
    }

    if ($sql)
    {
        header("location: ../../views/page/productDetail.php?id_produk=".$_POST['id_produk']." ");
    } else {
        header("location: ../../views/page/productDetail.php?id_produk=".$_POST['id_produk']." ");
        echo mysqli_error($connect);
    }

?>