<?php 
    require_once "../controladores/pagos.controlador.php";
    require_once "../modelos/pagos.modelo.php";
        
               
class TablaPagos {
 
  public function mostrarPagos(){
        $item = null;
        $valor = null;
   
        $pagos = ob_get_clean();
        $pagos = ControladorPagos::ctrMostrarPagos($item,$valor);
        
        $datosJson = '{
      "data": [';
      if ($pagos == null) {
           $datosJson .= '["0","","No hay Pagos","","","","","",""],';
      } // fin if
      for($i = 0; $i < count($pagos); $i++){    
          

          $pdf = "<button data-toggle='modal' data-target='#modalVerPago' class='btn btn-xs btn-danger btnVerPDF' idPago='".$pagos[$i]["id"]."' >PDF/IMG</button>";
            
          if(isset($_GET["perfilOculto"]) && $_GET["perfilOculto"] == "Administrador"){
              $botones = "<div class='btn-group'><button class='btn btn-xs btn-warning btnEditarPago' idPago='".$pagos[$i]["id"]."' data-toggle='modal' data-target='#modalEditarPago'><i class='fa fa-pencil'></i></button><button class='btn btn-xs btn-danger btnEliminarPago' idPago = '".$pagos[$i]["id"]."'><i class='fa fa-times'></i></button></div>";
          }else {
              $botones = "<i class='fa fa-th'></i>"; 
          }// fin if    
          $datosJson .= '[
            "'.($i+1).'",
            "'.$pagos[$i]["tipo"].'",
            "'.$pagos[$i]["numero"].'",
            "'.$pagos[$i]["fecha"].'",
            "'.$pagos[$i]["monto"].'",
            "'.$pagos[$i]["dolares"].'",
            "'.$pagos[$i]["observacion"].'",
            "'.$pdf.'",
            "'.$botones.'"
            ],';       
      } // fin for
      
      $datosJson = substr($datosJson,0,-1);
      $datosJson .='] }';

      echo $datosJson;
          
   } // fin funcion mostrarPagos

} // fin class TablaPagos

// Activar TablaPagos

$activarPago = new TablaPagos();
$activarPago ->mostrarPagos(); 

