<?php
session_start();
if (!isset($_SESSION['tipo']) || $_SESSION['tipo'] != 0) {
    echo "<script>
        alert('Acceso denegado: esta función solo es para administradores.');
        window.location.href = '../pantallas/lista_usuario.php';
    </script>";
    exit;
}
// Validar que venga el ID
if (!isset($_GET['id']) || empty($_GET['id'])) {
    die("Error: No se recibió un ID válido.");
}

$id = intval($_GET['id']); // lo convierte a número seguro

include('../clases/usuario.php');
$clase = new Usuario();

$resultado = $clase->eliminar($id);

if ($resultado) {
    header('Location: ../pantallas/lista_usuario.php');
    exit;
} else {
    echo "Error al eliminar el usuario.";
}
?>
