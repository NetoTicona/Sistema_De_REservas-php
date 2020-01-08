<?php 
require "conexion.php";
Class ModeloBanner{
    /*  
    mostrar banner
    */
    static public function mdlMostrarBanner($tablaName){
        $stmt = Conexion::conectar() -> prepare("select * from $tablaName");
        $stmt -> execute();
        return $stmt -> fetchAll();
        $stmt -> close();
        $stmt = null;
    }
    
}


?>