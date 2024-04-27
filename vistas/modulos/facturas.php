<?php
    
   $resultado = ControladorFacturas::ctrConsecutivo();
   $consecutivo = $resultado[0]["siguiente"];
   $estado =  $resultado[0]["estado"];
   if ($estado == null) {
      $estado = "cerrado";
      $consecutivo = ".";    
   } // fin if
   $idReporte = '395';
   $fechaHoy = new DateTime();
   $fechaHoy = $fechaHoy->format('Y-m-d');
   $tracking = "";
   if (isset($_SESSION['tracking'])) {
       $tracking = $_SESSION['tracking'];                
   } // fin if    
?>

    
<div class="content-wrapper">

  <section class="content-header">
    <h1>Factura USA</h1>
            
    <ol class="breadcrumb">
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      <li class="active">Factura USA aa</li>
    </ol>
   
  </section> <!--Fin content-header -->
   
  <section class="content">
    <div class="box"> 
      <div class="box-header with-border">
         <div class="row"> <!-- PRIMERA LINEA DE ENTRADA -->
            <div class="col-xs-5 col-sm-2">
               <?php
                  $item = "id";
                  $valor = $consecutivo;
                  $respuesta = ControladorFacturas::ctrMostrarFacturas($item, $valor);
                  if(!empty($respuesta)){
                     $sold1 = $respuesta[0]["sold1"];
                     $sold2 = $respuesta[0]["sold2"];
                     $sold3 = $respuesta[0]["sold3"];
                     $sold4 = $respuesta[0]["sold4"];
                     $ship  = $respuesta[0]["ship"];
                     $ship1 = $respuesta[0]["ship1"];
                     $track = $respuesta[0]["tracking"];
                     $condicion = $respuesta[0]["condicion"];
                     if ($sold1 == "") $sold1 = "Inversiones Alvarado y Gómez DIMA";
                     if ($sold2 == "") $sold2 = "San José Costa Rica";
                     if ($sold3 == "") $sold3 = "206 Segedfield cir. Winter Park Fl 32792";
                     if ($sold4 == "") $sold4 = "PHONE NUMBER 4074592099";
                     if ($ship == "")  $ship = "Aeropost 9950 NW 17TH ST DORAL,FLORIDA 33172";
                     if ($ship1 == "") $ship1 = "-";
                     if ($condicion == "") $condicion = "ANTICIPADO";
                     if ($track == "") $track = "";
                  }else{
                     $sold1 = "Inversiones Alvarado y Gómez DIMA";
                     $sold2 = "San José Costa Rica";
                     $sold3 = "206 Segedfield cir. Winter Park Fl 32792";
                     $sold4 = "PHONE NUMBER 4074592099";
                     $ship  = "Aeropost 9950 NW 17TH ST DORAL,FLORIDA 33172";
                     $ship1 = "-";
                     $track = "";
                     $condicion = "ANTICIPADO";
                  }// fin if 
                  
                  if ($estado == 'activa'){
                     echo '<script>$(".btnFinFactura").css("display","block"); </script>' ;  
                     echo '<button style="display:none" class="btn btnNuevaFactura btn-warning pull-left" nFecha='; echo date('Y-m-d'); echo '>
                     <i class="fa fa-list-alt"> Nueva</i></button>';
                     echo '<form method="post" action="reportes/reporteFactura.php" > 
                              <input type="hidden" id="idReporte" name="idReporte" value='; echo $consecutivo; echo '>      
                              <button type="submit" style="display:block" class="btn btnFinFactura btn-primary pull-left" >
                                  <i class="fa fa-print"> Finalizar</i>
                              </button>    
                           </form>';              
                  } else {   
                     $_SESSION['tracking'] = "";   
                     echo '<script>$(".btnFinFactura").css("display","none"); </script>';
                     echo '<button style="display:block" class="btn btnNuevaFactura btn-warning pull-left" nFecha='; echo date('Y-m-d'); echo '>
                     <i class="fa fa-list-alt"> Nueva</i></button>';   
                     echo '<button style="display:none" class="btn btnFinFactura btn-primary pull-left" idFactura='; echo $consecutivo; echo '>
                     <i class="fa fa-print"> Finalizar</i></button>';
                     
                  }// fin if       
                                
               ?>                      
               
            </div>

                  
            <div class="col-xs-5 col-sm-2">
               <?php
                  if ($estado == 'activa'){
                     echo '<button style="display:none" class="btn btnBuscarFactura btn-danger pull-right" >
                              <i class="fa fa-search"> Buscar</i>   
                           </button>';
                  } else{
                     echo '<button style="display:block" class="btn btnBuscarFactura btn-danger pull-right" data-toggle="modal" data-target="#modalBuscarFactura" >
                              <i class="fa fa-search"> Buscar</i>   
                           </button>';
                  }// fin if
               ?>                  
            </div>

            <div class="col-xs-5 col-sm-2">

               <div class="form-group">
                  <div class="input-group">    
                     <span class="input-group-addon"><i class="fa fa-list-alt"> Factura</i></span> 
                     <input type="text" class="form-control input-xs" id="nFactura" name="nFactura" value = "<?php echo $consecutivo; ?>" readonly>
                  </div>
               </div>

            </div>
            <div class="col-xs-5 col-sm-3">    
               <div class="form-group">
                  <div class="input-group">    
                     <span class="input-group-addon"><i class="fa fa-calendar"> Fecha</i></span> 
                     <input type="date" class="form-control input-xs" id="nFecha" name="nFecha" value="<?php echo $fechaHoy; ?>">
                  </div>     
               </div>
            </div>         
            <?php
               if ($estado == 'activa'){     
                  if ($condicion == "ANTICIPADO") {
                  echo ' <div class="col-xs-5 col-sm-3">    
                           <div class="form-group">
                              <div class="input-group">    
                                 <span class="input-group-addon">Condición:</span> 
                                 <select class= "form-control input-xs btnCondicion" name="nCondicion" id="nCondicion">
                                    <option value="ANTICIPADO" selected>ANTICIPADO</option>
                                    <option value="CONTADO">CONTADO</option>
                                    <option value="CREDITO">CREDITO</option>
                                 </select>     
                              </div>     
                           </div>
                        </div>';    
                  }// fin if   
                  if ($condicion == "CONTADO") {
                     echo ' <div class="col-xs-5 col-sm-3">    
                              <div class="form-group">
                                 <div class="input-group">    
                                    <span class="input-group-addon">Condición:</span> 
                                    <select class= "form-control input-xs btnCondicion" name="nCondicion" id="nCondicion">
                                       <option value="ANTICIPADO">ANTICIPADO</option>
                                       <option value="CONTADO" selected>CONTADO</option>
                                       <option value="CREDITO">CREDITO</option>
                                    </select>     
                                 </div>     
                              </div>
                           </div>';
                     }// fin if 
                     if ($condicion == "CREDITO") {
                        echo ' <div class="col-xs-5 col-sm-3">    
                                 <div class="form-group">
                                    <div class="input-group">    
                                       <span class="input-group-addon">Condición:</span> 
                                       <select class= "form-control input-xs btnCondicion" name="nCondicion" id="nCondicion">
                                          <option value="ANTICIPADO">ANTICIPADO</option>
                                          <option value="CONTADO">CONTADO</option>
                                          <option value="CREDITO" selected>CREDITO</option>
                                       </select>     
                                    </div>     
                                 </div>
                              </div>';
                        }// fin if   
               } // fin if
            ?>           
         </div>    
      </div>    
      <div class="box-body">
         <?php     
            
         ?>              
         <form method='post' action='#' ENCTYPE='multipart/form-data'>
            <div class="row"> <!-- PRIMERA LINEA DE ENTRADA -->
               <?php
                  if ($estado == 'activa'){
                    echo' <div class="col-xs-4 col-md-4 bt-Factura">
                              <div class="form-group">
                                 <div class="input-group">    
                                    <span class="input-group-addon">Solid To</span> 
                                    <input style="font-size:12px;" type="text" class="form-control input-xs encabezado" id="nSold1"
                                    name="nSold1" onfocus="obtieneFoco(\'#nSold1\')" onblur = "pierdeFoco(\'#nSold1\')" 
                                    onkeypress="siguiente(event,\'#nSold2\')" value="'. $sold1 .'">
                              </div>
                           </div>       
                        </div>';
                     echo' <div class="col-xs-3 col-md-2 bt-Factura">
                              <div class="form-group">
                                 <div class="input-group">    
                                    <span class="input-group-addon">-</span> 
                                    <input style="font-size:12px;" type="text" class="form-control input-xs encabezado" id="nSold2"
                                    name="nSold2" onfocus="obtieneFoco(\'#nSold2\')" onblur = "pierdeFoco(\'#nSold2\')" 
                                    onkeypress="siguiente(event,\'#nSold3\')" value="'. $sold2 .'">
                                  </div>
                              </div>    
                           </div>';
                     echo' <div class="col-xs-4 col-md-3 bt-Factura">
                              <div class="form-group">
                                 <div class="input-group">    
                                    <span class="input-group-addon">-</span> 
                                    <input style="font-size:12px;" type="text" class="form-control input-xs encabezado" id="nSold3"
                                    name="nSold3" onfocus="obtieneFoco(\'#nSold3\')" onblur = "pierdeFoco(\'#nSold3\')" 
                                    onkeypress="siguiente(event,\'#nSold4\')" value="'. $sold3 .'">
                                  </div>
                              </div>    
                           </div>';
                     echo' <div class="col-xs-4 col-md-3 bt-Factura">
                              <div class="form-group">
                                 <div class="input-group">    
                                    <span class="input-group-addon">-</span> 
                                    <input style="font-size:12px;" type="text" class="form-control input-xs encabezado" id="nSold4"
                                    name="nSold4" onfocus="obtieneFoco(\'#nSold4\')" onblur = "pierdeFoco(\'#nSold4\')" 
                                    onkeypress="siguiente(event,\'#nShip\')" value="'. $sold4 .'">
                                 </div>
                              </div>    
                           </div>';
                     echo' <div class="col-xs-5 col-md-4 bt-Factura">
                              <div class="form-group">
                                 <div class="input-group">    
                                    <span class="input-group-addon">Ship To 1</span> 
                                    <input style="font-size:12px;" type="text" class="form-control input-xs encabezado" id="nShip"
                                    name="nShip" onfocus="obtieneFoco(\'#nShip\')" onblur = "pierdeFoco(\'#nShip\')" 
                                    onkeypress="siguiente(event,\'#nTrack\')" value="'. $ship .'">
                                 </div>
                              </div>    
                           </div>';
                     echo' <div class="col-xs-5 col-md-4 bt-Factura">
                              <div class="form-group">
                                 <div class="input-group">    
                                    <span class="input-group-addon">Ship To 2</span> 
                                    <input style="font-size:12px;" type="text" class="form-control input-xs encabezado" id="nShip1"
                                    name="nShip1" onfocus="obtieneFoco(\'#nShip1\')" onblur = "pierdeFoco(\'#nShip1\')" 
                                    onkeypress="siguiente(event,\'#nTrack\')" value="'. $ship1 .'">
                                 </div>
                              </div>    
                           </div>';

       
                     echo' <div class="col-xs-5 col-md-4 bt-Factura">
                              <div class="form-group">
                                 <div class="input-group">    
                                    <span class="input-group-addon">Tracking Number</span> 
                                    <input style="font-size:12px;" type="text" class="form-control input-xs encabezado" id="nTrack"
                                    name="nTrack" onfocus="obtieneFoco(\'#nTrack\')" onblur = "pierdeFoco(\'#nTrack\')" 
                                    value="'. $track .'">
                                 </div>
                              </div>    
                           </div>';

                  } //fin if      
               ?>           
            </div> <!-- FIN PRIMERA 1 -->        
            <div class="row"> <!-- SEGUNDA LINEA DE ENTRADA -->
               <?php
                  if ($estado == 'activa'){   
                     echo '<div class="col-xs-5 col-sm-2 bt-factura"> 
                              <div class="form-group">
                                 <div class="input-group">    
                                    <span class="input-group-addon"><i class="fa fa-slack"> Cant.</i></span> 
                                    <input style="font-size:12px;" type="number" class="form-control input-xs" id="nCanti" name="nCanti"  
                                    onfocus=" obtieneFoco(\'#nCanti\')" onblur = "pierdeFoco(\'#nCanti\')" onkeypress="siguiente(event,\'#nParte\')" required>
                                    <input type="hidden" id="nIdFactura" name="nIdFactura" value = "'. $consecutivo . '">
                                 </div>
                              </div>
                           </div>';
                     echo '<div class="col-xs-7 col-sm-2 bt-factura" > 
                              <div class="form-group">
                                 <div class="input-group">    
                                    <span class="input-group-addon"><i class="fa fa-steam"> Parte</i></span> 
                                    <input style="font-size:12px;" type="text" class="form-control input-xs" id="nParte" name="nParte"
                                    onfocus=" obtieneFoco(\'#nParte\')" onblur = "pierdeFoco(\'#nParte\')" 
                                    onkeypress="siguiente(event,\'#nDescri\')" required>
                                 </div>
                              </div>
                           </div>';  
                     echo '<div class="col-xs-7 col-sm-4 bt-factura" > 
                              <div class="form-group">
                                 <div class="input-group">    
                                    <span class="input-group-addon"><i class="fa fa-comment-o"> Descrip.</i></span> 
                                    <input style="font-size:12px;" type="text" class="form-control input-xs" id="nDescri" name="nDescri" 
                                    onfocus=" obtieneFoco(\'#nDescri\')" onblur = "pierdeFoco(\'#nDescri\')"
                                    onkeypress="siguiente(event,\'#nMonto\')" required>
                                 </div>
                              </div>
                           </div>';
                     echo '<div class="col-xs-5 col-sm-2 bt-factura"> 
                              <div class="form-group">
                                 <div class="input-group">    
                                    <span class="input-group-addon"><i class="fa fa-dollar"> Monto</i></span> 
                                    <input type="number" class="form-control input-xs" id="nMonto" name="nMonto" 
                                    onfocus=" obtieneFoco(\'#nMonto\')" onblur = "pierdeFoco(\'#nMonto\')" required>
                                 </div>
                              </div>
                           </div>';
                  }
               ?>            
               <div class="col-xs-12 col-sm-2"> 
                  <div class="btn-group">
                    <?php
                        if ($estado == 'activa'){
                           echo '<button style="display:block" type="submit" class="btn btnAddLinea btn-info" ><i class="fa fa-plus"> Agregar</i></button>';
                        }else {
                           echo '<button style="display:none" type="submit" class="btn btnAddLinea btn-info" ><i class="fa fa-plus"> Agregar</i></button>';    
                        } // fin if       
                    ?>
                  </div>    
               </div><!--fin  item 5-->
            </div> <!-- FIN SEGUNDA 1 -->
         </form>
         <?php    
            $crearLnFactura = new ControladorFacturas();
            $crearLnFactura -> ctrCrearLinea();     
         ?>               
       
         <!--========================================================================== --> 
         <div class="row"> <!-- SEGUNDA LINEA DE ENTRADA -->
            <div class="col-xs-12 col-sm-12 bt-factura" >
              
               <table class="table table-bordered table-striped table-condensed dt-responsive tablaFacturas" width="100%">
   				   <thead class="bg-primary text-light">      
						   <tr>
							   <th style="width:3%">#</th>
							   <th style="text-align:center; width:8% x-small;">Quant</th>
							   <th style="text-align:center; width:15% x-small;">Part No</th>
							   <th style="text-align:center; width:35% x-small;">Description</th>
						      <th style="text-align:center; width:15% x-small;">Net</th>
							   <th style="text-align:center; width:15% x-small;">Amount</th>
                        <th style="text-align:center; x-small;">Action</th>
						   </tr>   
						</thead>
						<tbody>
                     <?php
                           $item = "idFactura";
                           $valor = $consecutivo;
                           $lineas = ControladorFacturas::ctrMostrarLineas($item, $valor);
                                                
                           foreach ($lineas as $key => $value) {
                              $_SESSION['tracking'] = $value["tracking"];
                              echo ' <tr>
                                    <td>'.($key+1).'</td>
                                    <td>'.$value["cantidad"].'</td>
                                    <td>'.$value["parte"].'</td>
                                    <td>'.$value["descripcion"].'</td>
                                    <td>'.$value["monto"].'</td>
                                    <td>'.$value["total"].'</td> 
                                    <td>
                                       <div class="btn-group">
                                          <button class="btn btn-xs btn-warning btnBorrarLn" lnFactura="'.$value["idLinea"].'"><i class="fa fa-times"> Borrar</i></button>      
                                       </div>
                                       <div class="btn-group">
                                          <button class="btn btn-xs btn-info btnEditarFactura" lnFactura="'.$value["idLinea"].'" data-toggle="modal" data-target="#modalEditarFactura"><i class="fa fa-pencil"> Editar</i></button>
                                       </div>     
                                    </td>     
                                 </tr>';
                           } // fin for    
                     ?>     
                  </tbody>
						<tfoot style="color:black; background:cyan;">
                     <tr>
							   <td colspan="4 " style="text-align:center; font-weight:bold;" > Totals</td>
							      <td></td>
							      <td></td>
                           <td></td>
						      </tr>
						</tfoot>
					</table>  
            </div> <!--Fin de Linea -->
			</div> <!--Fin Segunda -->
      </div> <!--Fin div box-body -->
         
    </div> <!--Fin div box -->
  </section> <!--Fin section Content -->
</div> <!--Fin Class Content Wrapper -->  
<!--=====================================
MODAL EDITAR FACTURA
======================================-->
<div id="modalEditarFactura" class="modal fade" role="dialog">
  <div class="modal-dialog" style="width: 70% !important;">
    <div class="modal-content">
      <form role="form" method="post" enctype="multipart/form-data" onKeypress="if(event.keyCode == 13) event.returnValue = false;">
        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->
        <div class="modal-header" style="background:#3c8dbc; color:white">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Editar Linea</h4>
        </div>
        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->
        <div class="modal-body">   
           <div class="box-body">
              <div class="row"> <!-- PRIMERA LINEA DE ENTRADA -->
                 <div class="col-xs-12 col-sm-3"> 
                      <!-- EDITA CANTIDAD -->
                      <div class="form-group">
                          <div class="input-group">
                             <span class="input-group-addon"><i class="fa fa-slack"> Cant.</i></span> 
                             <input type="hidden" id="eIdFactura" name="eIdFactura">
                             <input type="number" class="form-control input-xs" name="eCanti" id="eCanti" onfocus=" obtieneFoco('#eCanti')" onblur = "pierdeFoco('#eCanti')" onkeypress="siguiente(event,'#eParte')" required>
                          </div>
                      </div>   
                  </div>
                 
                  <div class="col-xs-12 col-sm-4">
                      <!-- EDITA PARTE -->
                      <div class="form-group">
                         <div class="input-group">
                             <span class="input-group-addon"><i class="fa fa-steam"> Parte</i></span> 
                             <input type="text" class="form-control input-xs" name="eParte" id="eParte" onfocus=" obtieneFoco('#eParte')" onblur = "pierdeFoco('#eParte')" onkeypress="siguiente(event,'#eDescri')" required>
                         </div>
                      </div>
                  </div>
               </div> <!-- Fin Linea 1 --> 
              <div class="row"> <!-- SEGUNDA LINEA DE ENTRADA -->
                  <div class="col-xs-12 col-sm-8"> 
                      <!-- EDITA DESCRIPCION -->
                      <div class="form-group">
                          <div class="input-group">
                             <span class="input-group-addon"><i class="fa fa-comment-o"> Descrip.</i></span> 
                             <input type="text" class="form-control input-xs" id="eDescri" name="eDescri" onfocus=" obtieneFoco('#eDescri')" onblur = "pierdeFoco('#eDescri')" onkeypress="siguiente(event,'#eMonto')" >
                          </div>
                      </div>
                  </div>            
          
                  <div class="col-xs-12 col-sm-3"> 
                      <!-- ENTRADA PARA EL EMAIL -->
                      <div class="form-group">
                          <div class="input-group">
                             <span class="input-group-addon"><i class="fa fa-dollar"> Monto</i></span> 
                             <input type="number" class="form-control input-xs" id="eMonto" name="eMonto"  onfocus=" obtieneFoco('#eMonto')" onblur = "pierdeFoco('#eMonto')" >
                          </div>
                      </div>
                  </div>
               </div> <!-- Fin Linea 2 -->
              
          </div> <!-- Fin box modal Body -->
        </div>  <!-- Fin modal Body -->      
        <!--=====================================
        PIE DEL MODAL
        ======================================-->
        <div class="modal-footer">
          <div class="row"> <!-- CUARTA LINEA DE ENTRADA -->
              <div class="col-xs-11 col-sm-2">
                <button type="button" class="btn btn-info pull-left" data-dismiss="modal">
                  <i class="fa fa-mail-reply">
                    Regresar ..
                  </i>
                </button>       
              </div><!--fin item 1-->
             
              <div class="col-xs-1 col-sm-8">
              </div><!--fin item 2-->
         
              <div class="col-xs-12 col-sm-2">
                <button type="submit" class="btn btn-primary">
                  <i class="fa fa-save">
                    Actualizar
                  </i>  
                </button> 
              </div><!--fin item 3-->  
            </div> <!-- FIN CUARTA LINEA -->  
         </div>
      </form>
        <?php     
          $editarFactura = new ControladorFacturas();
          $editarFactura -> ctrEditarFactura();
        ?>     
    </div> <!-- FIN CLASS MODEL CONTENT -->
  </div> <!-- FIN MODAL DIALOG -->
</div> <!-- FIN MODAL EDITAR FACTURA -->

 

<!--=====================================
MODAL BUSCAR FACTURA
======================================-->
<div id="modalBuscarFactura" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header" style="background:#3c8dbc; color:white"> 
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Buscar Factura</h4>
      </div> <!-- fin div modal-header -->
      
      <div class="modal-body" style="background: cyan;">
        <table class="table table-bordered table-condensed table-striped dt-responsive tablas" width="100%"> 
          <thead>
            <tr>
               <th style="width:10px">#</th>
               <th style="width:120px">Factura</th>
               <th>Fecha</th>
               <th>Tracking</th>
               <th>Total</th>
               <th>Acciones</th>
            </tr> 
          </thead>  
          <tbody>
              <?php  
                  $item = null;
                  $valor = null;
                       
                  $facturas = ControladorFacturas::ctrMostrarFacturas($item, $valor);
             
                  foreach ($facturas as $key => $value) {
                        echo ' <tr>
                           <td>'.($key+1).'</td>
                           <td>'.$value["id"].'</td>
                           <td>'.$value["fecha"].'</td>
                           <td>'.$value["tracking"].'</td> 
                           <td>'.$value["total"].'</td>
                           <td>
                              <div class="btn-group">
                                 <form method="post" action="reportes/reporteFactura1.php" >          
                                   <input type="hidden"  name="vIdReporte" value='.$value["id"].'>
                                   <input type="hidden"  name="vFecha" value='.$value["fecha"].'>
                                   <input type="hidden"  name="vTracking" value='.$value["tracking"].'>                 
                                   <button type="submit" class="btn btn-xs btn-warning"  ><i class="fa fa-check"> Ver</i></button>     
                                 </form>
                              </div>
                              <div class="btn-group">  
                                 <button type="submit"  class="btn btnActivaFactura btn-xs btn-danger" idFactura ='.$value["id"].'><i class="fa fa-pencil" data-dismiss="modal"> Activa</i></button>  
                              </div>
                           </td>
                       </tr>';    
                 } // fin for    
                  
              ?> 
          </tbody>
        </table>  
      </div> <!-- fin div modal-body -->
    
      <div class="modal-footer"></div> <!-- fin div modal-footer -->
   
    </div> <!-- fin ventana modal-content -->
  </div> <!-- fin ventana modal-dialog -->
</div> <!-- fin ventana modalBuscarFactura -->  
       
  
<?php
     
  $borrarLnFactura = new ControladorFacturas();
  $borrarLnFactura -> ctrBorrarLinea();

?>  
      