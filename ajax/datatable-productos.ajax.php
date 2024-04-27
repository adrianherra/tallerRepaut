<?php

require_once "../controladores/productos.controlador.php";
require_once "../modelos/productos.modelo.php";

require_once "../controladores/categorias.controlador.php";
require_once "../modelos/categorias.modelo.php";

    
class TablaProductos{
    
 	/*=============================================
 	 MOSTRAR LA TABLA DE PRODUCTOS
  	=============================================*/ 

	public function mostrarTablaProductos(){

		$item = null;
    	$valor = null;

  		$productos = ControladorProductos::ctrMostrarProductos($item, $valor);	
		
  		$datosJson = '{
		  "data": [';
  			
  		  if ($productos == null) {
              $datosJson .= '["0","","No hay Productos","","","","","","","","","",""],';
      	  } // fin if			

		  for($i = 0; $i < count($productos); $i++){

		  	/*=============================================
 	 		TRAEMOS LA IMAGEN
  			=============================================*/ 

		  	$imagen = "<img src='".$productos[$i]["imagen"]."' width='40px'>";

		  	/*=============================================
 	 		TRAEMOS LA CATEGORÍA
  			=============================================*/ 

		  	$item = "id";
		  	$valor = $productos[$i]["id_categoria"];

		  	$categorias = ControladorCategorias::ctrMostrarCategorias($item, $valor);

		  	/*=============================================
 	 		STOCK
  			=============================================*/ 

  			$stock =  $productos[$i]["stock"];

  			
		  	/*=============================================
 	 		TRAEMOS LAS ACCIONES
  			=============================================*/ 
            if(isset($_GET["perfilOculto"]) && $_GET["perfilOculto"] == "Administrador"){         
		  		$botones =  "<div class='btn-group'><button class='btn btn-xs btn-warning btnEditarProducto' idProducto='".$productos[$i]["id"]."' data-toggle='modal' data-target='#modalEditarProducto'><i class='fa fa-pencil'></i></button><button class='btn btn-xs btn-danger btnEliminarProducto' idProducto='".$productos[$i]["id"]."' codigo='".$productos[$i]["codigo"]."' imagen='".$productos[$i]["imagen"]."'><i class='fa fa-times'></i></button></div>"; 
		  	}else {
		  		$botones = "<i class='fa fa-th'></i>"; 
		  	}// fin if	
               


		  	$datosJson .='[
			      "'.($i+1).'",
			      "'.$imagen.'",
			      "'.$categorias["categoria"].'",
			      "'.$productos[$i]["codigo"].'",
			      "'.$productos[$i]["descripcion"].'",
			      "'.$productos[$i]["marca"].'",
			      "'.$productos[$i]["modelo"].'",
			      "'.$productos[$i]["ano"].'",
			      "'.$stock.'",
			      "'.$productos[$i]["precio_compra"].'",
			      "'.$productos[$i]["precio_venta"].'",
			      "'.$productos[$i]["fecha"].'",
			      "'.$botones.'"
			    ],';

		  }

		  $datosJson = substr($datosJson, 0, -1);

		 $datosJson .=   '] 

		 }';
		
		echo $datosJson;


	}

  
}

/*=============================================
ACTIVAR TABLA DE PRODUCTOS
=============================================*/ 
$activarProductos = new TablaProductos();
$activarProductos -> mostrarTablaProductos();

