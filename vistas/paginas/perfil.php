<?php

//persona registradas en la BD abal usuarios peuden tener acceso a estos elemtnso n este se vrea en controlador usuarios
echo '<pre class="bg-white">'; print_r( $_SESSION["validarSesion"]  ) ; echo '</pre>';
if(isset($_SESSION["validarSesion"])){	

	if($_SESSION["validarSesion"] == "ok"){

		include "modulos/banner-interior.php";
		include "modulos/info-perfil.php";
		include "modulos/habitaciones.php";
		include "modulos/planes.php";
		include "modulos/planes-movil.php";
		include "modulos/recorrido-pueblo.php";
		include "modulos/restaurante.php";
		echo '<div class="mb-5"></div>';

	}

}else{

//sino lo mandamos al pagina de usuario

	echo '<script> window.location="'.$ruta.'"</script>';
}


