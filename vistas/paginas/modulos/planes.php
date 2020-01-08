<?php 
$planes = ControladorPlanes::ctrMostrarPlanes();
//echo '<pre class="bg-white">'; print_r($planes) ; echo '</pre>';

?>


<!--=====================================
PLANES
======================================-->

<div class="planes container-fluid bg-white p-0" id="planes">
	
	<div class="container p-0">
		
		<div class="grid-container">
			
			<div class="grid-item">
				
				<h1 class="text-center py-3 py-lg-5 tituloPlan text-uppercase " tituloPlan="BIENVENIDO">BIENVENIDO</h1>

				<p class="text-muted text-left px-4 descripcionPlan " descripcionPlan="Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iure deleniti quidem minus voluptatibus repellendus error, excepturi quam, iste vitae tenetur fugiat possimus in. In iure cum facilis, saepe, libero accusantium.">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iure deleniti quidem minus voluptatibus repellendus error, excepturi quam, iste vitae tenetur fugiat possimus in. In iure cum facilis, saepe, libero accusantium.</p>

			</div>

					
				<?php foreach($planes as $key => $value):  ?>




					<div class="grid-item d-none d-lg-block" data-toggle="modal" data-target="#modalPlanes">
				
				<figure class="text-center">
					
					<h1 descripcion=" <?php  echo $value["descripcion"]; ?>" class="text-uppercase"  > PLAN <?php echo ($value["tipo"]);  ?>  </h1>

				</figure>


				<img src=" <?php echo $servidor.$value["img"] ?> " class="img-fluid" width="100%">


			</div>
				<?php endforeach  ?>
				



			<!-- aqui se despliega la ino de la database -->

			<!-- 

			<div class="grid-item d-none d-lg-block" data-toggle="modal" data-target="#modalPlanes">
				
				<figure class="text-center">
					
					<h1 descripcion="Lorem ipsum dolor sit amet, consectetur adipisicing elit. Placeat dicta fugiat nihil amet officiis, atque molestiae velit, quod repudiandae asperiores illum accusantium ullam, necessitatibus excepturi inventore, mollitia est vitae impedit.">PLAN LUNA DE MIEL</h1>

				</figure>

				<img src="img/luna-de-miel.png" class="img-fluid" width="100%">


			</div>

			<div class="grid-item d-none d-lg-block" data-toggle="modal" data-target="#modalPlanes">
				
				<figure class="text-center">
					
					<h1 descripcion="Lorem ipsum dolor sit amet, consectetur adipisicing elit. Deserunt blanditiis nulla expedita nostrum vero. Laborum repudiandae numquam mollitia earum natus ut delectus quas, iste unde doloribus suscipit qui, voluptate perspiciatis.">PLAN AVENTURA</h1>

				</figure>

				<img src="img/plan-aventura.png" class="img-fluid" width="100%">

			</div>

			<div class="grid-item d-none d-lg-block" data-toggle="modal" data-target="#modalPlanes">
				
				<figure class="text-center">
					
					<h1 descripcion="Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nam quibusdam magni atque provident, quaerat libero harum possimus. Illum iure magni voluptate, quos amet! Ipsam, sit, sapiente. Cumque est officiis in!">PLAN SPA</h1>

				</figure>

				<img src="img/plan-spa.png" class="img-fluid" width="100%">

			</div> -->
			<!-- hasta ahi nomas -->
			
		</div>

	</div>

</div>
