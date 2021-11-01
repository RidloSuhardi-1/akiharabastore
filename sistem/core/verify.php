<?php

    include "conn.php";

    $sql = mysqli_query($connect, "UPDATE karyawan SET status = 'verified' WHERE id_pgw = '".$_GET['id_pgw']."' ");
    
    if ($sql) {
        header("location: ../../views/user/admin/pegawaiData.php");
    } else {
        echo "gagal";
    }

?>