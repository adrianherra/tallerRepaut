<?php
     
       
class ControladorLineasDima{
	       
	/*=============================================
	REGISTRO DE ControladorLineas
	=============================================*/
    
	static public function ctrCrearLinea(){
          

		if(isset($_POST["nOrden"])){
                        	
 				$tabla = "lineas";

                $estado = "En Proceso";
                             
				$datos = array("idOrden" => $_POST["nId"],
							  "numParte" => $_POST["nParte"],
							  "compra" => $_POST["nCompra"],
							  "numMia" => $_POST["nMia"],
							  "rutaMia" => $_POST["nRuta"],
							  "descripcion" => $_POST["nDescri"],
							  "numFactura" => $_POST["nFactura"],
							  "fechaFactura" => $_POST["nFecha"], 	
							  "presentacion" => $_POST["nPresenta"],
							  "vencimiento" => $_POST["nVencimiento"],	
							  "tipo" => $_POST["nTipo"],
							  "cantidad" => $_POST["nCantidad"],
							  "pVenta" => $_POST["nPVenta"],
							  "impVenta" => $_POST["nImpVenta"],
							  "totalVenta" => $_POST["nPrecioIva"],
							  "costoLocal" => $_POST["nCostoLocal"],
							  "impLocal" => $_POST["nImpCompra"],
							  "TCompra" => $_POST["nTCompra"],
                              "TCambio" => $_POST["nTCambio"],
                              "costoUsa" => $_POST["nCostoUsa"],
                              "impImporta" => $_POST["nImpImporta"],
                              "envioUsa" => $_POST["nEnvio"],
							  "impAduana" => $_POST["nAduana"],
							  "impMia" => $_POST["nImpMia"],
							  "envioMia" => $_POST["nEnvioMia"],
							  "totalUsa" => $_POST["nTotalUsa"], 
							  "totalCol" => $_POST["nTotalCol"],
							  "estado" => $estado);
                             
   				$respuesta = ModeloLineas::mdlIngresarLineas($tabla,$datos);
                      
                                              
   				$tabla = "expedientes";
            	 	 
            	$idOrden    =  $_POST["nId"];	 
            	$montoOrden =  $_POST["nPrecioIva"];
            	$costoOrden =  $_POST["nTCompra"] + $_POST["nTotalCol"] ;
				  
				$datos = array("idOrden" => $idOrden,
					       	   "montoOrden" => $montoOrden,
					       	   "costoOrden" => $costoOrden,
					       	   "estado" => $estado);
                  
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
						         
								window.location = "lineasDima";
								
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
               
		    	$tabla = "lineas";

				$datos = array("id" => $_POST["eId"],
					          "idOrden" => $_POST["eOrden"],
							  "numParte" => $_POST["eParte"],
							  "compra" => $_POST["eCompra"],
							  "numMia" => $_POST["eMia"],
							  "rutaMia" => $_POST["eRuta"],
							  "descripcion" => $_POST["eDescri"],
							  "numFactura" => $_POST["eFactura"],
							  "fechaFactura" => $_POST["eFecha"], 	
							  "presentacion" => $_POST["ePresenta"],
							  "vencimiento" => $_POST["eVencimiento"],	
							  "tipo" => $_POST["eTipo"],
							  "cantidad" => $_POST["eCantidad"],
							  "pVenta" => $_POST["ePVenta"],
							  "impVenta" => $_POST["eImpVenta"],
							  "totalVenta" => $_POST["ePrecioIva"],
							  "costoLocal" => $_POST["eCostoLocal"],
							  "impLocal" => $_POST["eImpCompra"],
							  "TCompra" => $_POST["eTCompra"],
                              "TCambio" => $_POST["eTCambio"],
                              "costoUsa" => $_POST["eCostoUsa"],
                              "impImporta" => $_POST["eImpImporta"],
                              "envioUsa" => $_POST["eEnvio"],
							  "impAduana" => $_POST["eAduana"],
							  "totalUsa" => $_POST["eTotalUsa"], 
							  "totalCol" => $_POST["eTotalCol"],
							  "estado" => $_POST["eEstado"]);


				$respuesta = ModeloLineas::mdlEditarLineas($tabla, $datos);
    		          		         
				/*$tabla = "expedientes";

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
                        window.location = "lineasDima";
					</script>';

				} // fin if
                      
		}// fin Pos

	} // fin ctrEditarLineas
  

	/*=============================================
	MOSTRAR LINEAS
	=============================================*/
	static public function ctrMostrarLineas($item,$valor){
		$tabla = "lineas";
           
       	$respuesta = ModeloLineas::mdlMostrarLineas($tabla, $item, $valor);		
               
		return $respuesta;

	}// fin metodo ctrMostrarLineas

	/*=============================================
	ACTUALIZAR LINEAS
	=============================================*/
	static public function ctrActualizarLineas($item,$valor){
		$tabla = "lineas";
       
       	$respuesta = ModeloLineas::mdlMostrarLineas($tabla, $item, $valor);		
         
		return $respuesta;

	}// fin metodo ctrActualizarLineas
          
   
	/*=============================================
	BORRAR Lineas
	=============================================*/
                                   
	static public function ctrBorrarLinea(){

		if(isset($_GET["idLinea"])){
           
     		$tabla ="lineas";
           
	    	$datos = $_GET["idLinea"];
			
	    	$respuesta = ModeloLineas::mdlBorrarLineas($tabla, $datos);
            
            $tabla = "expedientes";
            	 	          
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
                                      
				                      window.location = "lineasDima";
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
	

