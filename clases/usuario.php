<?php   
class Usuario {

    function __construct() {
        require_once('conexion.php');
        $this->conexion = new Conexion();
    }

   
    function guardar($usuario, $correo, $contraseña, $tipo) {

        // 1. Verificar si usuario o correo ya existen
        $consulta_existente = "
            SELECT id FROM usuario 
            WHERE usuario = '{$usuario}' OR correo = '{$correo}'
        ";

        $resultado = $this->conexion->query($consulta_existente);

        if ($resultado->num_rows > 0) {
            return "existe"; // <<< para que el controlador lo detecte
        }

        // 2. Insertar usuario
        $consulta = "
            INSERT INTO usuario (usuario, correo, contraseña, tipo, estatus)
            VALUES ('{$usuario}', '{$correo}', '{$contraseña}', {$tipo}, 0)
        ";

        return $this->conexion->query($consulta);
    }

    function login($correo, $contraseña) {

        $consulta = "SELECT * FROM usuario
                     WHERE (usuario='{$correo}' OR correo='{$correo}')
                     AND contraseña='{$contraseña}'";
        
        return $this->conexion->query($consulta);
    }

    
    function mostrar(){
        $consulta = "SELECT * FROM usuario";
        return $this->conexion->query($consulta);
    }

    function eliminar($id){
        $consulta = "UPDATE usuario SET estatus = 1 WHERE id = {$id}";
        return $this->conexion->query($consulta);
    }

    function activar($id){
        $consulta = "UPDATE usuario SET estatus = 0 WHERE id = {$id}";
        return $this->conexion->query($consulta);
    }

    function actualizar($usuario, $correo, $contraseña, $id){
        $consulta = "
            UPDATE usuario 
            SET usuario = '{$usuario}', 
                correo = '{$correo}', 
                contraseña = '{$contraseña}' 
            WHERE id = {$id}
        ";
        return $this->conexion->query($consulta);
    }

    function buscarPorId($id){
        $consulta = "SELECT * FROM usuario WHERE id = {$id}";
        return $this->conexion->query($consulta);
    }
}
?>
