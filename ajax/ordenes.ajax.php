<?php
      
require_once "../controladores/ordenes.controlador.php";
require_once "../modelos/ordenes.modelo.php";
    
class AjaxOrdenes{

  /*=============================================
  VER ORDEN
  =============================================*/ 
  public $vIdOrden;

  public function ajaxVerOrden(){

    $item = "id";
    $valor = $this->vIdOrden;
         
    $respuesta = ControladorOrdenes::ctrMostrarOrdenes($item, $valor);
   
    echo json_encode($respuesta);

  } // fin funcion ajaxVerOrden
       
  /*=============================================
  ESTADO ORDEN
  =============================================*/ 
  public $nEstado;
  public $nSaldo;
  public $nMonto;
  public $nCosto;

  public function ajaxEstadoOrden(){

    $tabla = "ordenes";
    
    $id = $this->vIdOrden;
    $estado = $this->nEstado;
    $monto = $this->nMonto;
    $costo = $this->nCosto;
    $saldo = $this->nSaldo;
          
    $respuesta = ModeloOrdenes::mdlEstadoOrdenOld($tabla, $id, $estado, $monto, $costo, $saldo);
                
    echo json_encode($respuesta);   

  } // fin funcion ajaxEstadoOrden

/*=============================================
  ESTADO ORDEN OLD
  =============================================*/ 
  public function ajaxEstadoOrdenOld(){

    $tabla = "expedientes";
    $id = $this->vIdOrden;
    $estado = $this->nEstado;
    $monto = $this->nMonto;
    $costo = $this->nCosto;
    $saldo = $this->nSaldo;
          
    $respuesta = ModeloOrdenes::mdlEstadoOrdenOld($tabla, $id, $estado, $monto, $costo, $saldo);
                         
    echo json_encode($respuesta);   

  } // fin funcion ajaxEstadoOrdenOld
  
  /*=============================================
  REPORTES ORDENES
  =============================================*/ 
  public $sReporte;
  public $fechaInicial;
  public $fechaFinal;
  
  public function ajaxReportesOrden(){

    $tabla = "ordenes";
    $valor1 = $this->fechaInicial;
    $valor2 = $this->fechaFinal;

    $respuesta = ModeloOrdenes::mdlReporteFecha($tabla, $valor1, $valor2);
              
    echo json_encode($respuesta);
      
  } // fin funcion ajaxReportesOrden


}// fin class AjaxOrdenes

/*=============================================
Ver ORDEN
=============================================*/
if(isset($_POST["vIdOrden"])){
   
  $verOrden = new AjaxOrdenes();
  $verOrden -> vIdOrden = $_POST["vIdOrden"];
  $verOrden -> ajaxVerOrden();
      
} // fin if 


/*=============================================
Actualizar  Estado
=============================================*/
if(isset($_POST["nValor"])){
       
  $aEstado = new AjaxOrdenes();
  $aEstado -> nEstado = $_POST["nValor"];
  $aEstado -> nSaldo = $_POST["nSaldo"];
  $aEstado -> nMonto = $_POST["nMonto"];
  $aEstado -> nCosto = $_POST["nCosto"];
  $aEstado -> vIdOrden = $_POST["idOrden"];
  $aEstado -> ajaxEstadoOrden();
  
} // fin if 

/*=============================================
Actualizar  Estado OLD
=============================================*/
if(isset($_POST["nValorOld"])){
       
  $aEstado = new AjaxOrdenes();
  $aEstado -> nEstado = $_POST["nValorOld"];
  $aEstado -> nSaldo = $_POST["nSaldoOld"];
  $aEstado -> nMonto = $_POST["nMontoOld"];
  $aEstado -> nCosto = $_POST["nCostoOld"];
  $aEstado -> vIdOrden = $_POST["idOrdenOld"];
  $aEstado -> ajaxEstadoOrdenOld();
  
} // fin if 


/*=============================================
Reportes Ordenes
=============================================*/
if(isset($_POST["sReporte"])){
       
  $aReporte = new AjaxOrdenes();
  $aReporte -> sReporte = $_POST["sReporte"];
  $aReporte -> fechaInicial = $_POST["fechaInicial"];
  $aReporte -> fechaFinal = $_POST["fechaFinal"];
  $aReporte -> ajaxReportesOrden();
  
} // fin if 


