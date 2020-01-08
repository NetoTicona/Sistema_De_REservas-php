<?php 
require_once "conexion.php";
class ModeloUsuarios{
    /* Registro de usuarios */
    

    static public function mdlRegistroUsuario($tabla,$datos)
    {
        $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(nombre, contrasena, email, foto, modo, verificacion, email_encrip) VALUES (:nombre, :contrasena, :email, :foto, :modo, :verificacion, :email_encrip)");

		$stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
		$stmt->bindParam(":contrasena", $datos["password"], PDO::PARAM_STR);
		$stmt->bindParam(":email", $datos["email"], PDO::PARAM_STR);
		$stmt->bindParam(":foto", $datos["foto"], PDO::PARAM_STR);
		$stmt->bindParam(":modo", $datos["modo"], PDO::PARAM_STR);
		$stmt->bindParam(":verificacion", $datos["verificacion"], PDO::PARAM_STR);
		$stmt->bindParam(":email_encrip", $datos["email_encrip"], PDO::PARAM_STR);

		if($stmt->execute()){

			return "ok";

		}else{

		
		}

		$stmt->close();
		$stmt = null;


    }

	static public function mdlMostrarUsuario( $tabla,$item,$valor ){
		$tmt = Conexion::conectar() -> prepare("select * from $tabla where $item = :$item");
		$tmt -> bindParam( ":".$item ,$valor,PDO::PARAM_STR );
		$tmt -> execute();
		return $tmt -> fetch();
		$tmt =  null ;
	}

	static public function mdlActualizarUsuario($tabla,$id,$item,$valor){
		$stmt = Conexion::conectar() -> prepare("update $tabla set $item = :$item where id_u = :id_u ");

		$stmt -> bindParam(":".$item,$valor,PDO:: PARAM_STR  );
		$stmt -> bindParam(":id_u" ,$id,PDO::PARAM_INT );


		if($stmt -> execute()){
			return "ok";
		}else{
			//return "error"
			echo "\nPDO::errorInfo():\n";
    		print_r(Conexion::conectar()->errorInfo());
		}
		$stmt -> close();
		$stmt = null;



	}



}
?>