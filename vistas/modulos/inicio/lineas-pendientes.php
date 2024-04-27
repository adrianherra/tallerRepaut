<?php
            
     $lineas = ControladorLineas::ctrLineasDia();
     //var_dump($lineas);  
     echo '<script>';
     echo 'console.log('. json_encode( $lineas ) .')';
     echo '</script>';     
   // SELECT descripcion, vencimiento, DATEDIFF(CURDATE(),vencimiento) as dias FROM `articulos` WHERE estado = "En Proceso" ORDER BY dias ASC   
?>            
   
<!--=====================================
LINEAS PENDIENTES
======================================-->

<div class="box box-default">
	
	<div class="box-header with-border" style="background:#999999; color:white; text-align: center;">   
  
      <h3 class="box-title">Alerta de Repuestos Pendientes</h3>

    </div>

	 <div class="box-body">
      <div class="row">   
        <div class="col-xs-12 col-sm-11">
          <table class="table table-bordered table-striped table-condensed" width="80%"> 
            <thead>
              <tr>     
                <th style="width:10px; font-size: x-small;">#</th>
                <th style="font-size: x-small;">Orden</th>
                <th style="font-size: x-small;"># Parte</th>
                <th style="font-size: x-small;">Repuesto</th>      
                <th style="font-size: x-small;">Vencimiento</th>
                <th style="font-size: x-small;">Días</th>    
              </tr> 
            </thead>
            <tbody>        
              <?php
                  
                 foreach ($lineas as $key => $value) {
                    $orden = $value["orden"];
                    $dias = $value["dias"];
                    if ($dias >= -3) {  
                       $ver =  "<a class = 'btn btn-danger btn-xs' href='ordenes'>".$dias."</a>";
                       echo '<tr>
                            <td style="font-size: x-small;">'.($key+1).'</td>
                            <td style="font-size: x-small;">'.$orden.'</td>
                            <td style="font-size: x-small;">'.$value["numParte"].'</td>
                            <td style="font-size: x-small;">'.$value["descripcion"].'</td>
                            <td style="font-size: x-small;">'.$value["vencimiento"].'</td>
                            <td style="font-size: x-small;">'.$ver.'</td>
                          </tr>';
                    } //fin if        
                 }// fin foreach
              ?>               
	          </tbody>
            <tfoot style="color:#FF00FF;">
            </tfoot> 
          </table>      
		    </div>   
		   </div>

    </div>   

    <div class="box-footer no-padding">
    		
    </div>

</div>

