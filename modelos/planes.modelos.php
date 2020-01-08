<?php 

require_once "conexion.php";
Class ModeloPlanes{
    /*  
    mostrar banner
    */
    static public function mdlMostrarPlanes($tablaName){
        $stmt = Conexion::conectar() -> prepare("select * from $tablaName");
        $stmt -> execute();
        return $stmt -> fetchAll();
        $stmt -> close();
        $stmt = null;
    }
    
}


?>