<?php 
require_once "conexion.php";
Class ModeloReservas{
    /*  
    mostrar Reservas
    */
    static public function mdlMostrarReservas($valor,$tabla1,$tabla2,$tabla3){
        /* $tabla1 = "habitaciones";
        $tabla2 = "reservas";
        $tabla3 = "categorias" */

        $stmt = Conexion::conectar() -> prepare("select $tabla1.*, $tabla2.*,$tabla3.* from
                $tabla1 inner join $tabla2 on $tabla1.id_h = $tabla2.id_habitacion
                inner join $tabla3 on $tabla1.tipo_h = $tabla3.id where $tabla1.id_h = :value ");

        $stmt -> bindParam(":value",$valor,PDO::PARAM_STR);
        $stmt -> execute();
        return $stmt -> fetchAll();
        $stmt -> close();
        $stmt = null;
    }


    static public function mdlMostrarCodigoReserva($tabla,$codigo){

        $stmt = Conexion::conectar() -> prepare(" select * from $tabla where codigo_reserva
        = :codigo ");

        $stmt -> bindParam(":codigo",$codigo,PDO::PARAM_STR );
        $stmt -> execute();
        return $stmt -> fetch();/* devolvemos solo na fila */
        $stmt -> close();
        $stmt = null;
    
    
    }

    static public function mdlGuardarReserva($tabla,$datos){
        //echo var_dump($datos);
    

        $connection = Conexion::conectar();
		$stmt = $connection->prepare("INSERT INTO $tabla(id_habitacion, id_usuario, pago_reserva, num_transa, codigo_reserva, descripcion_reserva, fecha_ingreso, fecha_salida) VALUES (:id_habitacion, :id_usuario, :pago_reserva, :num_transa, :codigo_reserva, :descripcion_reserva, :fecha_ingreso, :fecha_salida)");

        $stmt->bindParam(":id_habitacion", $datos["id_habitacion"], PDO::PARAM_STR);
		$stmt->bindParam(":id_usuario", $datos["id_usuario"], PDO::PARAM_STR);
		$stmt->bindParam(":pago_reserva", $datos["pago_reserva"], PDO::PARAM_STR);
		$stmt->bindParam(":num_transa", $datos["num_transa"], PDO::PARAM_STR);
		$stmt->bindParam(":codigo_reserva", $datos["codigo_reserva"], PDO::PARAM_STR);
		$stmt->bindParam(":descripcion_reserva", $datos["descripcion_reserva"], PDO::PARAM_STR);
		$stmt->bindParam(":fecha_ingreso", $datos["fecha_ingreso"], PDO::PARAM_STR);
        $stmt->bindParam(":fecha_salida", $datos["fecha_salida"], PDO::PARAM_STR);

        if($stmt -> execute() ){
            $id = $connection -> lastInsertId(); //lo que ocurrio en esa conexion me devuelva la ultima conexion

            return $id;
        }else{
            return 'no sepudo almacenar la reserva siñors';
        }
        $stmt -> close();
        $stmt -> null; 

    } 



    /* REervass unipatrias */
     static public function mdlMostrarReservasUsuario($tabla, $valor){

		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE id_usuario = :id_usuario ORDER BY id_reserva DESC LIMIT 5");

		$stmt -> bindParam(":id_usuario", $valor, PDO::PARAM_INT);

		$stmt -> execute();

		return $stmt -> fetchAll();

		$stmt -> close();

		$stmt = null;
		
    }
    

/*  CREAR TESTIMOIO  */
static public function mdlCrearTestimonio($tabla, $datos){

    $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(id_res, id_us, id_hab, testimonio, aprobado) VALUES (:id_res, :id_us, :id_hab, :testimonio, :aprobado)");

		$stmt->bindParam(":id_res", $datos["id_res"], PDO::PARAM_STR);
		$stmt->bindParam(":id_us", $datos["id_us"], PDO::PARAM_STR);
		$stmt->bindParam(":id_hab", $datos["id_hab"], PDO::PARAM_STR);
		$stmt->bindParam(":testimonio", $datos["testimonio"], PDO::PARAM_STR);
		$stmt->bindParam(":aprobado", $datos["aprobado"], PDO::PARAM_STR);

		if($stmt->execute()){

			return "ok"; 

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

}
/* mostrando TEstimonios , se lousa en el for each de info-perfil se trae el id de la reserva y se oconuslta la tabla teti.  */

    static public function mdlMostrarTestimonios($tabla1, $tabla2, $tabla3, $tabla4, $item, $valor){
        /* 
        $tabla1 = "testimonios";
            $tabla2 = "habitaciones";
            $tabla3 = "reservas";
            $tabla4 = "usuarios";
    */
        $stmt = Conexion::conectar()->prepare("SELECT $tabla1.*, $tabla2.*, $tabla3.*,  $tabla4.* FROM $tabla1 INNER JOIN $tabla2 ON $tabla1.id_hab = $tabla2.id_h INNER JOIN $tabla3 ON $tabla1.id_res = $tabla3.id_reserva INNER JOIN $tabla4 ON $tabla1.id_us = $tabla4.id_u WHERE $item = :$item ORDER BY id_t DESC");

        $stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

        $stmt -> execute();

        return $stmt -> fetchAll();

        $stmt -> close();

        $stmt = null;
    }


    /* actualizar testimonio */
    static public function mdlActualizarTestimonio($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET testimonio = :testimonio WHERE id_t = :id_testimonio");

		$stmt -> bindParam(":testimonio", $datos["testimonio"], PDO::PARAM_STR);
		$stmt -> bindParam(":id_testimonio", $datos["id_t"], PDO::PARAM_INT);

		if($stmt -> execute()){

			return "ok";

		}else{

			return "error";

		}

		$stmt-> close();

		$stmt = null;

	}
    
}//fin clase modelo


?>