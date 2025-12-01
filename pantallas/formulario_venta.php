<?php
session_start();
 if (!isset($_SESSION['tipo'])) {
    header("Location: login.php");
    exit;
}

if (session_status() === PHP_SESSION_NONE) {
    
}

include 'menu.php';
include('../clases/producto.php');

// Obtener productos activos de forma segura
$clase = new Producto();
$productos = $clase->mostrarActivas();


// Si mostrarActivas devolvió un mysqli_result o null, convertimos a array
if ($productos instanceof mysqli_result) {
    $productos_arr = $productos->fetch_all(MYSQLI_ASSOC);
    $productos = $productos_arr;
} elseif (!is_array($productos)) {
    // forzamos array vacío si algo raro pasó
    $productos = [];
}

// Opcional (temporal) debug — descomenta para inspeccionar
// echo '<pre>'; var_dump($productos); echo '</pre>'; exit;

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <title>Ventas</title>
    <link rel="stylesheet" href="../src/output.css">
</head>
<body>

<main class="pt-20 px-4 pb-8">
    <div class="mx-auto py-8 max-w-4xl">

        <h1 class="text-3xl font-bold mb-8 mt-3">Registrar Venta</h1>

        <form action="../controladores/insertar_venta.php" method="POST" id="formVenta">
            <input type="hidden" name="id_usuario" value="<?= isset($_SESSION['idusuario']) ? $_SESSION['idusuario'] : '' ?>">

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
                <tbody></tbody>
            </table>

            <button type="button" id="agregarFila" class="bg-blue-600 text-white px-4 py-2 rounded mt-4">
                + Agregar producto
            </button>

            <div class="mt-6 text-right">
                <label class="font-bold text-xl">Total: </label>
                <input type="text" id="totalVenta" name="total" class="p-2 border rounded w-40" readonly>
            </div>

            <div class="flex justify-center mt-4">
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-2 rounded-lg shadow-md transition"> Guardar</button>
            </div>
        </form>

    </div>
</main>

<script>
// pasar productos a JS de forma segura
const productos = <?= json_encode($productos, JSON_HEX_TAG|JSON_HEX_AMP|JSON_HEX_APOS|JSON_HEX_QUOT) ?>;

// añadir fila
document.getElementById("agregarFila").addEventListener("click", () => {
    const tbody = document.querySelector("#tablaProductos tbody");
    const fila = document.createElement("tr");

    fila.innerHTML = `
        <td class="p-2">
            <select name="producto_id[]" class="producto w-full p-2 border rounded" required>
                <option value="">Seleccione</option>
                ${productos.map(p => `
                    <option value="${p.id}" data-precio="${p.precio_venta}">
                        ${p.nombre}
                    </option>`).join("")}
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

// cálculo dinámico y eliminación (igual que antes)
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

document.addEventListener("click", e => {
    if (e.target.classList.contains("eliminar")) {
        e.target.closest("tr").remove();
        recalcularTotal();
    }
});

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
