<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

require_once('../clases/venta.php');
require_once('../clases/venta_items.php');
require_once('../clases/producto.php');

$venta      = new Venta();
$items      = new Venta_items();
$producto   = new Producto();

$id_venta    = intval($_POST['id']);
$id_usuario  = $_POST['id_usuario'];
$producto_id = $_POST['producto_id'];
$cantidad    = $_POST['cantidad'];
$subtotal    = array_map('floatval', $_POST['subtotal']);
$totalVenta  = floatval($_POST['total']);


$items_ant = $items->buscarPorVenta($id_venta);

foreach ($items_ant as $it) {
    $producto->sumarStock($it['producto_id'], $it['cantidad']);
}


for ($i = 0; $i < count($producto_id); $i++) {

    if ($producto_id[$i] == "" || $cantidad[$i] <= 0) continue;

    $stockActual = $producto->obtenerStock($producto_id[$i]);

    if ($cantidad[$i] > $stockActual) {

        $_SESSION['error'] =
        "No puedes vender {$cantidad[$i]} unidades del producto ID {$producto_id[$i]} (Stock: {$stockActual}).";

        
        foreach ($items_ant as $it) {
            $producto->restarStock($it['producto_id'], $it['cantidad']);
        }

        header("Location: ../pantallas/editar_venta.php?id=".$id_venta);
        exit;
    }
}

$items->eliminarPorVenta($id_venta);


$venta->actualizar($id_venta, $id_usuario, $totalVenta);

// GUARDAR NUEVOS ITEMS
for ($i = 0; $i < count($producto_id); $i++) {

    if ($producto_id[$i] == "" || $cantidad[$i] <= 0 || $subtotal[$i] <= 0) continue;

    $items->guardar($id_venta, $producto_id[$i], $cantidad[$i], $subtotal[$i]);

    $producto->restarStock($producto_id[$i], $cantidad[$i]);
}

header('Location: ../pantallas/lista_ventas.php');
exit;
?>
