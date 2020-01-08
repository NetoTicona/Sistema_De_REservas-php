

<?php 
echo "ESto es en habitaiones";
$categorias = ControladorCategorias::ctrMostrarCategorias();
//echo '<pre class="bg-white">'; print_r($categorias) ; echo '</pre>';
?>






<!--=====================================
HABITACIONES
======================================-->

<div class="habitaciones container-fluid bg-light" id="habitaciones">
	
	<div class="container">


		<h1 class="pt-4 text-center">HABITACIONES</h1>

		<div class="row p-4 text-center">  


				<?php  foreach($categorias as $key => $value): ?>
					<div class="col-12 col-lg-4 pb-3 px-0 px-lg-3">

						<a href="<?php echo $ruta.$value["ruta"]  ?> "> 
							
							<figure class="text-center">
								
								<img src=" <?php  echo $servidor.$value["img"] ?>" class="img-fluid" width="100%">

								<p class="small py-4 mb-0">  <?php echo $value["descripcion"]  ?>  </p>

								<h3 class="py-2 text-gray-dark mb-0"><?php echo number_format($value["continental_baja"],2)  ?></h3>

								<h5 class="py-2 text-gray-dark border">Ver detalles <i class="fas fa-chevron-right ml-2"></i></h5>
								
								<h1 class="text-white p-3 mx-auto w-50 lead text-uppercase " style=" background:<?php echo $value["color"];  ?> "> 
								
								  <?php echo $value["tipo"]  ?>  </h1>

							</figure>

						</a>

				</div>
				<?php endforeach  ?>
			
			<!-- <div class="col-12 col-lg-4 pb-3 px-0 px-lg-3">

				<a href="<?php echo $ruta;  ?>habitaciones"> 
					
					<figure class="text-center">
						
						<img src="img/habitacion01.png" class="img-fluid" width="100%">

						<p class="small py-4 mb-0">Lorem ipsum dolor sit amet</p>

						<h3 class="py-2 text-gray-dark mb-0">DESDE $300 USD</h3>

						<h5 class="py-2 text-gray-dark border">Ver detalles <i class="fas fa-chevron-right ml-2"></i></h5>
						
						<h1 class="text-white p-3 mx-auto w-50 lead" style="background:#847059">SUITE</h1>

					</figure>

				</a>

			</div>

			<div class="col-12 col-lg-4 pb-3 px-0 px-lg-3">

				<a href="<?php echo $ruta;  ?>habitaciones">
					
					<figure class="text-center">
						
						<img src="img/habitacion02.png" class="img-fluid" width="100%">

						<p class="small py-4 mb-0">Lorem ipsum dolor sit amet</p>

						<h3 class="py-2 text-gray-dark mb-0">DESDE $200 USD</h3>

						<h5 class="py-2 text-gray-dark border">Ver detalles <i class="fas fa-chevron-right ml-2"></i></h5>
						
						<h1 class="text-white p-3 mx-auto w-50 lead" style="background:#197DB1">ESPECIAL</h1>

					</figure>

				</a>

			</div>

			<div class="col-12 col-lg-4 pb-3 px-0 px-lg-3">

				<a href="<?php echo $ruta;  ?>habitaciones">
					
					<figure class="text-center">
						
						<img src="img/habitacion03.png" class="img-fluid" width="100%">

						<p class="small py-4 mb-0">Lorem ipsum dolor sit amet</p>

						<h3 class="py-2 text-gray-dark mb-0">DESDE $150 USD</h3>

						<h5 class="py-2 text-gray-dark border">Ver detalles <i class="fas fa-chevron-right ml-2"></i></h5>
						
						<h1 class="text-white p-3 mx-auto w-50 lead" style="background:#2F7D84">STANDAR</h1>

					</figure>

				</a>

			</div> -->

		</div>

	</div>

</div>