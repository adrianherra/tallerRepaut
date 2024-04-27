<?php
   
require_once "../controladores/galerias.controlador.php";
require_once "../modelos/galerias.modelo.php";

class AjaxGalerias{  
  
  /*=============================================
      GENERAR ZIP
  =============================================*/ 

  public $idCaso;
    
  public function ajaxGenerarZip(){
    
    $item = "idCaso";
    $valor = $this->idCaso;

    $respuesta = ControladorGalerias::ctrMostrarGalerias($item, $valor);
    echo '<scrip>alert("hola");</script>';

    if(extension_loaded('zip'))  
    {   
      $zip = new ZipArchive(); // Load zip library   
      $zip_name = "caso.zip";
      $zip->open($zip_name, ZIPARCHIVE::CREATE);

      $zip->addFile("../vistas/img/galeria/img258.jpg"); // Adding files into zip  
      
      $zip->close();  
      if(file_exists($zip_name))  
      {
        echo "<embed src='".$zip_name."' type='application/pdf' width='0%' style='height: 0vh; display:block'/>";
       // unlink($zip_name);
      }

    }// fin if    
  
   // echo json_encode($respuesta);
 

  } // fin funcion ajaxGenerarZip


} // fin clase AjaxLineas

/*=============================================
    GENERAR ZIP
=============================================*/ 
if(isset($_POST["idCaso"])){

  $caso = new AjaxGalerias();
  $caso -> idCaso= $_POST["idCaso"];
  $caso -> ajaxGenerarZip();
} // fin if
