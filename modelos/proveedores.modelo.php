<?php

require_once "conexion.php";

class ModeloProveedores{

	/*=============================================
	CREAR PROVEEDORES
	=============================================*/

	static public function mdlIngresarProveedor($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(nombre, telefono, email, contacto, direccion, observacion) VALUES (:nombre, :telefono, :email, :contacto, :direccion, :observacion)");
		
		$datos["nombre"] = strtoupper($datos["nombre"]);
		$datos["email"] = strtolower($datos["email"]);
		$datos["contacto"] = ucwords(strtolower($datos["contacto"]));
		$datos["direccion"] = ucwords(strtolower($datos["direccion"]));
		$datos["observacion"] = ucwords(strtolower($datos["observacion"]));

		$stmt -> bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
		$stmt -> bindParam(":telefono", $datos["telefono"], PDO::PARAM_STR);
		$stmt -> bindParam(":email", $datos["email"], PDO::PARAM_STR);
		$stmt -> bindParam(":contacto", $datos["contacto"], PDO::PARAM_STR);
		$stmt -> bindParam(":direccion", $datos["direccion"], PDO::PARAM_STR);
		$stmt -> bindParam(":observacion", $datos["observacion"], PDO::PARAM_STR);

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

	}

	/*=============================================
	MOSTRAR PROVEEDORES
	=============================================*/

	static public function mdlMostrarProveedores($tabla, $item, $valor){

		if($item != null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetch();

		}else{
      
			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");

			$stmt -> execute();

			return $stmt -> fetchAll();

		}

		$stmt -> close();

		$stmt = null;

	}

	/*=============================================
	EDITAR PROVEEDOR
	=============================================*/

	static public function mdlEditarProveedor($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET nombre = :nombre, telefono = :telefono, email = :email, contacto = :contacto, direccion = :direccion, observacion = :observacion WHERE id = :id");
         
		$stmt -> bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
		$stmt -> bindParam(":telefono", $datos["telefono"], PDO::PARAM_STR);
		$stmt -> bindParam(":email", $datos["email"], PDO::PARAM_STR);
		$stmt -> bindParam(":contacto", $datos["contacto"], PDO::PARAM_STR);
		$stmt -> bindParam(":direccion", $datos["direccion"], PDO::PARAM_STR);
		$stmt -> bindParam(":observacion", $datos["observacion"], PDO::PARAM_STR);
		$stmt -> bindParam(":id", $datos["id"], PDO::PARAM_STR);

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

	}

	/*=============================================
	BORRAR PROVEEDOR
	=============================================*/

	static public function mdlBorrarProveedor($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id = :id");

		$stmt -> bindParam(":id", $datos, PDO::PARAM_INT);

		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;

	}

}

