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
      session_start();
if (!isset($_SESSION['tipo']) || $_SESSION['tipo'] != 0) {
   echo "<script>
        alert('Acceso denegado: esta función solo es para administradores.');
        window.location.href = '../pantallas/indexadmin.php';
    </script>";
    exit;
}
    include('menu.php');
    include('../clases/usuario.php');
    $clase = new Usuario();
    $Resultado = $clase->mostrar();
    ?>
    <main class="pt-20 px-4 pb-8">
       <div class="p-6  ">

    <!-- Título y botón de registro -->
    
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-2xl font-bold">Lista de Usuarios</h2>
        <a href="login.php">
        <button class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg">
            Registrar Usuario
        </button>
        </a>
    </div>
    <div class="overflow-x-auto rounded-xl shadow">
        <table class="w-full text-left border-collapse">
            <thead class="bg-gray-100">
                <tr>
                    <th class="p-3 font-semibold">usuario</th> 
                    <th class="p-3 font-semibold">correo</th> 
                    <th class="p-3 font-semibold">fecha</th>
                    <th class="p-3 font-semibold">tipo</th>  
                    <th class="p-3 font-semibold">Estatus</th>
                </tr>
            </thead>
            <tbody>
                <?php
            foreach ($Resultado as $fila) {
           ?>
                 <tr class="border-b hover:bg-gray-50">
                    <td class="p-3"><?=$fila["usuario"]?></td>
                    <td class="p-3"><?=$fila["correo"]?></td>
                    <td class="p-3"><?=$fila["fecha_creacion"]?></td>
                    <?php if ($fila["tipo"] == 0): ?>
                    <td class="p-3">Administrador</td>
                    <?php else: ?>
                    <td class="p-3">Usuario normal</td>
                    <?php endif; ?>
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
                    <?php if ($fila["estatus"] == 0): ?>
                        
                            <a href="../controladores/eliminar_usuario.php?id=<?=$fila['id']?>">
                            <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded">
                                Eliminar
                            </button>
                        </a>
                        <?php else: ?>
                        <a href="../controladores/activar_usuario.php?id=<?=$fila['id']?>">
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