<?php
      
require_once "../controladores/proveedores.controlador.php";
require_once "../modelos/proveedores.modelo.php";

class AjaxProveedores{

  /*=============================================
  EDITAR PROVEEDOR
  =============================================*/ 
        
  public $idProveedor;

  public function ajaxEditarProveedor(){

    $item = "id";
    $valor = $this->idProveedor;
         
    $respuesta = ControladorProveedores::ctrMostrarProveedores($item, $valor);

    echo json_encode($respuesta); 

  } // fin funcion ajaxProveedores
 
}// fin class AjaxProveedores

/*=============================================
EDITAR PROVEEDORES
=============================================*/
if(isset($_POST["idProveedor"])){

  $editar = new AjaxProveedores();
  $editar -> idProveedor = $_POST["idProveedor"];
  $editar -> ajaxEditarProveedor();

} // fin if 

