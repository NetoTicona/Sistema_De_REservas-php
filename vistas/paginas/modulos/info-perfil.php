
<?php 
$item = "id_u";
$valor = $_SESSION["id"];

$usuario = ControladorUsuarios::ctrMostrarUsuario($item, $valor);

$reservas = ControladorReservas::ctrMostrarReservasUsuario($valor);
//echo '<pre class="bg-white">'; print_r($reservas) ; echo '</pre>'
$hoy = date("Y-m-d");
$noVencidas = 0;
$vencidas = 0;

foreach ($reservas as $key => $value) {
	if( $hoy = $value["fecha_ingreso"] ){
		 $vencidas++;
	}else{
		$noVencidas++;
	}
}

?>




<!--=====================================
INFO PERFIL
======================================-->

<div class="infoPerfil container-fluid bg-white p-0 pb-5 mb-5">
	
	<div class="container">
		
		<div class="row">

			<!--=====================================
			BLOQUE IZQ
			======================================-->
			
			<div class="col-12 col-lg-4 colIzqPerfil p-0 px-lg-3">
				
				<div class="cabeceraPerfil pt-4">
					<?php if($usuario["modo"]=="facebook"):  ?>
						<a href="<?php echo $ruta;  ?>salir" class="float-left lead text-white pt-1 px-3 mb-4">
											<h5><i class="fas fa-chevron-left"></i> Salir</h5>
										</a>
					<?php else:   ?>

						<a href="<?php echo $ruta;  ?>salir" class="float-left lead text-white pt-1 px-3 mb-4  salir">
						<h5><i class="fas fa-chevron-left"></i> Salir</h5>
					</a>
					<?php endif  ?>	
					
				

					<div class="clearfix"></div>

					<h1 class="text-white p-2 pb-lg-5 text-center text-lg-left">MI PERFIL</h1>	
				</div>

				<!--=====================================
				PERFIL
				======================================-->

				<div class="descripcionPerfil">
					
					<figure class="text-center imgPerfil">
							
					<?php if ($usuario["foto"] == ""): ?>

					<img src="<?php echo $servidor; ?>vistas/img/usuarios/default/default.png" class="img-fluid rounded-circle"  >

					<?php else: ?>

						<?php if ($usuario["modo"] == "direccto"): ?>

							<img src="<?php echo $servidor.$usuario["foto"]; ?>" class="img-fluid rounded-circle">

						<?php else: ?>	

							<img src="<?php echo $usuario["foto"]; ?>" class="img-fluid rounded-circle"  >
							
						<?php endif ?>

					<?php endif ?>

					</figure>

					<div id="accordion">

						<div class="card">

							<div class="card-header">
								<a class="card-link" data-toggle="collapse" href="#collapseOne">
									MIS RESERVAS
								</a>
							</div>

							<div id="collapseOne" class="collapse show" data-parent="#accordion">

								<ul class="card-body p-0">

									<li class="px-2  " style="background:#FFFDF4"  > <?php echo$noVencidas  ?> Por vencerse</li>
									<li class="px-2  text-white" style="background:#CEC5B6"> <?php echo $vencidas  ?> vencidas</li>

								</ul>

								<!--=====================================
								TABLA RESERVAS MÓVIL
								======================================-->	

								<?php 
									if(!$reservas){
										echo '<tr>
									<td colspan="5"> "Aun no hay rservas" </td>
								</tr>';
								return;

									}else{
										foreach ($reservas as $key => $value) {
											$habitacion = ControladorHAbitaciones::ctrMostrarHabitacion($value["id_habitacion"]);
											$categoria = ControladorCategorias::ctrMostrarCategoria($habitacion["tipo_h"]);

								'<div class="d-lg-none d-flex py-2">
									
									<div class="p-2 flex-grow-1">

										<h5>'   .$categoria["tipo"] .$habitacion["estilo"] .'</h5>
										<h5 class="small text-gray-dark">Del' .$value["fecha_ingreso"].' al '.$value["fecha_salida"] .'</h5>

									</div>

									<div class="p-2">

										<button type="button" class="btn btn-dark btn-sm text-white"><i class="fas fa-pencil-alt"></i></button>
										<button type="button" class="btn btn-warning btn-sm text-white"><i class="fas fa-eye"></i></button>

									</div>

								</div>

								<hr class="my-0">';

										}

									}


								
								
								
								?>

							<!-- 	<div class="d-lg-none d-flex py-2">
									
									<div class="p-2 flex-grow-1">

										<h5>Suite Contemporánea</h5>
										<h5 class="small text-gray-dark">Del 30.08.2018 al 03.09.2018</h5>

									</div>

									<div class="p-2">

										<button type="button" class="btn btn-dark btn-sm text-white"><i class="fas fa-pencil-alt"></i></button>
										<button type="button" class="btn btn-warning btn-sm text-white"><i class="fas fa-eye"></i></button>

									</div>

								</div>

								<hr class="my-0">

								<div class="d-lg-none d-flex py-2">
									
									<div class="p-2 flex-grow-1">

										<h5>Suite Contemporánea</h5>
										<h5 class="small text-gray-dark">Del 30.08.2018 al 03.09.2018</h5>

									</div>

									<div class="p-2">

										<button type="button" class="btn btn-dark btn-sm text-white"><i class="fas fa-pencil-alt"></i></button>
										<button type="button" class="btn btn-warning btn-sm text-white"><i class="fas fa-eye"></i></button>

									</div>

								</div> -->

							</div>

						</div>

						<div class="card">

							<div class="card-header">
								<a class="collapsed card-link" data-toggle="collapse" href="#collapseTwo">
									MIS DATOS
								</a>
							</div>

							<div id="collapseTwo" class="collapse" data-parent="#accordion">
								<div class="card-body p-0">

									<ul class="list-group">
										
										<li class="list-group-item small"><?php echo $usuario["nombre"]; ?></li>
										<li class="list-group-item small"><?php echo $usuario["email"]; ?></li>
									<?php if($usuario["modo"]=="direccto"):  ?>

										

										<li class="list-group-item small">
											<button class="btn btn-dark btn-sm"  data-toggle="modal" data-target="#cambiarPassword"  >Cambiar Contraseña</button>
										</li>

									<?php endif  ?>




									<li class="list-group-item small">
											<button class="btn btn-primary btn-lg" data-toggle="modal" data-target="#cambiarFotoPerfil">Cambiar Imagen</button>
										</li>

									</ul>

								</div>

							</div>

						</div>

					</div>

				</div>

			</div>

			<!--=====================================
			BLOQUE DER
			======================================-->

			<div class="col-12 col-lg-8 colDerPerfil">

				<div class="row">

					<div class="col-6 d-none d-lg-block">
						
						<h4 class="float-left"> Hola <?php echo $usuario["nombre"]; ?> </h4>

						<!-- mercado apgo ejemplo -->
						<div class="col-12">

							<?php if(isset($_COOKIE["codigoReserva"])):  ?>
								<?php 

									// validacion de no pagar el mismo dia 
									$validarPagoReserva = false;
									$hoy = date("Y-m-d");
									if( $hoy >= $_COOKIE["fechaIngreso"] || $hoy >= $_COOKIE["fechaSalida"]){
										echo 'Las fechas de la reserva no pueden ser igual o inferiores al dia de hoy, vuelve a intentarlo porfi';
										$validarPagoReserva = false;
									}else{
										$validarPagoReserva = true;
									}

/* ----------------------------------------- */
									/* Antes de mostrar el formulario se hace una validacion */
							/*=============================================
						 	CRUCE DE FECHAS
							=============================================*/

							$valor = $_COOKIE["idHabitacion"];

							$validarReserva = ControladorReservas::ctrMostrarReservas($valor);

							$opcion01 = array();
							$opcion02 = array();
							$opcion03 = array();
							
							if($validarReserva != 0){

								foreach ($validarReserva as $key => $value) {
									
									/* VALIDAR CRUCE DE FECHAS OPCIÓN 1 */     

									if($_COOKIE["fechaIngreso"] == $value["fecha_ingreso"]){

										array_push($opcion01, false);

									}else{

										array_push($opcion01, true);

									}

									 /* VALIDAR CRUCE DE FECHAS OPCIÓN 2 */

									 if($_COOKIE["fechaIngreso"] > $value["fecha_ingreso"] && $_COOKIE["fechaIngreso"] < $value["fecha_salida"]){

										array_push($opcion02, false);

									}else{

										array_push($opcion02, true);

									} 

									 /* VALIDAR CRUCE DE FECHAS OPCIÓN 3 */

									 if($_COOKIE["fechaIngreso"] < $value["fecha_ingreso"] && $_COOKIE["fechaSalida"] > $value["fecha_ingreso"]){

										array_push($opcion03, false);

									}else{

										array_push($opcion03, true);

									} 

									if($opcion01[$key] == false || $opcion02[$key] == false || $opcion03[$key] == false){

										$validarPagoReserva = false;

										echo 'Lo sentimos, las fechas de la reserva que habías seleccionado han sido ocupadas  
											<a href="'.$ruta.'" class="btn btn-danger btn-sm">vuelve a intentarlo </a>';

										break;	

									}else{

										$validarPagoReserva = true;

									}	        


								}

							}
/* ----------------------------------------- */
									

									?>

									<?php if( $validarPagoReserva ):  ?>
																	<div class="card">
									<div class="card-header">
										<h4>Tienes una reserrva pendiente por pagar</h4>
									</div>
									
									<div class="card-body">
										<figure>
											<img src="<?php echo $_COOKIE["imgHabitacion"]  ?>" class="img-thumbnail w-50" >
										</figure>
										<h3> <strong> <?php echo $_COOKIE["infoHabitacion"]  ?> </strong> </h3>
										<h4> <strong> <?php echo $_COOKIE["pagoReserva"]  ?> </strong> </h4>
									</div>
									<div class="card-footer">

									</div>

								</div>
								


								<form action="<?php echo $ruta.'perfil';  ?>" method="POST">
								
									<script
										src="https://www.mercadopago.com.pe/integrations/v1/web-tokenize-checkout.js"
										data-public-key="TEST-fd8358b9-691e-4a65-96fb-f28308586414"
										data-transaction-amount="<?php echo $_COOKIE["pagoReserva"]  ?>">
										data-summary-product-label="<?php echo $_COOKIE["infoHabitacion"];  ?>"
									</script>
									
								</form>
						

								<!-- en la misma pagina esperamos la respuesta -->
							<?php if( isset($_REQUEST["token"]) ){
								$token = $_REQUEST["token"];
								//echo '<pre class="bg-white">'; print_r($token) ; echo '</pre>';
								$payment_method_id = $_REQUEST["payment_method_id"];
								//echo '<pre class="bg-white">'; print_r($payment_method_id ) ; echo '</pre>';
								$installments = $_REQUEST["installments"];
								//echo '<pre class="bg-white">'; print_r($installments) ; echo '</pre>';
								$issuer_id = $_REQUEST["issuer_id"];
								//  echo '<pre class="bg-white">'; print_r($issuer_id) ; echo '</pre>';
								

								MercadoPago\SDK::setAccessToken("TEST-6900295215615053-122118-b4afcd4f6dc7ee0e8763483dd8f90dfc-466964048");
								//...
								$payment = new MercadoPago\Payment();
								$payment->transaction_amount = $_COOKIE["pagoReserva"]; //monto de transaccion
								$payment->token = $token;
								$payment->description = "una descripcion deproducto linme 184t";
								$payment->installments = $installments; //cuotas
								$payment->payment_method_id = $payment_method_id;
								$payment->issuer_id = $issuer_id;
								$payment->payer = array(
								"email" => "conrad.kohler@gmail.com"//correo del comprador
								);
								// Guarda y postea el pago
								$payment->save();
								//...
								// Imprime el estado del pago
								//echo '<pre class="bg-white">'; print_r($payment) ; echo '</pre>';
								echo $payment->status;

								//si es que se aprueba el pago , por parte de mercado de pago
								if($payment -> status == "approved"){

									//creando array para llevah
									$datos = array(
									'id_habitacion'=> $_COOKIE["idHabitacion"] ,
									'id_usuario' => $usuario['id_u'],
									'pago_reserva' => $_COOKIE["pagoReserva"],
									'num_transa'=> "132",
									'codigo_reserva' => $_COOKIE["codigoReserva"],
									'descripcion_reserva' => $_COOKIE["infoHabitacion"],
									'fecha_ingreso' => $_COOKIE["fechaIngreso"],
									'fecha_salida' => $_COOKIE["fechaSalida"],
									);

									/* echo '<pre class="bg-white">'; print_r( $datos ) ; echo '</pre>'; 
									echo '<pre class="bg-white">'; print_r( $payment ) ; echo '</pre>'; */
									$respuesta = ControladorReservas::ctrGuardarReserva($datos);
								/* 	echo '<pre class="bg-white">'; print_r( $respuesta  ) ; echo '</pre>'; */  
									if($respuesta ==  "ok"){
										echo '<script>

									document.cookie = "idHabitacion=; expires=Thu, 01 Jan 1985 00:00:00 UTC; path='.$ruta.'";
									document.cookie = "imgHabitacion=; expires=Thu, 01 Jan 1985 00:00:00 UTC; path='.$ruta.'";
									document.cookie = "infoHabitacion=; expires=Thu, 01 Jan 1985 00:00:00 UTC; path='.$ruta.'";
									document.cookie = "codigoReserva=; expires=Thu, 01 Jan 1985 00:00:00 UTC; path='.$ruta.'";
									document.cookie = "fechaIngreso=; expires=Thu, 01 Jan 1985 00:00:00 UTC; path='.$ruta.'";
									document.cookie = "pagoReserva=; expires=Thu, 01 Jan 1985 00:00:00 UTC; path='.$ruta.'";
									document.cookie = "fechaSalida=; expires=Thu, 01 Jan 1985 00:00:00 UTC; path='.$ruta.'";

										swal({
											type:"success",
											title:"¡ Oye, siiii !",
											text:"La reserva a sido creadata",
											conformButtonText:"Cerrar"
										}).then( function(rpta){
											if( rpta.value ){
												history.back();
											}


										});

									
									</script>';
									}
									
									
								}else{
								//el token no llego , taba la tarjeta sin saldo  o vencida;
								echo '<h1> ¡!Algo salio mal </h1>
								<p> Algo salio mal , verifique sus tarjetas o vuelva a intentarlo! </p>';
							}
								
							}
								?>
								
							<?php endif  ?> <!-- if del cokkie -->
						<?php endif  ?>



	
						
						</div>

					

						<!-- mercado pago ejemplo -->

					</div>

					<div class="col-6 d-none d-lg-block"></div>

					<div class="col-12 mt-3">
						
						<table class="table table-striped">
					    <thead>
					      <tr>
					      	<th>#</th>
					        <th>Habitación</th>
					        <th>Fecha de Ingreso</th>
					        <th>Fecha de Salida</th>
					        <th>Testimonioss</th>
					      </tr>
					    </thead>
					    <tbody>
							<?php 

							if(!$reservas){
								echo '<tr>
									<td colspan="5"> "Aun no hay rservas" </td>
								</tr>';
								return;

							}else{
								
								foreach ($reservas as $key => $value) {
									$habitacion = ControladorHAbitaciones::ctrMostrarHabitacion($value["id_habitacion"]);
									$categoria = ControladorCategorias::ctrMostrarCategoria($habitacion["tipo_h"]);
									//$item = "id_res"
									$testimonio = ControladorReservas::ctrMostrarTestimonios( "id_res", $value["id_reserva"] );
									echo '<pre class="bg-white">'; print_r( $testimonio[0]["testimonio"] ) ; echo '</pre>';

								echo 

									'<tr>
										<td>' .($key+1 ) .'</td>
										<td>' .$categoria["tipo"] .$habitacion["estilo"] .'</td>
										<td>'.$value["fecha_ingreso"].'</td>
										<td>'.$value["fecha_salida"].'</td>

										<td>
										<button data-toggle="modal" data-target="#actualizarTestimonio" type="button" class="btn btn-dark text-white actualizarDemonio" idTestimonio="'.$testimonio[0]["id_t"].'"
										verTestimonio="'.$testimonio[0]["testimonio"].'" >
										
										<i class="fas fa-pencil-alt"></i>
										
										</button>

										<button data-toggle="modal" data-target="#verTestimonio" type="button" class="btn btn-warning text-white veloPx " verTestimonio="'.$testimonio[0]["testimonio"].'"
										idTestimonio="'.$testimonio[0]["id_t"].'"
										>

										<i class="fas fa-eye"></i>

										</button>
										</td>
									</tr>';

								
								}
							}
							
							
							?>




					     <!--  <tr>
					        <td>1</td>
					        <td>Suite Contemporánea</td>
					        <td>30.08.2018</td>
					        <td>03.09.2018</td>
					        <td>
					        
								  <button type="button" class="btn btn-dark text-white"><i class="fas fa-pencil-alt"></i></button>
								  <button type="button" class="btn btn-warning text-white"><i class="fas fa-eye"></i></button>
								
					        </td>
					      </tr>
					       <tr>
					        <td>2</td>
							
					        <td>03.09.2018</td>
					        <td>
					        	
								  <button type="button" class="btn btn-dark text-white"><i class="fas fa-pencil-alt"></i></button>
								  <button type="button" class="btn btn-warning text-white"><i class="fas fa-eye"></i></button>
								
					        </td>
					      </tr>

					       <tr>
					        <td>3</td>
					        <td>Suite Clásica</td>
					        <td>30.08.2018</td>
					        <td>03.09.2018</td>
					        <td>
					        	
								  <button type="button" class="btn btn-dark text-white"><i class="fas fa-pencil-alt"></i></button>
								  <button type="button" class="btn btn-warning text-white"><i class="fas fa-eye"></i></button>
								
					        </td>
					      </tr> -->
					    </tbody>
					  </table>


					</div>

				</div>
			
			</div>

		</div>

	</div>

</div>

<!-- modal decabio de foo de perfil -->
<div class="modal formulario" id="cambiarFotoPerfil">

 <div class="modal-dialog">

		<div class="modal-content">

			<form method="post" enctype="multipart/form-data">

														<div class="modal-header">

															 <h4 class="modal-title">Cambiar Imagen</h4>

															 <button type="button" class="close" data-dismiss="modal">&times;</button>

														</div>

														<div class="modal-body">

															<input type="hidden" name="idUsuarioFoto" value="<?php echo $usuario["id_u"]; ?>">

															<div class="form-group">

																<input type="file" class="form-control-file border" name="cambiarImagen" required>

																<input type="hidden" name="fotoActual" value="<?php echo $usuario["foto"]; ?>">

															</div>	

														</div>

														<div class="modal-footer d-flex justify-content-between">  

														 	<div>

												        		<button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>

												        	</div>

												        	<div>
         
													         	<button type="submit" class="btn btn-primary">Enviar</button>

													         </div>

														</div>

														<?php

															$cambiarImagen = new ControladorUsuarios();
															$cambiarImagen -> ctrCambiarFotoPerfil();


														?>

			</form>

		</div>
 </div>

</div>

<!-- modal para cabio de contraeña -->
<div class="modal formulario" id="cambiarPassword">
											
											<div class="modal-dialog">

										 		<div class="modal-content">

										 			<form method="post">

										 				<div class="modal-header">

									 				 		<h4 class="modal-title">Cambiar Contraseña</h4>

        													<button type="button" class="close" data-dismiss="modal">&times;</button>

										 				</div>

										 				<div class="modal-body">
										 					
															<input type="hidden" name="idUsuarioPassword" value="<?php echo $usuario["id_u"]; ?>">

															<div class="form-group">

																<input type="password" class="form-control" placeholder="Nueva contraseña" name="editarPassword" required>

															</div>

														 </div>
														 

										 				<div class="modal-footer d-flex justify-content-between"> 

														 	<div>

													        	<button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>

													        </div>

												         	<div>
         
												         		<button type="submit" class="btn btn-primary">Enviar</button>

											        	 	</div>

										 				</div>

									 				 	<?php

															$cambiarPassword = new ControladorUsuarios();
															$cambiarPassword -> ctrCambiarPassword();

														?>

										 			</form>

										 		</div>

											</div>

										</div>


<!-- modal  para ver Testiminio -->

<div class="modal" id="verTestimonio">
	
	<div class="modal-dialog">

		<div class="modal-content">

			<div class="modal-header">

				<h4 class="modal-title">Testimonio</h4>

				<button type="button" class="close" data-dismiss="modal">&times;</button>

			</div>

			<div class="modal-body visorTestimonios">
				<p> Aun no hay tesimnios </p>

				<script>
					
				$(".veloPx").click(function(){  //cuado se haga click el boton declae velopx se evalue su atributo verTEstimoni y segun se setea en el body

					var testimonio = $(this).attr("verTestimonio");

					if(testimonio != ""){

						$(".modal-body.visorTestimonios").html('<p>'+testimonio+'</p>')

					}else{

						$(".modal-body.visorTestimonios").html('<p>Aún no tiene testimonios de esta reserva</p>');

					}


				})

				</script>			

			</div>

		</div>

	</div>

</div>



<!-- VENTANA MODAL APRA EDITAR TESTIMNIO -->
<div class="modal" id="actualizarTestimonio">
	
	<div class="modal-dialog">

		<div class="modal-content">

			<div class="modal-header">

				<h4 class="modal-title">Testimonio</h4>

				<button type="button" class="close" data-dismiss="modal">&times;</button>

			</div>

			<div class="modal-body">

			<script>

				$(".actualizarDemonio").click(function(){

					var testimonio = $(this).attr("verTestimonio");
					var idTestimonio = $(this).attr("idTestimonio");

					if(testimonio != ""){

						$(".modal-body textarea").val(testimonio);

					}else{

						$(".modal-body textarea").val("");

					}

					$("input[name='idTestimonio']").val(idTestimonio);


				})


			</script>

				<form method="post">

					<input type="hidden" value="" name="idTestimonio">
				
					<textarea class="form-control" rows="3" name="actualizarTestimonio" required></textarea>

					<input class="btn btn-primary my-3 float-right" type="submit" value="Guardar testimonio">

					 <?php

						$actualizarTestimonio = new ControladorReservas();
						$actualizarTestimonio -> ctrActualizarTestimonio();

					?> 

				</form>

			</div>

		</div>

	</div>

</div>