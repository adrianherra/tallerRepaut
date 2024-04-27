<?php

require_once "conexion.php";

class ModeloFacturas{
	/*=============================================
     	MOSTRAR CONSECUTIVO
	=============================================*/
    static public function mdlConsecutivo(){
    	//$stmt = Conexion::conectar()->prepare("SELECT MAX(id) as siguiente FROM facturas");
		$stmt = Conexion::conectar()->prepare("SELECT MAX(id) as siguiente, estado, fecha FROM facturas WHERE estado = 'activa'");
		$stmt -> execute();
		return $stmt -> fetchAll();
		
		$stmt -> close();
		$stmt = null;    
	} // fin class mdlConsegutivo
	   
	/*=============================================
     	MOSTRAR LINEAS FACTURA
	=============================================*/
    static public function mdlMostrarLineas($tabla, $item, $valor){
        if($item != null){
            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla 
													WHERE $item = :$item");  
			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);
			$stmt -> execute();
            return $stmt -> fetchAll(); 
		}else{
			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla ORDER BY id DESC");
			$stmt -> execute();
			return $stmt -> fetchAll();
		} // fin if
		$stmt -> close();
		$stmt = null;    
	} // fin class mdlMostrarEntradas
         
	/*=============================================
     	MOSTRAR FACTURAS
	=============================================*/
    static public function mdlMostrarFacturas($tabla, $item, $valor){
        if($item != null){
            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla 
													WHERE $item = :$item");  
			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);
			$stmt -> execute();
            return $stmt -> fetchAll(); 
		}else{
			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla ORDER BY id DESC");
			$stmt -> execute();
			return $stmt -> fetchAll();
		} // fin if
		$stmt -> close();
		$stmt = null;    
	} // fin class mdlMostrarFacturas

	/*=============================================
	REGISTRO DE LINEAS
	=============================================*/
   	static public function mdlLineaFactura($tabla, $datos){
        $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(idFactura, cantidad, tracking, parte, descripcion, monto, total) 
												VALUES (:idFactura, :cantidad, :tracking, :parte, :descripcion, :monto, :total)");
    
        $stmt -> bindParam(":idFactura", $datos["idFactura"], PDO::PARAM_STR);
		$stmt -> bindParam(":cantidad", $datos["cantidad"], PDO::PARAM_STR);
		$stmt -> bindParam(":tracking", $datos["tracking"], PDO::PARAM_STR);
		$stmt -> bindParam(":parte", $datos["parte"], PDO::PARAM_STR);
		$stmt -> bindParam(":descripcion", $datos["descripcion"], PDO::PARAM_STR);
		$stmt -> bindParam(":monto", $datos["monto"], PDO::PARAM_STR);
		$stmt -> bindParam(":total", $datos["total"], PDO::PARAM_STR);
		
		if($stmt->execute()){
        	return "ok";
		}else {
       		return "error";
		} // fin if		
		$stmt -> close();
		$stmt = null;
		
	} // fin funcion mdlLineaFactura
	    
	/*=============================================
	EDITAR DE LINEAS
	=============================================*/
	static public function mdlEditarFactura($tabla, $datos){
		//var_dump($datos);
    	$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET cantidad = :cantidad, parte =:parte, descripcion = :descripcion, monto =:monto, total =:total WHERE id = :idFactura");
                                                   
		$stmt -> bindParam(":idFactura", $datos["idFactura"], PDO::PARAM_INT); 
		$stmt -> bindParam(":cantidad", $datos["cantidad"], PDO::PARAM_INT);
		$stmt -> bindParam(":parte", $datos["parte"], PDO::PARAM_STR);
		$stmt -> bindParam(":descripcion", $datos["descripcion"], PDO::PARAM_STR);
		$stmt -> bindParam(":monto", $datos["monto"], PDO::PARAM_STR);
		$stmt -> bindParam(":total", $datos["total"], PDO::PARAM_STR);
		
		if($stmt -> execute()){
        	return "ok";
		}else{
			return "error";	
		} // fin if

		$stmt -> close();
		$stmt = null;
		
	} // fin funcion mdlEditarFactura
	
	/*=============================================
	REGISTRO DE FACTURA
	=============================================*/
	static public function mdlCrearFactura($tabla, $datos){
        $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(fecha, estado) 
												VALUES (:fecha, :estado)");
    
        $stmt -> bindParam(":fecha", $datos["fecha"], PDO::PARAM_STR);
        $stmt -> bindParam(":estado", $datos["estado"], PDO::PARAM_STR);
		

		if($stmt->execute()){
        	return "ok";
		}else {
       		return "error";
		} // fin if		
		$stmt -> close();
		$stmt = null;
		
	} // fin funcion mdlCrearFactura
	
	/*=============================================
	FIN FACTURA
	=============================================*/
	static public function mdlFinFactura($valor,$total,$tracking){
		$stmt = Conexion::conectar()->prepare("UPDATE facturas SET tracking = :tracking,  total = :total, estado = 'cerrado' WHERE id = :idFactura");
		    
		$stmt -> bindParam(":idFactura", $valor, PDO::PARAM_INT);
		$stmt -> bindParam(":total", $total, PDO::PARAM_INT);
		$stmt -> bindParam(":tracking", $tracking, PDO::PARAM_INT);
		if($stmt -> execute()){
        	return "ok";
		}else{
			return "error";	
		} // fin if

		$stmt -> close();
		$stmt = null;
	} // fin class mdlFinFactura

	/*=============================================
	ACTIVA FACTURA
	=============================================*/
	static public function mdlActivaFactura($valor){
		$stmt = Conexion::conectar()->prepare("UPDATE facturas SET estado = 'activa' WHERE id = :idFactura");
		    
		$stmt -> bindParam(":idFactura", $valor, PDO::PARAM_INT);
	
		if($stmt -> execute()){
        	return "ok";
		}else{
			return "error";	
		} // fin if

		$stmt -> close();
		$stmt = null;
	} // fin class mdlFinFactura

	/*=============================================
	BORRAR LINEA
	=============================================*/
    static public function mdlBorrarLinea($tabla, $datos){
        
		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id = :id");
				
		$stmt -> bindParam(":id", $datos, PDO::PARAM_INT);

	    if($stmt -> execute()){
			return "ok";
		}else{
    		return "error";	
		}
		$stmt -> close();
		$stmt = null;
		
	} // fin funcion mdlBorrarLinea
        
	
} // fin de la class modelo Entradas