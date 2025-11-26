<?php 
class Producto {

    function __construct() {
        require_once('conexion.php');
        $this->conexion = new Conexion();
    }

   function guardar ($nombre, $descripcion, $color, $categoria_id, $precio_venta, $stock, $min_stock){
        $consulta = "INSERT INTO productos (id, nombre, descripcion, color, categoria_id, precio_venta, stock, min_stock, estatus) 
                     VALUES (null,'{$nombre}', '{$descripcion}', '{$color}', {$categoria_id}, {$precio_venta}, {$stock}, {$min_stock}, 0)";
        return $this->conexion->query($consulta);
   }
   function mostrar(){
       $consulta = "SELECT p.id, p.nombre, p.descripcion, p.color, c.nombre AS categoria, p.precio_venta, p.stock, p.min_stock, p.estatus
                    FROM productos p 
                    JOIN categorias c ON p.categoria_id = c.id  
                    "; 
       $repuesta = $this->conexion->query($consulta);
            return $repuesta;
   }
  function eliminar($id){
       $consulta = "UPDATE productos SET estatus = 1 WHERE id = {$id}";
       $respuesta = $this->conexion->query($consulta);
       return $respuesta;
    }
    function activar($id){
       $consulta = "UPDATE productos SET estatus = 0 WHERE id = {$id}";
       $respuesta = $this->conexion->query($consulta);
       return $respuesta;
    }

    function actualizar($nombre, $descripcion, $color, $categoria_id, $precio_venta, $stock, $min_stock, $id){
        $consulta = "UPDATE productos 
                     SET nombre = '{$nombre}', descripcion = '{$descripcion}', color = '{$color}', 
                         categoria_id = {$categoria_id}, precio_venta = {$precio_venta}, 
                         stock = {$stock}, min_stock = {$min_stock} 
                     WHERE id = {$id}";
        return $this->conexion->query($consulta);
    }
    function buscarPorId($id){
        $consulta = "SELECT * FROM productos WHERE id = {$id}";
        return $this->conexion->query($consulta);
    }
    function sumarStock($id, $cantidad) {
        $consulta = "UPDATE productos SET stock = stock + {$cantidad} WHERE id = {$id}";
        return $this->conexion->query($consulta);
    }
    function restarStock($id, $cantidad) {
        $consulta = "UPDATE productos SET stock = stock - {$cantidad} WHERE id = {$id}";
        return $this->conexion->query($consulta);
    }
    function mostrarActivas(){
    $consulta = "SELECT * FROM productos WHERE estatus = 0";
    return $this->conexion->query($consulta);
}

}

?>