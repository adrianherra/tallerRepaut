<?php
      
require_once "../controladores/facturas.controlador.php";
require_once "../modelos/facturas.modelo.php";

class AjaxFacturas{

  /*=============================================
  NUEVA FACTURA
  =============================================*/ 

  public $nFecha;
  public $idFactura;
  public $lnFactura;
  public $condicion;
  public $sold1;
  public $sold2;
  public $sold3;
  public $sold4;
  public $ship;
  public $ship1;
  public $tracking;

  public function ajaxNuevaFactura(){

    $tabla = "facturas";
    $fecha = date('Y-m-d');
    $estado = "activa";
    
    $datos = array("fecha" => $fecha,
							    "estado" => $estado);
   
    $respuesta = ModeloFacturas::mdlCrearFactura($tabla, $datos);
         
    if($respuesta == "ok"){ 
       $consecutivo =  ModeloFacturas::mdlConsecutivo();
       echo json_encode($consecutivo);
    } // fin if
    
  } // fin funcion ajaxNuevaFactura
  
  public function ajaxEditaFactura(){

    $item = "id";
    $valor = $this->lnFactura;
    $tabla = "detalleFactura";
				   
		$respuesta = ModeloFacturas::mdlMostrarLineas1($tabla, $item, $valor);
                     
    echo json_encode($respuesta);
    
  } // fin funcion ajaxEditaFactura
  
  public function ajaxActualizaCondicion(){

    $id = $this->idFactura;
    $condicion = $this->condicion;

    $respuesta = ModeloFacturas::mdlActualizaCondicion($id,$condicion);
                  
    echo json_encode($respuesta);
    
  } // fin funcion ajaxActualizaCondicion

  public function ajaxActualizaEncabezado(){

    $id         = $this->idFactura;
    $condicion  = $this->condicion;
    $sold1      = $this->sold1;
    $sold2      = $this->sold2;
    $sold3      = $this->sold3;
    $sold4      = $this->sold4;
    $ship       = $this->ship;
    $ship1      = $this->ship1;
    $tracking   = $this->tracking;

    $datos = array("id"        => $id,
							     "condicion" => $condicion,
							     "sold1"     => $sold1,
						       "sold2"     => $sold2,						
							     "sold3"     => $sold3,
							     "sold4"     => $sold4,
							     "ship"      => $ship,
                   "ship1"     => $ship1,
                   "tracking"  => $tracking);
    var_dump($datos);   
    $respuesta = ModeloFacturas::mdlActualizaEncabezado($datos);
                    
    echo json_encode($respuesta);
   
  } // fin funcion ajaxActualizaEncabezado
  
  public function ajaxActivaFactura(){
    $valor = $this->idFactura;   
    $respuesta = ModeloFacturas::mdlActivaFactura($valor);
    
    echo json_encode($respuesta);
  } // fin funcion ajaxActivaFactura

} // fin class  AjaxFacturas
               
/*=============================================
      NUEVA FACTURA
=============================================*/ 
if(isset($_POST["nFecha"])){

  $factura = new AjaxFacturas();
  $factura -> nFecha= $_POST["nFecha"];
  $factura -> ajaxNuevaFactura();
} // fin if 

/*=============================================
    ACTIVA FACTURA
=============================================*/ 
if(isset($_POST["idFactura"])){

  $factura = new AjaxFacturas();
  $factura -> idFactura= $_POST["idFactura"];
  $factura -> ajaxActivaFactura();
} // fin if
       
/*=============================================
     EDITA FACTURA
=============================================*/ 
if(isset($_POST["lnFactura"])){
  $factura = new AjaxFacturas();
  $factura -> lnFactura= $_POST["lnFactura"];
  $factura -> ajaxEditaFactura();
} // fin if   

/*=============================================
    ACTUALIZA CONDICION FACTURA
=============================================*/ 
if(isset($_POST["condicion"])){
  $factura = new AjaxFacturas();
  $factura -> idFactura= $_POST["idFactura"];
  $factura -> condicion= $_POST["condicion"];
  $factura -> ajaxActualizaCondicion();
} // fin if

/*=============================================
     ACTUALIZA ENCABEZADO
=============================================*/ 
if(isset($_POST["sold1"])){
  $factura = new AjaxFacturas();
  $factura -> idFactura = $_POST["idFactura"];
  $factura -> condicion = $_POST["condicion"];
  $factura -> sold1     = $_POST["sold1"];
  $factura -> sold2     = $_POST["sold2"];
  $factura -> sold3     = $_POST["sold3"];
  $factura -> sold4     = $_POST["sold4"];
  $factura -> ship      = $_POST["ship"];
  $factura -> ship1     = $_POST["ship1"];
  $factura -> tracking  = $_POST["tracking"];
  $factura -> ajaxActualizaEncabezado();

}// fin if