<?php 
class Venta {
  public $conexion;
    function __construct() {
        require_once('conexion.php');
        $this->conexion = new Conexion();
    }
    function guardar ($usuario_id, $total){

        // Hacer el INSERT
        $consulta = "INSERT INTO ventas (usuario_id, total, fecha, estatus) 
                     VALUES ({$usuario_id}, {$total}, NOW(), 0)";
        $resultado = $this->conexion->query($consulta);
        // Verificar si se insertó correctamente
        if ($resultado) {
            return $this->conexion->insert_id; 
        } else {  
            return false;
        }
    }

    
    function mostrar(){
        $consulta = "SELECT v.id, u.usuario AS usuario, v.total, v.fecha, v.estatus
                     FROM ventas v 
                     JOIN usuario u ON v.usuario_id = u.id  
                     "; 
        $repuesta = $this->conexion->query($consulta);
             return $repuesta;
    }
    function eliminar($id){
         $consulta = "UPDATE ventas SET estatus = 1 WHERE id = {$id}";
         $respuesta = $this->conexion->query($consulta);
       return $respuesta;
     }
     function activar($id){
       $consulta = "UPDATE ventas SET estatus = 0 WHERE id = {$id}";
       $respuesta = $this->conexion->query($consulta);
       return $respuesta;
     }
     function actualizar($id_venta, $id_usuario, $totalVenta){
       $consulta = "UPDATE ventas SET usuario_id = {$id_usuario}, total = {$totalVenta} WHERE id = {$id_venta}";
       $respuesta = $this->conexion->query($consulta);
       return $respuesta; 
     }
     function buscarPorId($id)
{
    $sql = "SELECT * FROM ventas WHERE id = ?";
    $stmt = $this->conexion->prepare($sql);

    if (!$stmt) {
        return false;
    }

    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 0) {
        return false;
    }

    return $result->fetch_assoc();
}

      }
?>