<?php
      
require_once "../controladores/clientes.controlador.php";
require_once "../modelos/clientes.modelo.php";

class AjaxClientes{

  /*=============================================
  EDITAR CLIENTE
  =============================================*/ 
        
  public $idCliente;

  public function ajaxEditarCliente(){

    $item = "id";
    $valor = $this->idCliente;
         
    $respuesta = ControladorClientes::ctrMostrarClientes($item, $valor);

    echo json_encode($respuesta); 

  } // fin funcion ajaxClientes
   
    
}// fin class AjaxClientes

/*=============================================
EDITAR CLIENTES
=============================================*/
if(isset($_POST["idCliente"])){

  $editar = new AjaxClientes();
  $editar -> idCliente = $_POST["idCliente"];
  $editar -> ajaxEditarCliente();

} // fin if 

