<?php
session_start();

if (!isset($_SESSION['tipo'])) {
    header("Location: ../pantallas/login.php");
    exit;
}

$fecha = $_POST['fecha'] ?? date("Y-m-d");

header("Location: ../pantallas/corte_caja.php?fecha=$fecha");
exit;
?>
