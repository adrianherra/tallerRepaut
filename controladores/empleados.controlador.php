<?php

class ControladorEmpleados{
           
	/*=============================================
	CREAR EMPLEADOS
	=============================================*/

	static public function ctrCrearEmpleado(){

		if(isset($_POST["nEmpleado"])){
			$tabla = "empleados";
      
			$datos = array("nombre" => $_POST["nEmpleado"],
			           "cedula" => $_POST["nCedula"],
			           "telefono" => $_POST["nTelefono"],
			           "fechaNacimiento" => $_POST["nNacimiento"],
			       	   "fechaIngreso" => $_POST["nIngreso"],
			       	   "puesto" => $_POST["nPuesto"],
			       	   "salario" => $_POST["nSalario"],
			       	   "jornada" => $_POST["nJornada"],
			       	   "email" => $_POST["nEmail"],
			       	   "direccion" => $_POST["nDireccion"],
			       	   "observaciones" => $_POST["nObservacion"],);

				$respuesta = ModeloEmpleados::mdlIngresarEmpleado($tabla, $datos);

				if($respuesta == "ok"){ 

					echo'<script> 

					swal({
						  type: "success",
						  title: "El empleado ha sido guardado correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "empleados";

									}
								})

					</script>';

				}// fin $respuesta

		} // fin $_POST

	} // fin funcion ctrCrearEmpleado

	/*=============================================
	MOSTRAR EMPLEADOS
	=============================================*/

	static public function ctrMostrarEmpleados($item, $valor){
      
		$tabla = "empleados";

		$respuesta = ModeloEmpleados::mdlMostrarEmpleados($tabla, $item, $valor);
              
		return $respuesta;
	
	} // fin funcione ctrMostrarEmpleado

	/*=============================================
	EDITAR EMPLEADOS
	=============================================*/

	static public function ctrEditarEmpleado(){

		if(isset($_POST["eEmpleado"])){

			    $tabla = "empleados";

			    $datos = array("nombre" => $_POST["eEmpleado"],
					           "cedula" => $_POST["eCedula"],
					           "telefono" => $_POST["eTelefono"],
					           "fechaNacimiento" => $_POST["eNacimiento"],
					       	   "fechaIngreso" => $_POST["eIngreso"],
					       	   "puesto" => $_POST["ePuesto"],
					       	   "salario" => $_POST["eSalario"],
					       	   "jornada" => $_POST["eJornada"],
					       	   "email" => $_POST["eEmail"],
					       	   "direccion" => $_POST["eDireccion"],
					       	   "observaciones" => $_POST["eObservacion"],);
        
				$respuesta = ModeloEmpleados::mdlEditarEmpleado($tabla, $datos);

				if($respuesta == "ok"){

					echo'<script>

					swal({
						  type: "success",
						  title: "El empleado ha sido cambiado correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "empleados";

									}
								})

					</script>';

				} // fin if $respuesta

		} // fin if Post

	} // fin if funcion
 
	/*=============================================
	BORRAR EMPLEADOS
	=============================================*/

	static public function ctrBorrarEmpleado(){

		if(isset($_GET["idEmpleado"])){

			$tabla ="Empleados";
			$datos = $_GET["idEmpleado"];

			$respuesta = ModeloEmpleados::mdlBorrarEmpleado($tabla, $datos);

			if($respuesta == "ok"){
  
				echo'<script>

					swal({
						  type: "success",
						  title: "El empleado ha sido borrado correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {
               
									window.location = "empleados";

									}
								})

					</script>';
			} // fin if $respuesta
		} // fin if $_Get
		
	} // fin funcione ctrBorrarEmpledo
}// fin clase controlador
