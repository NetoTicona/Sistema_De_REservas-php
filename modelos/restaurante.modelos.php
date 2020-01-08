<?php 

require_once "conexion.php";
Class ModeloRestaurante{
    /*  
    mostrar Restaurante
    */
    static public function mdlMostrarRestaurante($tablaName){
        $stmt = Conexion::conectar() -> prepare("select * from $tablaName");
        $stmt -> execute();
        return $stmt -> fetchAll();
        $stmt -> close();
        $stmt = null;
    }
    
}


?>