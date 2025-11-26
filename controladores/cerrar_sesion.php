<?php
    session_start();
    session_destroy();

    header('location:../pantallas/login.php');
?>