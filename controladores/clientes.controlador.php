<?php

class ControladorClientes{
         
	/*=============================================
	CREAR CLIENTES   
	=============================================*/
	static public function ctrCrearCliente(){
		if(isset($_POST["nuevoCliente"])){
			$tabla = "clientes";
			$datos = array("nombre" => $_POST["nuevoCliente"],
				           "telefono" => $_POST["nuevoTelefono"],
						   "email" => $_POST["nuevoEmail"],
						   "direccion" => $_POST["nuevaDireccion"]);

			$respuesta = ModeloClientes::mdlIngresarCliente($tabla, $datos);
			if($respuesta == "ok"){
				echo'<script>
				swal({
     				type: "success",
					  title: "El cliente ha sido guardado correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar"
					  }).then(function(result){
						if (result.value) {
							window.location = "clientes";
						} // fin if
					});
				</script>';
			}// fin if
		} // fin if
	} // fin funcion ctrCrearCliente

	/*=============================================
	CREAR CLIENTES   
	=============================================*/
	static public function ctrCrearClienteE(){
		if(isset($_POST["nuevoCliente"])){
			$tabla = "clientes";
			$datos = array("nombre" => $_POST["nuevoCliente"],
				           "telefono" => $_POST["nuevoTelefono"],
						   "email" => $_POST["nuevoEmail"],
						   "direccion" => $_POST["nuevaDireccion"]);

			$respuesta = ModeloClientes::mdlIngresarCliente($tabla, $datos);
			if($respuesta == "ok"){
				echo'<script>
				swal({
     				type: "success",
					  title: "El cliente ha sido guardado correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar"
					  }).then(function(result){
						if (result.value) {
							//window.location = "clientes";
							
						} // fin if
					});
				</script>';
			}// fin if
		} // fin if
	} // fin funcion ctrCrearClienteE





	/*=============================================
	MOSTRAR CLIENTES
	=============================================*/

	static public function ctrMostrarClientes($item, $valor){

		$tabla = "clientes";

		$respuesta = ModeloClientes::mdlMostrarClientes($tabla, $item, $valor);
         
		return $respuesta;
	
	}

	/*=============================================
	EDITAR CLIENTES
	=============================================*/

	static public function ctrEditarCliente(){

		if(isset($_POST["editaCliente"])){

			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editaCliente"])){

				
                $tabla = "clientes";

				$datos = array("nombre" => $_POST["editaCliente"],
					           "telefono" => $_POST["editaTelefono"],
					           "email" => $_POST["editaEmail"],
					           "direccion" => $_POST["editaDireccion"]);
				      
        
				$respuesta = ModeloClientes::mdlEditarCliente($tabla, $datos);

				if($respuesta == "ok"){

					echo'<script>

					swal({
						  type: "success",
						  title: "El cliente ha sido cambiado correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "clientes";

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

							window.location = "clientes";

							}
						})

			  	</script>';

			}

		}

	}
 
	/*=============================================
	BORRAR CLIENTES
	=============================================*/

	static public function ctrBorrarCliente(){

		if(isset($_GET["idCliente"])){

			$tabla ="Clientes";
			$datos = $_GET["idCliente"];

			$respuesta = ModeloClientes::mdlBorrarCliente($tabla, $datos);

			if($respuesta == "ok"){

				echo'<script>

					swal({
						  type: "success",
						  title: "El cliente ha sido borrado correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {
               
									window.location = "clientes";

									}
								})

					</script>';
			}
		}
		
	}
}
