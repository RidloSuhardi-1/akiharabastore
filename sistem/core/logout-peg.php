<?php

    include "conn.php";
    session_start();

    $getID = $_SESSION['id_pgw'];
    $sql = mysqli_query($connect, "UPDATE karyawan SET last_online = current_timestamp() WHERE id_pgw = '$getID' ");

    session_destroy();

    header("location: ../../views/login-portal.php?message=logout_success");

?>