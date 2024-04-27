<?php

class ControladorAseguradoras{
         
	/*=============================================
	CREAR ASEGURADORAS  
	=============================================*/
	static public function ctrCrearAseguadora(){
		if(isset($_POST["nuevaAseguadora"])){
			$tabla = "aseguradoras";
			$datos = array("nombre" => $_POST["nuevaAseguradora"]);

			$respuesta = ModeloAseguradoras::mdlIngresarAseguradora($tabla, $datos);
			if($respuesta == "ok"){
				echo'<script>
				swal({
     				type: "success",
					  title: "La Aseguradora ha sido guardado correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar"
					  }).then(function(result){
						if (result.value) {
							window.location = "aseguradoras";
						} // fin if
					});
				</script>';
			}// fin if
		} // fin if
	} // fin funcion ctrCrearAseguradoras

	
	/*=============================================
	MOSTRAR ASEGURADORAS
	=============================================*/

	static public function ctrMostrarAseguradoras($item, $valor){

		$tabla = "aseguradoras";

		$respuesta = ModeloAseguradoras::mdlMostrarAseguradoras($tabla, $item, $valor);
         
		return $respuesta;
	
	}

	/*=============================================
	EDITAR ASEGURADORAS
	=============================================*/

	static public function ctrEditarAseguradora(){

		if(isset($_POST["editaAseguradora"])){

			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editaAseguradora"])){

				
                $tabla = "aseguradoras";

				$datos = array("nombre" => $_POST["editaAseguradora"]);
				      
        
				$respuesta = ModeloAseguradora::mdlEditarAseguradora($tabla, $datos);

				if($respuesta == "ok"){

					echo'<script>

					swal({
						  type: "success",
						  title: "La aseguradora ha sido cambiado correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "aseguradoras";

									}
								})

					</script>';

				}


			}else{

				echo'<script>

					swal({
						  type: "error",
						  title: "¡En Nombre no puede ir vacía o llevar caracteres especiales!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "aseguradoras";

							}
						})

			  	</script>';

			}

		}

	}
 
	/*=============================================
	BORRAR ASEGURADORA
	=============================================*/

	static public function ctrBorrarAseguradora(){

		if(isset($_GET["idAseguradora"])){

			$tabla ="Aseguradoras";
			$datos = $_GET["idAseguradora"];

			$respuesta = ModeloAseguradoras::mdlBorrarAseguradora($tabla, $datos);

			if($respuesta == "ok"){

				echo'<script>

					swal({
						  type: "success",
						  title: "La aseguradora ha sido borrado correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {
               
									window.location = "aseguradoras";

									}
								})

					</script>';
			}
		}
		
	}
}
