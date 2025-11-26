<?php 
class Venta {

    function __construct() {
        require_once('conexion.php');
        $this->conexion = new Conexion();
    }
    function guardar ($usuario_id, $total){
          $consulta = "INSERT INTO ventas (id, usuario_id, total, fecha , estatus) 
                        VALUES (null, {$usuario_id}, {$total}, NOW(), 0)";
          return $this->conexion->query($consulta);
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
     function actualizar($usuario_id, $total, $id){
       $consulta = "UPDATE ventas SET usuario_id = {$usuario_id}, total = {$total} WHERE id = {$id}";
       $respuesta = $this->conexion->query($consulta);
       return $respuesta;
     }
        function buscarPorId($id){
        $consulta = "SELECT * FROM ventas WHERE id = {$id}";
        $respuesta = $this->conexion->query($consulta);
        return $respuesta;
        }
    
}