<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <link rel="stylesheet" href="../src/output.css">
</head>
<body>
    <?php
    include('../clases/categoria.php');
    $clase = new Categoria();
    $respuesta = $clase->mostrar();
    ?>
    <?php include 'menu.php'?> 
    <form action=" ../controladores/insertar_producto.php" method="POST">
       <main class="pt-20 px-4 pb-8">
        <div class="mx-auto py-8 max-w-2xl">
            <h1 class="text-3xl font-bold mb-8 mt-3">Formulario de Productos</h1>
            <div class="bg-white rounded-lg shadow-lg p-6 space-y-6">
                <div class="border-b border-gray-200 pb-6"> 
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium  mb-2">Nombre del producto:</label>
                            <input type="text" name="nombre" class="w-full p-2 border border-gray-300 rounded-md" required/>
                        </div>
                        <div>
                            <label class="block text-sm font-medium  mb-2">Descripción:</label>
                            <input type="text" name="descripcion" class="w-full p-2 border border-gray-300 rounded-md" required/>
                        </div>
                         <div>
                            <label class="block text-sm font-medium  mb-2">Color:</label>
                            <input type="color" name="color" class="w-full p-2 border border-gray-300 rounded-md" required/>
                        </div>
                        <div>
                            <label class="block text-sm font-medium  mb-2">Categoría:</label>
                            <select name="categoria" class="w-full p-2 border border-gray-300 rounded-md" required/>
                                <option value="">Seleccione una categoría</option>
                                <?php foreach ($respuesta as $fila) { ?>
                                    <option value="<?= $fila['id'] ?>"><?= $fila['nombre'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium  mb-2">Precio de venta:</label>
                            <input type="number" step="0.01" name="precio_venta" class="w-full p-2 border border-gray-300 rounded-md" required/>
                        </div>
                        <div>
                            <label class="block text-sm font-medium  mb-2">Stock:</label>
                            <input type="number" name="stock" class="w-full p-2 border border-gray-300 rounded-md" required/>
                        </div>
                        <div>
                            <label class="block text-sm font-medium  mb-2">Stock mínimo:</label>
                            <input type="number" name="min_stock" class="w-full p-2 border border-gray-300 rounded-md" required/>
                        </div>
                        <div class="flex justify-center mt-4">
                            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-2 rounded-lg shadow-md transition"> Guardar</button>
                        </div>
                    </div>
                </div>
            </div>
    </form>

</body>
</html>