<?php
session_start();
if (!isset($_SESSION['tipo']) || $_SESSION['tipo'] != 0) {
    echo "<script>
        alert('Acceso denegado: esta función solo es para administradores.');
        window.location.href = '../pantallas/lista_categoria.php';
    </script>";
    exit;
}
$nombre = $_POST['nombre']; 
include('../clases/categoria.php');
$clase = new Categoria();
$Resultado = $clase->guardar($nombre);

if ($Resultado) {
     header('location:../pantallas/lista_categoria.php');
}else{
    echo "Error";
}
?>