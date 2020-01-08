<?php 
 Class ControladorReservas{
     /*     
     Motrar Reservas
     */
    static public function ctrMostrarReservas( $valor ){
        $tabla1 = "habitaciones";
        $tabla2 = "reservas";
        $tabla3 = "categorias";
        $respuesta = ModeloReservas::mdlMostrarReservas($valor,$tabla1,$tabla2,$tabla3);
        return $respuesta;


    }


    static public function ctrMostrarCodigoReservas($codigo){
        $tabla = "reservas";
        //echo $tabla;
        $respuesta = ModeloReservas::mdlMostrarCodigoReserva($tabla,$codigo);
        return $respuesta;

    }

    /* metodo para enviar */
    static public function ctrGuardarReserva($valor){
        $tabla = "reservas";
        $respuesta = ModeloReservas::mdlGuardarReserva($tabla,$valor);
        if( $respuesta != "" )//la respuesta vien diferene a vacia , por que viene con un id
        {
            $tablaTestimonio = "testimonios"; //una variable que almacena la tabla testimoio
            $datos = array("id_res" => $respuesta,
						   "id_us" => $valor["id_usuario"],
						   "id_hab" => $valor["id_habitacion"],
						   "testimonio" => "",
                           "aprobado" => 0);
            $crearTestimonio = ModeloReservas::mdlCrearTestimonio( $tablaTestimonio,$datos );
            //deberiamos retornar un "ok" para q nmo malogre lasdemas funcionalidades
            return $crearTestimonio;               

        }


        //return $respuesta;
    }


    /* Mostrar reservas por usuario ara mostrar en perfil  */
    static public function ctrMostrarReservasUsuario($valor){

        $tabla = "reservas";
        //valor es e id del usuario

		$respuesta = ModeloReservas::mdlMostrarReservasUsuario($tabla, $valor);

		return $respuesta;
		
    }
    
    static public function ctrMostrarTestimonios($item, $valor){
        $tabla1 = "testimonios";
		$tabla2 = "habitaciones";
		$tabla3 = "reservas";
		$tabla4 = "usuarios";

        $respuesta = ModeloReservas::mdlMostrarTestimonios($tabla1, $tabla2, $tabla3, $tabla4, $item, $valor);
        //echo '<pre class="bg-white">'; print_r($respuesta) ; echo '</pre>';
        return $respuesta;
    }

    public function ctrActualizarTestimonio(){
        echo '<pre class="bg-white">'; print_r(  $_POST["actualizarTestimonio"] ) ; echo '</pre>';
        if(isset($_POST["actualizarTestimonio"])){
            $tabla = "testimonios";
            $datos = array("id_t"=>$_POST["idTestimonio"],
							   "testimonio"=>$_POST["actualizarTestimonio"]);

            $respuesta = ModeloReservas::mdlActualizarTestimonio($tabla, $datos);
            if($respuesta == "ok"){
                echo'<script>

							swal({
									type:"success",
								  	title: "¡CORRECTO!",
								  	text: "El testimonio ha sido actualizado correctamente",
								  	showConfirmButton: true,
									confirmButtonText: "Cerrar"
								  
							}).then(function(result){

									if(result.value){   
									    history.back();
									  } 
							});

						</script>';
            }
        } 

    }


 }//fin de calse controlador

?>