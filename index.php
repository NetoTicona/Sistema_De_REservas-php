<?php

require_once "controladores/plantilla.controlador.php";
require_once "controladores/ruta.controlador.php";

require_once "controladores/banner.controlador.php";
require_once "modelos/banner.modelos.php";

require_once "controladores/planes.controlador.php";
require_once "modelos/planes.modelos.php";

require_once "modelos/categorias.modelos.php";
require_once "controladores/categorias.controlador.php";

require_once "modelos/recorrido.modelos.php";
require_once "controladores/recorrido.controlador.php";


require_once "modelos/restaurante.modelos.php";
require_once "controladores/restaurante.controlador.php";

require_once "modelos/habitaciones.modelos.php";
require_once "controladores/habitaciones.controlador.php";

require_once "modelos/reservas.modelos.php";
require_once "controladores/reservas.controlador.php";

require_once "modelos/usuarios.modelos.php";
require_once "controladores/usuarios.controlador.php";

require_once "extensiones/vendor/autoload.php"; /* mercado pago */

$plantilla = new ControladorPlantilla();
$plantilla -> ctrPlantilla();
