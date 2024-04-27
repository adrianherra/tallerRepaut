<?php

require_once "conexion.php";

class ModeloEmpleados{

	/*=============================================
	CREAR EMPLEADOS
	=============================================*/

	static public function mdlIngresarEmpleado($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(nombre, cedula, fechaNacimiento, email, fechaIngreso, puesto, salario, jornada, direccion, telefono, estado, observaciones) VALUES (:nombre, :cedula, :fechaNacimiento, :email, :fechaIngreso, :puesto, :salario, :jornada, :direccion, :telefono, :estado, :observaciones)");
       
        $estado = "Activo";
                 
		$stmt -> bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
		$stmt -> bindParam(":cedula", $datos["cedula"], PDO::PARAM_STR);
		$stmt -> bindParam(":fechaNacimiento", $datos["fechaNacimiento"], PDO::PARAM_STR);
		$stmt -> bindParam(":email", $datos["email"], PDO::PARAM_STR);
		$stmt -> bindParam(":fechaIngreso", $datos["fechaIngreso"], PDO::PARAM_STR);
		$stmt -> bindParam(":puesto", $datos["puesto"], PDO::PARAM_STR);
		$stmt -> bindParam(":salario", $datos["salario"], PDO::PARAM_STR);
		$stmt -> bindParam(":jornada", $datos["jornada"], PDO::PARAM_STR);
		$stmt -> bindParam(":direccion", $datos["direccion"], PDO::PARAM_STR);
		$stmt -> bindParam(":telefono", $datos["telefono"], PDO::PARAM_STR);
		$stmt -> bindParam(":estado", $estado, PDO::PARAM_STR);
		$stmt -> bindParam(":observaciones", $datos["observaciones"], PDO::PARAM_STR);


		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

	}

	/*=============================================
	MOSTRAR EMPLEADOS
	=============================================*/

	static public function mdlMostrarEmpleados($tabla, $item, $valor){

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
	EDITAR EMPLEADOS
	=============================================*/

	static public function mdlEditarEmpleado($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET nombre = :nombre, cedula = :cedula, fechaNacimiento = :fechaNacimiento, email = :email, fechaIngreso = :fechaIngreso, puesto = :puesto, salario = :salario, jornada = :jornada, direccion = :direccion, telefono = :telefono, estado = :estado, observaciones = :observaciones WHERE nombre = :nombre");
     
		$stmt -> bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
		$stmt -> bindParam(":cedula", $datos["cedula"], PDO::PARAM_STR);
		$stmt -> bindParam(":fechaNacimiento", $datos["fechaNacimiento"], PDO::PARAM_STR);
		$stmt -> bindParam(":email", $datos["email"], PDO::PARAM_STR);
		$stmt -> bindParam(":fechaIngreso", $datos["fechaIngreso"], PDO::PARAM_STR);
		$stmt -> bindParam(":puesto", $datos["puesto"], PDO::PARAM_STR);
		$stmt -> bindParam(":salario", $datos["salario"], PDO::PARAM_STR);
		$stmt -> bindParam(":jornada", $datos["jornada"], PDO::PARAM_STR);
		$stmt -> bindParam(":direccion", $datos["direccion"], PDO::PARAM_STR);
		$stmt -> bindParam(":telefono", $datos["telefono"], PDO::PARAM_STR);
		$stmt -> bindParam(":estado", $datos["estado"], PDO::PARAM_STR);
		$stmt -> bindParam(":observaciones", $datos["observaciones"], PDO::PARAM_STR);


		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		} // fin if

		$stmt->close();
		$stmt = null;

	} // fin funcion mdlEditarEpleado

	/*=============================================
	BORRAR EMPLEADO
	=============================================*/

	static public function mdlBorrarEmpleado($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id = :id");

		$stmt -> bindParam(":id", $datos, PDO::PARAM_INT);

		if($stmt -> execute()){
			return "ok";
		}else{
			return "error";	
		} // fin if

		$stmt -> close();

		$stmt = null;

	} // fin funcion mdlBorrarEmpleado

	/*=============================================
	ACTUALIZAR EMPLEADO
	=============================================*/

	static public function mdlActualizarEmpleado($tabla, $item1, $valor1, $item2, $valor2){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET $item1 = :$item1 WHERE $item2 = :$item2");

		$stmt -> bindParam(":".$item1, $valor1, PDO::PARAM_STR);
		$stmt -> bindParam(":".$item2, $valor2, PDO::PARAM_STR);

		if($stmt -> execute()){
			return "ok";
 		}else{
			return "error";	
		} // fin if

		$stmt -> close();
		$stmt = null;

	} // fin mdlActualizarEmpleado
 

}// fin de la clase modelo Empleados

