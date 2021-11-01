<?php

    include "conn.php";

    $alamat = $_POST['alamat'];

    $generatedAddressID = "ADDS".rand();
    $sql = mysqli_query($connect, "INSERT INTO address VALUES ('".$generatedAddressID."' ,'".$_GET['id_user']."', '".$alamat."') ");

    if ($sql)
    {
        header("location: ../../views/user/user/addressData.php");
    } else {
        header("location: ../../views/user/user/addressData.php");
        echo mysqli_error($connect);
    }

?>