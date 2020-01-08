<?php 
if(isset($_POST["id_habitacion"])){
	$valor = $_POST["id_habitacion"];
   /*  echo 'aparecisge entre las flores';
	echo '<pre class="bg-white">'; print_r( $_POST["id_habitacion"]  ) ; echo '</pre>';
	echo '<pre class="bg-white">'; print_r( $_POST["fecha_ingreso"]  ) ; echo '</pre>';
	echo '<pre class="bg-white">'; print_r( $_POST["fecha_salida"]  ) ; echo '</pre>'; 
	echo '<pre class="bg-white">'; print_r( $_POST["ruta"]  ) ; echo '</pre>';  */

	$reservas = ControladorReservas:: ctrMostrarReservas( $valor ); /* valor es el id de la habitacion */
	$indice = 0;
		
	if(!$reservas){
		$valor = $_POST["ruta"];
		$reservas = ControladorHabitaciones::ctrMostrarHabitaciones($valor);
		foreach ($reservas as $key => $value) {
			if($value["id_h"] == $_POST["id_habitacion"]  ){
				$indice = $key;
			}
		}
	}
	//echo   '<pre class="bg-white">'; 'LA rUATA'; echo '</pre>'; 


	$planes = ControladorPlanes:: ctrMostrarPlanes();
	date_default_timezone_set("America/Lima");
	//echo '<pre class="bg-white">'; print_r( $reservas ) ; echo '</pre>';
	$hoy = getdate();
	/* temporada alta */
	if($hoy["mon"] == 12 && $hoy["mday"] >=15 && $hoy["mday"] <=31 || 
	   $hoy["mon"] == 1  && $hoy["mday"] >=1 &&  $hoy["mday"] <=15 ||
	   $hoy["mon"] == 6  && $hoy["mday"] >=15 &&  $hoy["mday"] <=31 ||
	   $hoy["mon"] == 7  && $hoy["mday"] >=1 &&  $hoy["mday"] <=15 ){

		$precioContinental=$reservas[$indice]["continental_alta"];
		$precioAmericano=$reservas[$indice]["americano_alta"];
		$precioRomantico=$reservas[$indice]["americano_alta"] + $planes[0]["precio_alta"];
		$precioLunaDeMiel=$reservas[$indice]["americano_alta"] + $planes[1]["precio_alta"];
		$precioAventura=$reservas[$indice]["americano_alta"] + $planes[2]["precio_alta"];
		$precioSPA=$reservas[$indice]["americano_alta"] + $planes[3]["precio_alta"];

	   }else{
			/* temporada baja */
			$precioContinental=$reservas[$indice]["continental_baja"];
			$precioAmericano=$reservas[$indice]["americano_baja"];
			$precioRomantico=$reservas[$indice]["americano_baja"] + $planes[0]["precio_baja"];
			$precioLunaDeMiel=$reservas[$indice]["americano_baja"] + $planes[1]["precio_baja"];
			$precioAventura=$reservas[$indice]["americano_baja"] + $planes[2]["precio_baja"];
			$precioSPA=$reservas[$indice]["americano_baja"] + $planes[3]["precio_baja"];
	   }
		/* Definiendo la cantidad  de dias   */


		
		$fechaIngreso = new DateTime($_POST["fecha_ingreso"]);
		$fechaSalida = new DateTime($_POST["fecha_salida"]);

		 $diff = $fechaIngreso -> diff($fechaSalida);
		 $dias = $diff -> days;
		if( $dias == 0 ){
			$dias = 1;
		}
		

}else{
echo	"<script>  window.location=' $urlPrincipal ' </script>";
}

?>



<!--=====================================
INFO RESERVAS
======================================-->


<div class="infoReservas container-fluid bg-white p-0 pb-5"  idHabitacion="<?php echo $_POST["id_habitacion"]  ?>"  fechaIngreso="<?php echo $_POST['fecha_ingreso'] ?> " fechaSalida='<?php echo $_POST["fecha_salida"]?> '  dias="<?php echo $dias;  ?>"  >


	
	<div class="container">


		
		<div class="row">

			<!--=====================================
			BLOQUE IZQ
			======================================-->
			
			<div class="col-12 col-lg-8 colIzqReservas p-0">
				
				<!--=====================================
				CABECERA RESERVAS
				======================================-->
				
				<div class="pt-4 cabeceraReservas">
					
					<a href="<?php echo $ruta;  ?>habitaciones" class="float-left lead text-white pt-1 px-3">
						<h5><i class="fas fa-chevron-left"></i> Regresar</h5>
					</a>

					<div class="clearfix"></div>

					<h1 class="float-left text-white p-2 pb-lg-5">RESERVAS</h1>	

					<h6 class="float-right px-3">

						<br>
						<?php if (isset($_SESSION["validarSesion"])): ?>

							<?php if ($_SESSION["validarSesion"] == "ok"): ?>

								<br>
								<a href="<?php echo $ruta;  ?>perfil" style="color:#FFCC29">Ver tus reservas</a>

							<?php endif ?>

						<?php else: ?>

							<br>
							<a href="#modalIngreso" data-toggle="modal" style="color:#FFCC29">Ver tus reservas</a>

						<?php endif ?>	
    
					</h6>

					<div class="clearfix"></div>

				</div>

				<!--=====================================
				CALENDARIO RESERVAS
				======================================	-->

				<div class="bg-white p-4 calendarioReservas">
<?php if($valor == $_POST["ruta"]):?>
	<h1 class="pb-5 float-left" > Disponible papucho </h1>
<?php else:  ?>
	<div class="infoDisponibilidad"></div>
<?php endif  ?>
			

				<div class="infoDisponibilidad"></div>



					<div class="float-right pb-3">
							
						<ul>
							<li>
								<i class="fas fa-square-full" style="color:#847059"></i> No disponible
							</li>

							<li>
								<i class="fas fa-square-full" style="color:#eee"></i> Disponible
							</li>

							<li>
								<i class="fas fa-square-full" style="color:#FFCC29"></i> Tu reserva
							</li>
						</ul>

					</div>

					<div class="clearfix"></div>
			
					<div id="calendar"></div>

					<!--=====================================
					MODIFICAR FECHAS
					======================================	-->

					<h6 class="lead pt-4 pb-2">Puede modificar la fecha de acuerdo a los días disponibles:</h6>

					<form action="<?php echo $ruta;  ?>reservas"  method="post">


                    <input type="hidden" name="id_habitacion" value="<?php echo $_POST['id_habitacion']  ?>" >

					<input type="hidden" name="ruta" value="<?php echo $_POST["ruta"] ?>" >

					<input type="hidden"  name="ruta" value="<?php echo $_POST["ruta"] ?>" >

					<div class="container mb-3">

						<div class="row py-2" style="background:#509CC3">

							 <div class="col-6 col-md-3 input-group pr-1">
							
							 <input type="text" class="form-control datepicker entrada" placeholder="Entrada" name="fecha_ingreso" value='<?php echo $_POST["fecha_ingreso"]  ?> '>

								<div class="input-group-append">
									
									<span class="input-group-text"><i class="far fa-calendar-alt small text-gray-dark"></i></span>
								
								</div>

							</div>

						 	<div class="col-6 col-md-3 input-group pl-1">
							
							 <input type="text" class="form-control datepicker salida" placeholder="Salida" name="fecha_salida" value='<?php echo $_POST["fecha_salida"]  ?> '>

								<div class="input-group-append">
									
									<span class="input-group-text"><i class="far fa-calendar-alt small text-gray-dark"></i></span>
								
								</div>

							</div>

							<div class="col-12 col-md-6 mt-2 mt-lg-0 input-group">
								
								
									<input type="submit" class="btn btn-block btn-md text-white" value="Ver disponibilidad" style="background:black">	
								

							</div>

						</div>

					</div>

				</div>

			</div>

			<!--=====================================
			BLOQUE DER
			======================================-->

			<div class="col-12 col-lg-4 colDerReservas" style="display:none"  >

				<h4 class="mt-lg-5">Código de la Reserva:</h4>
				<h2 class="colorTitulos"><strong class="codigoReserva" >  </strong></h2>

				<div class="form-group">
				  <label>Ingreso 3:00 pm </label>
				 
				  <input type="date" class="form-control" value="<?php echo $_POST["fecha_ingreso"]  ?>" readonly>
				</div>

				<div class="form-group">
				  <label>Salida 1:00 pm</label>
				  <input type="date" class="form-control" value="<?php echo $_POST["fecha_salida"]  ?>"  readonly>
				</div>

				<div class="form-group">
				  <label>Habitación:</label>
				  
				  <input type="text" class="form-control" value="Habitación <?php echo $reservas[$indice]["tipo_h"] ." " .$reservas[$indice]["estilo"]  ?>" readonly>

					<?php $galeria = json_decode( $reservas[$indice]["galeria"],true)?>
					
				  <img src=" <?php echo $servidor.$galeria[0]  ?> " class="img-fluid">

				</div>

				<div class="form-group">
				  <label>  <a href="#infoPlanes" data-toggle="modal">Escoje tu Plan:</a>
				<small>(precio para dos Personas)</small> </label>
				  <select class="form-control elegirPlan" >
				  	
					<?php echo $precioContinental ?>,

					<option value="<?php echo $precioContinental ?>,plan continental">Plan Continental <?php echo number_format($precioContinental)  ?> 1 dia 1 noche </option>
					<option value="<?php echo $precioAmericano ?>,plan americano">Plan Americano <?php echo number_format($precioAmericano)  ?> 1 dia 1 noche </option>
					<option value="<?php echo $precioRomantico ?>,plan romantico">Plan Romántico <?php echo number_format($precioRomantico)  ?> 1 dia 1 noche </option>
					<option value="<?php echo $precioLunaDeMiel ?>,plan lunademiel">Plan Luna de Miel <?php echo number_format($precioLunaDeMiel)  ?> 1 dia 1 noche </option>
					<option value="<?php echo $precioAventura ?>,plan aventura">Plan Aventura <?php echo number_format($precioAventura)  ?>  1 dia 1 noche</option>
					<option value="<?php echo $precioSPA ?>,plan spa">Plan SPA  <?php echo number_format($precioSPA)  ?>1 dia 1 noche </option>

				  </select>
				</div>
				  
				<div class="form-group">
				  <label>Personas:</label>
				  <select class="form-control cantidadPersonas">
				  	
					<option value="2">2</option>
					<option value="3">3</option>
					<option value="4">4</option>
					<option value="5">5</option>

				  </select>
				</div>

				<div class="row py-4">

					<div class="col-12 col-lg-6 col-xl-7 text-center text-lg-left">
						
						<h1 class="precioReserva"> <?php echo number_format($precioContinental*$dias);   ?>   </h1>

					</div>
					
					
					
					
					
					

					<div class="col-12 col-lg-6 col-xl-5">

					<?php if (isset($_SESSION["validarSesion"])): ?>

						<?php if ($_SESSION["validarSesion"] == "ok"): ?>
				
						<a href="<?php echo $ruta;?>perfil" class="pagarReerva" idHabitacion="<?php echo $reservas[$indice]["id_h"];  ?>"
						imgHabitacion="<?php echo $servidor.$galeria[$indice];  ?>"
						infoHabitacion="<?php echo $reservas[$indice]["tipo_h"] ." " .$reservas[$indice]["estilo"]  ?>" 
						pagoReserva="<?php echo $precioContinental*$dias;   ?>"
						codigoReserva=""
						fechaIngreso="<?php echo $_POST["fecha_ingreso"]  ?>"
						fechaSalida="<?php echo $_POST["fecha_salida"]  ?>"
						plan="Plan Continental" 
						personas="2">
							<button type="button" class="btn btn-dark btn-lg w-100">PAGAR <br> RESERVA</button>
						</a>
						<?php endif ?>
									
					<?php else: ?>
						<a href="#modalIngreso" data-toggle="modal" class="pagarReerva" idHabitacion="<?php echo $reservas[$indice]["id_h"];  ?>"
						imgHabitacion="<?php echo $servidor.$galeria[$indice];  ?>"
						infoHabitacion="<?php echo $reservas[$indice]["tipo_h"] ." " .$reservas[$indice]["estilo"]  ?>" 
						pagoReserva="<?php echo $precioContinental*$dias;   ?>"
						codigoReserva=""
						fechaIngreso="<?php echo $_POST["fecha_ingreso"]  ?>"
						fechaSalida="<?php echo $_POST["fecha_salida"]  ?>"
						plan="Plan Continental" 
						personas="2">
							<button type="button" class="btn btn-dark btn-lg w-100">PAGAR <br> RESERVA</button>
						</a>	
					 <?php endif ?>					

					</div>
			
				</div>

			</div>

		</div>

	</div>

</div>


<div class="modal" id="infoPlanes">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title  text-uppercase">
					Habitaion <?php echo $reservas[0]["tipo"] 
					." " .$reservas[0]["estilo"] ?>
				</h4>
				<button  class="button" class="close" data-dismiss="modal"> &times; </button>

			</div>

			<div class="modal-body">
				<figure class="text-center" >
					
				<img src=" <?php echo $servidor.$galeria[1]  ?> " class="img-fluid" alt="">
				</figure>

				<p class="px-2"> <?php echo $reservas[0]["descripcion_h"]  ?> </p>
				<hr>
				<div class="row" >
					<?php foreach($planes as $key => $value ):  ?>
						<div class="col-12 col-md-6">
						<h2 class="text-uppercase p-2">Plan <?php echo $value["tipo"];  ?> </h2>
						<figure class="text-center" >
					
					<img src=" <?php echo $servidor.$value["img"]  ?> " class="img-fluid" alt="">
					</figure>
					<p class="p-2" > <?php echo $value["descripcion"]  ?> </p>

					<h4 class="px-2"></h4>
					<p class="px-2" >
						Temporada baja plan americano  + $ <?php echo number_format($value["precio_baja"]);
						  ?>

                        Temporada alta plan americano + $ <?php echo number_format($value["precio_alta"]);
						  ?>
					</p>

						</div>

					<?php endforeach  ?>


				</div>

			</div>

		</div>

	</div>

</div>















