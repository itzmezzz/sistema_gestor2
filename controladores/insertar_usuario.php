<?php 
session_start();
if (!isset($_SESSION['tipo']) || $_SESSION['tipo'] != 0) {
 echo "<script>
        alert('Acceso denegado: esta función solo es para administradores.');
        window.location.href = '../pantallas/login.php';
    </script>";
    exit;
}
$usuario = $_POST['usuario'];
$correo = $_POST['correo'];
$contraseña = $_POST['contraseña'];
$tipo = $_POST['tipo'];

include('../clases/usuario.php');

$clase = new Usuario();
$resultado = $clase->guardar($usuario, $correo, $contraseña, $tipo);

if ($resultado === "existe") {
    echo "<script>
        alert('El usuario ya existe. Intenta con otro nombre.');
        window.location.href = '../pantallas/login.php';
    </script>";
    exit;
}else if ($resultado) {
    header('Location: ../pantallas/lista_usuario.php');
    exit;
} else {
    echo "Error al guardar";
}
?>
