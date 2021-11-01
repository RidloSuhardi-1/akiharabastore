<?php

include "conn.php";

$alamat = $_POST['alamat'];

$sql = mysqli_query($connect, "UPDATE address SET alamat = '".$_POST['alamat']."' WHERE id_alamat = '".$_GET['id_alamat']."' " );

if ($sql)
{
    header("location: ../../views/user/user/addressData.php");
} else {
    header("location: ../../views/user/user/addressData.php");
    echo mysqli_error($connect);
}

?>