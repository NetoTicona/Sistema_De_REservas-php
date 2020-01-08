<?php 
 Class ControladorBanner{
     /*     
     Motrar BAnner
     */
    static public function ctrMostrarBanner(){
        $tabla = "banner";
        $respuesta = ModeloBanner::mdlMostrarBanner($tabla);
        return $respuesta;


    }
 }

?>