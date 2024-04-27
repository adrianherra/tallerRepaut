<?php

require_once "conexion.php";

class ModeloOrdenes{

	/*=============================================
	MOSTRAR Ordenes
	=============================================*/
                           
	static public function mdlMostrarOrdenes($tabla, $item, $valor){
            
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

	} // fin class mdlMostrarOrdenes
	
    /*=============================================
	REGISTRO de Ordenes
	=============================================*/
   
	static public function mdlIngresarOrdenes($tabla, $datos){
         
        $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(numero, placa, taller, fechaAutorizado, fechaVencimiento, fechaEntrega, plazo, montoOrden, costoRepuesto, costoEnvio, costoAdicional, utilidad, observaciones) VALUES (:numero, :placa, :taller, :fechaAutorizado, :fechaVencimiento, :fechaEntrega, :plazo, :montoOrden, :costoRepuesto, :costoEnvio, :costoAdicional, :utilidad, :observaciones)");

		$stmt -> bindParam(":numero", $datos["numero"], PDO::PARAM_STR);

		$stmt -> bindParam(":placa", $datos["placa"], PDO::PARAM_STR);

		$stmt -> bindParam(":taller", $datos["taller"], PDO::PARAM_STR);

		$stmt -> bindParam(":fechaAutorizado", $datos["fechaAutorizado"], PDO::PARAM_STR);

        $stmt -> bindParam(":fechaVencimiento", $datos["fechaVencimiento"], PDO::PARAM_STR);

		$stmt -> bindParam(":fechaEntrega", $datos["fechaEntrega"], PDO::PARAM_STR);

		$stmt -> bindParam(":plazo", $datos["plazo"], PDO::PARAM_STR);

		$stmt -> bindParam(":montoOrden", $datos["montoOrden"], PDO::PARAM_STR);

		$stmt -> bindParam(":costoRepuesto", $datos["costoRepuesto"], PDO::PARAM_STR);

		$stmt -> bindParam(":costoEnvio", $datos["costoEnvio"], PDO::PARAM_STR);

		$stmt -> bindParam(":costoAdicional", $datos["costoAdicional"], PDO::PARAM_STR);

		$stmt -> bindParam(":utilidad", $datos["utilidad"], PDO::PARAM_STR);		
       
        $stmt -> bindParam(":observaciones", $datos["observaciones"], PDO::PARAM_STR);
          
		if($stmt->execute()){
        
			return "ok";

		}else {
       
       		return "error";

		} // fin if		

		$stmt -> close();

		$stmt = null;
		
	} // fin funcion mdlIngresarOrdenes

	/*=============================================
	EDITAR Ordenes
	=============================================*/

	static public function mdlEditarOrdenes($tabla, $datos){
	
		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET numero = :numero, placa = :placa, taller = :taller, fechaAutorizado = :fechaAutorizado, fechaVencimiento = :fechaVencimiento, fechaEntrega = :fechaEntrega, plazo = :plazo, montoOrden = :montoOrden, costoRepuesto = :costoRepuesto, costoEnvio = :costoEnvio, costoAdicional= :costoAdicional, utilidad = :utilidad, observaciones = :observaciones  WHERE numero = :numero");
 
  		$stmt -> bindParam(":numero", $datos["numero"], PDO::PARAM_STR);

		$stmt -> bindParam(":placa", $datos["placa"], PDO::PARAM_STR);

		$stmt -> bindParam(":taller", $datos["taller"], PDO::PARAM_STR);

		$stmt -> bindParam(":fechaAutorizado", $datos["fechaAutorizado"], PDO::PARAM_STR);

		$stmt -> bindParam(":fechaVencimiento", $datos["fechaVencimiento"], PDO::PARAM_STR);

		$stmt -> bindParam(":fechaEntrega", $datos["fechaEntrega"], PDO::PARAM_STR);

		$stmt -> bindParam(":plazo", $datos["plazo"], PDO::PARAM_STR);

		$stmt -> bindParam(":montoOrden", $datos["montoOrden"], PDO::PARAM_STR);

		$stmt -> bindParam(":costoRepuesto", $datos["costoRepuesto"], PDO::PARAM_STR);

		$stmt -> bindParam(":costoEnvio", $datos["costoEnvio"], PDO::PARAM_STR);

		$stmt -> bindParam(":costoAdicional", $datos["costoAdicional"], PDO::PARAM_STR);

		$stmt -> bindParam(":utilidad", $datos["utilidad"], PDO::PARAM_STR);

		$stmt -> bindParam(":observaciones", $datos["observaciones"], PDO::PARAM_STR);
		
		if($stmt -> execute()){
            
			return "ok";
		
		}else{
				
			return "error";	

		} // fin if

		$stmt -> close();

		$stmt = null;

	} // fin mdlEditarOrdenes

	
	/*=============================================
	BORRAR Ordenes
	=============================================*/
                           
	static public function mdlBorrarOrdenes($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id = :id");

		$stmt -> bindParam(":id", $datos, PDO::PARAM_INT);

        if($stmt -> execute()){

			return "ok";
		
		}else{
           
			return "error";	

		}

		$stmt -> close();

		$stmt = null;


	} // fin funcion mdlBorrarOrden

	
} // fin de la class modelo Ordenes