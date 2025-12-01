<?php
session_start();

if (!isset($_SESSION['tipo'])) {
    header("Location: login.php");
    exit;
}

include('menu.php');
include('../clases/corte_caja.php');

$fecha = $_GET['fecha'] ?? date("Y-m-d");

$corte = new corte_caja();
$lista = $corte->ventasPorDia($fecha);
$total = $corte->totalDelDia($fecha);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Corte de Caja</title>
    <link rel="stylesheet" href="../src/output.css">
</head>
<body>
    <main class="pt-20 px-4 pb-8">
        <div class="p-6">

            <div class="flex justify-between items-center mb-4">
                <h2 class="text-2xl font-bold">Corte de Caja por Día</h2>
            </div>

            <!-- FORM FECHA -->
            <form action="../controladores/corte_caja.php" method="POST" class="mb-4">
                <div class="flex items-center space-x-2">
                    <input type="date" name="fecha" value="<?= $fecha ?>" 
                        class="border px-3 py-2 rounded-lg">
                    <button class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg">
                        Buscar
                    </button>
                </div>
            </form>

            <!-- TABLA IGUAL A TU DISEÑO -->
            <div class="overflow-x-auto rounded-xl shadow">
                <table class="w-full text-left border-collapse">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="p-3 font-semibold">Usuario</th>
                            <th class="p-3 font-semibold">Fecha</th>
                            <th class="p-3 font-semibold">Total</th>
                            <th class="p-3 font-semibold">Estatus</th>
                        </tr>
                    </thead>

                    <tbody>
                    <?php foreach ($lista as $fila): ?>
                        <tr class="border-b hover:bg-gray-50">
                            <td class="p-3"><?= $fila["usuario"] ?></td>
                            <td class="p-3"><?= $fila["fecha"] ?></td>
                            <td class="p-3">$<?= number_format($fila["total"], 2) ?></td>
                            <td class="p-3">
                                <?php if ($fila["estatus"] == 0): ?>
                                    <span class="px-2 py-0.5 border border-green-500 text-green-700 rounded-full text-xs font-medium">Activo</span>
                                <?php else: ?>
                                    <span class="px-2 py-0.5 border border-red-500 text-red-700 rounded-full text-xs font-medium">Inactivo</span>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

            <!-- TOTAL DEL DIA -->
            <div class="mt-6 p-4 bg-gray-100 rounded-xl shadow text-lg">
                <strong>Total del día:</strong> 
                $<?= number_format($total["totalDia"] ?? 0, 2) ?>
            </div>

        </div>
    </main>
</body>
</html>
