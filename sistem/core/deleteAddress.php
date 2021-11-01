<?php

    include "conn.php";

    $sql = mysqli_query($connect, "DELETE FROM address WHERE id_alamat = '".$_GET['id_alamat']."' ");
    header("location: ../../views/user/user/addressData.php");

?>