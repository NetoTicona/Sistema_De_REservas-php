<?php 
 Class ControladorRestaurante{
     /*     
     Motrar Restaurante
     */
    static public function ctrMostrarRestaurante(){
        $tabla = "restaurante";
        $respuesta = ModeloRestaurante::mdlMostrarRestaurante($tabla);
        return $respuesta;


    }
 }

?>