<?php 
session_start();
if (!isset($_SESSION['tipo'])) {
    header("Location: login.php");
    exit;
}

$venta_id = isset($_GET['id']) ? intval($_GET['id']) : 0;



include('menu.php');
include('../clases/venta_items.php');

$clase = new Venta_items();
$Resultado = $clase->detallesPorVenta($venta_id);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalles de Venta</title>
    <link rel="stylesheet" href="../src/output.css">
</head>
<body>

<main class="pt-20 px-4 pb-8">
    <div class="p-6">

        <!-- Título y botón -->
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-2xl font-bold">Detalles de la venta #<?= $venta_id ?></h2>

            <a href="lista_ventas.php">
                <button class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg">
                    Regresar
                </button>
            </a>
        </div>

        <div class="overflow-x-auto rounded-xl shadow">
            <table class="w-full text-left border-collapse">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="p-3 font-semibold">Venta</th>
                        <th class="p-3 font-semibold">Producto</th>
                        <th class="p-3 font-semibold">Cantidad</th>
                        <th class="p-3 font-semibold">Subtotal</th>
                        <th class="p-3 font-semibold">Estatus</th>
                    </tr>
                </thead>

                <tbody>
                    <?php if (!empty($Resultado)): ?>
                        <?php foreach ($Resultado as $fila): ?>
                            <tr class="border-b hover:bg-gray-50">
                                <td class="p-3"><?= $fila["venta_id"] ?></td>
                                <td class="p-3"><?= $fila["producto"] ?></td>
                                <td class="p-3"><?= $fila["cantidad"] ?></td>
                                <td class="p-3"><?= number_format($fila["subtotal"], 2) ?></td>
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
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5" class="p-4 text-center text-gray-500">
                                No hay detalles registrados para esta venta.
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>

            </table>
        </div>

    </div>
</main>

</body>
</html>
