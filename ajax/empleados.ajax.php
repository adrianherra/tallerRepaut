<?php
   
require_once "../controladores/empleados.controlador.php";
require_once "../modelos/empleados.modelo.php";

class AjaxEmpleados{

  /*=============================================
  EDITAR Empleado
  =============================================*/ 

  public $idEmpleado;
    
  public function ajaxEditarEmpleado(){

    $item = "id";  
    $valor = $this->idEmpleado;

    $respuesta = ControladorEmpleados::ctrMostrarEmpleados($item, $valor);

   // var_dump(json_encode($respuesta));
    echo json_encode($respuesta);


  } // fin funcion ajaxEditarEmpleado

  /*=============================================
   ACTUALIZAR ESTADO
  =============================================*/ 
  public $estadoEmpleado;
  
  public function ajaxActualizarEstado(){

    $tabla = "empleados";
    $item1 = "estado";
    $valor1 = $this->estadoEmpleado;

    $item2 = "id";
    $valor2 = $this->idEmpleado;
  
    $respuesta = ModeloEmpleados::mdlActualizarEmpleado($tabla, $item1, $valor1, $item2, $valor2);
         
    echo json_encode($respuesta);

  } // fin funcion ajaxActualizarEstado

  
} // fin clase AjaxLineas

/*============================================
EDITAR EMPLEADO
=============================================*/ 
if(isset($_POST["idEmpleado"])){
  $empleado = new AjaxEmpleados();
  $empleado -> idEmpleado= $_POST["idEmpleado"];
  $empleado -> ajaxEditarEmpleado();
} // fin if

/*=============================================
ACTUALIZAR ESTADO
=============================================*/ 
     
if(isset($_POST["estadoEmpleado"])){
  $actualiza = new AjaxEmpleados();
  $actualiza -> idEmpleado = $_POST["idEmpleado`"];
  $actualiza -> estadoEmpleado= $_POST["estadoEmpleado"];
  $actualiza -> ajaxActualizarEstado();
} // fin if

    