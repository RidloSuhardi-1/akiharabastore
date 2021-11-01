<?php

    session_start();
    include "conn.php";

    $sql = mysqli_query($connect, "DELETE FROM wishlist WHERE id_wish = '".$_GET['id_wish']."' ");
    header("location: ../../views/user/user/wishlistDash.php");
?>