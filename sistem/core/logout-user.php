<?php

    include "conn.php";
    session_start();
    session_destroy();

    header("location: ../../views/login.php?message=logout_success");

?>