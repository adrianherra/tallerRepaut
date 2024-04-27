<?php
       
class ControladorLineas{
	/*=============================================
	REGISTRO DE ControladorLineas
	=============================================*/
	static public function ctrCrearLinea(){
		if(isset($_POST["nOrden"])){
        		$tabla = "articulos";
		        $estado = "En Proceso";
        		
				$pVenta      = (double)filter_var($_POST["nPVenta"], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
				$impVenta    = (double)filter_var($_POST["nImpVenta"], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
				$totalVenta  = (double)filter_var($_POST["nPrecioIva"], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
				$costoLocal  = (double)filter_var($_POST["nCostoLocal"], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
				$impLocal    = (double)filter_var($_POST["nImpCompra"], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
				$TCompra     = (double)filter_var($_POST["nTCompra"], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
				$TCambio     = (double)filter_var($_POST["nTCambio"], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
				$costoUsa    = (double)filter_var($_POST["nCostoUsa"], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
				$costoMia    = (double)filter_var($_POST["nCostoMia"], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
				$TotalUsa    = (double)filter_var($_POST["nTotalUsa"], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
				$TotalCol    = (double)filter_var($_POST["nTotalCol"], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);

				$datos  = array("idOrden"     => $_POST["nId"],
							    "numParte"     => $_POST["nParte"],
							    "compra"       => $_POST["nCompra"],
							    "numMia"       => $_POST["nMia"],
							    "rutaMia"      => $_POST["nRuta"],
							    "descripcion"  => $_POST["nDescri"],
							    "numFactura"   => $_POST["nFactura"],
							    "fechaFactura" => $_POST["nFecha"], 	
							    "presentacion" => $_POST["nPresenta"],
							    "vencimiento"  => $_POST["nVencimiento"],	
							    "tipo"         => $_POST["nTipo"],
							    "cantidad"     => $_POST["nCantidad"],
							    "pVenta"       => $pVenta,
							    "impVenta"     => $impVenta,
							    "totalVenta"   => $totalVenta,
							    "costoLocal"   => $costoLocal,
							    "impLocal"     => $impLocal,
							    "TCompra"      => $TCompra,
                                "TCambio"      => $TCambio,
                                "costoUsa"     => $costoUsa,
                                "costoMia"     => $costoMia,
							    "totalUsa"     => $TotalUsa, 
							    "totalCol"     => $TotalCol,
							    "estado"       => $estado);
                //var_dump($datos);    
   				$respuesta = ModeloLineas::mdlIngresarLineas($tabla,$datos);
                      
   				$tabla = "ordenes";
            	 	 
            	$idOrden    =  $_POST["nId"];	    
            	$montoOrden =  $totalVenta;
            	$costoOrden =  $TCompra + $TotalCol;
				    
				$datos = array("idOrden" => $idOrden,
					       	   "montoOrden" => $montoOrden,
					       	   "costoOrden" => $costoOrden,
					       	   "estado" => $estado);
				//var_dump($datos);
				  	
				$respuesta1 = ModeloOrdenes::mdlActualisaOrden($tabla,$datos);	

               	if(($respuesta == "ok") && ($respuesta1 == "ok")){    	
                  	echo '<script>
						swal({
							type: "success",
							title: "¡La linea ha sido guardada correctamente..!",
							showConfirmButton: true,
							confirmButtonText: "Cerrar"

						}).then(function(result){
							if(result.value){
								window.location = "lineas";
							}    
						});
					</script>';
				}// fin if
		} // fin isset(POST)
	} // fin funcion ctrCrearLineas

	/*=============================================
	EDITAR LINEAS
	=============================================*/
   
	static public function ctrEditarLineas(){
		if(isset($_POST["eOrden"])){
		    $tabla = "articulos";

			$pVenta      = (double)filter_var($_POST["ePVenta"], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
			$impVenta    = (double)filter_var($_POST["eImpVenta"], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
			$totalVenta  = (double)filter_var($_POST["ePrecioIva"], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
			$costoLocal  = (double)filter_var($_POST["eCostoLocal"], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
			$impLocal    = (double)filter_var($_POST["eImpCompra"], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
			$TCompra     = (double)filter_var($_POST["eTCompra"], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
			$TCambio     = (double)filter_var($_POST["eTCambio"], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
			$costoUsa    = (double)filter_var($_POST["eCostoUsa"], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
			$costoMia    = (double)filter_var($_POST["eCostoMia"], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
			$TotalUsa    = (double)filter_var($_POST["eTotalUsa"], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
			$TotalCol    = (double)filter_var($_POST["eTotalCol"], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);


			$datos = array("id"          => $_POST["eId"],
				          "idOrden"      => $_POST["eOrden"],
						  "numParte"     => $_POST["eParte"],
						  "compra"       => $_POST["eCompra"],
						  "numMia"       => $_POST["eMia"],
						  "rutaMia"      => $_POST["eRuta"],
						  "descripcion"  => $_POST["eDescri"],
						  "numFactura"   => $_POST["eFactura"],
						  "fechaFactura" => $_POST["eFecha"], 	
						  "presentacion" => $_POST["ePresenta"],
						  "vencimiento"  => $_POST["eVencimiento"],	
						  "tipo"         => $_POST["eTipo"],
						  "cantidad"     => $_POST["eCantidad"],
						  "pVenta"       => $pVenta,
						  "impVenta"     => $impVenta,
						  "totalVenta"   => $totalVenta,
						  "costoLocal"   => $costoLocal,
						  "impLocal"     => $impLocal,
						  "TCompra"      => $TCompra,
                          "TCambio"      => $TCambio,
                          "costoUsa"     => $costoUsa,
			        	  "costoMia"     => $costoMia,
                          "totalUsa"     => $TotalUsa, 
						  "totalCol"     => $TotalCol,
						  "estado"       => $_POST["eEstado"]);

				$respuesta = ModeloLineas::mdlEditarLineas($tabla, $datos);
    		          		    
				/*$tabla = "ordenes";

            	$estado  = $_POST["eEstado"];	 
            	$idOrden    =  $_POST["eId"];	 
            	$montoOrden =  $_POST["ePrecioIva"] - $_POST["eMontoAnte"] ;
            	$costoOrden =  $_POST["eTCompra"] + $_POST["eTotalCol"] - $_POST["eCostoAnte"] ;
				       
				$datos = array("idOrden" => $idOrden,
					       	   "montoOrden" => $montoOrden,
					       	   "costoOrden" => $costoOrden,
					       	   "estado" => $estado);
                
				$respuesta1 = ModeloOrdenes::mdlActualisaOrden($tabla,$datos);	
                */
               	if($respuesta == "ok") {  //&& ($respuesta1 == "ok")){    			
				
					echo'<script>
                        window.location = "lineas";
					</script>';

				} // fin if

		}// fin Pos

	} // fin ctrEditarLineas
  

	/*=============================================
	MOSTRAR LINEAS
	=============================================*/
	static public function ctrMostrarLineas($item,$valor){
		$tabla = "articulos";
       
       	$respuesta = ModeloLineas::mdlMostrarLineas($tabla, $item, $valor);		
         
		return $respuesta;

	}// fin metodo ctrMostrarLineas

	/*=============================================
	ACTUALIZAR LINEAS
	=============================================*/
	static public function ctrActualizarLineas($item,$valor){
		$tabla = "articulos";
       
       	$respuesta = ModeloLineas::mdlMostrarLineas($tabla, $item, $valor);		
         
		return $respuesta;

	}// fin metodo ctrActualizarLineas
          
   
	/*=============================================
	BORRAR Lineas
	=============================================*/
                                   
	static public function ctrBorrarLinea(){

		if(isset($_GET["idLinea"])){
           
     		$tabla ="articulos";
           
	    	$datos = $_GET["idLinea"];
			
	    	$respuesta = ModeloLineas::mdlBorrarLineas($tabla, $datos);
            
            $tabla = "ordenes";
            	 	          
            $idOrden    =  $_GET["idOrden"];	 
            $montoOrden =  $_GET["montoOrden"];
            $costoOrden =  $_GET["costoOrden"];
            $estado = $_GET["estado"];
				  
			$datos = array("idOrden" => $idOrden,
					       	"montoOrden" => $montoOrden,
					       	"costoOrden" => $costoOrden,
					        "estado" => $estado);

			$respuesta1 = ModeloOrdenes::mdlActualisaOrden($tabla,$datos);	
           
            if(($respuesta == "ok") && ($respuesta1 == "ok")){  
                    
				echo'<script>
					
					swal({
						  type: "success",
						  title: "La  linea se ha  borrado correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {
                                      
				                      window.location = "lineas";
									}
								})

					</script>';	

			} // fin if 		

		} // fin if

	} // fin funcion ctrBorrarLineas
	
    /*=============================================
	SUMA TOTAL LINEAS DIAS
	=============================================*/

	public function ctrLineasDia(){

		$respuesta = ModeloLineas::mdlLineasDia();
          
		return $respuesta;
        
	} // fin funcion ctrLineasDia
	
	/*=============================================
	SUMA TOTAL COSTOS DIAS
	=============================================*/

	public function ctrTotalCostos(){

		$respuesta = ModeloLineas::mdlSumaTotales();
          
		return $respuesta;
        
	} // fin funcion ctrTotalCostos
	
	   
	    	
} // fin clase ControladorLineas
	

  