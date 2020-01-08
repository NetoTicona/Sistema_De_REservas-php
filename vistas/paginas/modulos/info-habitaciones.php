<?php 
$valor = $_GET["pagina"];

$habitaciones = ControladorHabitaciones :: ctrMostrarHabitaciones($valor);
echo "oliiii";
//echo '<pre class="bg-white">'; print_r($habitaciones) ; echo '</pre>';

/* ESCENARIO 2 DE RESERVAS */

?>


<!--=====================================
INFO HABITACIÓN
======================================-->

<div class="infoHabitacion container-fluid bg-white p-0 pb-5">
	
	<div class="container">
		
		<div class="row">

			<!--=====================================
			BLOQUE IZQ
			======================================-->
			
			<div class="col-12 col-lg-8 colIzqHabitaciones p-0">
				
				<!--=====================================
				CABECERA HABITACIONES
				======================================-->
				
				<div class="pt-4 cabeceraHabitacion">

					<a href="<?php echo $ruta;  ?>" class="float-left lead text-white pt-1 px-3">
						<h5><i class="fas fa-chevron-left"></i> Regresar</h5>
					</a>

					<h2 class="float-right text-white px-3 categoria"> <?php echo $habitaciones[1]["tipo"]  ?> </h2>

					<div class="clearfix"></div>

					<ul class="nav nav-justified mt-lg-4">	
						
					<?php foreach($habitaciones as $key => $value) : ?>
						<li class="nav-item">
								
							<a class="nav-link text-white"  orden="<?php echo $key?>" ruta="<?php echo $_GET["pagina"]?>"  href="#">
								 <?php echo $value["estilo"] ?>
							</a>

						</li>

					<?php endforeach  ?>




					<!-- 	<li class="nav-item">

							<a class="nav-link text-white" href="#">Moderna</a>

						</li>

						<li class="nav-item">

							<a class="nav-link text-white" href="#">Africana</a>

						</li>

						<li class="nav-item">

							<a class="nav-link text-white" href="#">Clásica</a>

						</li>

						<li class="nav-item">

							<a class="nav-link text-white" href="#">Retro</a>

						</li> -->

					</ul>

				</div>

				<!--=====================================
				MULTIMEDIA HABITACIONES
				======================================-->

				<!-- SLIDE  -->

				<section class="jd-slider mb-3 my-lg-3 slideHabitaciones">
		      	       
			        <div class="slide-inner">
			            
			            <ul class="slide-area">
						<?php $galeria = json_decode( $habitaciones[1]["galeria"],true )  ?>

						<?php foreach($galeria as $key => $vale) : ?>
							<li>	
							

								<img src=" <?php echo $servidor.$vale;  ?>" class="img-fluid">

							</li>

						<?php endforeach  ?>

				            
						<!-- 	<li>	

								<img src="img/oriental.png" class="img-fluid">

							</li>

							<li>	

								<img src="img/oriental.png" class="img-fluid">

							</li>	 -->						

						</ul>

					</div>

				  	  	<a class="prev d-none d-lg-block" href="#">
				            <i class="fas fa-angle-left fa-2x"></i>
				        </a>

				        <a class="next d-none d-lg-block" href="#">
				            <i class="fas fa-angle-right fa-2x"></i>
				        </a>

				         <div class="controller d-block d-lg-none">

					        <div class="indicate-area"></div>

					    </div>
									   
				</section>

				<!-- VIDEO  -->

				<section class="mb-3 my-lg-3 videoHabitaciones d-none">
					
					<iframe width="100%" height="380" src="https://www.youtube.com/embed/<?php echo $habitaciones[1]["video"] ?>" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
				
				</section>

				<!-- 360 GRADOS -->

				<section class="mb-3 my-lg-3 360Habitaciones d-none">

					<div id="myPano" class="pano" back="<?php echo $servidor.$habitaciones[1]["recorrido_virtual"] ?>" >

						<div class="controls">
							<a href="#" class="left">&laquo;</a>
							<a href="#" class="right">&raquo;</a>
						</div>

					</div>
									
				</section>

				<!--=====================================
				DESCRIPCIÓN HABITACIONES
				======================================-->	

				<div class="descripcionHabitacion px-3">
					
					<h1 class="colorTitulos float-left"> <?php echo $habitaciones[1]["estilo"]
					." " .$habitaciones[1]["tipo"]  ?>  </h1>

					<div class="float-right pt-2">
						
						<button type="button" class="btn btn-default" vista="fotos"><i class="fas fa-camera"></i> Fotos</button>

						<button type="button" class="btn btn-default" vista="video"><i class="fab fa-youtube"></i> Video</button>
			
						<button type="button" class="btn btn-default" vista="360"><i class="fas fa-video"></i> 360°</button>
							
					</div>

					<div class="clearfix mb-4"></div>	
						<div class="d-habitacion">
							<?php echo $habitaciones[1]["descripcion_h"]   ?>
						</div>
					<!-- <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cum sit, quia blanditiis fugiat nam libero possimus totam modi sint autem repellat fugit dicta est pariatur? Ut aut vel ad sapiente. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Beatae, reprehenderit! Deserunt laborum dolorum deleniti molestiae quae vitae animi ratione nihil, minus ut quibusdam incidunt voluptate eos sed id repudiandae ex.
					</p>	

					<p >Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cum sit, quia blanditiis fugiat nam libero possimus totam modi sint autem repellat fugit dicta est pariatur? Ut aut vel ad sapiente. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Beatae, reprehenderit! Deserunt laborum dolorum deleniti molestiae quae vitae animi ratione nihil, minus ut quibusdam incidunt voluptate eos sed id repudiandae ex.
					</p>

					<br>

					<h3>PLAN CONTINENTAL</h3>

					<p>(Precio x pareja 1 día 1 noche, incluye: desayuno)<br>
					Temporada Baja:$300 USD<br>
					Temporada Alta $350 USD</p>	

					<br>

					<h3>PLAN AMERICANO</h3>

					<p>(Precio x pareja 1 día 1 noche, incluye: cena, desayuno, almuerzo)<br>
					Temporada Baja:$380 USD<br>
					Temporada Alta $420 USD</p>
					
					<br>

					<p>Hora de entrada (Check in) 3:00 pm | Hora de salida (Check out) 1:00 pm</p> -->

<form action="<?php echo $ruta;  ?>reservas"  method="post">
<input type="hidden" name="id_habitacion" value="<?php echo $habitaciones[0]["id_h"]  ?>" >
<input type="hidden" name="ruta" value="<?php echo $habitaciones[0]["ruta"]  ?>" >

<div class="container">

						<div class="row py-2" style="background:#509CC3">

							 <div class="col-6 col-md-3 input-group pr-1">
							
								<input type="text" class="form-control datepicker entrada" placeholder="Entrada" name="fecha_ingreso">

								<div class="input-group-append">
									
									<span class="input-group-text"><i class="far fa-calendar-alt small text-gray-dark"></i></span>
								
								</div>

							</div>

						 	<div class="col-6 col-md-3 input-group pl-1">
							
								<input type="text" class="form-control datepicker salida" placeholder="Salida" name="fecha_salida" >

								<div class="input-group-append">
									
									<span class="input-group-text"><i class="far fa-calendar-alt small text-gray-dark"></i></span>
								
								</div>

							</div>

							<div class="col-12 col-md-6 mt-2 mt-lg-0 input-group">
							
									<input type="submit" class="btn btn-block btn-md text-white" value="Ver disponibilidaddd" style="background:black">	
								
 
							</div>

						</div>

					</div>

</form>
					

				</div>

			</div>
			
			<!--=====================================
			BLOQUE DER
			======================================-->

			<div class="col-12 col-lg-4 colDerHabitaciones">

				<h2 class="colorTitulos">  <?php echo $habitaciones[0]['tipo']  ?> INCRYe </h2>
				
				<ul>
						<?php 
							$incluye = json_decode($habitaciones[0]['incluye'],true);
							//echo '<pre>' .print_r($incluye) .'</pre>';
						
						?>

						<?php  foreach($incluye as $key => $value) :?>


							<li>
								<h5>
								
									<i class="<?php echo $value['icono'] ; ?> w-25 colorTitulos"></i> 
									<span class="text-dark small"> <?php echo $value['item']  ?>  </span>
								</h5>
							</li>


						<?php endforeach  ?>

				<!-- 	<li>
						<h5>
							<i class="fas fa-tv w-25 colorTitulos"></i> 
							<span class="text-dark small">TV de 42"</span>
						</h5>
					</li>

					<li>
						<h5>
							<i class="fas fa-tint w-25 colorTitulos"></i> 
							<span class="text-dark small">Agua caliente</span>
						</h5>
					</li>

					<li>
						<h5>
							<i class="fas fa-water w-25 colorTitulos"></i> 
							<span class="text-dark small">Jacuzzi</span>
						</h5>
					</li>

					<li>
						<h5>
							<i class="fas fa-toilet w-25 colorTitulos"></i> 
							<span class="text-dark small">Baño privado</span>
						</h5>
					</li>

					<li>
						<h5>
							<i class="fas fa-couch w-25 colorTitulos"></i>
							<span class="text-dark small"> Sofá</span>
						</h5>
					</li>

					<li>
						<h5>
							<i class="far fa-image w-25 colorTitulos"></i> 
							<span class="text-dark small">Balcón</span>
						</h5>
					</li>


					<li>
						<h5>
							<i class="fas fa-wifi w-25 colorTitulos"></i> 
							<span class="text-dark small">Servicio Wifi</span>
						</h5>
					</li> -->
				</ul>

				<!-- HABITACIONES -->

				<div class="habitaciones"  id="habitaciones" >

					<div class="container">

						<div class="row">
						<?php 
						$categorias = ControladorCategorias:: ctrMostrarCategorias();

						?>

						<?php foreach($categorias as $key => $value):  ?>

						<?php if($_GET['pagina']  != $value['ruta'] ):?>
													<div class="col-12 pb-3 px-0 px-lg-3">

														<a href="<?php echo $ruta.$value['ruta'] ?>  ">
														
															
															<figure class="text-center">
																
																<img src="<?php echo $servidor.$value['img'];  ?>" class="img-fluid" width="100%">

																<p class="small py-4 mb-0"> <?php echo $value['descripcion'] ?>  </p>

																<h3 class="py-2 text-gray-dark mb-0">DESDE <?php echo $value['continental_baja'] ?> </h3>

																<h5 class="py-2 text-gray-dark border">Ver detalles <i class="fas fa-chevron-right ml-2" style=""></i></h5>

																<h1 class="text-white p-3 mx-auto w-50 lead}}}}" style="background:<?php echo $value['color'] ?> ">  
																
																<?php echo $value['tipo'] ?> </h1>

															</figure>

														</a>

													</div>
						<?php endif  ?>		

						

						<?php endforeach  ?>




						<!-- 	<div class="col-12 pb-3 px-0 px-lg-3">

								<a href="<?php echo $ruta;  ?>habitaciones">
									
									<figure class="text-center">
										
										<img src="img/habitacion03.png" class="img-fluid" width="100%">

										<p class="small py-4 mb-0">Lorem ipsum dolor sit amet, consectetur</p>

										<h3 class="py-2 text-gray-dark mb-0">DESDE $150 USD</h3>

										<h5 class="py-2 text-gray-dark border">Ver detalles <i class="fas fa-chevron-right ml-2"></i></h5>

										<h1 class="text-white p-3 mx-auto w-50 lead" style="background:#2F7D84">STANDAR</h1>

									</figure>

								</a>

							</div>
 -->


						</div>

					</div>

				</div>

			</div>

		</div>

	</div>

</div>