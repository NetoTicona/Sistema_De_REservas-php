<?php 
class ControladorHabitaciones{
/* Mosrar categorias hbitacibes con iner join */

static public function ctrMostrarHabitaciones($valor){
    $tabla1 = "categorias";
    $tabla2 = "habitaciones";

    $respuestas = ModeloHabitaciones:: mdlMostrarHabitaciones($tabla1,$tabla2,$valor);
    return $respuestas;
}


	
	static public function ctrMostrarHabitacion($valor){

		$tabla = "habitaciones";

		$respuesta = ModeloHabitaciones::mdlMostrarHabitacion($tabla, $valor);

		return $respuesta;

	}


}





?>