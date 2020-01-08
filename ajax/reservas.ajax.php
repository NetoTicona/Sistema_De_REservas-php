<?php 

require_once "../modelos/reservas.modelos.php";
require_once "../controladores/reservas.controlador.php";





class AjaxReservas{
    public $idHabitacion;
    public function ajaxTraerReserva(){ /* no se pueden tener paraetros */
        $valor = $this-> idHabitacion;
        $respuesta = ControladorReservas::ctrMostrarReservas($valor);
        echo json_encode($respuesta);


    }

   public $codigoReserva;
 public function ajaxTraerCodigoReserva(){ /* no se pueden tener paraetros */
        $codigo = $this-> codigoReserva;
        $respuest = ControladorReservas::ctrMostrarCodigoReservas($codigo);
        echo json_encode($respuest);


    }

    public $id_h;
    public function ajaxTraerTestimonios(){
        $item = "id_hab";
        $valor = $this -> id_h;
        $respuesta = ControladorReservas :: ctrMostrarTestimonios($item,$valor);

        echo json_encode($respuesta);
    }




}


if(isset( $_POST['idHabitacion'] )){
    $idHabitacion = new AjaxReservas ; /* el metod no necesita static  ($ruts se huza el metodo y se desecha) */
    $idHabitacion -> idHabitacion = $_POST['idHabitacion'] ; /* aigmacion a la propiedad publica idHabitacion */
    $idHabitacion -> ajaxTraerReserva();
}

/* $idHabitacion = AjaxHabitacion::ajaxTraerHabitacion();  */ /* necesita el metodo STATIC ($ruta se ejecuta en otras partes) */

/* --------- TRAER RESERVA ATRAVEZ DE CODIGO ALETORIA GENERADO------ */



if(isset( $_POST['codigoReserva'] )){
    $codigoReserva = new AjaxReservas ; /* el metod no necesita static  ($ruts se huza el metodo y se desecha) */
    $codigoReserva -> codigoReserva = $_POST['codigoReserva'] ; /* aigmacion a la propiedad publica codigoReserva */
    $codigoReserva -> ajaxTraerCodigoReserva();
}


/*=============================================
Traer Testimonios
=============================================*/

if(isset($_POST["id_h"])){

	$id_h = new AjaxReservas();
	$id_h -> id_h = $_POST["id_h"];
	$id_h -> ajaxTraerTestimonios();

}





?>
