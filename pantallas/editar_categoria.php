<?php
    session_start();
     if (!isset($_SESSION['tipo'])) {
    header("Location: login.php");
    exit;
}
if (!isset($_SESSION['tipo']) || $_SESSION['tipo'] != 0) {
   echo "<script>
        alert('Acceso denegado: esta función solo es para administradores.');
        window.location.href = '../pantallas/lista_categoria.php';
    </script>";
    exit;
}
    include('../clases/categoria.php');
    $clase = new Categoria();

    if (!isset($_GET['id'])) {
        die("Error: no se recibió el parámetro id");
    }

    $id = intval($_GET['id']); 

    // Buscar la categoría por ID
    $resultado = $clase->buscarPorId($id);

    // Obtener los datos de la categoría
    $datos = mysqli_fetch_assoc($resultado);

    if (!$datos) {
        die("Error: No se encontró la categoría con el ID recibido.");
    }
    ?>
    <?php include 'menu.php'?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <link rel="stylesheet" href="../src/output.css">
</head>
<body>
    

    <form class="form" id="formulario" action="../controladores/actualizar_categoria.php" method="POST">
        <main class="pt-20 px-4 pb-8">
            <div class="mx-auto py-8 max-w-2xl">

                <h1 class="text-3xl font-bold mb-8 mt-3">Editar Categoría</h1>

                <div class="bg-white rounded-lg shadow-lg p-6 space-y-6">
                    <div class="border-b border-gray-200 pb-6"> 
                        <div class="space-y-4">

                            <input type="hidden" name="id" value="<?= $datos['id'] ?>">

                            <label class="block text-sm font-medium mb-2">Nombre de la categoría:</label>
                            <input 
                                value="<?= $datos['nombre'] ?>" 
                                type="text" 
                                name="nombre" 
                                class="w-full p-2 border border-gray-300 rounded-md"
                            >

                            <div class="flex justify-center mt-4">
                                <button type="submit" 
                                    class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-2 rounded-lg shadow-md transition">
                                    Guardar
                                </button>
                            </div>

                        </div>
                    </div>
                </div>

            </div>
        </main>
    </form>
</body>
</html>
