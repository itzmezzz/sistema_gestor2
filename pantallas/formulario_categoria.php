<?php
session_start();
if (!isset($_SESSION['tipo'])) {
    header("Location: login.php");
    exit;
}
 

include 'menu.php';


?>
<!DOCTYPE html>
<html lang="es" class="">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Configuración</title>
    <link rel="stylesheet" href="../src/output.css">
</head>

<body>

     
     <form class="form" id="formulario" action="../controladores/insertar_categoria.php" method="POST">

    <!-- Contenido -->
    <main class="pt-20 px-4 pb-8">
        <div class="mx-auto py-8 max-w-2xl">
            <!-- Título -->
            <h1 class="text-3xl font-bold mb-8 mt-3">Formulario de Categorías</h1>
            <!-- card principal  -->
            <div class="bg-white rounded-lg shadow-lg p-6 space-y-6">
                <!-- sección de perfil -->
                <div class="border-b border-gray-200 pb-6"> 
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium  mb-2">Nombre de la categoria:</label>
                            <input type="text" name="nombre" class="w-full p-2 border border-gray-300 rounded-md">
                        </div>
                        <div class="flex justify-center mt-4">
                            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-2 rounded-lg shadow-md transition"> Guardar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    </form>
</body>
</html>