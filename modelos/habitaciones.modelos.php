<?php 
require_once "conexion.php";
Class ModeloHabitaciones{
    /* Mostrar */



    static public  function mdlMostrarHabitaciones($tabla1,$tabla2,$valor){
    
        $smt = Conexion::conectar() -> prepare("select $tabla1.*,$tabla2.*from $tabla1 
        inner join $tabla2 on $tabla1.id = $tabla2.tipo_h where ruta = :ruta ");


        $smt -> bindParam(":ruta",$valor,PDO::PARAM_STR);
        $smt -> execute();
        return $smt -> fetchAll(); //esto una especia de juntalo todo?
        $smt -> close();
        $smt = null;
        
    }

    /* Mostrar hbiatacion olo una */

    static public function mdlMostrarHabitacion($tabla, $valor){

		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE id_h = :id_h");

		$stmt -> bindParam(":id_h", $valor, PDO::PARAM_INT);

		$stmt -> execute();

		return $stmt -> fetch();

		$stmt -> close();

		$stmt = null;
	
	}  




}

?>


