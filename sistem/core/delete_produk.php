<?php

    include "conn.php";

    $sql = mysqli_query($connect, "DELETE FROM produk WHERE id_produk = '".$_GET['id_produk']."' ");
    header("location: ../../views/user/karyawan/barangData.php");

?>