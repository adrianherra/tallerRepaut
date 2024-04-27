<?php
       
require_once "conexion.php";

class ModeloLineas{
   	/*=============================================
	MOSTRAR LINEAS
	=============================================*/
    static public function mdlMostrarLineas($tabla, $item, $valor){
    	if($item != null){
            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");
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
	} // fin class mdlMostrarLineas
	  
    /*=============================================
	ACTUALIZAR LINEAS
	=============================================*/
  	static public function mdlActualizarLineas($tabla, $item, $valor){
        $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET $item = :$item WHERE $item = :$item");
      	$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);
		if($stmt -> execute()){
			return "ok";
		}else{
			return "error";	
		} // fin if
		$stmt -> close();
		$stmt = null;
	} // fin class mdlActualizarLineas   
	   
   /*=============================================
	ACTUALIZAR ESTADO
	=============================================*/
   static public function mdlActualizarEstado($tabla, $item1, $valor1, $item2, $valor2){
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
	} // fin class mdlActualizarEstado
  
	/*=============================================
	REGISTRO de Lineas
	=============================================*/
  	static public function mdlIngresarLineas($tabla, $datos){
        $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(idOrden, numParte, compra, numMia, rutaMia, descripcion,
												numFactura, fechaFactura, presentacion, vencimiento, tipo, cantidad, pVenta,
												impVenta, totalVenta, costoLocal, impLocal, TCompra, TCambio, costoUsa, 
												costoMia, totalUsa, totalCol, estado) VALUES (:idOrden, :numParte, :compra, :numMia,
												:rutaMia, :descripcion, :numFactura, :fechaFactura, :presentacion, :vencimiento,
												:tipo, :cantidad, :pVenta, :impVenta, :totalVenta, :costoLocal, :impLocal, :TCompra,
												:TCambio, :costoUsa, :costoMia, :totalUsa, :totalCol, :estado)");
        

	   
		$stmt -> bindParam(":idOrden",      $datos["idOrden"], PDO::PARAM_STR);
		$stmt -> bindParam(":numParte",     $datos["numParte"], PDO::PARAM_STR);
		$stmt -> bindParam(":compra",       $datos["compra"], PDO::PARAM_STR);
		$stmt -> bindParam(":numMia",       $datos["numMia"], PDO::PARAM_STR);
		$stmt -> bindParam(":rutaMia",      $datos["rutaMia"], PDO::PARAM_STR);
		$stmt -> bindParam(":descripcion",  $datos["descripcion"], PDO::PARAM_STR);
		$stmt -> bindParam(":numFactura",   $datos["numFactura"], PDO::PARAM_STR);
		$stmt -> bindParam(":fechaFactura", $datos["fechaFactura"], PDO::PARAM_STR);
		$stmt -> bindParam(":presentacion", $datos["presentacion"], PDO::PARAM_STR);
		$stmt -> bindParam(":vencimiento",  $datos["vencimiento"], PDO::PARAM_STR);
		$stmt -> bindParam(":tipo",         $datos["tipo"], PDO::PARAM_STR);
		$stmt -> bindParam(":cantidad",     $datos["cantidad"], PDO::PARAM_STR);
		$stmt -> bindParam(":pVenta",       $datos["pVenta"], PDO::PARAM_STR);
		$stmt -> bindParam(":impVenta",     $datos["impVenta"], PDO::PARAM_STR);
		$stmt -> bindParam(":totalVenta",   $datos["totalVenta"], PDO::PARAM_STR);
		$stmt -> bindParam(":costoLocal",   $datos["costoLocal"], PDO::PARAM_STR);
		$stmt -> bindParam(":impLocal",     $datos["impLocal"], PDO::PARAM_STR);
		$stmt -> bindParam(":TCompra",      $datos["TCompra"], PDO::PARAM_STR);
		$stmt -> bindParam(":TCambio",      $datos["TCambio"], PDO::PARAM_STR);
		$stmt -> bindParam(":costoUsa",     $datos["costoUsa"], PDO::PARAM_STR);
		$stmt -> bindParam(":costoMia",     $datos["costoMia"], PDO::PARAM_STR);
		$stmt -> bindParam(":totalUsa",     $datos["totalUsa"], PDO::PARAM_STR);
		$stmt -> bindParam(":totalCol",     $datos["totalCol"], PDO::PARAM_STR);		
		$stmt -> bindParam(":estado",       $datos["estado"], PDO::PARAM_STR);
		      
		if($stmt->execute()){
        
			return "ok";

		}else {
       
       		return "error";

		} // fin if		

		$stmt -> close();

		$stmt = null;
		
	} // fin funcion mdlIngresarLineas

	/*=============================================
	EDITAR Lineas
	=============================================*/

	static public function mdlEditarLineas($tabla, $datos){
	
		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET idOrden = :idOrden, numParte = :numParte, compra =:compra,
											 numMia = :numMia, rutaMia = :rutaMia, descripcion = :descripcion, numFactura = :numFactura,
											 fechaFactura = :fechaFactura, presentacion = :presentacion, vencimiento = :vencimiento,
											 tipo = :tipo, cantidad = :cantidad, pVenta = :pVenta, impVenta = :impVenta,
											 totalVenta = :totalVenta, costoLocal = :costoLocal, impLocal = :impLocal, TCompra = :TCompra,
											 TCambio = :TCambio, costoUsa = :costoUsa, costoMia = :costoMia, totalUsa = :totalUsa, 
											 totalCol = :totalCol, estado = :estado WHERE id = :id");
 		      
 		$stmt -> bindParam(":id",           $datos["id"], PDO::PARAM_STR);
		$stmt -> bindParam(":idOrden",      $datos["idOrden"], PDO::PARAM_STR);
		$stmt -> bindParam(":numParte",     $datos["numParte"], PDO::PARAM_STR);
		$stmt -> bindParam(":compra",       $datos["compra"], PDO::PARAM_STR);
		$stmt -> bindParam(":numMia",       $datos["numMia"], PDO::PARAM_STR);
		$stmt -> bindParam(":rutaMia",      $datos["rutaMia"], PDO::PARAM_STR);
		$stmt -> bindParam(":descripcion",  $datos["descripcion"], PDO::PARAM_STR);
		$stmt -> bindParam(":numFactura",   $datos["numFactura"], PDO::PARAM_STR);
		$stmt -> bindParam(":fechaFactura", $datos["fechaFactura"], PDO::PARAM_STR);
		$stmt -> bindParam(":presentacion", $datos["presentacion"], PDO::PARAM_STR);
		$stmt -> bindParam(":vencimiento",  $datos["vencimiento"], PDO::PARAM_STR);
		$stmt -> bindParam(":tipo",         $datos["tipo"], PDO::PARAM_STR);
		$stmt -> bindParam(":cantidad",     $datos["cantidad"], PDO::PARAM_STR);
		$stmt -> bindParam(":pVenta",       $datos["pVenta"], PDO::PARAM_STR);
		$stmt -> bindParam(":impVenta",     $datos["impVenta"], PDO::PARAM_STR);
		$stmt -> bindParam(":totalVenta",   $datos["totalVenta"], PDO::PARAM_STR);
		$stmt -> bindParam(":costoLocal",   $datos["costoLocal"], PDO::PARAM_STR);
		$stmt -> bindParam(":impLocal",     $datos["impLocal"], PDO::PARAM_STR);
		$stmt -> bindParam(":TCompra",      $datos["TCompra"], PDO::PARAM_STR);
		$stmt -> bindParam(":TCambio",      $datos["TCambio"], PDO::PARAM_STR);
		$stmt -> bindParam(":costoUsa",     $datos["costoUsa"], PDO::PARAM_STR);
		$stmt -> bindParam(":costoMia",     $datos["costoMia"], PDO::PARAM_STR);
		$stmt -> bindParam(":totalUsa",     $datos["totalUsa"], PDO::PARAM_STR);
		$stmt -> bindParam(":totalCol",     $datos["totalCol"], PDO::PARAM_STR);		
		$stmt -> bindParam(":estado",       $datos["estado"], PDO::PARAM_STR);
		
		if($stmt -> execute()){
            
			return "ok";
		
		}else{
				
			return "error";	

		} // fin if

		$stmt -> close();

		$stmt = null;

	} // fin mdlEditarOrdenes
    
	/*=============================================
	BORRAR Lineas
	=============================================*/
	static public function mdlBorrarLineas($tabla, $datos){
		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id = :idLinea");
		$stmt -> bindParam(":idLinea", $datos, PDO::PARAM_INT);
        if($stmt -> execute()){
			return "ok";
		}else{
			return "error";	
		}
		$stmt -> close();
		$stmt = null;
	} // fin funcion mdlBorrarLinea  

    /*=============================================
	SUMAR EL TOTAL DE DIAS
	=============================================*/
	static public function mdlLineasDia(){	    
		$stmt = Conexion::conectar()->prepare("SELECT t2.orden, 
		                                       t1.descripcion,
		                                       t1.numParte,
											   t1.vencimiento,
											   DATEDIFF(CURDATE(),t1.vencimiento) as dias
											   FROM articulos t1 INNER JOIN ordenes t2 
											   ON t1.idOrden = t2.id
											   WHERE t1.estado = 'En Proceso' 
											   ORDER BY dias DESC");

		$stmt -> execute();
		return $stmt -> fetchAll();
		$stmt -> close();
		$stmt = null;
	} // fin  funcion mdLineasDia   
	
	/*=============================================
	SUMAR EL TOTAL DE COSTOS
	=============================================*/
	static public function mdlSumaTotales(){	
		$stmt = Conexion::conectar()->prepare("SELECT  SUM(costoLocal) as local,SUM(totalCol) as externo FROM articulos");
		$stmt -> execute();
		return $stmt -> fetch();
		$stmt -> close();
		$stmt = null;
	} // fin  funcion mdlSumaTotales   

	/*=============================================
	     REPORTE DE VENCIMIENTOS
	=============================================*/
	static public function mdlLineasPendientes(){	    
		$stmt = Conexion::conectar()->prepare("SELECT t2.orden, 
		                                       t1.descripcion,
											   t1.vencimiento,
											   DATEDIFF(CURDATE(),t1.vencimiento) as dias
											   FROM articulos t1 INNER JOIN ordenes t2 
											   ON t1.idOrden = t2.id
											   WHERE t1.estado = 'En Proceso' 
											   ORDER BY dias DESC");

		$stmt -> execute();
		return $stmt -> fetchAll();
		$stmt -> close();
		$stmt = null;
	} // fin  funcion mdLineasPendientes
	 
	/*=============================================
	     REPORTE DE FACTURAS X DETALLE
	=============================================*/
	static public function mdlReporteFactD($fechaIni, $fechaFin){
		$stmt = Conexion::conectar()->prepare("SELECT t2.taller,
													t2.aseguradora,
													t1.numFactura,
													t2.siniestro,
													CAST(t1.numFactura AS UNSIGNED) as factura,
													t1.fechaFactura,
													t2.orden,
													t2.placa,
													t2.marca,
													t2.modelo,
													t2.ano
													FROM articulos t1 INNER JOIN ordenes t2 ON t1.idOrden = t2.id
													WHERE t1.numFactura != '' AND t1.fechaFactura BETWEEN '$fechaIni' AND '$fechaFin'
													GROUP BY t1.numFactura
													ORDER BY CAST(t1.numFactura AS UNSIGNED) ASC");

		$stmt -> execute();
		return $stmt -> fetchAll();
		$stmt -> close();
		$stmt = null;
	} // fin funcion mdlReporteFactD
	
	/*=============================================
	     REPORTE DE FACTURAS X DETALLE Old
	=============================================*/
	static public function mdlReporteFactDv($fechaIni, $fechaFin){
		$stmt = Conexion::conectar()->prepare("SELECT t2.taller,
													t2.aseguradora,
													t1.numFactura,
													t2.siniestro,
													CAST(t1.numFactura AS UNSIGNED) as factura,
													t1.fechaFactura,
													t2.orden,
													t2.placa,
													t2.marca,
													t2.modelo,
													t2.ano
													FROM lineas t1 INNER JOIN expedientes t2 ON t1.idOrden = t2.id
													WHERE t1.numFactura != '' AND t1.fechaFactura BETWEEN '$fechaIni' AND '$fechaFin'
													GROUP BY t1.numFactura
													ORDER BY CAST(t1.numFactura AS UNSIGNED) ASC");

		$stmt -> execute();
		return $stmt -> fetchAll();
		$stmt -> close();
		$stmt = null;
	} // fin funcion mdlReporteFactD

	/*=============================================
	     REPORTE DE FACTURAS X DETALLE x ASEGURADORA
	=============================================*/
	static public function mdlReporteFactDAs($fechaIni, $fechaFin, $aseguradora){
		$stmt = Conexion::conectar()->prepare("SELECT t2.taller,
													t2.aseguradora,
													t1.numFactura,
													t2.siniestro,
													CAST(t1.numFactura AS UNSIGNED) as factura,
													t1.fechaFactura,
													t2.orden,
													t2.placa,
													t2.marca,
													t2.modelo,
													t2.ano
													FROM articulos t1 INNER JOIN ordenes t2 ON t1.idOrden = t2.id
													WHERE t1.numFactura != '' AND t1.fechaFactura BETWEEN '$fechaIni' AND '$fechaFin'
													AND t2.aseguradora = '$aseguradora'
													GROUP BY t1.numFactura
													ORDER BY CAST(t1.numFactura AS UNSIGNED) ASC");

		$stmt -> execute();
		return $stmt -> fetchAll();
		$stmt -> close();
		$stmt = null;
	} // fin funcion mdlReporteFactDAS

	/*=============================================
		REPORTE DE FACTURAS X DETALLE x ASEGURADORA OLD
	=============================================*/
	static public function mdlReporteFactDAsv($fechaIni, $fechaFin, $aseguradora){
		$stmt = Conexion::conectar()->prepare("SELECT t2.taller,
													t2.aseguradora,
													t1.numFactura,
													t2.siniestro,
													CAST(t1.numFactura AS UNSIGNED) as factura,
													t1.fechaFactura,
													t2.orden,
													t2.placa,
													t2.marca,
													t2.modelo,
													t2.ano
													FROM lineas t1 INNER JOIN expedientes t2 ON t1.idOrden = t2.id
													WHERE t1.numFactura != '' AND t1.fechaFactura BETWEEN '$fechaIni' AND '$fechaFin'
													AND t2.aseguradora = '$aseguradora'
													GROUP BY t1.numFactura
													ORDER BY CAST(t1.numFactura AS UNSIGNED) ASC");

		$stmt -> execute();
		return $stmt -> fetchAll();
		$stmt -> close();
		$stmt = null;
	} // fin funcion mdlReporteFactDASv
	
} // fin de la class modelo Lineas
