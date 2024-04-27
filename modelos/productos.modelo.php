<?php

require_once "conexion.php";

class ModeloProductos{

	/*=============================================
	MOSTRAR PRODUCTOS
	=============================================*/
	static public function mdlMostrarProductos($tabla, $item, $valor){
		if($item != null){
			$stmt = Conexion::conectar()->prepare("SELECT t1.id, t1.parte, t1.descripcion,
													t1.marca, t1.modelo, t1.ano, t1.stock, t1.idProveedor,
													t2.nombre, t1.costoCol, t1.costoDol, t1.tipo,
													t1.ubicacion, t1.foto, t1.foto1, t1.foto2
												    FROM inventario t1 INNER JOIN proveedores t2 
													ON t1.idProveedor = t2.id WHERE t1.id = :$item 
													ORDER BY t1.id ASC");
			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);
			$stmt -> execute();    
			return $stmt -> fetch();    
		}else{
			$stmt = Conexion::conectar()->prepare("SELECT t1.id, t1.parte, t1.descripcion,
													t1.marca, t1.modelo, t1.ano, t1.stock, t1.idProveedor,
													t2.nombre, t1.costoCol, t1.costoDol, t1.tipo,
													t1.ubicacion, t1.foto, t1.foto1, t1.foto2
												    FROM inventario t1 INNER JOIN proveedores t2 
													ON t1.idProveedor = t2.id ORDER BY t1.id ASC");
			$stmt -> execute();
			return $stmt -> fetchAll();
		}
		$stmt -> close();
		$stmt = null;
	} // fin Mostrar Productos
	
	/*=============================================
	REGISTRO DE PRODUCTO
	=============================================*/
	static public function mdlCrearProducto($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(parte, descripcion, idProveedor,
														marca, modelo, ano, stock, costoCol,
														costoDol, tipo, ubicacion, foto, foto1, foto2) 
														VALUES (:parte, :descripcion, :idProveedor,
														:marca, :modelo, :ano, :stock, :costoCol,
														:costoDol, :tipo, :ubicacion, :foto, :foto1, :foto2)");
		
		$datos["ubicacion"] = ucwords(strtolower($datos["ubicacion"]));
		$datos["descripcion"] = ucwords(strtolower($datos["descripcion"]));
		$datos["marca"] = strtoupper($datos["marca"]);
		$datos["modelo"] = strtoupper($datos["modelo"]);
		
		$stmt->bindParam(":parte", $datos["parte"], PDO::PARAM_STR);
		$stmt->bindParam(":descripcion", $datos["descripcion"], PDO::PARAM_STR);
		$stmt->bindParam(":idProveedor", $datos["idProveedor"], PDO::PARAM_STR);
		$stmt->bindParam(":marca", $datos["marca"], PDO::PARAM_STR);
		$stmt->bindParam(":modelo", $datos["modelo"], PDO::PARAM_STR);
		$stmt->bindParam(":ano", $datos["ano"], PDO::PARAM_STR);   
		$stmt->bindParam(":stock", $datos["stock"], PDO::PARAM_STR);
		$stmt->bindParam(":costoCol", $datos["costoCol"], PDO::PARAM_STR);
		$stmt->bindParam(":costoDol", $datos["costoDol"], PDO::PARAM_STR);
		$stmt->bindParam(":tipo", $datos["tipo"], PDO::PARAM_STR);
		$stmt->bindParam(":ubicacion", $datos["ubicacion"], PDO::PARAM_STR);
		$stmt->bindParam(":foto", $datos["foto"], PDO::PARAM_STR);
		$stmt->bindParam(":foto1", $datos["foto1"], PDO::PARAM_STR);
		$stmt->bindParam(":foto2", $datos["foto2"], PDO::PARAM_STR);
		
		     
		if($stmt->execute()){
			return "ok";
		}else{
			return "error";
		} // fin if

		$stmt->close();
		$stmt = null;

	} // fin mdlCrearProducto

	/*=============================================
	EDITAR PRODUCTO
	=============================================*/
	static public function mdlEditarProducto($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET parte = :parte,
											 descripcion = :descripcion, idProveedor = :idProveedor, marca = :marca,
											 modelo = :modelo, ano = :ano, stock = :stock, costoCol = :costoCol,
											 costoDol = :costoDol, tipo = :tipo, ubicacion = :ubicacion, 
											 foto = :foto, foto1 = :foto1, foto2 = :foto2 WHERE id = :id");
		
		$datos["ubicacion"] = ucwords(strtolower($datos["ubicacion"]));
		$datos["descripcion"] = ucwords(strtolower($datos["descripcion"]));
		$datos["marca"] = strtoupper($datos["marca"]);
		$datos["modelo"] = strtoupper($datos["modelo"]);

		$stmt->bindParam(":id", $datos["id"], PDO::PARAM_STR);
		$stmt->bindParam(":parte", $datos["parte"], PDO::PARAM_STR);
		$stmt->bindParam(":descripcion", $datos["descripcion"], PDO::PARAM_STR);
		$stmt->bindParam(":idProveedor", $datos["idProveedor"], PDO::PARAM_STR);
		$stmt->bindParam(":marca", $datos["marca"], PDO::PARAM_STR);
		$stmt->bindParam(":modelo", $datos["modelo"], PDO::PARAM_STR);
		$stmt->bindParam(":ano", $datos["ano"], PDO::PARAM_STR);   
		$stmt->bindParam(":stock", $datos["stock"], PDO::PARAM_STR);
		$stmt->bindParam(":costoCol", $datos["costoCol"], PDO::PARAM_STR);
		$stmt->bindParam(":costoDol", $datos["costoDol"], PDO::PARAM_STR);
		$stmt->bindParam(":tipo", $datos["tipo"], PDO::PARAM_STR);
		$stmt->bindParam(":ubicacion", $datos["ubicacion"], PDO::PARAM_STR);
		$stmt->bindParam(":foto", $datos["foto"], PDO::PARAM_STR);
		$stmt->bindParam(":foto1", $datos["foto1"], PDO::PARAM_STR);
		$stmt->bindParam(":foto2", $datos["foto2"], PDO::PARAM_STR);

		if($stmt->execute()){
			return "ok";
		}else{
			return "error";
		} // fin if

		$stmt->close();
		$stmt = null;

	} // fin mdlEditarProducto

	/*=============================================
	BORRAR PRODUCTO
	=============================================*/
	static public function mdlEliminarProducto($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("DELETE FROM inventario WHERE id = :id");
		   
		$stmt -> bindParam(":id", $datos, PDO::PARAM_INT);
        
		if($stmt -> execute()){        
			return "ok";
		}else{
			return "error";	
		} // fin if

		$stmt -> close();
		$stmt = null;
		
	} // fin mdlEliminarProducto
      
} // fin ModeloProductos