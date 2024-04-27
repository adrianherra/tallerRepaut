<?php

require_once "conexion.php";

class ModeloOrdenes{

	/*=============================================
	MOSTRAR Ordenes
	=============================================*/


    const Todas           = 'Todas';
	const ASE_MAPFRE      = 'Mapfre';
	const ASE_INS         = 'INS';
	const ASE_QUALITAS    = 'Qualitas';
	const ASE_LAFISE      = 'Lafise';
	const ASE_OCEANICA    = 'Oceanica';
	const ASE_ASSA        = 'Assa';
	const ASE_REPAUT      = 'Repaut';
	const ASE_DESIFYN     = 'DESIFYN';
    const ASE_HNOSGUTI    = 'HERMANOS GUTIERREZ'; 
    const ASE_ELAMIGO     = 'EL AMIGO';  
    const ASE_MARZU       = 'MARZU';
    const ASE_FERNANDO    = 'FERNANDO';
    const ASE_GONZALEZ    = 'GONZALEZ'; 
    const ASE_3R          = '3R'; 
    const ASE_PERITAJE    = 'PERITAJE';
    const ASE_SERVIMOTRIZ = 'SERVIMOTRIZ';
    const ASE_BAVARIAN    = 'BAVARIAN';
    const ASE_AUTOSHOP    = 'AUTOSHOP';
    const ASE_WILKING     = 'WILKING';
    const ASE_WILLIAMRAM  = 'WILLIAM RAMIREZ';
    const ASE_FRANKMARTI  = 'FRANKLING MARTINEZ';
    const ASE_DAYSICUBI   = 'DAYSI CUBILLO'; 
    const ASE_AUTOBACO    = 'AUTO TRANSP HNOS BACO';
	const ASE_OTROS       = 'Otros';

	
	public static function getAseguradoras() {
		$aseguradoras =  [
            self::Todas            => self::Todas,
            self::ASE_MAPFRE       => self::ASE_MAPFRE,
			self::ASE_INS          => self::ASE_INS,
			self::ASE_QUALITAS     => self::ASE_QUALITAS,
			self::ASE_LAFISE       => self::ASE_LAFISE,
			self::ASE_OCEANICA     => self::ASE_OCEANICA,
			self::ASE_ASSA         => self::ASE_ASSA,
			self::ASE_REPAUT       => self::ASE_REPAUT,
			self::ASE_DESIFYN      => self::ASE_DESIFYN,
			self::ASE_HNOSGUTI    => self::ASE_HNOSGUTI,
			self::ASE_ELAMIGO      => self::ASE_ELAMIGO,
			self::ASE_MARZU        => self::ASE_MARZU,
			self::ASE_FERNANDO     => self::ASE_FERNANDO,
			self::ASE_GONZALEZ     => self::ASE_GONZALEZ,
			self::ASE_3R           => self::ASE_3R,
			self::ASE_PERITAJE     => self::ASE_PERITAJE,
			self::ASE_SERVIMOTRIZ  => self::ASE_SERVIMOTRIZ,
			self::ASE_BAVARIAN     => self::ASE_BAVARIAN,
			self::ASE_AUTOSHOP     => self::ASE_AUTOSHOP,
			self::ASE_WILKING      => self::ASE_WILKING,
			self::ASE_WILLIAMRAM   => self::ASE_WILLIAMRAM,
			self::ASE_FRANKMARTI   => self::ASE_FRANKMARTI,
			self::ASE_DAYSICUBI    => self::ASE_DAYSICUBI,
			self::ASE_AUTOBACO     => self::ASE_AUTOBACO,
			self::ASE_OTROS        => self::ASE_OTROS

		 ];
		 return $aseguradoras;
	 }


	static public function mdlMostrarOrdenes($tabla, $item, $valor){
     	if($item != null){
            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");
			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);
			$stmt -> execute();
            return $stmt -> fetch();
		}else{
			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla ORDER BY estado ASC, id DESC");
			$stmt -> execute();
			return $stmt -> fetchAll();
		} // fin if

		$stmt -> close();
		$stmt = null;   
	} // fin class mdlMostrarOrdenes
	
	/*===========================================
	 Mostrar Aseguradoras
	=============================================*/
	static public function mdlMostrarAseguradoras(){
	   $stmt = Conexion::conectar()->prepare("SELECT * FROM Aseguradoras");
	   $stmt -> execute();
	   $resultado = $stmt -> fetchAll();
	   return $resultado;
   } // fin class mdlMostrarAseguradoras

   


    /*=============================================
	REGISTRO de Ordenes
	=============================================*/
   
	static public function mdlIngresarOrdenes($tabla, $datos){
         
        $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(orden, siniestro, taller, aseguradora,
												fechaOrden, plazo, fechaVencimiento, placa, marca, modelo,
												ano, subTotal, iva, descuento, montoOrden, costoOrden, utilidad,
												pUtl, observacion, envio, flete, impAduanas, estado, pdf1, pdf2,
												pdf3, pdf4, pdf5) VALUES (:orden, :siniestro, :taller, :aseguradora,
												:fechaOrden, :plazo, :fechaVencimiento, :placa, :marca, :modelo,
												:ano, :subTotal, :iva, :descuento, :montoOrden, :costoOrden,
												:utilidad, :pUtl, :observacion, :envio, :flete, :impAduanas,
												:estado, :pdf1, :pdf2, :pdf3, :pdf4, :pdf5)");

        $estado = "Sin Lineas";
        $subTotal = "0";
        $iva = "0";
        $descuento = "0";
        $montoOrden = "0";
        $costoOrden = "0";
        $utilidad = "0";
        $pUtl = "0 %";

        $stmt -> bindParam(":orden", $datos["orden"], PDO::PARAM_STR);
        $stmt -> bindParam(":siniestro", $datos["siniestro"], PDO::PARAM_STR);
		$stmt -> bindParam(":taller", $datos["taller"], PDO::PARAM_STR);
		$stmt -> bindParam(":aseguradora", $datos["aseguradora"], PDO::PARAM_STR);
		$stmt -> bindParam(":fechaOrden", $datos["fechaOrden"], PDO::PARAM_STR);
		$stmt -> bindParam(":plazo", $datos["plazo"], PDO::PARAM_STR);
		$stmt -> bindParam(":fechaVencimiento", $datos["fechaVencimiento"], PDO::PARAM_STR);		
        $stmt -> bindParam(":placa", $datos["placa"], PDO::PARAM_STR);
		$stmt -> bindParam(":marca", $datos["marca"], PDO::PARAM_STR);
		$stmt -> bindParam(":modelo", $datos["modelo"], PDO::PARAM_STR);
		$stmt -> bindParam(":ano", $datos["ano"], PDO::PARAM_STR);
   		$stmt -> bindParam(":subTotal", $subTotal, PDO::PARAM_STR);
   		$stmt -> bindParam(":iva", $iva, PDO::PARAM_STR);
   		$stmt -> bindParam(":descuento", $descuento, PDO::PARAM_STR);
   		$stmt -> bindParam(":montoOrden", $montoOrden, PDO::PARAM_STR);
   		$stmt -> bindParam(":costoOrden", $costoOrden, PDO::PARAM_STR);
   		$stmt -> bindParam(":utilidad", $utilidad, PDO::PARAM_STR);
   		$stmt -> bindParam(":pUtl", $pUtl, PDO::PARAM_STR);
		$stmt -> bindParam(":observacion", $datos["observacion"], PDO::PARAM_STR);
		$stmt -> bindParam(":envio", $datos["envio"], PDO::PARAM_STR);
		$stmt -> bindParam(":flete", $datos["flete"], PDO::PARAM_STR);
		$stmt -> bindParam(":impAduanas", $datos["impAduanas"], PDO::PARAM_STR);
		$stmt -> bindParam(":estado", $estado, PDO::PARAM_STR);		
		$stmt -> bindParam(":pdf1", $datos["pdf1"], PDO::PARAM_STR);
		$stmt -> bindParam(":pdf2", $datos["pdf2"], PDO::PARAM_STR);
		$stmt -> bindParam(":pdf3", $datos["pdf3"], PDO::PARAM_STR);		
		$stmt -> bindParam(":pdf4", $datos["pdf4"], PDO::PARAM_STR);
		$stmt -> bindParam(":pdf5", $datos["pdf5"], PDO::PARAM_STR);
        
        
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
	
		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET orden = :orden, siniestro= :siniestro, 
												taller = :taller, aseguradora = :aseguradora, fechaOrden = :fechaOrden,
												placa = :placa, marca = :marca, modelo = :modelo, ano = :ano, plazo = :plazo,
												fechaVencimiento= :fechaVencimiento, observacion = :observacion, envio = :envio,
												flete = :flete, impAduanas= :impAduanas, pdf1 = :pdf1,	pdf2 = :pdf2,
												pdf3 = :pdf3, pdf4 = :pdf4, pdf5 = :pdf5 WHERE id = :id");
        
        $stmt -> bindParam(":id", $datos["id"], PDO::PARAM_STR);
  		$stmt -> bindParam(":orden", $datos["orden"], PDO::PARAM_STR);
        $stmt -> bindParam(":siniestro", $datos["siniestro"], PDO::PARAM_STR);
		$stmt -> bindParam(":taller", $datos["taller"], PDO::PARAM_STR);
		$stmt -> bindParam(":aseguradora", $datos["aseguradora"], PDO::PARAM_STR);
		$stmt -> bindParam(":fechaOrden", $datos["fechaOrden"], PDO::PARAM_STR);
		$stmt -> bindParam(":placa", $datos["placa"], PDO::PARAM_STR);
		$stmt -> bindParam(":marca", $datos["marca"], PDO::PARAM_STR);
		$stmt -> bindParam(":modelo", $datos["modelo"], PDO::PARAM_STR);
		$stmt -> bindParam(":ano", $datos["ano"], PDO::PARAM_STR);
		$stmt -> bindParam(":plazo", $datos["plazo"], PDO::PARAM_STR);
		$stmt -> bindParam(":fechaVencimiento", $datos["fechaVencimiento"], PDO::PARAM_STR);		
		$stmt -> bindParam(":observacion", $datos["observacion"], PDO::PARAM_STR);
		$stmt -> bindParam(":envio", $datos["envio"], PDO::PARAM_STR);
		$stmt -> bindParam(":flete", $datos["flete"], PDO::PARAM_STR);
		$stmt -> bindParam(":impAduanas", $datos["impAduanas"], PDO::PARAM_STR);   
		$stmt -> bindParam(":pdf1", $datos["pdf1"], PDO::PARAM_STR);
		$stmt -> bindParam(":pdf2", $datos["pdf2"], PDO::PARAM_STR);
		$stmt -> bindParam(":pdf3", $datos["pdf3"], PDO::PARAM_STR);		
		$stmt -> bindParam(":pdf4", $datos["pdf4"], PDO::PARAM_STR);
		$stmt -> bindParam(":pdf5", $datos["pdf5"], PDO::PARAM_STR);

        		
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
                           
	static public function mdlBorrarOrden($tabla, $datos){
		
		//$stmt = Conexion::conectar()->prepare("DELETE t1,t2 FROM $tabla AS t1 INNER JOIN articulos AS t2 ON t1.id = t2.idOrden WHERE t1.id = :idOrden");
			
		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id = :idOrden");

		$stmt -> bindParam(":idOrden", $datos, PDO::PARAM_INT);


        if($stmt -> execute()){

			return "ok";
		
		}else{
           
			return "error";	

		}   

		$stmt -> close();

		$stmt = null;
			

	} // fin funcion mdlBorrarOrden
    

    /*=============================================
	ACTUALISA SALDO ORDENES
	=============================================*/

	static public function mdlActualisaOrden($tabla, $datos){
	
		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET montoOrden = montoOrden + :montoOrden, costoOrden = costoOrden + :costoOrden, estado = :estado WHERE id = :idOrden");

  		$stmt -> bindParam(":montoOrden", $datos["montoOrden"], PDO::PARAM_STR);

  		$stmt -> bindParam(":costoOrden", $datos["costoOrden"], PDO::PARAM_STR);

		$stmt -> bindParam(":idOrden", $datos["idOrden"], PDO::PARAM_STR);

		$stmt -> bindParam(":estado", $datos["estado"], PDO::PARAM_STR);
		
		if($stmt -> execute()){
            
			return "ok";
		
		}else{
				
			return "error";	

		} // fin if

		$stmt -> close();

		$stmt = null;

	} // fin mdlActualisaOrden

	 /*=============================================
	ACTUALISA ESTADO ORDENES
	=============================================*/
    static public function mdlEstadoOrden($tabla, $item1, $valor1, $item2, $valor2, $item3, $valor3){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET $item1 = :$item1, $item2 = :$item2 WHERE $item3 = :$item3");
                      
		$stmt -> bindParam(":".$item1, $valor1, PDO::PARAM_STR);
		$stmt -> bindParam(":".$item2, $valor2, PDO::PARAM_STR);
        $stmt -> bindParam(":".$item3, $valor3, PDO::PARAM_STR);               
	
		if($stmt -> execute()){
            
			return "ok";
		
		}else{
				
			return "error";	

		} // fin if

		$stmt -> close();

		$stmt = null;

	} // fin  mdlEstadoOrden
	
	 /*=============================================
	ACTUALISA ESTADO ORDENES
	=============================================*/
    static public function mdlEstadoOrdenOld($tabla, $id, $estado, $monto, $costo, $saldo){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET estado = '$estado', montoOrden = '$monto', costoOrden = '$costo', saldo = '$saldo' WHERE id = '$id'");
                      
		if($stmt -> execute()){
            
			return "ok";
		
		}else{
				
			return "error";	

		} // fin if

		$stmt -> close();

		$stmt = null;

	} // fin  mdlEstadoOrden
	

    /*=============================================
	SUMAR EL TOTAL DE VENTAS
	=============================================*/

	static public function mdlSumaVentas($tabla){	

		$stmt = Conexion::conectar()->prepare("SELECT SUM(montoOrden) as totalVentas, SUM(costoOrden) as totalCostos, SUM(saldo) as totalSaldos  FROM $tabla");

		$stmt -> execute();

		return $stmt -> fetch();

		$stmt -> close();

		$stmt = null;

	} // fin  funcion mdlSumaVentas
	
	/*=============================================
	SUMAR EL TOTAL DE CLIENTES
	=============================================*/

	static public function mdlSumaClientes($tabla){	

		$stmt = Conexion::conectar()->prepare("SELECT taller, SUM(montoOrden) as total FROM $tabla GROUP BY taller ORDER BY total DESC");

		$stmt -> execute();

		return $stmt -> fetchAll();

		$stmt -> close();

		$stmt = null;

	} // fin  funcion mdlSumaClientes      
    
    /*=============================================
        REPORTE DE ORDENES X FECHA
	=============================================*/
    static public function mdlReporteFecha($tabla, $valor1, $valor2){	

		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla 
											 WHERE estado <> 'Anulado' AND fechaOrden BETWEEN '$valor1' AND '$valor2'");
        
		$stmt -> execute();

		return $stmt -> fetchAll();

		$stmt -> close();

		$stmt = null;
  
	} // fin  funcion mdlReporteFecha
	/*=============================================
        REPORTE DE ORDENES X FECHA x ASEGURADORA
	=============================================*/
    static public function mdlReporteFechaAs($tabla, $valor1, $valor2,$aseguradora){	

		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla 
											 WHERE estado <> 'Anulado' AND fechaOrden BETWEEN '$valor1' AND '$valor2'
											 AND aseguradora = '$aseguradora'");
        
		$stmt -> execute();

		return $stmt -> fetchAll();

		$stmt -> close();

		$stmt = null;
         
	} // fin  funcion mdlReporteFecha
	/*=============================================
	    LISTA DETALLADA DE ORDENES
	=============================================*/

	static public function mdlDetalleOrden($valor1,$valor2){	    

		$stmt = Conexion::conectar()->prepare("SELECT t2.orden, 
		                                       t1.siniestro,
											   t1.taller,
											   t1.aseguradora,
											   t1.fechaOrden,
											   t1.plazo,
											   t1.placa,
											   t1.marca,
											   t1.modelo,
											   t1.ano,
											   t2.numParte,
											   t2.compra,
											   t2.numMia,
											   t2.descripcion,
											   t2.numFactura,
											   t2.totalVenta,
											   t2.TCompra,
											   t2.totalCol,
										       t2.estado			
											   FROM articulos t1 INNER JOIN ordenes t2 
											   ON t1.idOrden = t2.id
											   WHERE t1.fechaOrden BETWEEN '$valor1' AND '$valor2'
											   ORDER BY t2.estado DESC");

		$stmt -> execute();
          
		return $stmt -> fetchAll();

		$stmt -> close();

		$stmt = null;

	} // fin  funcion mdDetalleOrden

	/*=============================================
			    LISTADO X SALDOS
	=============================================*/

	static public function mdlReporteSaldos(){	    

		$stmt = Conexion::conectar()->prepare("SELECT t2.orden, 
		                                       t2.aseguradora,
											   IF(t1.numFactura = '',CONCAT('Od: ',t2.orden), t1.numFactura) as factura,
											   t1.fechaFactura,
											   t1.presentacion,
											   t1.totalVenta,
											   t1.estado,
											   SUM(t1.totalVenta) as monto
											   FROM articulos as t1 INNER JOIN ordenes as t2  
											   ON t1.idOrden = t2.id
											   WHERE t1.estado != 'Pagado'
											   GROUP BY factura
											   ORDER BY t2.aseguradora, t1.presentacion DESC");
		
		$stmt -> execute();
          
		return $stmt -> fetchAll();

		$stmt -> close();

		$stmt = null;

	} // fin  funcion mdReporteSaldos
	
	/*=============================================
			    LISTADO X SALDOS OLD
	=============================================*/

	static public function mdlReporteSaldosOld(){	    

		$stmt = Conexion::conectar()->prepare("SELECT t2.orden, 
												t2.aseguradora,
												IF(t1.numFactura = '',CONCAT('Od: ',t2.orden), t1.numFactura) as factura,
												t1.fechaFactura,
												t1.presentacion,
												t1.totalVenta,
												t1.estado,
												SUM(t1.totalVenta) as monto
												FROM lineas as t1 INNER JOIN expedientes as t2  
												ON t1.idOrden = t2.id
												WHERE t1.estado != 'Pagado'
												GROUP BY factura
												ORDER BY t1.presentacion DESC");

		$stmt -> execute();
          
		return $stmt -> fetchAll();

		$stmt -> close();

		$stmt = null;   

	} // fin  funcion mdReporteSaldos
	
	/*=============================================
        REPORTE DE ORDENES X FACTURA
	=============================================*/
    static public function mdlReporteXfactura($fechaIni, $fechaFin){	

		$stmt = Conexion::conectar()->prepare("SELECT CAST(t2.numFactura AS UNSIGNED) as factura, 
												t1.orden,
												t1.placa,
												t1.aseguradora,
												t1.taller,
												SUM(t2.totalVenta) as venta,
												SUM(t2.costoLocal + totalCol) as costo
												FROM ordenes as t1 INNER JOIN articulos as t2 
												ON t1.id = t2.idOrden
												WHERE t2.numFactura != '' AND t2.fechaFactura BETWEEN '$fechaIni' AND '$fechaFin' 
												GROUP BY t2.numFactura
												ORDER BY CAST(t2.numFactura AS UNSIGNED) ASC");
												
		$stmt -> execute();
		return $stmt -> fetchAll();
		$stmt -> close();
		$stmt = null;
  
	} // fin  funcion mdlReporteXfactura
	
	/*=============================================
        REPORTE DE ORDENES X FACTURA X AS
	=============================================*/
    static public function mdlReporteXfacturaAs($fechaIni, $fechaFin,$aseguradora){	

		$stmt = Conexion::conectar()->prepare("SELECT CAST(t2.numFactura AS UNSIGNED) as factura, 
												t1.orden,
												t1.placa,
												t1.aseguradora,
												t1.taller,
												SUM(t2.totalVenta) as venta,
												SUM(t2.costoLocal + totalCol) as costo
												FROM ordenes as t1 INNER JOIN articulos as t2 
												ON t1.id = t2.idOrden
												WHERE t2.numFactura != '' AND t2.fechaFactura BETWEEN '$fechaIni' AND '$fechaFin'
												AND t1.aseguradora = '$aseguradora' 
												GROUP BY t2.numFactura
												ORDER BY CAST(t2.numFactura AS UNSIGNED) ASC");
												
		$stmt -> execute();
		return $stmt -> fetchAll();
		$stmt -> close();
		$stmt = null;
  
	} // fin  funcion mdlReporteXfactura
	
} // fin de la class modelo Ordenes