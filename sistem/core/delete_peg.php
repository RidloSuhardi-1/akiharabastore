<?php

    include "conn.php";

    $sql = mysqli_query($connect, "DELETE FROM karyawan WHERE id_pgw = '".$_GET['id_pgw']."' ");
    header("location: ../../views/user/admin/pegawaiData.php");

?>