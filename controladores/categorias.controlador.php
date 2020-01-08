<?php 
 Class ControladorCategorias{
     /*     
     Motrar Categorias
     */
    static public function ctrMostrarCategorias(){
        $tabla = "categorias";
        $respuesta = ModeloCategorias::mdlMostrarCategorias($tabla);
        return $respuesta;


    }

    static public function ctrMostrarCategoria($valor){

		$tabla = "categorias";

		$respuesta = ModeloCategorias::mdlMostrarCategoria($tabla, $valor);

		return $respuesta;

	}
 }

?>