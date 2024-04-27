<?php
   
require_once "../controladores/lineas.controlador.php";
require_once "../controladores/lineasDima.controlador.php";
require_once "../modelos/lineas.modelo.php";


class AjaxLineas{

  /*=============================================
  EDITAR LINEAS
  =============================================*/ 

  public $idLinea;
    
  public function ajaxEditarLinea(){

    $item = "id";
    $valor = $this->idLinea;
           
    $respuesta = ControladorLineas::ctrMostrarLineas($item, $valor);
       
    echo json_encode($respuesta);

  }// fin funcion ajaxEditarLinea
    
  /*=============================================
  EDITAR LINEAS OLD
  =============================================*/ 
    
  public function ajaxEditarLineaOld(){

    $item = "id";
    $valor = $this->idLinea;
           
    $respuesta = ControladorLineasDima::ctrMostrarLineas($item, $valor);
       
    echo json_encode($respuesta);

  }// fin funcion ajaxEditarLineaOld 
   
  /*=============================================
   ACTUALIZAR ESTADO
  =============================================*/ 
  public $nLinea;

  public $nEstado;
  
  public function ajaxActualizarEstado(){

    $tabla = "articulos";
    $item1 = "estado";
    $valor1 = $this->nEstado;

    $item2 = "id";
    $valor2 = $this->nLinea;

    $respuesta = ModeloLineas::mdlActualizarEstado($tabla, $item1, $valor1, $item2, $valor2);
    
    echo json_encode($respuesta);


  } // fin funcion ajaxActualizarEstado

  /*=============================================
   ACTUALIZAR ESTADO  OLD
  =============================================*/ 
  
  public function ajaxActualizarEstadoOld(){
    $tabla = "lineas";
    $item1 = "estado";
    $valor1 = $this->nEstado;

    $item2 = "id";
    $valor2 = $this->nLinea;
    
    $respuesta = ModeloLineas::mdlActualizarEstado($tabla, $item1, $valor1, $item2, $valor2);
    
    echo json_encode($respuesta);


  } // fin funcion ajaxActualizarEstadoOld

  /*=============================================
   ACTUALIZAR PRESENTACION
  =============================================*/ 
  public $nPresenta;
  
  public function ajaxActualizarPresenta(){

    $tabla = "articulos";
    $item1 = "presentacion";
    $valor1 = $this->nPresenta;

    $item2 = "id";
    $valor2 = $this->nLinea;

    $respuesta = ModeloLineas::mdlActualizarEstado($tabla, $item1, $valor1, $item2, $valor2);
    

    echo json_encode($respuesta);


  } // fin funcion ajaxActualizarPresenta


} // fin clase AjaxLineas

/*=============================================
EDITAR LINEAS
=============================================*/ 
if(isset($_POST["idLinea"])){

  $linea = new AjaxLineas();
  $linea -> idLinea= $_POST["idLinea"];
  $linea -> ajaxEditarLinea();
}

/*=============================================
EDITAR LINEAS Old
=============================================*/ 
if(isset($_POST["idLineaOld"])){

  $linea = new AjaxLineas();
  $linea -> idLinea= $_POST["idLineaOld"];
  $linea -> ajaxEditarLineaOld();
}

/*=============================================
ACTUALIZAR ESTADO
=============================================*/ 
  
if(isset($_POST["nEstado"])){

  $actualiza = new AjaxLineas(); 
  $actualiza -> nLinea= $_POST["nLinea"];
  $actualiza -> nEstado= $_POST["nEstado"];
  $actualiza -> ajaxActualizarEstado();
}

/*=============================================
ACTUALIZAR ESTADO OLD
=============================================*/ 
  
if(isset($_POST["nEstadoOld"])){
   
  $actualizaOld = new AjaxLineas();
 
  $actualizaOld -> nLinea= $_POST["nLineaOld"];
  $actualizaOld -> nEstado= $_POST["nEstadoOld"];
  $actualizaOld -> ajaxActualizarEstadoOld();
}// fin if



/*=============================================
ACTUALIZAR FECHA PRESENTACION
=============================================*/ 

if(isset($_POST["nPresenta"])){

  $presenta = new AjaxLineas();
  $presenta -> nLinea= $_POST["nLinea"];
  $presenta -> nPresenta= $_POST["nPresenta"];
  $presenta -> ajaxActualizarPresenta();
}



