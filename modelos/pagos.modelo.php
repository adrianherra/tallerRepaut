<?php

require_once "conexion.php";

class ModeloPagos{

	/*=============================================
	MOSTRAR PAGOS
	=============================================*/
    static public function mdlMostrarPagos($tabla, $item, $valor){
   		if($item != null){
            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");
			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);
			$stmt -> execute();
            return $stmt -> fetch();
		}else{
			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");
			$stmt -> execute();
			return $stmt -> fetchAll();
		} // fin if

		$stmt -> close();
		$stmt = null;
	} // fin class mdlMostrarPagos
	
	/*=============================================
	MOSTRAR PAGOS x FECHA
	=============================================*/
    static public function mdlMostrarPagosF($fechaIni, $fechaFin){
		$stmt = Conexion::conectar()->prepare("SELECT * FROM pagos
											   WHERE fecha BETWEEN '$fechaIni' AND '$fechaFin'
											   ORDER BY fecha ASC");
		      
		$stmt -> execute();
		return $stmt -> fetchAll();
	 
	 	$stmt -> close();
	 	$stmt = null;
 	} // fin class mdlMostrarPagosF
 
    /*=============================================
	REGISTRO de Pagos
	=============================================*/
   
	static public function mdlIngresarPagos($tabla, $datos){
         
        $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(tipo, numero, fecha, monto, dolares, observacion, pdf) VALUES (:tipo, :numero, :fecha, :monto, :dolares, :observacion, :pdf)");

		$stmt -> bindParam(":tipo", $datos["tipo"], PDO::PARAM_STR);
		$stmt -> bindParam(":numero", $datos["numero"], PDO::PARAM_STR);
		$stmt -> bindParam(":fecha", $datos["fecha"], PDO::PARAM_STR);
		$stmt -> bindParam(":monto", $datos["monto"], PDO::PARAM_STR);
		$stmt -> bindParam(":dolares", $datos["dolares"], PDO::PARAM_STR);
		$stmt -> bindParam(":observacion", $datos["observacion"], PDO::PARAM_STR);
		$stmt -> bindParam(":pdf", $datos["pdf"], PDO::PARAM_STR);		
		
		if($stmt->execute()){
			return "ok";
		}else {
       		return "error";
		} // fin if		
		$stmt -> close();
		$stmt = null;
		
	} // fin funcion mdlIngresarPagos

	/*=============================================
	EDITAR Pagos
	=============================================*/

	static public function mdlEditarPagos($tabla, $datos){
	   
		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET id =:id, tipo = :tipo, numero = :numero, fecha = :fecha, monto = :monto, dolares = :dolares, observacion = :observacion, pdf = :pdf WHERE id = :id");
 
  		$stmt -> bindParam(":id", $datos["id"], PDO::PARAM_STR);

  		$stmt -> bindParam(":tipo", $datos["tipo"], PDO::PARAM_STR);

		$stmt -> bindParam(":numero", $datos["numero"], PDO::PARAM_STR);

		$stmt -> bindParam(":fecha", $datos["fecha"], PDO::PARAM_STR);

		$stmt -> bindParam(":monto", $datos["monto"], PDO::PARAM_STR);

		$stmt -> bindParam(":dolares", $datos["dolares"], PDO::PARAM_STR);		

		$stmt -> bindParam(":observacion", $datos["observacion"], PDO::PARAM_STR);
		
		$stmt -> bindParam(":pdf", $datos["pdf"], PDO::PARAM_STR);
				
		if($stmt -> execute()){
            
			return "ok";
		
		}else{
				
			return "error";	

		} // fin if

		$stmt -> close();

		$stmt = null;

	} // fin mdlEditarPagos

	
	/*=============================================
	BORRAR Pagos
	=============================================*/
                           
	static public function mdlBorrarPagos($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id = :id");

		$stmt -> bindParam(":id", $datos, PDO::PARAM_INT);

        if($stmt -> execute()){

			return "ok";
		
		}else{
           
			return "error";	

		}

		$stmt -> close();

		$stmt = null;


	} // fin funcion mdlBorrarPagos

	
} // fin de la class modelo Pagos