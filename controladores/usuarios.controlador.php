<?php 

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

Class ControladorUsuarios{

    public function ctrRegistroUsuario(){
        //cuando ej cuando en otro lgar invocamos de sgte foraçma
        // $reservas = ControladorHabitaciones:::ctrMostrarHabitaciones($valor)
        // Aqui si deveriamo poner al metodo "static"

        //en nuestro caso lo estamos llmando de la sigte forma:
        //    	$registroUsuario = new ControladorUsuarios();
        //    	$registroUsuario -> ctrRegistroUsuario();
        // En este caso no necesita;

        if( isset( $_POST["registroNombre"] )){ //solo es el primer dato del form 
            if(preg_match('/^[a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["registroNombre"]) &&
            preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/', $_POST["registroEmail"]) &&
             preg_match('/^[a-zA-Z0-9]+$/', $_POST["registroPassword"])
             ){
                    $encriptarPassword = crypt( $_POST["registroPassword"],'$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$'  ); // esa cosa e el salt

                    $encriptarEmail = md5($_POST["registroEmail"]);
                    $tabla = "usuarios";

                     $datos = array( 
                         "nombre" => $_POST["registroNombre"],
                         "password" => $encriptarPassword,
                         "email" => $_POST["registroEmail"],
                         "foto" => "asd" ,//vacio por que es directo;
                         "modo" => "direccto",
                         "verificacion" => 0,
                         "email_encrip" =>  $encriptarEmail
                     );//fin del array
                      $respuesta = ModeloUsuarios::mdlRegistroUsuario($tabla,$datos);//pedimos q en la tabla usuarios me registrew los datos;
                      echo '<pre class="bg-white">'; print_r( $respuesta ) ; echo '</pre>';
                    
                      if($respuesta == "ok")
                      {

                      
                         echo "Usuario registrado con exito";


                            date_default_timezone_set("America/Lima");

                            $ruta = ControladorRuta::ctrRuta();
                            echo $ruta;

                            $mail = new PHPMailer(true);
        
                            $mail->CharSet = 'UTF-8';
        
                            $mail->isMail();
        
                            $mail->setFrom('cursos@tutorialesatualcance.com', 'Tutoriales a tu Alcance');
        
                            $mail->addReplyTo('cursos@tutorialesatualcance.com', 'Tutoriales a tu Alcance');
        
                            $mail->Subject = "Por favor verifique su dirección de correo electrónico";
        
                            $mail->addAddress($_POST["registroEmail"]); 
                            $mail -> msgHTML('


                            <div style="width:100%; background:#eee; position:relative; font-family:sans-serif; padding-bottom:40px">
                        
                                <center>
                                    
                                    <img style="padding:20px; width:10%" src="https://tutorialesatualcance.com/tienda/logo.png">
                        
                                </center>
                        
                                <div style="position:relative; margin:auto; width:600px; background:white; padding:20px">
                                    
                                    <center>
                        
                                        <img style="padding:20px; width:15%" src="https://tutorialesatualcance.com/tienda/icon-email.png">
                        
                                        <h3 style="font-weight:100; color:#999">VERIFIQUE SU DIRECCIÓN DE CORREO ELECTRÓNICO</h3>
                        
                                        <hr style="border:1px solid #ccc; width:80%">
                        
                                        <h4 style="font-weight:100; color:#999; padding:0 20px">Para comenzar a usar su cuenta, debe confirmar su dirección de correo electrónico</h4>
                        
                                        <a href="'.$ruta.$encriptarEmail.'" target="_blank" style="text-decoration:none">
                                            
                                            <div style="line-height:60px; background:#0aa; width:60%; color:white">Verifique su dirección de correo electrónico</div>
                        
                                        </a>
                        
                                        <br>
                        
                                        <hr style="border:1px solid #ccc; width:80%">
                        
                                        <h5 style="font-weight:100; color:#999">Si no se inscribió en esta cuenta, puede ignorar este correo electrónico y la cuenta se eliminará.</h5>
                        
                        
                                    </center>
                        
                        
                                </div>
                        
                            </div>');

                            $envio = $mail->Send();

                            if(!$envio)
                            {

                            echo'<script>

                                        swal({
                                                    type:"error",
                                                    title: "¡ERROR!",
                                                    text: "¡Ha ocurrido un problema enviando verificación de correo electrónico a '.$_POST["registroEmail"] .$mail->ErrorInfo .' , por favor inténtelo nuevamente",
                                                    showConfirmButton: true,
                                                    confirmButtonText: "Cerrar"
                                                
                                            }).then(function(result){

                                                    if(result.value){   
                                                        history.back();
                                                    } 
                                            });

                                </script>';

                            }else{


                                echo'<script>
        
                                    swal({
                                            type:"success",
                                              title: "¡SU CUENTA HA SIDO CREADA CORRECTAMENTE!",
                                              text: "¡Por favor revise la bandeja de entrada o la carpeta de SPAM de su correo electrónico para verificar la cuenta!",
                                              showConfirmButton: true,
                                            confirmButtonText: "Cerrar"
                                          
                                    }).then(function(result){
        
                                            if(result.value){   
                                                history.back();
                                              } 
                                    });
        
                                </script>';
        
                            }

                      }//if(respuesta == "ok")
                      
                }// preg-Match
                else
                {

                    echo'<script>

                    swal({
                            type:"error",
                            title: "¡CORREGIR!",
                            text: "¡No se permiten caracteres especiales!",
                            showConfirmButton: true,
                            confirmButtonText: "Cerrar"
                        
                    }).then(function(result){

                            if(result.value){   
                                history.back();
                            } 
                    });

                    </script>';
                }

          

        }//if(isset( $_POST["registro....

    }




    static public function ctrMostrarUsuario($item,$valor){
        $tabla = "usuarios";

        $rpta = ModeloUsuarios::mdlMostrarUsuario( $tabla, $item ,$valor  );

       
        return $rpta;
    }

    static public function ctrActualizarUsuario($id,$item,$valor){
        $tabla = "usuarios";

        $respuesta = ModeloUsuarios::mdlActualizarUsuario( $tabla,$id,$item,$valor );
        return $respuesta;
    }


     public  function ctrIngresoUsuario(){
         if( isset( $_POST["ingresoDirEmail"] ) ){

            if( preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/', $_POST["ingresoDirEmail"]) &&
            preg_match('/^[a-zA-Z0-9]+$/', $_POST["ingresoDirContrasena"] )){

                $encriptarPassword = crypt( $_POST["ingresoDirContrasena"]  , '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$' );

                $tabla = 'usuarios';
                $item = "email";
                $valor = $_POST["ingresoDirEmail"];

                $respuesta = ModeloUsuarios::mdlMostrarUsuario( $tabla, $item ,$valor  );
                
                if( $respuesta["email"] == $_POST["ingresoDirEmail"] && $respuesta["contrasena"] == $encriptarPassword ){
                    //poemos ingresar al sistema
                    //ahora vamo apreguntar por la clumn verificaoin;
                    if($respuesta["verificacion"]==0){
                        echo'<script>

                            swal({
                                    type:"error",
                                    title: "¡Alerta de verificaion!",
                                    text: "¡Por favor revise su correo para confirmar",
                                    showConfirmButton: true,
                                    confirmButtonText: "Cerrar"
                                
                            }).then(function(result){

                                    if(result.value){   
                                        history.back();
                                    } 
                            });

                            </script>';
                            return;

                    }else{

                        $_SESSION["validarSesion"]="ok";
                        $_SESSION["id"] = $respuesta["id_u"];
                        $_SESSION["nombre"] = $respuesta["nombre"];
                        $_SESSION["foto"] = $respuesta["foto"];
						$_SESSION["email"] = $respuesta["email"];
						$_SESSION["modo"] = $respuesta["modo"];


                         //el siguente eco nos mandara la pagnadel perfil.
                         $ruta = ControladorRuta::ctrRuta();
                         echo' <script>
                                window.location = "'.$ruta.'perfil"
                              </script>';
                    }


                }else{
                    //no coincide el email o la contraseña
                    echo'<script>

                swal({
                        type:"error",
                        title: "¡Vaya!",
                        text: "¡La contraseña o el email no esta registrado o no coincide!",
                        showConfirmButton: true,
                        confirmButtonText: "Cerrar"
                    
                }).then(function(result){

                        if(result.value){   
                            history.back();
                        } 
                });

                </script>';
                }



            }else{

                echo'<script>

                swal({
                        type:"error",
                        title: "¡CORREGIR!",
                        text: "¡No se permiten caracteres especiales!",
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


     /* Resgitrocon redes sociales */

     static public function ctrRegistrarRedesSociales($datos){
         //verificamos que el usuario no esxuta en BD.
          $tabla = "usuarios";
          $item = "email";
          $valor = $datos["email"];
          $emailRepetido = false;

          $verificarExixtenciaUsuario = ModeloUsuarios::mdlMostrarUsuario( $tabla ,$item,$valor);
          if($verificarExixtenciaUsuario){
              //es repetido el email
            $emailRepetido = true;
          }else{
              //el email no es repetido osea no exixte, 
              //hacemo e registr de usuarios
              $registrarUsuario = ModeloUsuarios :: mdlRegistroUsuario($tabla,$datos);
          }

          if($emailRepetido || $registrarUsuario == 'ok' )
          {
              //veriicaion si el correo fue ingresado por metodo facebuk
              $traerUsuario = ModeloUsuarios::mdlMostrarUsuario($tabla,$item,$valor);
              //echo '<pre class="bg-white">'; print_r($traerUsuario) ; echo '</pre>';

               if( $traerUsuario['modo'] == 'facebook' ){
                   session_start();

                $_SESSION["validarSesion"]="ok";
                $_SESSION["id"] = $traerUsuario["id_u"];
                $_SESSION["nombre"] = $traerUsuario["nombre"];
                $_SESSION["foto"] = $traerUsuario["foto"];
                $_SESSION["email"] = $traerUsuario["email"];
                $_SESSION["modo"] = $traerUsuario["modo"];
               // echo '<pre class="bg-white">'; print_r( $_SESSION["validarSesion"] ) ; echo '</pre>';

                   return "okey";

               } else if($traerUsuario['modo']== 'google'){

                $_SESSION["validarSesion"]="ok";
                $_SESSION["id"] = $traerUsuario["id_u"];
                $_SESSION["nombre"] = $traerUsuario["nombre"];
                $_SESSION["foto"] = $traerUsuario["foto"];
                $_SESSION["email"] = $traerUsuario["email"];
                $_SESSION["modo"] = $traerUsuario["modo"];

                return "okey";
               }else{
                   return 'otro metodo';
               }
          }
     }

     /* Metodo pat Acctualixfoto */
     public function ctrCambiarFotoPerfil(){

		if(isset($_POST["idUsuarioFoto"])){

			$ruta = "backend/".$_POST["fotoActual"];

			if(isset($_FILES["cambiarImagen"]["tmp_name"]) && !empty($_FILES["cambiarImagen"]["tmp_name"])){

				list($ancho, $alto) = getimagesize($_FILES["cambiarImagen"]["tmp_name"]);

				$nuevoAncho = 500;
				$nuevoAlto = 500;

				/*=============================================
				CREAMOS EL DIRECTORIO DONDE VAMOS A GUARDAR LA FOTO DEL USUARIO
				=============================================*/

				$directorio = "backend/vistas/img/usuarios/".$_POST["idUsuarioFoto"];

				/*=============================================
				PRIMERO PREGUNTAMOS SI EXISTE OTRA IMAGEN EN LA BD
				=============================================*/

				if($ruta != ""){
					
					unlink($ruta);

				}else{

					if(!file_exists($directorio)){	

						mkdir($directorio, 0755);

					}

				}

				/*=============================================
				DE ACUERDO AL TIPO DE IMAGEN APLICAMOS LAS FUNCIONES POR DEFECTO DE PHP
				=============================================*/

				if($_FILES["cambiarImagen"]["type"] == "image/jpeg"){

					$aleatorio = mt_rand(100,999);

					$ruta = $directorio."/".$aleatorio.".jpg";

					$origen = imagecreatefromjpeg($_FILES["cambiarImagen"]["tmp_name"]);

					$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);	

					imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

					imagejpeg($destino, $ruta);	

				}

				else if($_FILES["cambiarImagen"]["type"] == "image/png"){

					$aleatorio = mt_rand(100,999);

					$ruta = $directorio."/".$aleatorio.".png";

					$origen = imagecreatefrompng($_FILES["cambiarImagen"]["tmp_name"]);						

					$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

					imagealphablending($destino, FALSE);
		
					imagesavealpha($destino, TRUE);

					imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

					imagepng($destino, $ruta);

				}else{

					echo'<script>

						swal({
								type:"error",
							  	title: "¡CORREGIR!",
							  	text: "¡No se permiten formatos diferentes a JPG y/o PNG!",
							  	showConfirmButton: true,
								confirmButtonText: "Cerrar"
							  
						}).then(function(result){

								if(result.value){   
								    history.back();
								  } 
						});

					</script>';


				}

				$ruta = substr($ruta, 8);	

			}

			$tabla = "usuarios";
			$id = $_POST["idUsuarioFoto"];
			$item = "foto";
			$valor = $ruta;

			$actualizarFotoPerfil = ModeloUsuarios::mdlActualizarUsuario($tabla, $id, $item, $valor);

			if($actualizarFotoPerfil == "ok"){

				echo '<script>

					swal({
						type:"success",
					  	title: "¡CORRECTO!",
					  	text: "¡La foto de perfil ha sido actualizada!",
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
    
    public function ctrCambiarPassword(){
        if( isset( $_POST["editarPassword"] ) ) //este metdo e dispara cuando hay una variable POST
        {//verfifcaion de que no haya una inyeccion 
            if(preg_match('/^[^0-9][a-zA-Z0-9_]+$/', $_POST["editarPassword"])){

                $encriptar = crypt( $_POST["editarPassword"]  , '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');
                $tabla = "usuarios";
                $id = $_POST["idUsuarioPassword"];
                $item = "contrasena";
                $valor = $encriptar;

                $actualizarPassword = ModeloUsuarios::mdlActualizarUsuario($tabla, $id, $item, $valor);
                if($actualizarPassword  == "ok"){
                    echo '<script>

					swal({
						type:"success",
					  	title: "¡CORRECTO!",
					  	text: "¡La contraeña ha sido actualizada!",
					  	showConfirmButton: true,
						confirmButtonText: "Cerrar"
					  
					}).then(function(result){

							if(result.value){   
							    history.back();
							  } 
					});

				</script>';

                }

            }else{


                        echo'<script>

                            swal({
                                type:"error",
                                title: "¡CORREGIR!",
                                text: "¡No se permiten caracteres especiales!",
                                showConfirmButton: true,
                                confirmButtonText: "Cerrar"
                            
                            }).then(function(result){

                                    if(result.value){   
                                        history.back();
                                    } 
                            });

                        </script>';
            
            }//preg match
                
        }//fion isset
    }//fin metfo contrasseña



    /* FUNCION DE RECUPERAR LA CONTRASÑA OLVIDADA */
    public function ctrRecuperarPassword(){

    echo '<pre class="bg-white">'; print_r( $_POST["emailRecuperarPassword"] ) ; echo '</pre>';
     
    if(isset($_POST["emailRecuperarPassword"])){

        if(preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/', $_POST["emailRecuperarPassword"])){


                    function generarPassword( $longitud ){
                        $password = "";
                        $patron = "1234567890abcdefghijklmnopqrstuvwxyz";
                        $max = strlen($patron)-1;
                        for( $i = 0; $i < $longitud ; $i++ ){
                            $password = $password.$patron{mt_rand(0,$max)};

                        }

                        return $password;
                    }

                    $nuevaPassword = generarPassword(11);
                    $encriptar = crypt($nuevaPassword, '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

                    $tabla = "usuarios";
                    $item = "email";
                    $valor = $_POST["emailRecuperarPassword"];

                    $traerUsuario = ModeloUsuarios::mdlMostrarUsuario($tabla, $item, $valor);

                    if($traerUsuario){
                        $id = $traerUsuario["id_u"];
					    $item = "contrasena";
					    $valor = $encriptar;

                        $actualizarPassword = ModeloUsuarios::mdlActualizarUsuario($tabla, $id, $item, $valor);
                       

                        if( $actualizarPassword == 'ok' )
                        {
                                /*=============================================
                                VERIFICACIÓN CORREO ELECTRÓNICO
                                =============================================*/

                                date_default_timezone_set("America/Bogota");

                                $ruta = ControladorRuta::ctrRuta();

                                $mail = new PHPMailer;

                                $mail->CharSet = 'UTF-8';

                                $mail->isMail();

                                $mail->setFrom('cursos@tutorialesatualcance.com', 'Tutoriales a tu Alcance');

                                $mail->addReplyTo('cursos@tutorialesatualcance.com', 'Tutoriales a tu Alcance');

                                $mail->Subject = "Por favor verifique su dirección de correo electrónico";

                                $mail->addAddress($_POST["emailRecuperarPassword"]);

                                $mail->msgHTML('<div style="width:100%; background:#eee; position:relative; font-family:sans-serif; padding-bottom:40px">
            
                                    <center>
                                        
                                        <img style="padding:20px; width:10%" src="https://tutorialesatualcance.com/tienda/logo.png">

                                    </center>

                                    <div style="position:relative; margin:auto; width:600px; background:white; padding:20px">
                                    
                                        <center>
                                        
                                        <img style="padding:20px; width:15%" src="https://tutorialesatualcance.com/tienda/icon-pass.png">

                                        <h3 style="font-weight:100; color:#999">SOLICITUD DE NUEVA CONTRASEÑA</h3>

                                        <hr style="border:1px solid #ccc; width:80%">

                                        <h4 style="font-weight:100; color:#999; padding:0 20px"><strong>Su nueva contraseña: </strong>'.$nuevaPassword.'</h4>

                                        <a href="'.$ruta.'" target="_blank" style="text-decoration:none">

                                        <div style="line-height:30px; background:#0aa; width:60%; padding:20px; color:white">			
                                            Haz click aquí
                                        </div>

                                        </a>

                                        <h4 style="font-weight:100; color:#999; padding:0 20px">Ingrese nuevamente al sitio con esta contraseña y recuerde cambiarla en el panel de perfil de usuario</h4>

                                        <br>

                                        <hr style="border:1px solid #ccc; width:80%">

                                        <h5 style="font-weight:100; color:#999">Si no se inscribió en esta cuenta, puede ignorar este correo electrónico y la cuenta se eliminará.</h5>

                                        </center>

                                    </div>

                                </div>');

                                $envio = $mail->Send();
                                echo '<pre class="bg-white">'; print_r( $envio ) ; echo '</pre>';             
                                if(!$envio){

                                    echo'<script>
        
                                        swal({
                                                type:"error",
                                                  title: "¡ERROR!",
                                                  text: "¡Ha ocurrido un problema enviando verificación de correo electrónico a '.$_POST["emailRecuperarPassword"].$mail->ErrorInfo.', por favor inténtelo nuevamente",
                                                  showConfirmButton: true,
                                                confirmButtonText: "Cerrar"
                                              
                                        }).then(function(result){
        
                                                if(result.value){   
                                                    history.back();
                                                  } 
                                        });
        
                                    </script>';
        
                                }else{
                                    echo'<script>

                                    swal({
                                        type:"success",
                                        title: "¡SU SOLICITUD HA SIDO RECIBIDA!",
                                        text: "¡Por favor revise la bandeja de entrada o la carpeta de SPAM de su correo electrónico '.$_POST["emailRecuperarPassword"].' para su cambio de contraseña!",
                                        showConfirmButton: true,
                                        confirmButtonText: "Cerrar"
                                    
                                    }).then(function(result){

                                            if(result.value){   
                                                history.back();
                                            } 
                                    });

                                    </script>';

						        }

                        }//actualizar es verdadero?




                    }else{
                        //no existe ese correo
                        echo '<script>

						swal({
							type:"error",
						  	title: "¡ERROR!",
						  	text: "¡El correo no existe en el sistema, puede registrase nuevamente con ese correo!",
						  	showConfirmButton: true,
							confirmButtonText: "Cerrar"
						  
						}).then(function(result){

								if(result.value){   
								    history.back();
								  } 
						});

					                                                                                                                            </script>';

                    }


                }else{
                        echo'<script>

                                swal({
                                    type:"error",
                                    title: "¡CORREGIR!",
                                    text: "¡No se permiten caracteres especiales!",
                                    showConfirmButton: true,
                                    confirmButtonText: "Cerrar"
                                
                                }).then(function(result){

                                        if(result.value){   
                                            history.back();
                                        } 
                                });

                            </script>';

                    }//fin else

        }//fin isset Email-...    
       
    }//fin fucion de recup


    public function ctrFormularioContactenos(){

		if(isset($_POST["mensajeContactenos"])){

			if( preg_match('/^[a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nombreContactenos"]) &&
				preg_match('/^[a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["apellidoContactenos"]) &&
				preg_match('/^[0-9- ]+$/', $_POST["movilContactenos"]) &&
			    preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/', $_POST["emailContactenos"]) 
			 ){
				
				/*=============================================
				VERIFICACIÓN CORREO ELECTRÓNICO
				=============================================*/

				date_default_timezone_set("America/Bogota");

				$ruta = ControladorRuta::ctrRuta();

				$mail = new PHPMailer;

				$mail->CharSet = 'UTF-8';

				$mail->isMail();

				$mail->setFrom('cursos@tutorialesatualcance.com', 'Tutoriales a tu Alcance');

				$mail->addReplyTo('cursos@tutorialesatualcance.com', 'Tutoriales a tu Alcance');

				$mail->Subject = "Por favor verifique su dirección de correo electrónico";

				$mail->addAddress("tucorreo@tudominio.com");

				$mail->msgHTML('<div style="width:100%; background:#eee; position:relative; font-family:sans-serif; padding-bottom:40px">
	
						<center>

							<img style="padding:20px; width:10%" src="https://tutorialesatualcance.com/tienda/logo.png">

						</center>

						<div style="position:relative; margin:auto; width:600px; background:white; padding-bottom:20px">

							<center>
								
								<img style="padding:20px; width:15%" src="https://tutorialesatualcance.com/tienda/icon-email.png">

								<h3 style="font-weight:100; color:#999;">HA RECIBIDO UNA CONSULTA</h3>

								<hr style="width:80%; border:1px solid #ccc">

								<h4 style="font-weight:100; color:#999; padding:0px 20px; text-transform:uppercase">'.$_POST["nombreContactenos"].' '.$_POST["apellidoContactenos"].'</h4>
								<h4 style="font-weight:100; color:#999; padding:0px 20px;">Móvil: '.$_POST["movilContactenos"].'</h4>
								<h4 style="font-weight:100; color:#999; padding:0px 20px;">Email: '.$_POST["emailContactenos"].'</h4>
								<h4 style="font-weight:100; color:#999; padding:0px 20px">'.$_POST["mensajeContactenos"].'</h4>

								<hr style="width:80%; border:1px solid #ccc">

							</center>

						</div>
						
					</div>
				');

				$envio = $mail->Send();

				if(!$envio){

					echo'<script>

						swal({
								type:"error",
							  	title: "¡ERROR!",
							  	text: "¡Ha ocurrido un problema enviando el mensaje, vuelva a intentarlo!",
							  	showConfirmButton: true,
								confirmButtonText: "Cerrar"
							  
						}).then(function(result){

								if(result.value){   
								    history.back();
								  } 
						});

					</script>';

				}else{


					echo'<script>

							swal({
								 	type: "success",
							  		title: "¡OK!",
							  		text: "¡Su mensaje ha sido enviado, muy pronto le responderemos!",					 
									showConfirmButton: true,
									confirmButtonText: "Cerrar"
								
								}).then(function(result){

									if(result.value){
										history.back();
									}
							});

					</script>';

				}	


			}else{


				echo '<script>

					swal({
					 		type:"error",
							title: "¡ERROR!",
						  	text: "¡Problemas al enviar el mensaje, revise que no tenga caracteres especiales!",
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



    
    }//fin de la clase

   












?>