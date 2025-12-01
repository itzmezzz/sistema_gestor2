<?php
session_start();
if (!isset($_SESSION['tipo'])) {
    header("Location: login.php");
    exit;
}

if (session_status() === PHP_SESSION_NONE) {
    
}
include'menu.php';
include('../clases/producto.php');
include('../clases/venta.php');
include('../clases/venta_items.php');

// validar ID
if (!isset($_GET['id']) || trim($_GET['id']) === '') {
    die("Error: falta el ID de la venta.");
}

$venta_id = intval($_GET['id']);  // <-- USAR SIEMPRE ESTE

// Buscar venta
$venta = new Venta();
$datos = $venta->buscarPorId($venta_id);
if (!$datos) {
    die("Error: no se encontró la venta.");
}

// Buscar items de la venta
$items = new Venta_items();
$items_venta = $items->buscarPorVenta($venta_id);

// Buscar productos
$producto = new Producto();
$lista_productos = $producto->mostrar();
if ($lista_productos instanceof mysqli_result) {
    $lista_productos = $lista_productos->fetch_all(MYSQLI_ASSOC);
}

// Definir variable para el formulario
$productos = $lista_productos;



?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <title>Editar Venta</title>
    <link rel="stylesheet" href="../src/output.css">
</head>
<body>

<main class="pt-20 px-4 pb-8">
    <div class="mx-auto py-8 max-w-4xl">

        <h1 class="text-3xl font-bold mb-8 mt-3">Editar Venta</h1>

        <form action="../controladores/actualizar_venta.php" method="POST" id="formVenta">

            <input type="hidden" name="id" value="<?= $datos['id'] ?>">
            <input type="hidden" name="id_usuario" value="<?= isset($_SESSION['idusuario']) ? $_SESSION['idusuario'] : '' ?>">

            <!-- TABLA -->
            <table class="w-full text-left border-collapse" id="tablaProductos">
                <thead>
                    <tr class="border-b bg-gray-100">
                        <th class="p-3">Producto</th>
                        <th class="p-3">Cantidad</th>
                        <th class="p-3">Precio</th>
                        <th class="p-3">Subtotal</th>
                        <th class="p-3">Acción</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($items_venta as $it): ?>
                    <tr>
                        <td class="p-2">
                            <select name="producto_id[]" class="producto w-full p-2 border rounded" required>
                                <option value="">Seleccione</option>
                                <?php foreach ($productos as $p): ?>
                                    <option value="<?= $p['id'] ?>"
                                            data-precio="<?= $p['precio_venta'] ?>"
                                            <?= $p['id'] == $it['producto_id'] ? 'selected' : '' ?>>
                                        <?= $p['nombre'] ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </td>

                        <td class="p-2">
                            <input type="number" name="cantidad[]" class="cantidad w-full p-2 border rounded"
                                   value="<?= $it['cantidad'] ?>" min="1" required>
                        </td>

                        <td class="p-2">
                            <input type="text" class="precio w-full p-2 border rounded"
                                   value="<?= number_format($it['precio_venta'], 2) ?>" readonly>
                        </td>

                        <td class="p-2">
                            <input type="text" name="subtotal[]" class="subtotal w-full p-2 border rounded"
                                   value="<?= number_format($it['subtotal'], 2) ?>" readonly>
                        </td>

                        <td class="p-2 text-center">
                            <button type="button" class="eliminar bg-red-600 text-white px-2 py-1 rounded">X</button>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>

            <!-- BOTÓN AÑADIR FILA -->
            <button type="button" id="agregarFila" class="bg-blue-600 text-white px-4 py-2 rounded mt-4">
                + Agregar producto
            </button>

            <!-- TOTAL -->
            <div class="mt-6 text-right">
                <label class="font-bold text-xl">Total: </label>
                <input type="text" id="totalVenta" name="total" 
                       class="p-2 border rounded w-40" 
                       value="<?= number_format($datos['total'], 2) ?>" readonly>
            </div>

            <!-- GUARDAR -->
            <div class="flex justify-center mt-4">
                <button type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-2 rounded-lg shadow-md transition">
                    Guardar Cambios
                </button>
            </div>
        </form>

    </div>
</main>

<script>
const productos = <?= json_encode($productos, JSON_HEX_TAG|JSON_HEX_AMP|JSON_HEX_APOS|JSON_HEX_QUOT) ?>;

// FUNCION AGREGAR FILA
document.getElementById("agregarFila").addEventListener("click", () => {
    const tbody = document.querySelector("#tablaProductos tbody");
    const fila = document.createElement("tr");

    fila.innerHTML = `
        <td class="p-2">
            <select name="producto_id[]" class="producto w-full p-2 border rounded" required>
                <option value="">Seleccione</option>
                ${productos.map(p => `<option value="${p.id}" data-precio="${p.precio_venta}">${p.nombre}</option>`).join("")}
            </select>
        </td>

        <td class="p-2">
            <input type="number" name="cantidad[]" class="cantidad w-full p-2 border rounded" min="1" required>
        </td>

        <td class="p-2">
            <input type="text" class="precio w-full p-2 border rounded" readonly>
        </td>

        <td class="p-2">
            <input type="text" name="subtotal[]" class="subtotal w-full p-2 border rounded" readonly>
        </td>

        <td class="p-2 text-center">
            <button type="button" class="eliminar bg-red-600 text-white px-2 py-1 rounded">X</button>
        </td>
    `;

    tbody.appendChild(fila);
});

// CALCULOS DINÁMICOS
document.addEventListener("input", e => {
    if (e.target.classList.contains("cantidad") || e.target.classList.contains("producto")) {
        const fila = e.target.closest("tr");
        const select = fila.querySelector(".producto");
        const cantidad = parseFloat(fila.querySelector(".cantidad").value) || 0;
        const precio = parseFloat(select.options[select.selectedIndex]?.dataset.precio) || 0;

        fila.querySelector(".precio").value = precio.toFixed(2);
        fila.querySelector(".subtotal").value = (precio * cantidad).toFixed(2);

        recalcularTotal();
    }
});

// ELIMINAR FILA
document.addEventListener("click", e => {
    if (e.target.classList.contains("eliminar")) {
        e.target.closest("tr").remove();
        recalcularTotal();
    }
});

// TOTAL
function recalcularTotal() {
    let total = 0;
    document.querySelectorAll(".subtotal").forEach(s => {
        total += parseFloat(s.value) || 0;
    });
    document.getElementById("totalVenta").value = total.toFixed(2);
}
</script>

</body>
</html>
