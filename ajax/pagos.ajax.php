<?php
      
require_once "../controladores/pagos.controlador.php";
require_once "../modelos/pagos.modelo.php";

class AjaxPagos{

  /*=============================================
  EDITAR ORDEN
  =============================================*/ 
        
  public $idPago;

  public function ajaxEditarPago(){

    $item = "id";
    $valor = $this->idPago;
         
    $respuesta = ControladorPagos::ctrMostrarPagos($item, $valor);

    echo json_encode($respuesta);

  } // fin funcion ajaxPagos
   
    
}// fin class AjaxOrdenes

/*=============================================
EDITAR PAGO
=============================================*/
if(isset($_POST["idPago"])){

  $editar = new AjaxPagos();
  $editar -> idPago = $_POST["idPago"];
  $editar -> ajaxEditarPago();

} // fin if 

