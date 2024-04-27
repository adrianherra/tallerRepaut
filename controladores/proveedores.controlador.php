<?php

class ControladorProveedores{
           
	/*=============================================
	CREAR PROVEEDORES
	=============================================*/
	static public function ctrCrearProveedor(){
		if(isset($_POST["nProveedor"])){
			$tabla = "proveedores";
 			$datos = array( "id" => $_POST["idProveedor"],
				 			"nombre" => $_POST["nProveedor"],
				        	"telefono" => $_POST["nTelefono"],
						   	"email" => $_POST["nEmail"],
						   	"contacto" => $_POST["nContacto"],
							"direccion" => $_POST["nDireccion"],
							"observacion" => $_POST["nObservacion"]);

			$respuesta = ModeloProveedores::mdlIngresarProveedor($tabla, $datos);
			if($respuesta == "ok"){
				echo'<script>
					swal({
						  type: "success",
						  title: "El proveedor ha sido guardado correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {
     									window.location = "proveedores";
									} // fin if
					  })
					</script>';
			} // fin if
		} // fin if  
	} // fin ctrCrearProveedor
	
	/*=============================================
	CREAR PROVEEDORES
	=============================================*/
	static public function ctrCrearProveedorP(){
		if(isset($_POST["nProveedor"])){
			$tabla = "proveedores";
 			$datos = array( "id" => $_POST["idProveedor"],
				 			"nombre" => $_POST["nProveedor"],
				        	"telefono" => $_POST["nTelefono"],
						   	"email" => $_POST["nEmail"],
						   	"contacto" => $_POST["nContacto"],
							"direccion" => $_POST["nDireccion"],
							"observacion" => $_POST["nObservacion"]);

			$respuesta = ModeloProveedores::mdlIngresarProveedor($tabla, $datos);
			if($respuesta == "ok"){
				echo'<script>
					event.preventDefault();
     			 </script>';
			} // fin if
		} // fin if  
	} // fin ctrCrearProveedorP
	/*=============================================
	MOSTRAR PROVEEDORES
	=============================================*/
	static public function ctrMostrarProveedores($item, $valor){
		$tabla = "proveedores";
		$respuesta = ModeloProveedores::mdlMostrarProveedores($tabla, $item, $valor);
		return $respuesta;
	} // fin ctrMostrarProveedores    

	/*=============================================
	EDITAR PROVEEDORES
	=============================================*/
	static public function ctrEditarProveedor(){
		if(isset($_POST["eProveedor"])){
			$tabla = "proveedores";
			
			$datos = array( "id" => $_POST["idProveedor"], 
							"nombre" => $_POST["eProveedor"],
					        "telefono" => $_POST["eTelefono"],
							"email" => $_POST["eEmail"],
							"contacto" => $_POST["eContacto"],
							"direccion" => $_POST["eDireccion"],
							"observacion" => $_POST["eObservacion"]);
						     
			$respuesta = ModeloProveedores::mdlEditarProveedor($tabla, $datos);
			if($respuesta == "ok"){
				echo'<script>
					swal({
						type: "success",
				  		title: "El proveedor ha sido cambiado correctamente",
				  		showConfirmButton: true,
				  		confirmButtonText: "Cerrar"
				 		 }).then(function(result){
							if (result.value) {
								window.location = "proveedores";
							}
						})
				</script>';
			}// fin if
		} // fin if
	} // fin ctrEditarProveedor
 
	/*=============================================
	BORRAR PROVEEDOR
	=============================================*/
	static public function ctrBorrarProveedor(){
		if(isset($_GET["idProveedor"])){
			$tabla ="Proveedores";
			$datos = $_GET["idProveedor"];
			$respuesta = ModeloProveedores::mdlBorrarProveedor($tabla, $datos);
			if($respuesta == "ok"){
				echo'<script>
					swal({
						  type: "success",
						  title: "El proveedor ha sido borrado correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {
               							window.location = "proveedores";
									} // fin if
     					  })
					</script>';
			} // fin if
		} // fin if
	} // fin ctrBorrarProveedor
} // fin ControladorProveedores
