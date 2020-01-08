<?php 
require_once "conexion.php";
Class ModeloRecorrido{
    /*  
    mostrar Recorrido
    */
    static public function mdlMostrarRecorrido($tablaName){
        $stmt = Conexion::conectar() -> prepare("select * from $tablaName");
        $stmt -> execute();
        return $stmt -> fetchAll();
        $stmt -> close();
        $stmt = null;
    }
    
}


?>