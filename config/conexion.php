<?php 

require_once "global.php";



// conexion a la base de datos
$conexion = new mysqli(DB_SERVIDOR,DB_USUARIO,DB_CLAVE,DB_NAME);

// controla el si hay un error en la base de datos

if ($conexion->connect_errno)
	echo "Fallo la conexión a la base de datos " .$conexion->connect_errno;
	exit();
} // fin if

// eleccion de caracteres en español
$conexion->set_charset(DB_ENCODE);

// pregunta si no existe la funcion ejecutuarConsulta 
if (!ejecutarConsulta()) {
	function ejecutarConsulta($sql){
		global $conexion;
		$resultado = $conexion->query($sql);
		return $resultado;
	}// fin funcion ejecturarConsulta
} // fin if

function ejecutarConsultaSimple($sql){
	global $conexion;
	$resultado = $conexion->query($sql);
	return $resultado->fetch_assoc();
}// fin funcion ejectarConsultaSimple

function consultaRetornaId($sql){
	global $conexion;
	$resultado = $conexion->query($sql);
	return $conexion->insert_id;
}// fin funcion consultaRetornaId


try {
	$con=new PDO('mysql:host=localhost;dbname='.DB_NAME,DB_USUARIO,DB_CLAVE);
} catch (PDOException $e) {
	echo "Error".$e->getMessage();
}


?>

