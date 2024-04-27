<?php
      

    $item = "idOrden";
    $valor = $_POST["idLinea"];
         
    $respuesta = ControladorLineas::ctrMostrarLineas($item, $valor);
   
    echo json_encode($respuesta);

} // fin if 