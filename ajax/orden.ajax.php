<?php
      
require_once "../controladores/ordenes.controlador.php";
require_once "../modelos/ordenes.modelo.php";

class AjaxOrdenes{

  /*=============================================
  EDITAR ORDENES
  =============================================*/ 

  public $idOrden;

  public function ajaxEditarOrden(){

    $item = "id";
    $valor = $this->idOrden;

    $respuesta = ControladorOrdenes::ctrMostrarOrdenes($item, $valor);

    echo json_encode($respuesta);

  }
}
               
/*=============================================
EDITAR ORDENES
=============================================*/ 
if(isset($_POST["idOrden"])){

  $orden = new AjaxOrdenes();
  $orden -> idOrden= $_POST["idOrden"];
  $orden -> ajaxEditarOrden();
}
  
   