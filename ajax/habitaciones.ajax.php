<?php 

require_once "../modelos/habitaciones.modelos.php";
require_once "../controladores/habitaciones.controlador.php";





class AjaxHabitaciones{
    public $ruta;
    public function ajaxTraerHabitacion(){ /* no se pueden tener paraetros */
        $valor = $this->ruta;
        $respuesta = ControladorHabitaciones::ctrMostrarHabitaciones($valor);
        echo json_encode($respuesta);


    }
}

if(isset( $_POST['ruta'] )){
    $ruta = new AjaxHabitaciones ; /* el metod no necesita static  ($ruts se huza el metodo y se desecha) */
    $ruta -> ruta = $_POST['ruta'] ;
    $ruta -> ajaxTraerHabitacion();
}

/* $ruta = AjaxHabitacion::ajaxTraerHabitacion();  */ /* necesita el metodo STATIC ($ruta se ejecuta en otras partes) */

?>