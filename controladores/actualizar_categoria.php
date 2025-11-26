<?php 
session_start();
if (!isset($_SESSION['tipo']) || $_SESSION['tipo'] != 0) {
    echo "<script>
        alert('Acceso denegado: esta función solo es para administradores.');
        window.location.href = '../pantallas/lista_categoria.php';
    </script>";
    exit;
}

$nombre =$_POST['nombre'];
$id = $_POST['id'];
include('../clases/categoria.php');
$clase = new Categoria();
$resultado = $clase->actualizar($nombre, $id);
if($resultado){
header('location:../pantallas/lista_categoria.php');
}else{
	echo "Error";
}
 ?>