<?php

class ControladorProductos{

	/*=============================================
	MOSTRAR PRODUCTOS
	=============================================*/

	static public function ctrMostrarProductos($item, $valor){

		$tabla = "inventario";

		$respuesta = ModeloProductos::mdlMostrarProductos($tabla, $item, $valor);

		return $respuesta;
		  

	} // fin ctrMostarProductos

	/*=============================================
	CREAR PRODUCTO
	=============================================*/
	static public function ctrCrearProducto(){
		if(isset($_POST["nParte"])){
	      	$ruta = "vistas/img/productos/default/anonymous.png";
			$ruta1 = "vistas/img/productos/default/anonymous.png";
			$ruta2 = "vistas/img/productos/default/anonymous.png";   
			if(isset($_FILES["nImagen"]["tmp_name"])){
				list($ancho, $alto) = getimagesize($_FILES["nImagen"]["tmp_name"]);  
				list($ancho1, $alto1) = getimagesize($_FILES["nImagen1"]["tmp_name"]);
				list($ancho2, $alto2) = getimagesize($_FILES["nImagen2"]["tmp_name"]);

				$nuevoAncho = 500;
				$nuevoAlto = 500;
				$directorio = "vistas/img/productos/".$_POST["nParte"];
				mkdir($directorio, 0755);
				if($_FILES["nImagen"]["type"] == "image/jpeg"){
					$aleatorio = mt_rand(100,999);
					$ruta = "vistas/img/productos/".$_POST["nParte"]."/".$aleatorio.".jpg";
					$origen = imagecreatefromjpeg($_FILES["nImagen"]["tmp_name"]);						
					$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
					imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
					imagejpeg($destino, $ruta);
				} // fin if
				
				if($_FILES["nImagen1"]["type"] == "image/jpeg"){
					$aleatorio = mt_rand(100,999);
					$ruta1 = "vistas/img/productos/".$_POST["nParte"]."/".$aleatorio.".jpg";
					$origen1 = imagecreatefromjpeg($_FILES["nImagen1"]["tmp_name"]);						
					$destino1 = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
					imagecopyresized($destino1, $origen1, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho1, $alto1);
					imagejpeg($destino1, $ruta1);
				} // fin if
				
				  
				if($_FILES["nImagen2"]["type"] == "image/jpeg"){
					$aleatorio = mt_rand(100,999);
					$ruta2 = "vistas/img/productos/".$_POST["nParte"]."/".$aleatorio.".jpg";
					$origen2 = imagecreatefromjpeg($_FILES["nImagen2"]["tmp_name"]);						
					$destino2 = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
					imagecopyresized($destino2, $origen2, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho2, $alto2);
					imagejpeg($destino2, $ruta2);
				} // fin if

				
				if($_FILES["nImagen"]["type"] == "image/png"){
					$aleatorio = mt_rand(100,999);
					$ruta = "vistas/img/productos/".$_POST["nParte"]."/".$aleatorio.".png";
					$origen = imagecreatefrompng($_FILES["nImagen"]["tmp_name"]);						
					$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
					imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
					imagepng($destino, $ruta);
				} // fin if

				if($_FILES["nImagen1"]["type"] == "image/png"){
					$aleatorio = mt_rand(100,999);
					$ruta1 = "vistas/img/productos/".$_POST["nParte"]."/".$aleatorio.".png";
					$origen1 = imagecreatefrompng($_FILES["nImagen1"]["tmp_name"]);						
					$destino1 = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
					imagecopyresized($destino1, $origen1, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho1, $alto1);
					imagepng($destino1, $ruta1);
				} // fin if

				if($_FILES["nImagen2"]["type"] == "image/png"){
					$aleatorio = mt_rand(100,999);
					$ruta2 = "vistas/img/productos/".$_POST["nParte"]."/".$aleatorio.".png";
					$origen2 = imagecreatefrompng($_FILES["nImagen2"]["tmp_name"]);						
					$destino2 = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
					imagecopyresized($destino2, $origen2, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho2, $alto2);
					imagepng($destino2, $ruta2);
				} // fin if
			} // fin if
		         	 
			$tabla = "inventario";

			$datos = array("parte" => $_POST["nParte"],
						   "descripcion" => $_POST["nDescri"],
						   "idProveedor" => $_POST["nIdProveedor"],	  
						   "marca" => $_POST["nMarca"],
						   "modelo" => $_POST["nModelo"],
						   "ano" => $_POST["nAno"],
						   "stock" => $_POST["nStock"],
						   "costoCol" => $_POST["nCol"],
						   "costoDol" => $_POST["nDol"],
						   "tipo" => $_POST["nTipo"],
						   "ubicacion" => $_POST["nUbica"],
						   "foto" => $ruta,
						   "foto1" => $ruta1,
						   "foto2" => $ruta2);
			
			$respuesta = ModeloProductos::mdlCrearProducto($tabla, $datos);
				  
			if($respuesta == "ok"){
				echo'<script>
					swal({
						type: "success",
						title: "El producto ha sido guardado correctamente",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"
						}).then(function(result){
							if (result.value) {
								window.location = "productos";
							}
						})
				</script>';

			} // fin if
		}// fin if
	} // fin ctrCrearProducto
   
	/*=============================================
	EDITAR PRODUCTO
	=============================================*/
    
	static public function ctrEditarProducto(){
		
		if(isset($_POST["eParte"])){
			$ruta = $_POST["eActual"];
			$ruta1 = $_POST["eActual1"];
			$ruta2 = $_POST["eActual2"];
			$nuevoAncho = 500;
			$nuevoAlto = 500;
			   
		   	if(isset($_FILES["eImagen"]["tmp_name"]) && !empty($_FILES["eImagen"]["tmp_name"])){
				list($ancho, $alto) = getimagesize($_FILES["eImagen"]["tmp_name"]);
			
				$directorio = "vistas/img/productos/".$_POST["eParte"];
				if(!empty($_POST["eActual"]) && $_POST["eActual"] != "vistas/img/productos/default/vehiculo.png"){
					unlink($_POST["eActual"]);
				}else{
					mkdir($directorio, 0755);	
				} // fin if
				   	
				if($_FILES["eImagen"]["type"] == "image/jpeg"){
					$aleatorio = mt_rand(100,999);
					$ruta = "vistas/img/productos/".$_POST["eParte"]."/".$aleatorio.".jpg";
					$origen = imagecreatefromjpeg($_FILES["eImagen"]["tmp_name"]);						

					$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
					imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
					imagejpeg($destino, $ruta);

				} // fin if
				
				if($_FILES["eImagen"]["type"] == "image/png"){
					$aleatorio = mt_rand(100,999);
					$ruta = "vistas/img/productos/".$_POST["eParte"]."/".$aleatorio.".png";
					$origen = imagecreatefrompng($_FILES["eImagen"]["tmp_name"]);						
					$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

					imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
					imagepng($destino, $ruta);
				}// fin if

			} // fin if

			if(isset($_FILES["eImagen1"]["tmp_name"]) && !empty($_FILES["eImagen1"]["tmp_name"])){
				list($ancho1, $alto1) = getimagesize($_FILES["eImagen1"]["tmp_name"]);
				
				if($_FILES["eImagen1"]["type"] == "image/jpeg"){
					$aleatorio = mt_rand(100,999);
					$ruta1 = "vistas/img/productos/".$_POST["eParte"]."/".$aleatorio.".jpg";
					$origen1 = imagecreatefromjpeg($_FILES["eImagen1"]["tmp_name"]);						
					$destino1 = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
					imagecopyresized($destino1, $origen1, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho1, $alto1);
					imagejpeg($destino1, $ruta1);
				} // fin if

				if($_FILES["eImagen1"]["type"] == "image/png"){
					$aleatorio = mt_rand(100,999);
					$ruta1 = "vistas/img/productos/".$_POST["eParte"]."/".$aleatorio.".png";
					$origen1 = imagecreatefrompng($_FILES["eImagen1"]["tmp_name"]);						
					$destino1 = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

					imagecopyresized($destino1, $origen1, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho1, $alto1);
					imagepng($destino1, $ruta1);
				}// fin if

			}//fin if		

			if(isset($_FILES["eImagen2"]["tmp_name"]) && !empty($_FILES["eImagen2"]["tmp_name"])){
				list($ancho2, $alto2) = getimagesize($_FILES["eImagen2"]["tmp_name"]);
				if($_FILES["eImagen2"]["type"] == "image/jpeg"){
					$aleatorio = mt_rand(100,999);
					$ruta2 = "vistas/img/productos/".$_POST["eParte"]."/".$aleatorio.".jpg";
					$origen2 = imagecreatefromjpeg($_FILES["eImagen2"]["tmp_name"]);						

					$destino2 = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
					imagecopyresized($destino2, $origen2, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho2, $alto2);
					imagejpeg($destino2, $ruta2);

				} // fin if

				if($_FILES["eImagen2"]["type"] == "image/png"){
					$aleatorio = mt_rand(100,999);
					$ruta2 = "vistas/img/productos/".$_POST["eParte"]."/".$aleatorio.".png";
					$origen2 = imagecreatefrompng($_FILES["eImagen2"]["tmp_name"]);						
					$destino2 = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

					imagecopyresized($destino2, $origen2, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho2, $alto2);
					imagepng($destino2, $ruta2);
				}// fin if

			}//fin if	
				
			$tabla = "inventario";
                 
			$datos = array("id" => $_POST["eIdPr"],   
						   "parte" => $_POST["eParte"],
						   "descripcion" => $_POST["eDescri"],
						   "idProveedor" => $_POST["eIdProveedor"],	  
						   "marca" => $_POST["eMarca"],
						   "modelo" => $_POST["eModelo"],
						   "ano" => $_POST["eAno"],
						   "stock" => $_POST["eStock"],
						   "costoCol" => $_POST["eCol"],
						   "costoDol" => $_POST["eDol"],
						   "tipo" => $_POST["eTipo"],
						   "ubicacion" => $_POST["eUbica"],
						   "foto" => $ruta,
						   "foto1" => $ruta1,
						   "foto2" => $ruta2);
            
			$respuesta = ModeloProductos::mdlEditarProducto($tabla, $datos);
            
			if($respuesta == "ok"){
				echo'<script>
					swal({
						  type: "success",
						  title: "El producto ha sido editado correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
					}).then(function(result){
						if (result.value) {
							window.location = "productos";
						} // fin if
					});
				</script>';

			} // fin if
			
		}// fin if
	} // fin ctrEditarProducto

	/*=============================================
	ELIMINAR PRODUCTO
	=============================================*/
	static public function ctrEliminarProducto(){
		if(isset($_GET["idProducto"])){
			$tabla ="invetario";
			$datos = $_GET["idProducto"];

			if($_GET["imagen"] != "" && $_GET["imagen"] != "vistas/img/productos/default/vehiculo.png"){
				unlink($_GET["imagen"]);
				rmdir('vistas/img/productos/'.$_GET["parte"]);
			}
			
			$respuesta = ModeloProductos::mdlEliminarProducto($tabla, $datos);
               
			if($respuesta == "ok"){
				echo'<script>
				swal({
					  type: "success",
					  title: "El producto ha sido borrado correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar"
					  }).then(function(result){
						if (result.value) {
							window.location = "productos";
						} // fin if
					});
				</script>';
			}// fin if		
			
		} // fin if
	} // fin ctrEliminarProducto
} // fin class ControladorProductos