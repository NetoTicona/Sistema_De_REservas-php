<?php 

//https://code.tutsplus.com/tutorials/create-a-google-login-page-in-php--cms-33214

$client = new Google_Client();
 $client->setClientId('146713963344-d335iln0a85brhn57m00ah955br3o27v.apps.googleusercontent.com');
$client->setClientSecret('3U8SRj5rsqZVqOVmu1aM4MWK');
$client->setRedirectUri( "http://localhost/RESERVAS/"); 
//$client->setAuthConfig('modelos/client_secret.json');
$client->addScope("email");
$client->addScope("profile");
$rutaGoogle = $client->createAuthUrl();



/* jay que recibir la variable get de google llamada code */

?>




<!--=====================================
VENTANA MODAL PLANES
======================================-->

<div class="modal" id="modalPlanes">
	
	 <div class="modal-dialog">
			
		<div class="modal-content">
			
	      	<div class="modal-header">
	        	<h4 class="modal-title  text-uppercase  "></h4>
	        	<button type="button" class="close" data-dismiss="modal">&times;</button>
	      	</div>
			
	 		<div class="modal-body">
       			
       			<img src="" class="img-thumbnail">
    			
    			<p class="py-3"></p>
       			
       			<div class="text-center">
        			<a href="#habitaciones" class="btn btn-primary text-center btnModalPlan " data-dismiss="modal" >Separa tu habitación</a>
        		</div>

      		</div>

  		 	<div class="modal-footer">
        		<button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
      		</div>

		</div> 	

	 </div>

</div>

<!--=====================================
VENTANA MODAL INGRESO
======================================-->

<div class="modal  formulario" id="modalIngreso">

  <div class="modal-dialog">

    <div class="modal-content">

      <div class="modal-header bg-info text-white">
        <h4 class="modal-title">Ingresar</h4>
        <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
      </div>

      <div class="modal-body">

      	<!--=====================================
		INGRESO CON REDES SOCIALES
		======================================-->
		<?php 
		
		
		if(isset($_GET["code"]) ){
		
			$token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
			$client->setAccessToken($token['access_token']);
		
			 // get profile info
			 $google_oauth = new Google_Service_Oauth2($client);
			 $google_account_info = $google_oauth->userinfo->get();

			 //obteniedo lo que queremoss

		
		}

		if( isset($google_account_info) ){
			$datos = array( 
				"nombre" => $google_account_info->name,
				"email" => $google_account_info->email,
				"foto" => $google_account_info ->picture,
				"password "=>'null',
				"modo"=>'google',
				"verificacion"=>1,
				"email_encrip"=>'null'
			);
			echo '<pre class="bg-white">'; print_r( $datos) ; echo '</pre>';
			$respuesta = ControladorUsuarios::ctrRegistrarRedesSociales($datos);

			if($respuesta == 'okey'){
				echo' <script>
                                window.location = "'.$ruta.'perfil"
                              </script>';
			}	
			
		}
	   
		?>
       
      	<div class="d-flex">
      		
			<div class="px-2 flex-fill">

				<p class="p-2 bg-primary text-center text-white facebook" style="cursor:pointer" >
					<i class="fab fa-facebook"></i>
					Ingreso con Facebook
				</p>

			</div>

			<div class="px-2 flex-fill">
			
<a href="<?php echo $rutaGoogle;  ?>">
				<p class="p-2 bg-danger text-center text-white" style="cursor:pointer">
					<i class="fab fa-google"></i>
					Ingreso con Google
				</p>
</a>
			</div>

      	</div>

      	<!--=====================================
		INGRESO DIRECTO
		======================================-->

		<hr class="mt-0">
	
		<form method="post">

			<div class="input-group mb-3">

			    <div class="input-group-prepend">

			      <span class="input-group-text">
			      	
			      	<i class="far fa-envelope"></i>

			      </span>

			    </div>

			    <input type="email" class="form-control" placeholder="Email" required name="ingresoDirEmail" >

		  	</div>

		  	<div class="input-group mb-3">

			    <div class="input-group-prepend">

			      <span class="input-group-text">
			      	
					<i class="fas fa-unlock-alt"></i>

			      </span>

			    </div>

			    <input type="password"  name="ingresoDirContrasena" required class="form-control" placeholder="Contraseña">

		  	</div>

			  <div class="text-center pb-2">
			  <a href="#modalRecuperarPassword" data-toggle="modal" data-dismiss="modal" > olvido su contraseña </a>
			  </div>
			

			<input type="submit" class="btn btn-dark btn-block" value="Ingresar">
			<?php 
			$ingresoUsuario =  new ControladorUsuarios();
			$ingresoUsuario -> ctrIngresoUsuario();
			
			?>

		</form>

      </div>


      <div class="modal-footer">
        
		¿No tiene una cuenta registrada? | 

		<strong>

			<a href="#modalRegistro" data-toggle="modal" data-dismiss="modal">
				Registrarse
			</a>

		</strong>

      </div>

    </div>

  </div>

</div>

<!--=====================================
VENTANA MODAL REGISTRO
======================================-->

<div class="modal Formulario " id="modalRegistro">

  <div class="modal-dialog">

    <div class="modal-content">

      <div class="modal-header bg-info text-white">
        <h4 class="modal-title">Registarse</h4>
        <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
      </div>

      <div class="modal-body">

      	<!--=====================================
		INGRESO CON REDES SOCIALES
		======================================-->
       
      	<div class="d-flex">
      		
			<div class="px-2 flex-fill">

				<p class="p-2 bg-primary text-center text-white facebook" style="cursor:pointer" >
					<i class="fab fa-facebook"></i>
					Ingreso con Facebuko
				</p>

			</div>

			<div class="px-2 flex-fill">
			<a href="<?php echo $rutaGoogle;  ?>">
				<p class="p-2 bg-danger text-center text-white" style="cursor:pointer">
					<i class="fab fa-google"></i>
					Ingreso con Googli
				</p>
            </a>
			</div>

      	</div>

      	<!--=====================================
		REGISTRO DIRECTO
		======================================-->

		<hr class="mt-0">


		<form     method="post" >

			<div class="input-group mb-3">

			    <div class="input-group-prepend">

			      <span class="input-group-text">
			      	
			      	<i class="far fa-user"></i>

			      </span>

			    </div>

			    <input type="text" class="form-control" placeholder="Nombre" name="registroNombre" required>

		  	</div>


			<div class="input-group mb-3">

			    <div class="input-group-prepend">

			      <span class="input-group-text">
			      	
			      	<i class="far fa-envelope"></i>

			      </span>

			    </div>

			    <input type="text" class="form-control" placeholder="Email" placeholder="Nombre" name="registroEmail" required>

		  	</div>

		  	<div class="input-group mb-3">

			    <div class="input-group-prepend">

			      <span class="input-group-text">
			      	
					<i class="fas fa-unlock-alt"></i>

			      </span>

			    </div>

			    <input type="password" class="form-control" placeholder="Contraseña" placeholder="Nombre" name="registroPassword" required>

		  	</div>

			  

			  
			

			<input type="submit" class="btn btn-dark btn-block" value="Registrarse">

			<?php 
			
			$registroUsuario = new ControladorUsuarios();
			$registroUsuario -> ctrRegistroUsuario();
			
			?>

		</form>

      </div>


      <div class="modal-footer">
        
		¿Ya tienes una cuenta registrada? | 

		<strong>

			<a href="#modalIngreso" data-toggle="modal" data-dismiss="modal">
				Ingresar
			</a>

		</strong>

      </div>

    </div>

  </div>

</div>

<!-- modal RECUPERAR no actualizar contraseña -->
<div class="modal formulario" id="modalRecuperarPassword">
	
	<div class="modal-dialog">

	    <div class="modal-content">

	    	<div class="modal-header bg-info text-white">

		        <h4 class="modal-title">Recuperar contraseña</h4>

		        <button type="button" class="close text-white" data-dismiss="modal">&times;</button>

		    </div>

			 <div class="modal-body">
			 	
				<form method="post">

					<p class="text-muted">Escriba su correo electrónico con el que estás registrado y allí le enviaremos una nueva contraseña:</p>

					<div class="input-group mb-3">
						
						<div class="input-group-prepend">

					      <span class="input-group-text">
					      	
					      	<i class="far fa-envelope"></i>

					      </span>

					    </div>

					    <input type="email" class="form-control" placeholder="Email" name="emailRecuperarPassword" required>

					</div>

					<input type="submit" class="btn btn-dark btn-block" value="Enviar">

					<?php

						$recuperarPassword = new ControladorUsuarios();
						$recuperarPassword -> ctrRecuperarPassword();

					?>

				</form>

			 </div>

	    </div>

    </div>


</div>