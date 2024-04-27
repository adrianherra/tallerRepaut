<?php

require_once "conexion.php";

class ModeloGalerias{  

	/*=============================================
	MOSTRAR GALERIAS
	=============================================*/

	static public function mdlMostrarGalerias($tabla, $item, $valor, $valor2){

		if($item != null){
			
			if (($valor2 == "img") or ($valor2 == "otro")) {
			    $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item AND tipo = :tipo");	
				$stmt -> bindParam(":tipo", $valor2, PDO::PARAM_STR);    
			} else {
				$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");
			}
								  
			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);
				
			$stmt -> execute();

			return $stmt -> fetchAll();

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");

			$stmt -> execute();

			return $stmt -> fetchAll();

		}
		

		$stmt -> close();

		$stmt = null;

	} // mdlMostrarGalerias

	/*=============================================
	REGISTRO DE GALERIA
	=============================================*/

	static public function mdlIngresarGaleria($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(idCaso, ruta, tipo, titulo) VALUES (:idCaso, :ruta, :tipo, :titulo)");

		$stmt->bindParam(":idCaso", $datos["idCaso"], PDO::PARAM_STR);
		$stmt->bindParam(":ruta", $datos["ruta"], PDO::PARAM_STR);
		$stmt->bindParam(":tipo", $datos["tipo"], PDO::PARAM_STR);
		$stmt->bindParam(":titulo", $datos["titulo"], PDO::PARAM_STR);
		
		if($stmt->execute()){

			return "ok";	

		}else{

			return "error";
		
		}

		$stmt->close();
		
		$stmt = null;

	}// fin mdlIngresarGaleria

	/*=============================================
	EDITAR GALERIAS
	=============================================*/

	static public function mdlEditarGaleria($tabla, $datos){
	
		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET idCaso = :idCaso, detalle = :detalle, documento = :documento WHERE id = :id");

		$stmt -> bindParam(":id", $datos["id"], PDO::PARAM_STR);
		$stmt -> bindParam(":idCaso", $datos["idCaso"], PDO::PARAM_STR);
		$stmt -> bindParam(":detalle", $datos["detalle"], PDO::PARAM_STR);
		$stmt -> bindParam(":documento", $datos["documento"], PDO::PARAM_STR);
		
		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;

	} // mdlEditarGalerias

	
	/*=============================================
	BORRAR GALERIA
	=============================================*/

	static public function mdlBorrarGaleria($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id = :id");

		$stmt -> bindParam(":id", $datos, PDO::PARAM_INT);

		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;


	} // fin mdlBorrarGaleria

	/*=============================================
        	BORRAR IMAGENES
	=============================================*/
	static public function mdlBorrarImagen($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id = :idImagen");

		$stmt -> bindParam(":idImagen", $datos, PDO::PARAM_INT);

        if($stmt -> execute()){

			return "ok";
		
		}else{
           
			return "error";	

		}

		$stmt -> close();

		$stmt = null;


	} // fin funcion mdlBorrarImagen

} // fin clase Galerias