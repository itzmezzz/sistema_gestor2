<?php
session_start();

if (!isset($_GET['id']) || empty($_GET['id'])) {
    die("Error: No se recibió un ID válido.");
}

$id = intval($_GET['id']); // ID de la venta

require_once('../clases/venta.php');
require_once('../clases/producto.php');
require_once('../clases/venta_items.php');

$venta = new Venta();
$producto = new Producto();
$items = new Venta_items();

// 1. ITEMS DE LA VENTA
$lista = $items->buscarPorId($id);

while ($fila = $lista->fetch_assoc()) {

    $producto_id = $fila['producto_id'];
    $cantidad = $fila['cantidad'];

    // RESTAR stock porque se activa la venta nuevamente
    $producto->restarStock($producto_id, $cantidad);
}

// 2. ACTIVAR VENTA
$resultado = $venta->activar($id);

if ($resultado) {
    header('Location: ../pantallas/lista_ventas.php');
    exit;
} else {
    echo "Error al activar la venta.";
}
?>
