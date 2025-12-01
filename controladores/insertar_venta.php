<?php
session_start();

$id_usuario  = $_POST['id_usuario'];
$producto_id = $_POST['producto_id'];
$cantidad    = $_POST['cantidad'];
$subtotal    = array_map('floatval', $_POST['subtotal']);
$totalVenta  = floatval($_POST['total']);

require_once('../clases/venta.php');
require_once('../clases/venta_items.php');
require_once('../clases/producto.php');

$venta    = new Venta();
$items    = new Venta_items();
$producto = new Producto();




for ($i = 0; $i < count($producto_id); $i++) {

    // Evitar filas vacías
    if (empty($producto_id[$i]) || empty($cantidad[$i])) {
        continue;
    }

    // Convertir cantidad a número real
    $cantidad[$i] = floatval($cantidad[$i]);

    if ($cantidad[$i] <= 0) {
        $_SESSION['error'] = "La cantidad debe ser mayor a 0.";
        header("Location: ../pantallas/lista_ventas.php");
        exit;
    }

    // Obtener stock real del producto
    $stockActual = $producto->obtenerStock($producto_id[$i]);

    if ($cantidad[$i] > $stockActual) {
        $_SESSION['error'] = "No puedes vender {$cantidad[$i]} unidades del producto ID {$producto_id[$i]} (Stock disponible: {$stockActual}).";
        header("Location: ../pantallas/lista_ventas.php");
        exit;
    }
}





$id_venta = $venta->guardar($id_usuario, $totalVenta);



for ($i = 0; $i < count($producto_id); $i++) {

    if (empty($producto_id[$i]) || $cantidad[$i] <= 0 || $subtotal[$i] <= 0) {
        continue;
    }

    // Guardar item
    $items->guardar($id_venta, $producto_id[$i], $cantidad[$i], $subtotal[$i]);

    // Restar stock
    $producto->restarStock($producto_id[$i], $cantidad[$i]);
}


header('Location: ../pantallas/lista_ventas.php');
exit;

?>
