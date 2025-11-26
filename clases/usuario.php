<?php   
class Usuario {

    function __construct() {
        require_once('conexion.php');
        $this->conexion = new Conexion();
    }

    function guardar($usuario, $correo, $contraseña) {
        //verificar si el usuario o correo ya existe
        $consulta_existente = "SELECT * FROM usuario WHERE usuario='{$usuario}' OR correo='{$correo}'";
        $resultado = $this->conexion->query($consulta_existente);
        if ($resultado->num_rows > 0) {
            return "existe";
        }
    $consulta = "INSERT INTO usuario(id, usuario, correo, contraseña, tipo, estatus) VALUES (null,'{$usuario}', '{$correo}', '{$contraseña}', 1, 0 )";
        return $this->conexion->query($consulta);
    }

    function login($usuario, $contraseña) {
        $consulta = "SELECT * FROM usuario WHERE (usuario='{$usuario}' OR correo='{$usuario}') AND contraseña='{$contraseña}'";
        return $this->conexion->query($consulta);
    }
    function mostrar(){
       $consulta = "SELECT * FROM usuario ";
       $repuesta = $this->conexion->query($consulta);
       return $repuesta;
    }
    function eliminar($id){
         $consulta = "UPDATE usuario SET estatus = 1 WHERE id = {$id}";
         $respuesta = $this->conexion->query($consulta);
       return $respuesta;
     }
    function activar($id){
       $consulta = "UPDATE usuario SET estatus = 0 WHERE id = {$id}";
       $respuesta = $this->conexion->query($consulta);
       return $respuesta;
}
    function actualizar($usuario, $correo, $contraseña, $id){
       $consulta = "UPDATE usuario SET usuario = '{$usuario}', correo = '{$correo}', contraseña = '{$contraseña}' WHERE id = {$id}";
       $respuesta = $this->conexion->query($consulta);
       return $respuesta;
    }
    function buscarPorId($id){
       $consulta = "SELECT * FROM usuario WHERE id = {$id}";
       $respuesta = $this->conexion->query($consulta);
       return $respuesta;
    }
}
?>
