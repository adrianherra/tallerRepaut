<?php


class ControladorPagos{
	          
	/*=============================================
	REGISTRO DE ControladorPagos
	=============================================*/

	static public function ctrCrearPagos(){
          
		if(isset($_POST["nuevoTipo"])){

	      
                /*=============================================
				VALIDAR PDF
				=============================================*/
               
			   	$destino = "vistas/pdf/pagos/vacio.pdf";

			    if(isset($_FILES["nuevoPDF"]["tmp_name"])){
              		/*=============================================
					CREAMOS EL DIRECTORIO DONDE VAMOS A GUARDAR LA FOTO DEL USUARIO
					=============================================*/
                   
					  
					$nombre = $_FILES["nuevoPDF"]["name"];

					if ($nombre != "") 
     					$destino = "vistas/pdf/pagos/".$nombre;

					$origen = $_FILES["nuevoPDF"]["tmp_name"];						

					copy($origen, $destino);


				} // fin creacion de imagen 
	             

 				$tabla = "pagos";
                
                if ($_POST["nuevoTipo"] == "Otros") {
                	$tipo = $_POST["nuevoOtro"];
                } else {
                	$tipo = $_POST["nuevoTipo"];
                }
               
				$datos = array("tipo" => $tipo,
							   "numero" => $_POST["nuevoDoc"],		
					           "fecha" => $_POST["nuevaFecha"],
					           "monto" => $_POST["nuevoMonto"],
					           "dolares" => $_POST["nuevoDolar"],
					           "observacion" => $_POST["nuevaObserva"],
					           "pdf" => $destino);
                

   				$respuesta = ModeloPagos::mdlIngresarPagos($tabla,$datos);	
                   
               	if($respuesta == "ok"){
                    

					echo '<script>

						swal({

							type: "success",
							title: "¡El Pago ha sido guardado correctamente..!",
							showConfirmButton: true,
							confirmButtonText: "Cerrar"

						}).then(function(result){

							if(result.value){
						      					       
								window.location = "pagos";

							}
	
						});
		
					</script>';
	
				}// fin if

			
		} // fin isset(POST)
   

	} // fin funcion ctrCrearPagos

	/*=============================================
	EDITAR PAGO
	=============================================*/

	static public function ctrEditarPagos(){

		if(isset($_POST["editaTipo"])){    

			      
				/*=============================================
				VALIDAR PDF
				=============================================*/
                  
			   	$destino = $_POST["pdfActual"];
                
                if(isset($_FILES["editaPDF"]["tmp_name"]) && !empty($_FILES["editaPDF"]["tmp_name"])){

						/*=============================================
						GUARDAMOS LA IMAGEN EN EL DIRECTORIO
						=============================================*/

						$aleatorio = mt_rand(100,999);

						$nombre = $_FILES["editaPDF"]["name"];

						$destino = "vistas/pdf/pagos/".$nombre;

						$origen = $_FILES["editaPDF"]["tmp_name"];						

						copy($origen, $destino);	
						
				} // fin editar imagen  

				$tabla = "pagos";


				if ($_POST["editaTipo"] == "Otros") {
                	$tipo = $_POST["editaOtro"];
                } else {
                	$tipo = $_POST["editaTipo"];
                }
               
				$datos = array("id"  => $_POST["editaId"],
							   "tipo" => $tipo,
							   "numero" => $_POST["editaDoc"],	
					           "fecha" => $_POST["editaFecha"],
					           "monto" => $_POST["editaMonto"],
					           "dolares" => $_POST["editaDolar"],
					           "observacion" => $_POST["editaObserva"],
					           "pdf" => $destino);

   				
				$respuesta = ModeloPagos::mdlEditarPagos($tabla, $datos);
    
				if($respuesta == "ok"){

					echo'<script>

					swal({
						  type: "success",
						  title: "El pago ha sido cambiado correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "pagos";

									}
								})

					</script>';

				}
			
		}

	}

	/*=============================================
	MOSTRAR PAGOS
	=============================================*/
	static public function ctrMostrarPagos($item,$valor){

		$tabla = "pagos";
             
		$respuesta = ModeloPagos::mdlMostrarPagos($tabla, $item, $valor);		
        
		return $respuesta;

	}// fin metodo ctrMostrarPagos
	
	/*=============================================
	BORRAR PAGO
	=============================================*/
                           
	static public function ctrEliminarPago(){

		if(isset($_GET["idPago"])){

			$tabla ="pagos";
			$datos = $_GET["idPago"];

			
			

			if($_GET["pdf"] != "" && $_GET["pdf"] != "vistas/pdf/pagos/vacio.pdf"){

				unlink($_GET["pdf"]);
				
			}
  
			$respuesta = ModeloPagos::mdlBorrarPagos($tabla, $datos);

			if($respuesta == "ok"){

				echo'<script>

				swal({
					  type: "success",
					  title: "El Pago ha sido borrado correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar"
					  }).then(function(result){
								if (result.value) {

								window.location = "pagos";

								}
							})

				</script>';

			} // fin if 		

		} // fin if

	} // fin funcion ctrBorrarPagos
   
} // fin clase ControladorPagos 
	

