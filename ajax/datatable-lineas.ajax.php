<?php 
    require_once "../controladores/lineas.controlador.php";
    require_once "../modelos/lineas.modelo.php";


                
class TablaLineas {
  
  public $idOrden;

  public function mostrarLineas(){
        
       
        $item = null;
        $valor = null;    
   
        $item = "idOrden";
        $valor = $valor = $this->idOrden;
        
   

        $lineas = ControladorLineas::ctrMostrarLineas($item,$valor);
             
             
        $datosJson = '{
      "data": [';
      if ($lineas == null) {
           $datosJson .= '["0","","","No hay Lineas","","","","","","","",""],';
      } // fin if
      for($i = 0; $i < count($lineas); $i++){    
         
          $botones = "<div class='btn-group'><button class='btn btn-warning btn-xs btnEditarLinea' idLinea='".$lineas[$i]["id"]."' data-toggle='modal' data-target='#modalEditarLinea'><i class='fa fa-pencil'></i></button><button class='btn btn-danger btn-xs btnEliminarLinea' idLinea = '".$lineas[$i]["id"]."' idOrden='".$lineas[$i]["idOrden"]."' ><i class='fa fa-times'></i></button></div>";
                     
          $datosJson .= '[
            "'.($i+1).'",
            "'.$lineas[$i]["numParte"].'",
            "'.$lineas[$i]["numMia"].'",
            "'.$lineas[$i]["descripcion"].'",
            "'.$lineas[$i]["totalVenta"].'",
            "'.$lineas[$i]["totalCol"].'",
            "'.$lineas[$i]["totalCol"].'",
            "'.$lineas[$i]["totalCol"].'",
            "'.$lineas[$i]["presentacion"].'",
            "'.$lineas[$i]["numFactura"].'",
            "'.$lineas[$i]["estado"].'",
            "'.$botones.'"
            ],';
      } // fin for
      
      $datosJson = substr($datosJson,0,-1);
      $datosJson .='] }';

      echo $datosJson;

   } // fin funcion mostrarLineas

} // fin class TablaOrdenes

// Activar TablaOrdenes

if(isset($_POST["idOrden"])){
    $verLineas = new TablaLineas();
    $verLineas -> idOrden = $_POST["idOrden"];
    $verLineas ->mostrarLineas(); 
}
