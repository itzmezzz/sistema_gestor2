<?php 
class Venta_items {
    public $conexion;
    function __construct() {
        require_once('conexion.php');
        $this->conexion = new Conexion();
    }

    function guardar($venta_id, $producto_id, $cantidad, $subtotal){ 
        $consulta = "INSERT INTO venta_items (venta_id, producto_id, cantidad, subtotal, estatus) 
                     VALUES ({$venta_id}, {$producto_id}, {$cantidad}, {$subtotal}, 0)";
        return $this->conexion->query($consulta);
    }

    function mostrar(){
        $consulta = "SELECT vi.id, v.id AS venta_id, p.nombre AS producto,
                            vi.cantidad, vi.subtotal, vi.estatus
                     FROM venta_items vi 
                     JOIN ventas v ON vi.venta_id = v.id  
                     JOIN productos p ON vi.producto_id = p.id";
        return $this->conexion->query($consulta);
    }

    function eliminar($id){
        return $this->conexion->query("UPDATE venta_items SET estatus = 1 WHERE id = {$id}");
    }

    function activar($id){
        return $this->conexion->query("UPDATE venta_items SET estatus = 0 WHERE id = {$id}");
    }

    function actualizar($venta_id, $producto_id, $cantidad, $subtotal, $id){
        return $this->conexion->query("UPDATE venta_items 
                                       SET venta_id = {$venta_id}, producto_id = {$producto_id}, 
                                           cantidad = {$cantidad}, subtotal = {$subtotal}
                                       WHERE id = {$id}");
    }

    function buscarPorId($id){
        return $this->conexion->query("SELECT * FROM venta_items WHERE id = {$id}");
    }
    function eliminarPorVenta($venta_id) {
    $sql = "DELETE FROM venta_items WHERE venta_id = $venta_id";
    return $this->conexion->query($sql);
}
  function buscarPorVenta($venta_id)
{
    $sql = "SELECT vi.*, 
                   p.nombre AS producto, 
                   p.precio_venta AS precio_venta
            FROM venta_items vi
            INNER JOIN productos p ON p.id = vi.producto_id
            WHERE vi.venta_id = ?";

    $stmt = $this->conexion->prepare($sql);
    $stmt->bind_param("i", $venta_id);
    $stmt->execute();

    $resultado = $stmt->get_result();
    return $resultado->fetch_all(MYSQLI_ASSOC);
}
function detallesPorVenta($venta_id){
    $consulta = "
        SELECT vi.*, p.nombre AS producto
        FROM venta_items vi
        INNER JOIN productos p ON vi.producto_id = p.id
        WHERE vi.venta_id = $venta_id
    ";
    $respuesta = $this->conexion->query($consulta);
    return $respuesta;
}

}
?>
