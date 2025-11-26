<?php
session_start();
if (!isset($_SESSION['tipo']) || $_SESSION['tipo'] != 0) {
    echo "<script>
        alert('Acceso denegado: esta función solo es para administradores.');
        window.location.href = '../pantallas/lista_producto.php';
    </script>";
    exit;
}
// Validar que venga el ID
if (!isset($_GET['id']) || empty($_GET['id'])) {
    die("Error: No se recibió un ID válido.");
}

$id = intval($_GET['id']); // lo convierte a número seguro

include('../clases/producto.php');
$clase = new Producto();

$resultado = $clase->eliminar($id);

if ($resultado) {
    header('Location: ../pantallas/lista_producto.php');
    exit;
} else {
    echo "Error al eliminar el producto.";
}
?>
