<?php 
class Venta_items {

    function __construct() {
        require_once('conexion.php');
        $this->conexion = new Conexion();
    }


function guardar($venta_id, $producto_id, $cantidad, $precio_unitario, $subtotal){ 
     $consulta = "INSERT INTO venta_items(id,venta_id,producto_id,precio_unitario,subtotal,estatus) VALUES (null,{$venta_id},{$producto_id},{$cantidad},{$precio_unitario},{$subtotal},0)";
                   return $this->conexion->query($consulta);
    }
    function mostrar(){
        $consulta = "SELECT vi.id, v.id AS venta_id, p.nombre AS producto, vi.cantidad, vi.precio_unitario, vi.subtotal, vi.estatus
                     FROM venta_items vi 
                     JOIN ventas v ON vi.venta_id = v.id  
                     JOIN productos p ON vi.producto_id = p.id  
                     "; 
        $repuesta = $this->conexion->query($consulta);
             return $repuesta;
    }
}