<?php 
session_start();
     if (!isset($_SESSION['tipo'])) {
    header("Location: login.php");
    exit;
}
    
    include('menu.php');
    include('../clases/venta.php');
    $clase = new Venta();
    $Resultado = $clase->mostrar();
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <link rel="stylesheet" href="../src/output.css">
</head>
<body>
    <main class="pt-20 px-4 pb-8">
       <div class="p-6  ">

    <!-- Título y botón de registro -->
    
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-2xl font-bold">Lista de ventas</h2>
        <a href="formulario_venta.php">
        <button class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg">
            Registrar Venta
        </button>
       
    </div>
    <div class="overflow-x-auto rounded-xl shadow">
        <table class="w-full text-left border-collapse">
            <thead class="bg-gray-100">
                <tr>
                    <th class="p-3 font-semibold">Usuario</th> 
                    <th class="p-3 font-semibold">fecha</th> 
                    <th class="p-3 font-semibold">total</th>
                    <th class="p-3 font-semibold">estatus</th>
                    <th>
         <a href="corte_caja.php">
        <button class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg">
            Corte de caja 
        </button>
        </a></th>
                </tr>
            </thead>
            <tbody>
                <?php
            foreach ($Resultado as $fila) {
           ?>
                 <tr class="border-b hover:bg-gray-50">
                    <td class="p-3"><?=$fila["usuario"]?></td>
                    <td class="p-3"><?=$fila["fecha"]?></td>
                    <td class="p-3"><?=$fila["total"]?></td>
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
                    
                    </td>
                    <td class="p-3 text-center space-x-2">
                        <a href="detalle_venta.php?id=<?= $fila['id'] ?>"">
                     <button class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg">
                     detalles
                     </button>
                    </a>
                         <a href="editar_venta.php?id=<?=$fila["id"]?>">
                        <button class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded">
                            Editar
                        </button>
                         </a>
                         
                    
                    <?php if ($fila["estatus"] == 0): ?>
                        
                            <a href="../controladores/eliminar_venta.php?id=<?=$fila['id']?>">
                            <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded">
                                Eliminar
                            </button>
                        </a>
                        <?php else: ?>
                        <a href="../controladores/activar_venta.php?id=<?=$fila['id']?>">
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
    </main>
            
        </table>
    </div>

</body>
</html>