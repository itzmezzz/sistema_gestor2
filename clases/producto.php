<?php 
class Producto {
    public $conexion;
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

    function obtenerStock($id) {
    $consulta = "SELECT stock FROM productos WHERE id = {$id} LIMIT 1";
    $resultado = $this->conexion->query($consulta);

    if ($resultado && $resultado->num_rows > 0) {
        $fila = $resultado->fetch_assoc();
        return intval($fila['stock']);
    }

    return 0;

    }
    function sumarStock($id, $cantidad) {
        $consulta = "UPDATE productos SET stock = stock + {$cantidad} WHERE id = {$id}";
        return $this->conexion->query($consulta);
    }
    public function restarStock($id, $cantidad) {
    // Validar valores
    if ($id <= 0 || $cantidad <= 0) {
        return false;
    }

    
    $sql = "UPDATE productos SET stock = stock - ? WHERE id = ?";

    $stmt = $this->conexion->prepare($sql);
    if (!$stmt) {
        return false;
    }

    $stmt->bind_param("ii", $cantidad, $id);
    return $stmt->execute();
}
   function mostrarActivas() {
    $consulta = "SELECT id, nombre, precio_venta FROM productos WHERE estatus = 0";
    $resultado = $this->conexion->query($consulta);

    // Si la consulta falló, devolver array vacío
    if (!$resultado) {
        return [];
    }

    $productos = [];

    // Si es un mysqli_result, convertimos a array
    if ($resultado instanceof mysqli_result) {
        while ($fila = $resultado->fetch_assoc()) {
            // Convertir precio a número
            $fila['precio_venta'] = (float) $fila['precio_venta'];
            $productos[] = $fila;
        }
    }

    return $productos; // Siempre retorna un array
}

}

?>