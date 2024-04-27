<?php

    
class ControladorOrdenes{
	  
	/*=============================================
	REGISTRO DE ControladorOrdenes
	=============================================*/

	static public function ctrCrearOrden(){
          
		if(isset($_POST["nuevaOrden"])){
             
                   
                /*========== VALIDAR PDF1 ===========================*/
               	$destino1 = "vistas/img/ordenes/default/vacio.pdf";

			    if(isset($_FILES["nuevoPdf1"]["tmp_name"])){
              	  
              	   $nombre = $_FILES["nuevoPdf1"]["name"];
                  
                   if ($nombre != "") {	
					  $destino1 = "vistas/img/ordenes/".$nombre;
				  	  $origen = $_FILES["nuevoPdf1"]["tmp_name"];						
     			      copy($origen, $destino1);
     			   }// fin if
     			     	
				} // fin if 
                /*=========FIN DE VALIDACION PDF1 ==============*/
                
                /*========== VALIDAR PDF2 ===========================*/
               	$destino2 = "vistas/img/ordenes/default/vacio.pdf";

			    if(isset($_FILES["nuevoPdf2"]["tmp_name"])){
              	   $nombre = $_FILES["nuevoPdf2"]["name"];
                
                   if ($nombre != "") {	
					  $destino2 = "vistas/img/ordenes/".$nombre;
     				  $origen = $_FILES["nuevoPdf2"]["tmp_name"];
                      copy($origen, $destino2);
				   } // fin if

				} // fin creacion de imagen 
                /*=========FIN DE VALIDACION PDF2 ==============*/
                
                /*========== VALIDAR PDF3 ===========================*/
               	$destino3 = "vistas/img/ordenes/default/vacio.pdf";

			    if(isset($_FILES["nuevoPdf3"]["tmp_name"])){
              	   $nombre = $_FILES["nuevoPdf3"]["name"];
                   
                   if ($nombre != "") {	
					  $destino3 = "vistas/img/ordenes/".$nombre;
					  $origen = $_FILES["nuevoPdf3"]["tmp_name"];						
					  copy($origen, $destino3);
				   }// fin if
				   	  	
				} // fin creacion de imagen 
                /*=========FIN DE VALIDACION PDF3 ==============*/
                
               /*========== VALIDAR PDF4 ===========================*/
               	$destino4 = "vistas/img/ordenes/default/vacio.pdf";

			    if(isset($_FILES["nuevoPdf4"]["tmp_name"])){
              	   $nombre = $_FILES["nuevoPdf4"]["name"];
                   
                   if ($nombre != "") {	
					  $destino4 = "vistas/img/ordenes/".$nombre;
					  $origen = $_FILES["nuevoPdf4"]["tmp_name"];						
					  copy($origen, $destino4);
					} // fin if
					  
				} // fin creacion de imagen 
                /*=========FIN DE VALIDACION PDF4 ==============*/
                
                /*========== VALIDAR PDF5 ===========================*/
               	$destino5 = "vistas/img/ordenes/default/vacio.pdf";

			    if(isset($_FILES["nuevoPdf5"]["tmp_name"])){
              	   $nombre = $_FILES["nuevoPdf5"]["name"];
                   
                   if ($nombre != ""){	
					  $destino5 = "vistas/img/ordenes/".$nombre;
					  $origen = $_FILES["nuevoPdf5"]["tmp_name"];						
					  copy($origen, $destino5);
				   }// fin if	  
				} // fin creacion de imagen 
                /*=========FIN DE VALIDACION PDF5 ==============*/

 				$tabla = "ordenes";

				$datos = array("orden" => $_POST["nuevaOrden"],
							   "siniestro" => $_POST["nuevoSiniestro"],		
					           "aseguradora" => $_POST["nuevaAseguradora"],
					           "taller" => $_POST["nuevoTaller"],
					           "fechaOrden" => $_POST["nuevaFecha"],
					           "placa" => $_POST["nuevaPlaca"],
					           "marca" => $_POST["nuevaMarca"],
					           "modelo" => $_POST["nuevoModelo"],
					           "ano" => $_POST["nuevoAno"],
							   "plazo" => $_POST["nuevoPlazo"],
							   "fechaVencimiento" => $_POST["nuevaFVenc"],
							   "observacion" => $_POST["nuevaObserva"],
							   "envio" => $_POST["nuevoEnvio"],
							   "flete" => $_POST["nuevoFlete"],
							   "impAduanas" => $_POST["nuevoImpAduanas"],
					           "pdf1" => $destino1,
					           "pdf2" => $destino2,
					           "pdf3" => $destino3,
					       	   "pdf4" => $destino4,
					       	   "pdf5" => $destino5);
          
   				$respuesta = ModeloOrdenes::mdlIngresarOrdenes($tabla,$datos);	
                      
               	if($respuesta == "ok"){

					echo '<script>

						swal({

							type: "success",
							title: "¡La orden ha sido guardada correctamente..!",
							showConfirmButton: true,
							confirmButtonText: "Cerrar"

						}).then(function(result){

							if(result.value){
						      					       
								window.location = "ordenes";

							}
	
						});
		
					</script>';
	
				}// fin if

	
		} // fin isset(POST)

  
	} // fin funcion ctrCrearOrdenes

	/*=============================================
	EDITAR ORDEN
	=============================================*/

	static public function ctrEditarOrden(){

		if(isset($_POST["editaOrden"])){

				/*=============================================
				VALIDAR PDFS
				=============================================*/
			    /*========== VALIDAR PDF1 ===========================*/
               	$destino1 = $_POST["pdfActual1"]; //"vistas/img/ordenes/default/vacio.pdf";
             
			    if(isset($_FILES["editaPdf1"]["tmp_name"])){
              	  
              	   $nombre = $_FILES["editaPdf1"]["name"];
                  
                   if ($nombre != "") {	
					  $destino1 = "vistas/img/ordenes/".$nombre;
				  	  $origen = $_FILES["editaPdf1"]["tmp_name"];						
     			      copy($origen, $destino1);
     			   }// fin if
     			     	        
				} // fin if 
                /*=========FIN DE VALIDACION PDF1 ==============*/
                
                /*========== VALIDAR PDF2 ===========================*/
               	$destino2 = $_POST["pdfActual2"]; //"vistas/img/ordenes/default/vacio.pdf";

			    if(isset($_FILES["editaPdf2"]["tmp_name"])){
              	   $nombre = $_FILES["editaPdf2"]["name"];
                
                   if ($nombre != "") {	
					  $destino2 = "vistas/img/ordenes/".$nombre;
     				  $origen = $_FILES["editaPdf2"]["tmp_name"];
                      copy($origen, $destino2);
				   } // fin if

				} // fin creacion de imagen 
                /*=========FIN DE VALIDACION PDF2 ==============*/
                
                /*========== VALIDAR PDF3 ===========================*/
               	$destino3 = $_POST["pdfActual3"]; //"vistas/img/ordenes/default/vacio.pdf";

			    if(isset($_FILES["editaPdf3"]["tmp_name"])){
              	   $nombre = $_FILES["editaPdf3"]["name"];
                   
                   if ($nombre != "") {	
					  $destino3 = "vistas/img/ordenes/".$nombre;
					  $origen = $_FILES["editaPdf3"]["tmp_name"];						
					  copy($origen, $destino3);
				   }// fin if
				   	  	
				} // fin creacion de imagen 
                /*=========FIN DE VALIDACION PDF3 ==============*/
                
               /*========== VALIDAR PDF4 ===========================*/
               	$destino4 = $_POST["pdfActual4"]; //"vistas/img/ordenes/default/vacio.pdf";

			    if(isset($_FILES["editaPdf4"]["tmp_name"])){
              	   $nombre = $_FILES["editaPdf4"]["name"];
                   
                   if ($nombre != "") {	
					  $destino4 = "vistas/img/ordenes/".$nombre;
					  $origen = $_FILES["editaPdf4"]["tmp_name"];						
					  copy($origen, $destino4);
					} // fin if
					  
				} // fin creacion de imagen 
                /*=========FIN DE VALIDACION PDF4 ==============*/
                
                /*========== VALIDAR PDF5 ===========================*/
               	$destino5 = $_POST["pdfActual5"]; //"vistas/img/ordenes/default/vacio.pdf";

			    if(isset($_FILES["editaPdf5"]["tmp_name"])){
              	   $nombre = $_FILES["editaPdf5"]["name"];
                   
                   if ($nombre != ""){	
					  $destino5 = "vistas/img/ordenes/".$nombre;
					  $origen = $_FILES["editaPdf5"]["tmp_name"];						
					  copy($origen, $destino5);
				   }// fin if	  
				} // fin creacion de imagen 
                /*=========FIN DE VALIDACION PDF5 ==============*/ 

				$tabla = "ordenes";
                
                $datos = array("id" => $_POST["editaIdOrden"],
                	           "orden" => $_POST["editaOrden"],
							   "siniestro" => $_POST["editaSiniestro"],		
					           "aseguradora" => $_POST["editaAseguradora"],
					           "taller" => $_POST["editaTaller"],
					           "fechaOrden" => $_POST["editaFecha"],
					           "placa" => $_POST["editaPlaca"],
					           "marca" => $_POST["editaMarca"],
					           "modelo" => $_POST["editaModelo"],
					           "ano" => $_POST["editaAno"],
					           "plazo" => $_POST["editaPlazo"],
					           "fechaVencimiento" => $_POST["editaFVenc"],
							   "observacion" => $_POST["editaObserva"],
							   "envio" => $_POST["editaEnvio"],
							   "flete" => $_POST["editaFlete"],
							   "impAduanas" => $_POST["editaImpAduanas"],
					           "pdf1" => $destino1,
					           "pdf2" => $destino2,
					           "pdf3" => $destino3,
					       	   "pdf4" => $destino4,
	     			       	   "pdf5" => $destino5);
      				
				$respuesta = ModeloOrdenes::mdlEditarOrdenes($tabla, $datos);
    
				if($respuesta == "ok"){

					echo'<script>

					swal({
						  type: "success",
						  title: "La orden ha sido cambiada correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "ordenes";

									}
								})

					</script>';

				}

		}

	}

	/*=============================================
	MOSTRAR ordenes
	=============================================*/
	static public function ctrMostrarOrdenes($item,$valor){

		$tabla = "ordenes";
             
		$respuesta = ModeloOrdenes::mdlMostrarOrdenes($tabla, $item, $valor);		
     
		return $respuesta;

	}// fin metodo ctrMostrarOrdenes

	
	/*=============================================
	MOSTRAR aseguradoras
	=============================================*/
	static public function ctrMostrarAseguradoras(){

		$respuesta = ModeloOrdenes::mdlMostrarAseguradoras();		
     
		return $respuesta;

	}// fin metodo ctrMostrarAseguradoras



	/*=============================================
	BORRAR Orden
	=============================================*/
                           
	static public function ctrEliminarOrden(){

		if(isset($_GET["idOrden"])){

			$tabla ="ordenes";
			$datos = $_GET["idOrden"];

			//echo "<script>alert(".$datos.");</script>";

			if($_GET["pdf"] != "" && $_GET["pdf"] != "vistas/img/ordenes/default/vacio.pdf"){

				unlink($_GET["pdf"]);
				
			}
			
			
			$respuesta = ModeloOrdenes::mdlBorrarOrden($tabla, $datos);
                    
			if($respuesta == "ok"){

				echo'<script>

				swal({
					  type: "success",
					  title: "La Orden ha sido borrada correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar"
					  }).then(function(result){
								if (result.value) {

								window.location = "ordenes";

								}
							})

				</script>';

			} // fin if  		

		} // fin if

	} // fin funcion ctrBorrarOrdenes
	
	/*=============================================
	SUMA TOTAL VENTAS
	=============================================*/

	public function ctrSumaVentas(){

		$tabla = "ordenes";

		$respuesta = ModeloOrdenes::mdlSumaVentas($tabla);

		return $respuesta;

	} // fin funcion ctrSumaVentas
	         
	/*=============================================
	SUMA TOTAL CLIENTES
	=============================================*/

	public function ctrSumaClientes(){

		$tabla = "ordenes";

		$respuesta = ModeloOrdenes::mdlSumaClientes($tabla);

		return $respuesta;

	} // fin funcion ctrSumaClientes
	    
    

} // fin clase ControladorOrdenes 
	

