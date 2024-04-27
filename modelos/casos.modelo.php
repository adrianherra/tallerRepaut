<?php
          
require_once "conexion.php";

class ModeloCasos{
      
	/*=============================================
	MOSTRAR LINEAS
	=============================================*/
    static public function mdlMostrarCasos($tabla, $item, $valor){
    	if($item != null){  
    		$stmt = Conexion::conectar()->prepare("SELECT *
											   FROM casos 
											   WHERE id = :$item");
           
           	$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);
            $stmt -> execute();    
            return $stmt -> fetchAll();
		    
		}else{    
     		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");
			$stmt -> execute();
    		return $stmt -> fetchAll();
		} // fin if
		
		$stmt -> close();
		$stmt = null;
	} // fin class mdlMostrarCasos
	   
	 /*=============================================
	REGISTRO DE CASO
	=============================================*/
      
	static public function mdlIngresarCaso($tabla, $datos){
         
        $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(expediente, modelo, aseguradora, ano, mes, estado) VALUES (:expediente, :modelo, :aseguradora, :ano, :mes, :estado)");

        $stmt -> bindParam(":expediente", $datos["expediente"], PDO::PARAM_STR);        
		$stmt -> bindParam(":modelo", $datos["modelo"], PDO::PARAM_STR);
		$stmt -> bindParam(":aseguradora", $datos["aseguradora"], PDO::PARAM_STR);
		$stmt -> bindParam(":ano", $datos["ano"], PDO::PARAM_STR);
		$stmt -> bindParam(":mes", $datos["mes"], PDO::PARAM_STR);
		$stmt -> bindParam(":estado", $datos["estado"], PDO::PARAM_STR);
		
		if($stmt->execute()){
        	return "ok";
		}else {
     		return "error";
		} // fin if		

		$stmt -> close();
		$stmt = null;
		
	} // fin funcion mdlIngresarCaso
     
    /*=============================================
	EDITAR CASO
	=============================================*/

	static public function mdlEditarCaso($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET expediente = :expediente, modelo = :modelo, aseguradora = :aseguradora, ano = :ano, mes = :mes, estado = :estado WHERE id = :id");
                 
        $stmt -> bindParam(":id", $datos["id"], PDO::PARAM_STR);
		$stmt -> bindParam(":expediente", $datos["expediente"], PDO::PARAM_STR);        
		$stmt -> bindParam(":modelo", $datos["modelo"], PDO::PARAM_STR);
		$stmt -> bindParam(":aseguradora", $datos["aseguradora"], PDO::PARAM_STR);
		$stmt -> bindParam(":ano", $datos["ano"], PDO::PARAM_STR);
		$stmt -> bindParam(":mes", $datos["mes"], PDO::PARAM_STR);
		$stmt -> bindParam(":estado", $datos["estado"], PDO::PARAM_STR);
		     
		if($stmt->execute()){
			return "ok";
		}else{
			return "error";
		} // fin if

		$stmt->close();
		$stmt = null;

	} // fin mdlEditarCaso
     
	/*=============================================
	BORRAR CASO
	=============================================*/

	static public function mdlBorrarCaso($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("DELETE t1,t2 FROM casos AS t1 INNER JOIN galeria AS t2 ON t1.id = t2.idCaso WHERE t1.id = :idCaso");

		$stmt -> bindParam(":idCaso", $datos, PDO::PARAM_INT);
        
		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;

	}
  	 
    

} // fin de la class modelo Casos