<?php
  
       
class ControladorGalerias{
	    
	
	/*=============================================
	MOSTRAR GALERIAS
	=============================================*/
	static public function ctrMostrarGalerias($item,$valor, $valor2){
		$tabla = "galeria";
      
       	$respuesta = ModeloGalerias::mdlMostrarGalerias($tabla, $item, $valor, $valor2);		         
		return $respuesta;
           
	}// fin metodo ctrMostrarGalerias
 	      
 	/*=============================================
	REGISTRO DE GALERIA
	=============================================*/
	static public function obtenerExtensionFichero($str) 
	{
        return end(explode(".", $str));
	}// fin

	static public function ctrCrearGaleria(){
    	if(isset($_POST["nCaso"])){
               
 				$tabla = "galeria";
                               
                /*=============================================
				        VALIDAR DOCUMENTO
				=============================================*/
               	$ruta = "";
                foreach($_FILES["nGaleria"]['tmp_name'] as $key => $tmp_name)
				{
						
					//$filename = $_FILES["nGaleria"]["name"][$key]; 
				    if(isset($_FILES["nGaleria"]["tmp_name"][$key])){
    					$nombre = $_FILES["nGaleria"]["name"][$key];
                          
						if ($nombre != "") 
    	 					$ruta = "vistas/img/galeria/".$nombre;
						$origen = $_FILES["nGaleria"]["tmp_name"][$key];						
						copy($origen, $ruta);
					} // fin creacion de documento
	                $nombre = strtolower($nombre);
	                $tipo = explode(".",$nombre);

	        		$datos = array("idCaso" => $_POST["nCaso"],
					           "ruta" => $ruta,
					           "tipo" => $tipo[1],
					           "titulo" => $nombre);
                    //var_dump($datos);
   			  		$respuesta = ModeloGalerias::mdlIngresarGaleria($tabla,$datos);
				    //$respuesta ="ok";
				} // fin for
                         
               	if ($respuesta == "ok") {    	
					echo '<script>
	    				window.location = "galerias";
					</script>';
        		}// fin if

		} // fin isset(POST)
	} // fin funcion ctrCrearGaleria

	/*=============================================
	BORRAR Orden
	=============================================*/
	static public function ctrEliminarImagen(){

		if(isset($_GET["idImagen"])){

			$tabla ="galeria";
			$datos = $_GET["idImagen"];

			unlink($_GET["idRuta"]);

			$respuesta = ModeloGalerias::mdlBorrarImagen($tabla, $datos);

			if($respuesta == "ok"){

				echo'<script>  

				swal({
					  type: "success",
					  title: "La Imagen ha sido borrada correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar"
					  }).then(function(result){
								if (result.value) {

								window.location = "galerias";

								}
							})

				</script>';

			} // fin if 		

		} // fin if

	} // fin funcion ctrEliminarImagen
	

	    	
} // fin clase ControladorGalerias
	

 