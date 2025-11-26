<?php

class Categoria{
    //metodo constructor
    function __construct(){
        //se requiere una vez el archivo de conexion
        require_once('conexion.php');
        $this->conexion = new Conexion();

    }
    function guardar($nombre){
       $consulta = "INSERT INTO categorias (id, nombre, estatus) VALUES (null,  '{$nombre}', 0 )";

       $repuesta = $this->conexion->query($consulta);
       return $repuesta;
    }
    function mostrar(){
       $consulta = "SELECT * FROM  categorias";

       $repuesta = $this->conexion->query($consulta);
       return $repuesta;
    }
    function eliminar($id){
       $consulta = "UPDATE categorias SET estatus = 1 WHERE id = {$id}";
       $repuesta = $this->conexion->query($consulta);
       return $repuesta;
}
function activar($id){
       $consulta = "UPDATE categorias SET estatus = 0 WHERE id = {$id}";
       $respuesta = $this->conexion->query($consulta);
       return $respuesta;
}
    function actualizar($nombre, $id){
       $consulta = "UPDATE categorias SET nombre = '{$nombre}' WHERE id = {$id}";
       $respuesta = $this->conexion->query($consulta);
       return $respuesta;
    }
    function buscarPorId($id){
       $consulta = "SELECT * FROM categorias WHERE id = {$id}";
       $respuesta = $this->conexion->query($consulta);
       return $respuesta;
    }
    function mostrarActivas(){
    $consulta = "SELECT * FROM categorias WHERE estatus = 0";
    return $this->conexion->query($consulta);
}


}
?>