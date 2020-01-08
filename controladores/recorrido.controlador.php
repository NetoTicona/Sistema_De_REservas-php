<?php 
 Class ControladorRecorrido{
     /*     
     Motrar Recorrido
     */
    static public function ctrMostrarRecorrido(){
        $tabla = "recorrido";
        $respuesta = ModeloRecorrido::mdlMostrarRecorrido($tabla);
        return $respuesta;


    }
 }

?>