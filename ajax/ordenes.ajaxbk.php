<?php
      
require_once "../controladores/ordenes.controlador.php";
require_once "../modelos/ordenes.modelo.php";

require_once "../controladores/lineas.controlador.php";
require_once "../modelos/lineas.modelo.php";

 
class AjaxOrdenes{

  /*=============================================
  EDITAR ORDEN
  =============================================*/ 

  public $idOrden;

  public function ajaxEditarOrden(){

    $item = "id";
    $valor = $this->idOrden;
         
    $respuesta = ControladorOrdenes::ctrMostrarOrdenes($item, $valor);

    echo json_encode($respuesta);

  } // fin funcion ajaxOrdenes
   
  /*=============================================
  VER LINEAS
  =============================================*/ 

  public $numOrden;

  public function ajaxVerLineas(){

    $item = "idOrden";
    $valor = $this->numOrden;
         
    $respuesta = ControladorLineas::ctrMostrarLineas($item, $valor);
    
    
    echo json_encode($respuesta);

  } // fin funcion ajaxOrdenes
   


  /*=============================================
  VALIDAR ORDEN NO ESTE REPETIDO
  =============================================*/ 
 
  public $validarOrden;
  
  public function ajaxValidarOrden(){

    $item = "numero";
    $valor = $this->validarOrden;

    $respuesta = ControladorOrdenes::ctrMostrarOrdenes($item, $valor);

    echo json_encode($respuesta);

  } // fin funcion ajaxValidarOrdenes

      
    
}// fin class AjaxOrdenes

/*=============================================
EDITAR ORDEN
=============================================*/
if(isset($_POST["idOrden"])){

  $editar = new AjaxOrdenes();
  $editar -> idOrden = $_POST["idOrden"];
  $editar -> ajaxEditarOrden();

} // fin if 

/*=============================================
REVISAR ORDEN
=============================================*/ 
 
if(isset($_POST["validarOrden"])){
  $valOrden = new AjaxOrdenes();
  $valOrden -> validarOrden = $_POST["validarOrden"];
  $valOrden -> ajaxValidarOrden();
} // fin if
  


/*=============================================
VER LINEAS
=============================================*/ 
 
if(isset($_POST["numOrden"])){
  $valOrden = new AjaxOrdenes();
  $valOrden -> numOrden = $_POST["numOrden"];
  $valOrden -> ajaxVerLineas();
} // fin if
