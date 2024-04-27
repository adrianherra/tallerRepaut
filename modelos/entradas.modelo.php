<?php

require_once "conexion.php";

class ModeloEntradas{

	/*=============================================
     	MOSTRAR ENTRADAS
	=============================================*/
    static public function mdlMostrarEntradas($tabla, $item, $valor){
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
     	MOSTRAR ENTRADAS x Cliente
	=============================================*/
    static public function mdlMostrarEntradasC($item, $valor){
		if($item != null){
        	$stmt = Conexion::conectar()->prepare("SELECT t1.placa, t2.nombre, t2.email, t2.telefono, t2.direccion,
											t1.marca, t1.modelo, t1.ano, t1.kms, t1.vin, t1.motor, t1.aseguradora,
											t1.tanque, t1.tipoComb, t1.cono, t1.observacion, t1.imagen, t1.rutaPdf, t1.radio,
											t1.antena, t1.triangulos, t1.repuesto, t1.libros, t1.llavero, t1.copas,
											t1.alfombras, t1.extintor, t1.gata, t1.radioMarca, t1.bateriaMarca, t1.documentos, t1.encendedor, t1.fecha,
											t1.piezas, t1.estado
											FROM entradas t1 INNER JOIN clientes t2 
											ON t1.idCliente = t2.id
											WHERE t1.id = :$item");
		
			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);
			$stmt -> execute();
        	return $stmt -> fetch();
		} else {  
			$stmt = Conexion::conectar()->prepare("SELECT t1.id, t1.placa, t2.nombre, t2.email, t2.telefono, t2.direccion,
											t1.marca, t1.modelo, t1.ano, t1.kms, t1.vin, t1.motor, t1.aseguradora,
											t1.tanque, t1.tipoComb, t1.cono, t1.observacion, t1.imagen, t1.rutaPdf,t1.radio,
											t1.antena, t1.triangulos, t1.repuesto, t1.libros, t1.llavero, t1.copas,
											t1.alfombras, t1.extintor, t1.gata, t1.radioMarca, t1.bateriaMarca, t1.documentos, t1.encendedor, t1.fecha,
											t1.piezas, t1.estado
											FROM entradas t1 INNER JOIN clientes t2 
											ON t1.idCliente = t2.id ORDER BY id DESC");
			$stmt -> execute();
        	return $stmt -> fetchAll();		
		}
		$stmt -> close();
		$stmt = null;    
	} // fin class mdlMostrarEntradasC

    /*=============================================
	REGISTRO DE ENTRADAS
	=============================================*/
   	static public function mdlIngresarEntrada($tabla, $datos){
        $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(placa, marca, modelo, ano, kms, vin, motor,
												cono, tanque, tipoComb, idCliente, aseguradora, observacion, imagen,
												rutaPdf, radio, antena, triangulos, repuesto, libros, llavero, copas,
												alfombras, extintor, gata, radioMarca, bateriaMarca, documentos, encendedor, piezas, fecha, estado) 
												VALUES (:placa, :marca, :modelo, :ano, :kms, :vin, :motor,
												:cono, :tanque, :tipoComb, :idCliente, :aseguradora, :observacion, :imagen,
												:rutaPdf, :radio, :antena, :triangulos, :repuesto, :libros, :llavero, :copas,
												:alfombras, :extintor, :gata, :radioMarca, :bateriaMarca, :documentos, :encendedor, :piezas, :fecha, :estado)");
    
        $stmt -> bindParam(":placa", $datos["placa"], PDO::PARAM_STR);
        $stmt -> bindParam(":marca", $datos["marca"], PDO::PARAM_STR);
		$stmt -> bindParam(":modelo", $datos["modelo"], PDO::PARAM_STR);
		$stmt -> bindParam(":ano", $datos["ano"], PDO::PARAM_STR);
		$stmt -> bindParam(":kms", $datos["kms"], PDO::PARAM_STR);
		$stmt -> bindParam(":vin", $datos["vin"], PDO::PARAM_STR);
		$stmt -> bindParam(":motor", $datos["motor"], PDO::PARAM_STR);		
        $stmt -> bindParam(":cono", $datos["cono"], PDO::PARAM_STR);
		$stmt -> bindParam(":tanque", $datos["tanque"], PDO::PARAM_STR);
		$stmt -> bindParam(":tipoComb", $datos["tipoComb"], PDO::PARAM_STR);
		$stmt -> bindParam(":idCliente", $datos["idCliente"], PDO::PARAM_STR);
		$stmt -> bindParam(":aseguradora", $datos["aseguradora"], PDO::PARAM_STR);
		$stmt -> bindParam(":observacion", $datos["observacion"], PDO::PARAM_STR);   
		$stmt -> bindParam(":imagen", $datos["imagen"], PDO::PARAM_STR);
		$stmt -> bindParam(":rutaPdf", $datos["rutaPdf"], PDO::PARAM_STR);
		$stmt -> bindParam(":radio", $datos["radio"], PDO::PARAM_STR);
		$stmt -> bindParam(":antena", $datos["antena"], PDO::PARAM_STR);		
		$stmt -> bindParam(":triangulos", $datos["triangulos"], PDO::PARAM_STR);
		$stmt -> bindParam(":repuesto", $datos["repuesto"], PDO::PARAM_STR);
		$stmt -> bindParam(":libros", $datos["libros"], PDO::PARAM_STR);
		$stmt -> bindParam(":llavero", $datos["llavero"], PDO::PARAM_STR);
		$stmt -> bindParam(":copas", $datos["copas"], PDO::PARAM_STR);	
		$stmt -> bindParam(":alfombras", $datos["alfombras"], PDO::PARAM_STR);
		$stmt -> bindParam(":extintor", $datos["extintor"], PDO::PARAM_STR);
		$stmt -> bindParam(":gata", $datos["gata"], PDO::PARAM_STR);
		$stmt -> bindParam(":radioMarca", $datos["radioMarca"], PDO::PARAM_STR);
		$stmt -> bindParam(":bateriaMarca", $datos["bateriaMarca"], PDO::PARAM_STR);
		$stmt -> bindParam(":documentos", $datos["documentos"], PDO::PARAM_STR);
		$stmt -> bindParam(":encendedor", $datos["encendedor"], PDO::PARAM_STR);
		$stmt -> bindParam(":piezas", $datos["piezas"], PDO::PARAM_STR);
		$stmt -> bindParam(":fecha", $datos["fecha"], PDO::PARAM_STR);
		$stmt -> bindParam(":estado", $datos["estado"], PDO::PARAM_STR);

		if($stmt->execute()){
			return "ok";
			   
		}else {
       		return "error";
		} // fin if		
		$stmt -> close();
		$stmt = null;
		
	} // fin funcion mdlIngresarEntradas
	
	/*=============================================
     	MOSTRAR CONSECUTIVO
	=============================================*/
    static public function mdlConsecutivo(){
    	$stmt = Conexion::conectar()->prepare("SELECT MAX(id) as idReporte FROM entradas");
		$stmt -> execute();
		return $stmt -> fetch();
          		         
		$stmt -> close();
		$stmt = null;    
	} // fin class mdlConsegutivo
	    
	/*=============================================
	BORRAR ENTRADA
	=============================================*/
    static public function mdlBorrarEntrada($tabla, $datos){
		$stmt = Conexion::conectar()->prepare("DELETE t1,t2 FROM entradas AS t1 INNER JOIN galeria AS t2 ON t1.id = t2.idCaso WHERE t1.id = :idCaso");
		$stmt -> bindParam(":idCaso", $datos, PDO::PARAM_INT);
	    if($stmt -> execute()){
			return "ok";
		}else{
    		return "error";	
		}
		$stmt -> close();
		$stmt = null;
	} // fin funcion mdlBorrarEntrada
	
	/*=============================================
	CAMBIAR ESTADO
	=============================================*/
    static public function mdlCambiarEstado($valor, $valor1){
		
		$stmt = Conexion::conectar()->prepare("UPDATE entradas SET estado = :estado WHERE id = :id");
            
        $stmt -> bindParam(":id", $valor, PDO::PARAM_STR);
  		$stmt -> bindParam(":estado",$valor1, PDO::PARAM_STR);
        		
		if($stmt -> execute()){
        	return "ok";
		}else{
			return "error";	
		} // fin if
		$stmt -> close();
		$stmt = null;
     } // fin funcion mdlCambiarEstado

} // fin de la class modelo Entradas