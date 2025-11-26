<!DOCTYPE html>
<html lang="es" class="">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Configuración</title>
    <link rel="stylesheet" href="../src/output.css">
</head>

<body>

     <?php include 'menu.php'?>

    <!-- Contenido -->
    <main class="pt-20 px-4 pb-8">
       <div class="p-6">

    <!-- Título y botón de registro -->
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-2xl font-bold">Lista de Productos</h2>

        <button class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg">
            Registrar Producto
        </button>
    </div>

    <!-- Tabla -->
    <div class="overflow-x-auto rounded-xl shadow">
        <table class="w-full text-left border-collapse">
            <thead class="bg-gray-100">
                <tr>
                    <th class="p-3 font-semibold">Nombre</th>
                    <th class="p-3 font-semibold">Precio</th>
                    <th class="p-3 font-semibold">Stock</th>
                    <th class="p-3 font-semibold text-center">Acciones</th>
                    
                </tr>
            </thead>
            <tbody>
                 <tr class="border-b hover:bg-gray-50">
                    <td class="p-3">1</td>
                    <td class="p-3">Mouse Gamer RGB</td>
                    <td class="p-3">$450 MXN</td>
                    <td class="p-3">23</td>

                    <td class="p-3 text-center space-x-2">
                        <button class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded">
                            Editar
                        </button>
                        <button class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded">
                            Eliminar
                        </button>
                    </td>
                </tr>
            </tbody>

            
        </table>
    </div>

</div>

    </main>

</body>

</html>