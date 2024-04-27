<?php
    
class ControladorEntradas{
	/*=============================================
	CREAR ENTRADA   
	=============================================*/
	static public function ctrCrearEntrada(){
		
		$path= 'vistas/img/recepcion/img_'.date('d_m_Y_H_i_s').'.png';


		if(isset($_POST["nPlaca"])){
			if (isset($_POST['imgCaptura'])) { 
				echo '<img src="'.$_POST['imgCaptura'].'" style="display: none;">';
				function uploadImgBase64 ($base64, $name){
					$datosBase64 = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $base64));
					if(!file_put_contents($name, $datosBase64)){
						return false;
					} 
					else{
						return true;
					}
				}// fin funcion uploadImgBase64
				uploadImgBase64($_POST['imgCaptura'],$path);
			} // fin if

			$tabla = "entradas";
			  
			$fecha = date('Y-m-d');
			$hora = date('H:i:s');

			$fechaActual = $fecha.' '.$hora;
			$estado = 'Activo';
		
			if (isset($_POST["nRadio"]))
			  $radio = "si";
			else 
			  $radio = "no"; 
			
			if (isset($_POST["nAntena"]))
			  $antena = "si";
			else 
			  $antena = "no";  

			if (isset($_POST["nTriangulos"]))
			  $triangulos = "si";
			else 
			  $triangulos = "no";  
			
			if (isset($_POST["nRepuesto"]))
			  $repuesto = "si";
			else 
			  $repuesto = "no";
			 
			if (isset($_POST["nLibros"]))
			  $libros = "si";
			else 
			  $libros = "no";  
			
			if (isset($_POST["nLlavero"]))
			  $llavero = "si";
			else 
			  $llavero = "no";
			
			if (isset($_POST["nCopas"]))
			  $copas = "si";
			else 
			  $copas = "no";  

			if (isset($_POST["nAlfombras"]))
			  $alfombras = "si";
			else 
			  $alfombras = "no";  

			if (isset($_POST["nExtintor"]))
			  $extintor = "si";
			else 
			  $extintor = "no";  

			if (isset($_POST["nGata"]))
			  $gata = "si";
			else 
			  $gata = "no";

			if (isset($_POST["nDocumentos"]))
			  $documentos = "si";
			else 
			  $documentos = "no";  

			if (isset($_POST["nEncendedor"]))
			  $encendedor = "si";
			else 
			  $encendedor = "no";
			$marca = ucwords(utf8_decode($_POST["nMarca"]));
			$placa = utf8_decode($_POST["nPlaca"]);
			$nombreArchivo = 'vistas/img/recepcion/Recepcion'.trim($marca).'-'.trim($placa).'.pdf';
                
			$datos = array(	"placa" => $placa,
							"marca" => $marca,						
							"modelo" => $_POST["nModelo"],
							"ano" => $_POST["nAno"],
							"kms" => $_POST["nKms"],
							"vin" => $_POST["nVin"],
							"motor" => $_POST["nMotor"],
							"cono" => $_POST["nCono"],
							"tanque" => $_POST["nTanque"],
							"tipoComb" => $_POST["nTipoComb"],
							"idCliente" => $_POST["nIdCliente"],
							"aseguradora" => $_POST["nAseguradora"],
							"observacion" => $_POST["nObserva"],
							"imagen" => $path,
							"rutaPdf" => $nombreArchivo, 
							"radio" => $radio,
							"antena" => $antena,
							"triangulos" => $triangulos,
							"repuesto" => $repuesto,
							"libros" => $libros,
							"llavero" => $llavero,
							"copas" => $copas,
							"alfombras" => $alfombras,
							"extintor" => $extintor,
							"gata" => $gata,
							"radioMarca" => $_POST["radioMarca"],
							"bateriaMarca" => $_POST["bateriaMarca"],
							"documentos" => $documentos, 
							"encendedor" => $encendedor,
							"piezas" => $_POST["nPiezas"],	
							"fecha" => $fechaActual,
							"estado" => $estado);
			
			//var_dump($datos);  

			$respuesta = ModeloEntradas::mdlIngresarEntrada($tabla, $datos);
			  
			if($respuesta == "ok"){
				
				$resultado = ModeloEntradas::mdlConsecutivo();
				$idReporte = $resultado['idReporte'];
				
				$reporte =  ReporteRecepcion::generaReporte($idReporte);
				echo'<script>
					swal({  
						type: "success",
					    	title: "La entrada ha sido guardada correctamente",
					    	showConfirmButton: true,
					    	confirmButtonText: "Cerrar"
					    	}).then(function(result){
								if (result.value) {
									window.location = "casos";		  
								} // fin if  
					}); // fin swal
				</script>'; 
			} // fin if
			   
		} // fin if  
		     
	} // fin ctrCrearEntrada
	/*=============================================
    	MOSTRAR ENTRADAS
	=============================================*/
	static public function ctrMostrarEntradas($item, $valor){

		$tabla = "entradas";
		$respuesta = ModeloEntradas::mdlMostrarEntradas($tabla, $item, $valor);
		return $respuesta;
		  
	
	}    

	/*=============================================
	BORRAR ENTRADA
	=============================================*/
	static public function ctrEliminarEntrada(){
		if(isset($_GET["idCaso"])){
			$tabla ="entradas";
			$datos = $_GET["idCaso"];
			                      
			$respuesta = ModeloEntradas::mdlBorrarEntrada($tabla, $datos);
			if($respuesta == "ok"){
				echo'<script>
				swal({
					  type: "success",
					  title: "El expediente ha sido borrado correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar"
					  }).then(function(result){
						if (result.value) {
							window.location = "casos";
						}
					});
				</script>';

			} // fin if 		
		} // fin if
	} // fin funcion ctrBorrarEntradas

	/*=============================================
	  CAMBIAR ESTADO
	=============================================*/
	static public function ctrCambiarEstado($valor, $valor1){
	
       	$respuesta = ModeloEntradas::mdlCambiarEstado($valor, $valor1);		
              
		return $respuesta;

	}// fin metodo ctrCambiarEstado
    	  
     
} // fin controladorEntradas

