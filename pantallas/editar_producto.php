<?php
session_start();
    if (!isset($_SESSION['tipo'])) {
    header("Location: login.php");
    exit;
}
if (!isset($_SESSION['tipo']) || $_SESSION['tipo'] != 0) {
   echo "<script>
        alert('Acceso denegado: esta función solo es para administradores.');
        window.location.href = '../pantallas/lista_producto.php';
    </script>";
    exit;
}
 
    include('../clases/producto.php');
    $clase = new Producto();
    $respuesta = $clase->mostrar();
    if (!isset($_GET['id'])) {
        die("Error: no se recibió el parámetro id");
    }

    $id = intval($_GET['id']); 

    // Buscar el producto por ID
    $resultado = $clase->buscarPorId($id);

    // Obtener los datos del producto
    $datos = mysqli_fetch_assoc($resultado);

    if (!$datos) {
        die("Error: No se encontró el producto con el ID recibido.");
    }
    
    
		
		include('../clases/categoria.php');
		$clase = new Categoria();
		$resultado = $clase->mostrarActivas();
	
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scsale=1.0">
    <title></title>
    <link rel="stylesheet" href="../src/output.css">
</head>
<body>
    <?php include 'menu.php'?>
    <form class="form" id="formulario" action="../controladores/actualizar_producto.php" method="POST">
    <main class="pt-20 px-4 pb-8">
        
            <div class="mx-auto py-8 max-w-2xl">

                <h1 class="text-3xl font-bold mb-8 mt-3">Editar Producto</h1>

                <div class="bg-white rounded-lg shadow-lg p-6 space-y-6">
                    <div class="border-b border-gray-200 pb-6"> 
                        <div class="space-y-4">

                            <input type="hidden" name="id" value="<?= $datos['id'] ?>">

                            <label class="block text-sm font-medium mb-2">Nombre del producto:</label>
                            <input 
                                value="<?= $datos['nombre'] ?>" 
                                type="text" 
                                name="nombre" 
                                class="w-full p-2 border border-gray-300 rounded-md"
                            >

                            <label class="block text-sm font-medium mb-2">Descripción:</label>
                            <input 
                                value="<?= $datos['descripcion'] ?>" 
                                type="text" 
                                name="descripcion" 
                                class="w-full p-2 border border-gray-300 rounded-md"
                            >

                            <label class="block text-sm font-medium mb-2">Color:</label>
                            <input 
                                value="<?= $datos['color'] ?>" 
                                type="color" 
                                name="color" 
                                class="w-full p-2 border border-gray-300 rounded-md"
                            >

                            <label class="block text-sm font-medium mb-2">Categoría:</label>
                            <select name="categoria" class="w-full p-2 border border-gray-300 rounded-md" required/>
                                <option value="">Seleccione una categoría</option>
                                <?php foreach ($resultado as $fila) { ?>
                                    <option value="<?= $fila['id'] ?>" <?= $fila['id'] == $datos['categoria_id'] ? 'selected' : '' ?>>
                                        <?= $fila['nombre'] ?>
                                    </option>
                                <?php } ?>
                            </select>

                            <label class="block text-sm font-medium mb-2">Precio de venta:</label>
                            <input 
                                value="<?= $datos['precio_venta'] ?>" 
                                type="number" 
                                step="0.01"
                                name="precio_venta" 
                                class="w-full p-2 border border-gray-300 rounded-md"
                            >
                            <label class="block text-sm font-medium mb-2">Stock:</label>
                            <input 
                                value="<?= $datos['stock'] ?>" 
                                type="number" 
                                name="stock" 
                                class="w-full p-2 border border-gray-300 rounded-md"
                            >
                            <label class="block text-sm font-medium mb-2">Stock mínimo:</label>
                            <input 
                                value="<?= $datos['min_stock'] ?>" 
                                type="number" 
                                name="min_stock" 
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
        </main>
        </form>
</body>
</html>