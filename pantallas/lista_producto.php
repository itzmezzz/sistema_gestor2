<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../src/output.css">
</head>
<body>
    <?php 
    include('menu.php');
    include('../clases/producto.php');
    $clase = new Producto();
    $Resultado = $clase->mostrar();
    ?>

    <main class="pt-20 px-4 pb-8">
       <div class="p-6">

    <!-- Título y botón de registro -->
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-2xl font-bold">Lista de Productos</h2>
        <a href="formulario_producto.php">
        <button class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg">
            Registrar Producto
        </button>
        </a>
    </div>
    <div class="overflow-x-auto rounded-xl shadow">
        <table class="w-full text-left border-collapse">
            <thead class="bg-gray-100">
                <tr>
                    <th class="p-3 font-semibold">Nombre del producto</th>
                    <th class="p-3 font-semibold">Descripción</th>
                    <th class="p-3 font-semibold">Color</th>
                    <th class="p-3 font-semibold">Categoría</th>
                    <th class="p-3 font-semibold">Precio de venta</th>
                    <th class="p-3 font-semibold">Stock</th>
                    <th class="p-3 font-semibold">Stock mínimo</th>
                    <th class="p-3 font-semibold">Estatus</th>
                    
                </tr>
            </thead>
            <tbody>
                <?php
            foreach ($Resultado as $fila) {
           ?>
                 <tr class="border-b hover:bg-gray-50">
                    <td class="p-3"><?=$fila["nombre"]?></td>
                    <td class="p-3"><?=$fila["descripcion"]?></td>
                    <td class="p-3"><div style="width: 30px; height: 30px; background-color: <?=$fila['color']?>;"></div></td>
                    <td class="p-3"><?=$fila["categoria"]?></td>
                    <td class="p-3"><?=$fila["precio_venta"]?></td>
                    <td class="p-3"><?=$fila["stock"]?></td>
                    <td class="p-3"><?=$fila["min_stock"]?></td>
                    <td class="p-3">
                    <?php if ($fila["estatus"] == 0): ?>
                    <span class="px-2 py-0.5 border border-green-500 text-green-700 rounded-full text-xs font-medium">
                        Activo
                    </span>
                    <?php else: ?>
                    <span class="px-2 py-0.5 border border-red-500 text-red-700 rounded-full text-xs font-medium">
                        Inactivo
                    </span>
                    <?php endif; ?>
                    </td>
                    <td class="p-3 text-center space-x-2">
                        <a href="editar_producto.php?id=<?=$fila["id"]?>">
                        <button class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded">
                            Editar
                        </button>
                        </a>
                        <?php if ($fila["estatus"] == 0): ?>
                       <a href="../controladores/eliminar_producto.php?id=<?=$fila['id']?>">
                            <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded">
                                Eliminar
                            </button>
                        </a>
                        <?php else: ?>
                        <a href="../controladores/activar_producto.php?id=<?=$fila['id']?>">
                            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-1 rounded">
                                activar
                            </button>
                        </a>
                        <?php endif; ?>
                    </td>
                </tr>
            </tbody>
        <?php     
            }
     ?>
     </div> 

        
    
</body>
</html>