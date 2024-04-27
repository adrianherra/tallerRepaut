<?php
     
class ControladorFacturas{
	/*=============================================
    	CREAR LINEA FACTURA   
	=============================================*/
	static public function ctrCrearLinea(){
		if(isset($_POST["nParte"])){
			$tabla = "detallefactura";
			$total = $_POST["nMonto"] * $_POST["nCanti"] ;
			$factura = $_POST["nIdFactura"];
			     
			$datos = array(	"idFactura"   => $factura,
							"sold1"       => $_POST["nSold1"],
							"sold2"       => $_POST["nSold2"],
							"sold3"       => $_POST["nSold3"],
							"sold4"       => $_POST["nSold4"],
							"ship"        => $_POST["nShip"],
							"ship1"       => $_POST["nShip1"],		
							"cantidad"    => $_POST["nCanti"],
							"tracking"    => $_POST["nTrack"],
							"parte"       => $_POST["nParte"],						
							"descripcion" => $_POST["nDescri"],
							"monto"       => $_POST["nMonto"],
							"total"       => $total);
		    //var_dump($datos);
			$respuesta = ModeloFacturas::mdlLineaFactura($tabla, $datos);
	   		if($respuesta == "ok"){
				$tabla = "facturas";
				  
				$respuesta1 = ModeloFacturas::mdlActualizaFactura($tabla, $datos);
				if($respuesta1 == "ok"){
					echo'<script>
						window.location = "facturas";
					</script>';
				}// fin if	
			} // fin if   
		} // fin if  
	} // fin ctrCrearEntrada
    
	/*=============================================
    	EDITAR LINEA FACTURA   
	=============================================*/
	static public function ctrEditarFactura(){
		if(isset($_POST["eParte"])){
			$tabla = "detallefactura";
			$total = $_POST["eMonto"] * $_POST["eCanti"] ;
			$monto = $_POST["eMonto"];
			$datos = array(	"idFactura" => $_POST["eIdFactura"],
							"cantidad" => $_POST["eCanti"],
							"parte" => $_POST["eParte"],						
							"descripcion" => $_POST["eDescri"],
							"monto" => $monto,
							"total" => $total);
			
			//var_dump($datos);   
			$respuesta = ModeloFacturas::mdlEditarFactura($tabla, $datos);
			if($respuesta == "ok"){
				echo'<script>
				    window.location = "facturas";
				</script>';
			} // fin if       
		} // fin if  
	} // fin ctrCrearEntrada
	/*=============================================
    	MOSTRAR LINEAS FACTURA
	=============================================*/
	static public function ctrMostrarLineas($item, $valor){
		$tabla = "detalleFactura";
		$respuesta = ModeloFacturas::mdlMostrarLineas($tabla, $item, $valor);
		return $respuesta;
	} // fin ctrMostrarLineas          
	  
	/*=============================================
    	MOSTRAR FACTURAs
	=============================================*/
	static public function ctrMostrarFacturas($item, $valor){
		$tabla = "facturas";
		$respuesta = ModeloFacturas::mdlMostrarFacturas($tabla, $item, $valor);
		return $respuesta;
	}// fin ctrMostrarFacturas
	  
	/*=============================================
    	MOSTRAR CONSECUTIVO
	=============================================*/
	static public function ctrConsecutivo(){
		$respuesta = ModeloFacturas::mdlConsecutivo();
		return $respuesta;
	}// fin ctrConsecutivo

	/*=============================================
		BORRAR ENTRADA
	=============================================*/
	static public function ctrBorrarLinea(){
		if(isset($_GET["lnFactura"])){
			$tabla ="detallefactura";
			$datos = $_GET["lnFactura"];
			$respuesta = ModeloFacturas::mdlBorrarLinea($tabla, $datos);
			if($respuesta == "ok"){
				echo'<script>
					window.location = "facturas";
				</script>';
			} // fin if 		
		} // fin if
	} // fin funcion ctrBorrarLineas
	 
} // fin controladorFacturas  
   