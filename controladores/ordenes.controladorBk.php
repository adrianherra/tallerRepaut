<?php

class ControladorOrdenes{
	
	/*=============================================
	REGISTRO DE ControladorOrdenes
	=============================================*/

	static public function ctrCrearOrden(){
              
		if(isset($_POST["nuevoNumero"])){
           
          if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoNumero"])) {
				$tabla = "ordenes";
                 
				$datos = array("numero" => $_POST["nuevoNumero"],
					           "placa" => $_POST["nuevaPlaca"],
					           "taller" => $_POST["nuevoTaller"],
					           "fechaAutorizado" => $_POST["nuevaFechaA"],
					           "fechaVencimiento" => $_POST["nuevaFechaV"],
					           "fechaEntrega" => $_POST["nuevaFechaE"],
					           "plazo" => $_POST["nuevoPlazo"],
					           "montoOrden" => $_POST["nuevoMonto"],	
					           "costoRepuesto" => $_POST["costoRepuesto"],
					           "costoEnvio" => $_POST["costoEnvio"],
					           "costoAdicional" => $_POST["costoAdicional"],
					           "utilidad" => $_POST["nuevaUtilidad"],
					           "observaciones" => $_POST["nuevaObservacion"]);

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

			}else{

				echo '<script>

					swal({

						type: "error",
						title: "¡El numero no puede ir vacío o llevar caracteres especiales!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"

					}).then(function(result){

						if(result.value){
						    console.log("no se pudo");
							window.location = "ordenes";

						}

					});
				

				</script>';

			}  // fin preg_match


		} // fin isset(POST)


	} // fin funcion ctrCrearOrdenes

	/*=============================================
	EDITAR ORDEN
	=============================================*/

	static public function ctrEditarOrden(){

		if(isset($_POST["editaNumero"])){

			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editaNumero"])){

				$tabla = "ordenes";

				$datos = array("numero" => $_POST["editaNumero"],
					           "placa" => $_POST["editaPlaca"],
					           "taller" => $_POST["editaTaller"],
					           "fechaAutorizado" => $_POST["editaFechaA"],
					           "fechaVencimiento" => $_POST["editaFechaV"],
					           "fechaEntrega" => $_POST["editaFechaE"],
					           "plazo" => $_POST["editaPlazo"],
					           "montoOrden" => $_POST["editaMonto"],	
					           "costoRepuesto" => $_POST["eCostoRepuesto"],
					           "costoEnvio" => $_POST["eCostoEnvio"],
					           "costoAdicional" => $_POST["eCostoAdicional"],
					           "utilidad" => $_POST["editaUtilidad"],
					           "observaciones" => $_POST["editaObservacion"]);

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


			}else{

				echo'<script>

					swal({
						  type: "error",
						  title: "¡La orden no puede ir vacía o llevar caracteres especiales!",
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
	BORRAR Orden
	=============================================*/
                           
	static public function ctrBorrarOrden(){

		if(isset($_GET["idOrden"])){

			$tabla ="ordenes";
			$datos = $_GET["idOrden"];

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

	} // fin funcion ctrBorrarOrden
	
			

} // fin clase ControladorOrdenes 
	

