<?php
session_start();
if (!isset($_SESSION['tipo']) || $_SESSION['tipo'] != 0) {
   echo "<script>
        alert('Acceso denegado: esta función solo es para administradores.');
        window.location.href = '../pantallas/lista_producto.php';
    </script>";
    exit;
}
$nombre = $_POST['nombre'];
$descripcion = $_POST['descripcion'];
$color = $_POST['color'];
$categoria_id = $_POST['categoria'];
$precio_venta = $_POST['precio_venta'];
$stock = $_POST['stock'];
$min_stock = $_POST['min_stock'];
include('../clases/producto.php');
$clase = new Producto();
$Resultado = $clase->guardar($nombre, $descripcion, $color, $categoria_id, $precio_venta, $stock, $min_stock);
if ($Resultado) {
     header('location:../pantallas/lista_producto.php');
}else{
    echo "Error";
}
?>