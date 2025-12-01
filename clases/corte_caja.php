<?php

class Corte_Caja{
    //metodo constructor
    function __construct(){
        //se requiere una vez el archivo de conexion
        require_once('conexion.php');
        $this->conexion = new Conexion();

    }
    public function ventasPorDia($fecha) {
        $consulta = "
            SELECT v.id, u.usuario, v.fecha, v.total, v.estatus
            FROM ventas v
            INNER JOIN usuario u ON v.usuario_id = u.id
            WHERE DATE(v.fecha) = '$fecha'
            ORDER BY v.fecha ASC
        ";
        $respuesta = $this->conexion->query($consulta);
        return $respuesta;
    }

    //  Obtener total del día
    public function totalDelDia($fecha) {
        $consulta = "
            SELECT SUM(total) AS totalDia
            FROM ventas
            WHERE DATE(fecha) = '$fecha' AND estatus = 0
        ";
        $respuesta = $this->conexion->query($consulta);
        return $respuesta->fetch_assoc();
    }
}
?>
