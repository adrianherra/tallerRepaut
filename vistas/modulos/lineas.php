       
<div class="content-wrapper">
  <section class="content-header">
     <h1>Detalle de la Orden</h1>
     <ol class="breadcrumb">     
        <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li class="active">Lineas de Compra</li>
     </ol>
  </section>   
              
  <section class="content">        
    <div class="box">
      <div class="box-header with-border">
        <button type="button" class="btn btn-primary btnAgregarLineas" data-toggle="modal" data-target="#modalAgregarLinea">
           <i class="fa fa-plus">
              Nueva Linea
           </i>   
        </button> 
           
      </div>  
                    
      <div class="box-body">
          <?php

              if (isset($_POST["idOrden"])) {
                
                 $_SESSION['numeroOrden'] = $_POST["idOrden"];                
 
              } // fin if

              $item =  "id";
              $valor =  $_SESSION['numeroOrden'];
              $idOrden =  $_SESSION['numeroOrden'];
              $orden = ControladorOrdenes::ctrMostrarOrdenes($item, $valor);
             
           ?>


          <!--========================================================================== --> 
              <div class="row"> <!-- PRIMERA LINEA DE ENTRADA -->
                 <div class="col-xs-12 col-sm-2"> 
                      <!-- NUMERO ORDEN -->
                      <div class="form-group">
                          <div class="input-group">
                             <span class="input-group-addon"><i class="fa fa-cog"> Orden</i></span> 
                             <input type="text" class="form-control input-xs" id="verOrden" name="verOrden" value="<?php echo $orden["orden"];?>" readonly>
                          </div>
                      </div>
                  </div><!--fin  item 1-->
                  <div class="col-xs-12 col-sm-4"> 
                      <!-- ASEGURADORA -->
                      <div class="form-group">
                          <div class="input-group">
                             <span class="input-group-addon"><i class="fa fa-home"> Aseguradora</i></span> 
                             <input type="text" class="form-control input-xs" id="verAseguradora" name="verAseguradora" value="<?php echo $orden["aseguradora"];?>" readonly>
                          </div>
                      </div>
                  </div><!--fin  item 2-->
                  <div class="col-xs-12 col-sm-3"> 
                      <!-- FECHA -->
                      <div class="form-group">
                          <div class="input-group">
                             <span class="input-group-addon"><i class="fa fa-calendar"> Fecha</i></span> 
                             <input type="text" class="form-control input-xs" id="verFecha" name="verFecha" value="<?php echo $orden["fechaOrden"];?>" readonly>
                          </div>
                      </div>
                  </div><!--fin  item 3--> 
                  <div class="col-xs-12 col-sm-2"> 
                      <!-- PLAZO -->
                      <div class="form-group">
                          <div class="input-group">
                             <span class="input-group-addon"><i class="fa fa-star"> Plazo</i></span> 
                             <input type="text" class="form-control input-xs" id="verPlazo" name="verPlazo" value="<?php echo $orden["plazo"];?>" readonly>
                          </div>
                      </div>
                  </div><!--fin  item 4-->
              </div> <!-- FIN PRIMERA LINEA -->
              <br>
              <!--========================================================================== --> 
              <div class="row"> <!-- SEGUNDA LINEA DE ENTRADA -->
                 <div class="col-xs-12 col-sm-4"> 
                      <!-- TALLER -->
                      <div class="form-group">
                          <div class="input-group">
                             <span class="input-group-addon"><i class="fa fa-slideshare"> Taller</i></span> 
                             <input type="text" class="form-control input-xs" id="verTaller" name="verTaller" value="<?php echo $orden["taller"];?>" readonly>
                          </div>  
                      </div>
                  </div><!--fin  item 1-->
                  <div class="col-xs-12 col-sm-3"> 
                      <!-- FECHA VENCIMIENTO -->
                      <div class="form-group">
                          <div class="input-group">
                             <span class="input-group-addon"><i class="fa fa-calendar"> F.Vencimiento</i></span> 
                             <input type="text" class="form-control input-xs" id="verVencimiento" name="verVencimiento" value="<?php echo $orden["fechaVencimiento"];?>" readonly>
                          </div>
                      </div>   
                  </div><!--fin  item 2--> 
                  <div class="col-xs-12 col-sm-2"> 
                      <!-- NUMERO PLACA -->
                      <div class="form-group">    
                          <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-cc"> Placa</i></span> 
                            <input type="text" class="form-control input-xs" id="verPlaca" name="verPlaca" value="<?php echo $orden["placa"];?>" readonly>
                          </div>
                      </div>
                  </div><!--fin  item 3-->
                  <div class="col-xs-12 col-sm-3"> 
                      <!-- MARCA -->
                      <div class="form-group">
                          <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-tag"> Marca</i></span> 
                            <input type="text" class="form-control input-xs" id="verMarca" name="verMarca" value="<?php echo $orden["marca"];?>" readonly>
                          </div>
                      </div>
                  </div><!--fin  item 4-->
              </div> <!-- FIN SEGUNDA LINEA -->   
              <br>    
                
              <!--========================================================================== --> 
              <div class="row"> <!-- TERCERA LINEA DE ENTRADA -->
                 <div class="col-xs-12 col-sm-3"> 
                      <!-- MODELO -->
                      <div class="form-group">
                          <div class="input-group">
                             <span class="input-group-addon"><i class="fa fa-car"> Modelo</i></span> 
                             <input type="text" class="form-control input-xs" id="verModelo" name="verModelo" value="<?php echo $orden["modelo"];?>" readonly>
                          </div>
                      </div>
                  </div><!--fin  item 1-->
                  <div class="col-xs-12 col-sm-2"> 
                      <!-- AÑO VEHICULO -->     
                      <div class="form-group">
                          <div class="input-group">
                             <span class="input-group-addon"><i class="fa fa-tablet"> Año</i></span> 
                             <input type="text" class="form-control input-xs" id="verAno" name="verAno" value="<?php echo $orden["ano"];?>" readonly>
                          </div>
                      </div>
                  </div><!--fin  item 2--> 
                  <div class="col-xs-12 col-sm-3"> 
                      <!-- SINIESTRO -->
                      <div class="form-group">
                          <div class="input-group">
                             <span class="input-group-addon"><i class="fa fa-flash"> Siniestro</i></span> 
                             <input type="text" class="form-control input-xs" id="verSiniestro" name="verSiniestro" value="<?php echo $orden["siniestro"];?>" readonly>
                          </div>
                      </div>
                  </div><!--fin  item 3-->
                
                  <div class="col-xs-12 col-sm-4"> 
                      <!-- OBSERVACIONES -->
                      <div class="form-group">
                          <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-twitch"> Observación</i></span> 
                            <input type="text" class="form-control input-xs" id="verObservacion" name="verObservacion" value="<?php echo $orden["observacion"];?>" readonly>
                          </div>
                      </div>
                  </div><!--fin  item 3-->
                  
              </div> <!-- FIN TERCERA LINEA -->
                                        
              <!--========================================================================== --> 
              <div class="row"> <!-- CUARTA LINEA DE ENTRADA -->
                 <div class="col-xs-12 col-sm-12">
                    <table class="table table-bordered table-striped table-condensed dt-responsive tablaLineas" width="100%"> 
                      <thead class="bg-primary text-light">
                           <tr>         
                              <th style="width:10px;">#</th>
                              <th style="width:60px; font-size: x-small;"># Parte</th>
                              <th style="width:100px; font-size: x-small;"># Mia</th>
                              <th style="width:45px; font-size: x-small;">Compra</th>
                              <th style="width:140px; font-size: x-small;">Descripción</th>
                              <th style="font-size: x-small;">Monto S/imp.</th>
                              <th style="font-size: x-small;">Costo</th>
                              <th style="font-size: x-small;">Utilidad</th>      
                              <th style="font-size: x-small;">% Utl</th>
                              <th style="width:60px; font-size: x-small;">F. Prec</th>    
                              <th style="width:40px; font-size: x-small;">Factura</th>
                              <th style="font-size: x-small;">Estado</th>
                              <th style="font-size: x-small;">Acciones</th>
                         </tr> 
                       </thead>
                       <tbody>        
                           <?php  
                                
                                $item =  "idOrden";
                                
                                $lineas = ControladorLineas::ctrMostrarLineas($item, $valor);
                                
                                $conta = 0;
                                $pagado = 0;  
                                $entregado = 0;  
                                $saldo = 0;  
                                $montoGen = 0;
                                $costoGen = 0;
                                $saldoGen = 0;

                                foreach ($lineas as $key => $value) {
                                    
                                  $costo = $value["TCompra"] + $value["totalCol"];
                                  $venta = $value["pVenta"];
                                  $utilidad = $venta - $costo;
                                  $montoGen = $montoGen + $venta;
                                  $costoGen = $costoGen + $costo;
                                  
                                  if (($costo != 0) && ($utilidad != 0))  
                                     $porUtl = ($utilidad / $costo) * 100;
                                  else 
                                     $porUtl = 0;
                                  $conta ++;
                                  $costo =  number_format($costo, 2, '.', '');
                                  $venta =  number_format($venta, 2, '.', '');
                                  $utilidad = number_format($utilidad, 2, '.', '');  
                                  $porUtl = number_format($porUtl, 2, '.', '');
                                  $valorEstado = $value["estado"];
                                  $valorId =$value["id"];
                                  
                                  $presentacion = $value["presentacion"];
                                  if($_SESSION["perfil"] == "Administrador"){
                                    $presentacion = "<input type='date' style='background:#00FFFF;' class= 'input-xs btnVerPresentacion' nLinea= '".$valorId."' id='nFPre' name='nFPre' value='".$value["presentacion"]."'>";
                                  }// fin if
                                                   
                                  $estado = $valorEstado;
                                  //if($_SESSION["perfil"] == "Administrador"){
                                    if ($valorEstado == "En Proceso") { 
                                       $estado = "<select class= 'input-xs btnVerEstado btn-primary' name='nEstado' id='nEstado' nLinea= '".$valorId."'><option value='En Proceso' selected>En Proceso</option> <option value='Anulado'>Anulado</option> <option value='Entregado'>Entregado</option><option value='Pagado'>Pagado</option></select>";
                                    }// fin if  
                                    if ($valorEstado == "Anulado") { 
                                        $estado = "<select class= 'input-xs btnVerEstado btn-success' name='nEstado' id='nEstado' nLinea= '".$valorId."'><option value='En Proceso'>En Proceso</option> <option value='Anulado' selected>Anulado</option> <option value='Entregado'>Entregado</option><option value='Pagado'>Pagado</option></select>";
                                     }// fin if
                                    if ($valorEstado == "Entregado") {
                                       $estado = "<select class= 'input-xs btnVerEstado btn-warning' name='nEstado' id='nEstado' nLinea= '".$valorId."'><option value='En Proceso'>En Proceso</option> <option value='Anulado'>Anulado</option>  <option value='Entregado' selected>Entregado</option><option value='Pagado'>Pagado</option></select>";$entregado ++;   
                                    } // fin if   
                                    if ($valorEstado == "Pagado") { 
                                       $estado = "<select class='input-xs btnVerEstado btn-info' name='nEstado' id='nEstado' nLinea= '".$valorId."'><option value='En Proceso'>En Proceso</option> <option value='Anulado'>Anulado</option> <option value='Entregado'>Entregado</option><option value='Pagado' selected>Pagado</option></select>";$pagado ++;  
                                    } else {
                                       $saldo = $saldo + $value["totalVenta"];
                                    } // fin if 
                                  //}// fin if  
                                  $valorMia = $value["numMia"];
                                  $rutaMia = $value["rutaMia"];
                                
                                  if ($valorMia != null) {
                                      if ($rutaMia == "")
                                         $mia = "<a class = 'btn btn-info btn-xs' href='lineas'>".$valorMia."</a>";
                                      else  
                                         $mia = "<a class = 'btn btn-info btn-xs' target='_blank' href='".$rutaMia."'>".$valorMia."</a>";
                                  } else {
                                      if ($value["compra"] != "LOCAL")
                                         $mia = "<a class = 'btn btn-info btn-xs' href='lineas'>Sin Mia</a>";
                                      else 
                                         $mia = "---------------";    
                                  } // fin if 
        
                                  echo '<tr>
                                            <td>'.($key+1).'</td>
                                            <td style="font-size: x-small;">'.$value["numParte"].'</td>
                                            <td style="width:100px; font-size: x-small;">'.$mia.'</td>
                                            <td style="font-size: x-small;">'.$value["compra"].'</td>
                                            <td style="width:140px; font-size: x-small;">'.$value["descripcion"].'</td>
                                            <td style="font-size: x-small;">'.$venta.'</td>
                                            <td style="font-size: x-small;">'.$costo.'</td>
                                            <td style="font-size: x-small;">'.$utilidad.'</td>
                                            <td style="font-size: x-small;">'.$porUtl.'</td>
                                            <td style="width:60px; font-size: x-small;">'.$presentacion.'</td>
                                            <td style="width:40px; font-size: x-small;">'.$value["numFactura"].'</td>
                                            <td style="font-size: x-small;">'.$estado.'</td>   
                                            <td>
                                              <div class="btn-group">';
                                              if($_SESSION["perfil"] == "Administrador"){    
                                                echo'  <button class="btn btn-warning btn-xs btnEditarLinea" idLinea="'.$value["id"].'" data-toggle="modal" data-target="#modalEditarLinea"><i class="fa fa-pencil"></i></button> 
                                                  <button class="btn btn-danger btn-xs btnEliminarLinea" idLinea="'.$value["id"].'" idOrden="'.$value["idOrden"].'" montoOrden= "'.$venta.'" costoOrden = "'.$costo.'" estado= "'.$estado.'" ><i class="fa fa-times"></i></button>';      
                                              }else {
                                                 echo'<i class="fa fa-cab"></i>'; 
                                              }// fin if
                                         echo'</div>     
                                            </td>
                                        </tr>';    
                              } // fin for      
                              $estado = "En Proceso";
                              if ($conta == 0)
                                $estado = "Sin Lineas";
                              else {
                                if ($conta == $pagado){
                                    $estado = "Pagado";
                                }else if ($conta == $entregado){
                                    $estado = "Entregado";
                              } // fin if
                             } // fin if   

                                      
                           ?>                        
                       </tbody>
                       <tfoot style="color:#FF00FF;">
                          <tr>
                              <th colspan="5" style="text-align:center;">Totales :</th>
                              <th></th>
                              <th></th>      
                              <th></th>
                              <th></th>
                              <th colspan="4"></th>
                          </tr>
                      </tfoot> 
                   </table> 
                </div> <!-- fin iten 1 -->
             </div> <!-- FIN CUARTA LINEA -->   
      </div>
      <div class="box-footer">
           <input type="hidden" class="input-xs btnValorEstado" id="valorEstado" value ="<?php echo $estado;?>" readonly>
           <button type="button" class="btn btn-warning btnRegresar" nValor= "<?php echo $estado; ?>" nId= "<?php echo $idOrden; ?>" nSaldo= "<?php echo $saldo; ?>" nMonto= "<?php echo $montoGen; ?>" nCosto= "<?php echo $costoGen; ?>" >
              <i class="fa fa-mail-reply">
                 Regresar ..
              </i>   
           </button>  
      </div>
    </div>
  </section>
</div>


<!--=====================================
MODAL AGREGAR LINEAS
======================================-->
<div id="modalAgregarLinea" class="modal fade" role="dialog">

  <div class="modal-dialog" style="width: 80% !important;">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data" onKeypress="if(event.keyCode == 13) event.returnValue = false;">
        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->
        <div class="modal-header" style="background:#3c8dbc; color:white">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">
              Agregar Linea
          </h4>
        </div>
        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->
        <div class="modal-body">

           <div class="box-body">
            
              <!--========================================================================== --> 
              <div class="row"> <!-- PRIMERA LINEA DE ENTRADA -->
                 <div class="col-xs-12 col-sm-3"> 
                      <!-- NUMERO ORDEN -->
                      <div class="form-group">
                          <div class="input-group">
                             <span class="input-group-addon"><i class="fa fa-cog"> Orden</i></span>
                             <input type="hidden" id="nId" name="nId" value="<?php echo $orden["id"];?>"> 
                             <input type="text" class="form-control input-xs" id="nOrden" name="nOrden" value="<?php echo $orden["orden"];?>" readonly>
                          </div>  
                      </div>
                  </div><!--fin  item 1-->
                  <div class="col-xs-12 col-sm-3"> 
                      <!-- NUMERO DE PARTE -->
                      <div class="form-group">
                          <div class="input-group">
                             <span class="input-group-addon"><i class="fa fa-cog"></i></span> 
                             <input type="text" class="form-control input-xs" id="nParte" name="nParte" placeholder="# Parte" onfocus=" obtieneFoco('#nParte')" onblur = "pierdeFoco('#nParte')" onkeypress="siguiente(event,'#nCompra')" >
                          </div>
                      </div>
                  </div><!--fin  item 2-->
                  <div class="col-xs-12 col-sm-3"> 
                      <!-- TIPO COMPRA-->
                      <div class="form-group">
                          <div class="input-group">
                              <span class="input-group-addon"><i class="fa fa-file"> Compra</i></span>
                              <select class= "form-control input-xs" name="nCompra" id="nCompra">
                                 <option value="LOCAL">LOCAL</option>
                                 <option value="INVENTARIO">INVENTARIO</option>
                                 <option value="EXTERNA">EXTERNA</option>
                              </select>     
                          </div>
                      </div>
                  </div><!--fin item 3-->  
                  <div class="cInventario col-xs-12 col-sm-3" style ="display: none"> 
                      <!-- SELECION INVENTARIO-->
                      <div class="form-group">
                          <div class="input-group">
                             <span class="input-group-addon"><i class="fa fa-building"></i></span>
                             <input type="text" class="form-control input-xs" id="nArticulo" name="nArticulo" placeholder="Artículo" readonly>
                             <span class="input-group-addon"><input type="button"  class="btn btn-xs btn-success btnBucaArticulo" data-toggle="modal" data-target="#modalBuscaArticulo" value="Buscar"></span>  
                          </div>
                      </div>
                  </div><!--fin item 4-->   

              </div> <!-- FIN PRIMERA LINEA -->
              <br>
              <!--========================================================================== --> 
              <div class="row cExterior" style="display: none"> <!-- SEGUNDA LINEA DE ENTRADA -->
                 <div class="col-xs-12 col-sm-3"> 
                      <!-- NUMERO DE MIA -->
                      <div class="form-group">
                          <div class="input-group">
                             <span class="input-group-addon"><i class="fa fa-barcode"></i></span> 
                             <input type="text" class="form-control input-xs" id="nMia" name="nMia" placeholder="# Mia" onfocus=" obtieneFoco('#nMia')" onblur = "pierdeFoco('#nMia')" onkeypress="siguiente(event,'#nDescri')">
                          </div>
                      </div>
                  </div><!--fin  item 3--> 
                  <div class="col-xs-12 col-sm-9"> 
                      <!-- NUMERO ORDEN -->
                      <div class="form-group">
                          <div class="input-group">      
                             <span class="input-group-addon"><i class="fa fa-file"> Ruta</i></span>
                             <input type="text" class="form-control input-xs" id="nRuta" name="nRuta" placeholder="Dirección Web" onfocus=" obtieneFoco('#nRuta')" onblur = "pierdeFoco('#nRuta')" onkeypress="siguiente(event,'#nDescri')">
                          </div>
                      </div>
                  </div><!--fin  item 1-->
                  
              </div> <!-- FIN SEGUNDA LINEA -->
              <!--========================================================================== --> 
              <div class="row"> <!-- TERCERA LINEA DE ENTRADA -->
                 <div class="col-xs-12 col-sm-5"> 
                      <!-- DESCRIPCION -->
                      <div class="form-group">
                          <div class="input-group">
                             <span class="input-group-addon"><i class="fa fa-comment"></i></span> 
                             <input type="text" class="form-control input-xs" id="nDescri" name="nDescri" placeholder="Descripción" onfocus=" obtieneFoco('#nDescri')" onblur = "pierdeFoco('#nDescri')" onkeypress="siguiente(event,'#nFactura')">
                          </div>
                      </div>
                  </div><!--fin  item 1-->
                  <div class="col-xs-12 col-sm-3"> 
                      <!-- NUMERO DE FACTURA -->
                      <div class="form-group">
                          <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-file"></i></span> 
                            <input type="text" class="form-control input-xs" id="nFactura" name="nFactura" placeholder="Factura" onfocus=" obtieneFoco('#nFactura')" onblur = "pierdeFoco('#nFactura')" onkeypress="siguiente(event,'#nFecha')">
                          </div>
                      </div>
                   </div><!--fin  item 2-->
                   <div class="col-xs-12 col-sm-4"> 
                      <!-- NUMERO DE FACTURA -->
                      <div class="form-group">
                          <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-calendar"> Fecha</i></span> 
                            <input type="date" class="form-control input-xs" id="nFecha" name="nFecha" onkeypress="siguiente(event,'#nPresenta')">
                          </div>
                      </div>
                   </div><!--fin  item 2-->
              </div> <!-- FIN TERCERA LINEA -->
              <br>
              <!--========================================================================== --> 
              <div class="row"> <!-- CUARTA LINEA DE ENTRADA -->
                 <div class="col-xs-12 col-sm-4"> 
                      <!-- FECHA PRESENTACION -->
                      <div class="form-group">
                          <div class="input-group">
                             <span class="input-group-addon"><i class="fa fa-calendar"> Precentación</i></span>  
                             <input type="date" class="form-control input-xs" id="nPresenta" name="nPresenta" onkeypress="siguiente(event,'#nVencimiento')">  
                          </div>
                      </div>    
                  </div><!--fin  item 1-->
                  <div class="col-xs-12 col-sm-4"> 
                      <!-- FECHA VENCIMIENTO -->
                      <div class="form-group">
                          <div class="input-group">
                             <span class="input-group-addon"><i class="fa fa-calendar"> Vencimiento</i></span>  
                             <input type="date" class="form-control input-xs" id="nVencimiento" name="nVencimiento" onkeypress="siguiente(event,'#nPVenta')">
                          </div>
                      </div>
                   </div><!--fin  item 2-->
                   <div class="col-xs-12 col-sm-4"> 
                      <!-- TIPO COMPRA-->
                      <div class="form-group">
                          <div class="input-group">
                              <span class="input-group-addon"><i class="fa fa-file"> Tipo</i></span>
                              <select class= "form-control input-xs" name="nTipo" id="nTipo">
                                 <option value="ORIGINAL">ORIGINAL</option>
                                 <option value="USADO">USADO</option>
                                 <option value="GENERICO">GENERICO</option>
                              </select>     
                          </div>
                      </div>
                  </div><!--fin  item 4-->


              </div> <!-- FIN CUARTA LINEA -->
              <hr>
              <!--========================================================================== --> 
              <div class="row"> <!-- QUINTA LINEA DE ENTRADA -->
                 <div class="col-xs-12 col-sm-3"> 
                      <!-- CANTIDAD VENTAS -->
                      <div class="form-group">
                          <div class="input-group">
                             <span class="input-group-addon"><i class="fa fa-calculator"> Cantidad</i></span> 
                             <input type="number" class="form-control input-xs" id="nCantidad" name="nCantidad" placeholder="Cant.V" onfocus=" obtieneFoco('#nCantidad')" onblur = "pierdeFoco('#nCantidad')" value = 1>
                          </div>
                      </div>
                  </div><!--fin  item 1-->   
                  <div class="col-xs-12 col-sm-3"> 
                      <!-- PRECIO DE VENTA -->
                      <div class="form-group">
                          <div class="input-group">
                             <span class="input-group-addon"><i class="fa fa-money"> P.V.</i></span> 
                             <input type="text" class="form-control input-xs" id="nPVenta" name="nPVenta" placeholder=" Precio Venta" onfocus=" obtieneFoco('#nPVenta')" onblur = "pierdeFoco('#nPVenta')" onkeypress="siguiente(event,'#nImpVenta')">
                          </div>
                      </div>    
                  </div><!--fin  item 2-->
                  <div class="col-xs-12 col-sm-3"> 
                      <!-- IMP VENTAS -->
                      <div class="form-group">
                          <div class="input-group">
                             <span class="input-group-addon"><i class="fa fa-money"> Imp V</i></span> 
                             <input type="text" class="form-control input-xs" id="nImpVenta" name="nImpVenta" placeholder=" Imp Venta" onfocus=" obtieneFoco('#nImpVenta')" onblur = "pierdeFoco('#nImpVenta')" onkeypress="siguiente(event,'#nPrecioIva')">
                          </div>
                      </div>
                  </div><!--fin  item 3-->
                  <div class="col-xs-12 col-sm-3"> 
                      <!-- IMP VENTAS -->
                      <div class="form-group">
                          <div class="input-group">
                             <span class="input-group-addon"><i class="fa fa-money"> Total</i></span> 
                             <input type="text" class="form-control input-xs" id="nPrecioIva" name="nPrecioIva" placeholder=" Precio Iva" onfocus=" obtieneFoco('#nPrecioIva')" onblur = "pierdeFoco('#nPrecioIva')" onkeypress="siguiente(event,'#nPVenta')">
                          </div>
                      </div>
                  </div><!--fin  item 4-->  
              </div> <!-- FIN QUINTA LINEA -->
              <hr> 
              <!--========================================================================== --> 
              <div class="row cLocal" > <!-- SEXTA LINEA DE ENTRADA -->
                  <div class="col-xs-12 col-sm-3"> 
                      <!-- PRECIO DE VENTA -->
                      <div class="form-group">
                          <div class="input-group">
                             <span class="input-group-addon input-xs"><b>Compra Local</b></span>
                          </div>
                      </div>
                  </div><!--fin  item 1-->  
                  <div class="col-xs-12 col-sm-3"> 
                      <!-- PRECIO DE VENTA -->
                      <div class="form-group">
                          <div class="input-group">
                             <span class="input-group-addon"><i class="fa fa-money"> Costo</i></span> 
                             <input type="text" class="form-control input-xs" id="nCostoLocal" name="nCostoLocal" placeholder=" Costo" onfocus=" obtieneFoco('#nCostoLocal')" onblur = "pierdeFoco('#nCostoLocal')" onkeypress="siguiente(event,'#nImpCompra')">
                          </div>  
                      </div>
                  </div><!--fin  item 2-->
                  <div class="col-xs-12 col-sm-3"> 
                      <!-- IMP VENTAS -->
                      <div class="form-group">
                          <div class="input-group">
                             <span class="input-group-addon"><i class="fa fa-money"> Imp C</i></span> 
                             <input type="text" class="form-control input-xs" id="nImpCompra" name="nImpCompra" placeholder=" Imp Compra" onfocus=" obtieneFoco('#nImpCompra')" onblur = "pierdeFoco('#nImpCompra')"  onkeypress="siguiente(event,'#nTCompra')" >
                          </div>
                      </div>
                  </div><!--fin  item 3-->
                  <div class="col-xs-12 col-sm-3"> 
                      <!-- IMP VENTAS -->
                      <div class="form-group">
                          <div class="input-group">
                             <span class="input-group-addon"><i class="fa fa-money"> Total</i></span> 
                             <input type="text" class="form-control input-xs" id="nTCompra" name="nTCompra" placeholder=" P.Compra" onfocus=" obtieneFoco('#nTCompra')" onblur = "pierdeFoco('#nTCompra')" onkeypress="siguiente(event,'#nCostoLocal')">
                          </div>
                      </div>
                  </div><!--fin  item 4-->  
              </div> <!-- FIN SEXTA LINEA -->
              <br>
              <!--========================================================================== --> 
              <div class="row cExterior" style="display: none"> <!-- SETIMA LINEA DE ENTRADA -->
                  <div class="col-xs-12 col-sm-3"> 
                      <!-- PRECIO DE VENTA -->
                      <div class="form-group">
                          <div class="input-group">
                             <span class="input-group-addon input-xs"><b>Compra Exterior</b></span>
                          </div>
                      </div>
                  </div><!--fin  item 1-->  
                  <div class="col-xs-12 col-sm-3"> 
                      <!-- PRECIO DE VENTA -->
                      <div class="form-group">
                          <div class="input-group">
                             <span class="input-group-addon"><i class="fa fa-money"> Tipo C.</i></span> 
                             <input type="text" class="form-control input-xs" id="nTCambio" name="nTCambio" placeholder=" TC $" onfocus=" obtieneFoco('#nTCambio')" onblur = "pierdeFoco('#nTCambio')" onkeypress="siguiente(event,'#nCostoUsa')">
                          </div>
                      </div>
                  </div><!--fin  item 2-->
                  <div class="col-xs-12 col-sm-3"> 
                      <!-- IMP VENTAS -->
                      <div class="form-group">
                          <div class="input-group">
                             <span class="input-group-addon"><i class="fa fa-money"> Costo</i></span> 
                             <input type="text" class="form-control input-xs" id="nCostoUsa" name="nCostoUsa" placeholder=" $ Costo" onfocus=" obtieneFoco('#nCostoUsa')" onblur = "pierdeFoco('#nCostoUsa')" onkeypress="siguiente(event,'#nCostoMia')">
                          </div>
                      </div>
                  </div><!--fin  item 3-->
                  <div class="col-xs-12 col-sm-3"> 
                        <!-- COSTO MIA -->
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-money"> Mia</i></span> 
                                <input type="text" class="form-control input-xs" id="nCostoMia" name="nCostoMia" placeholder="$ Costo Mia" onfocus=" obtieneFoco('#nCostoMia')" onblur = "pierdeFoco('#nCostoMia')" onkeypress="siguiente(event,'#nCostoUsa')">
                            </div>
                        </div>     
                  </div><!--fin  item 4-->  
                    
              </div> <!-- FIN SETIMA LINEA -->    
              <br>
              <!--========================================================================== --> 
              <div class="row cExterior" style="display: none"> <!-- NOVENA LINEA DE ENTRADA -->  
                    
                    <div class="col-xs-12 col-sm-4"> 
                      <!-- IMP VENTAS -->
                      <div class="form-group">
                          <div class="input-group">
                             <span class="input-group-addon"><i class="fa fa-money"> Total $</i></span> 
                             <input type="text" class="form-control input-xs" id="nTotalUsa" name="nTotalUsa" placeholder=" $ Total" readonly >
                          </div>
                      </div>
                    </div><!--fin  item 3-->
                    <div class="col-xs-12 col-sm-4"> 
                      <!-- IMP VENTAS -->
                      <div class="form-group">
                          <div class="input-group">
                             <span class="input-group-addon"><i class="fa fa-money"> Total ¢</i></span> 
                             <input type="text" class="form-control input-xs" id="nTotalCol" name="nTotalCol" placeholder=" ¢ Total" readonly>
                          </div>
                      </div>
                    </div><!--fin  item 4-->            
              </div> <!-- FIN NOVENA LINEA -->
           </div> <!-- Fin box modal Body -->

        </div>  <!-- Fin modal Body -->

     
        <!--=====================================
        PIE DEL MODAL
        ======================================-->    
        <div class="modal-footer">
          <div class="row"> <!-- CUARTA LINEA DE ENTRADA -->
              <div class="col-xs-11 col-sm-2">
                <button type="button" class="btn btn-warning pull-left" data-dismiss="modal">
                  <i class="fa fa-mail-reply">   
                     Regresar ..
                  </i> 
                </button> 
              </div><!--fin item 1-->
             
              <div class="col-xs-12 col-sm-10">
                <button type="submit" class="btn btn-primary pull-right">
                  <i class="fa fa-save">
                    Guardar Linea
                  </i> 
                </button>      
              </div><!--fin item 3-->  
            </div> <!-- FIN CUARTA LINEA -->  
         </div>
      
      </form>    

        <?php  
          $crearLinea = new ControladorLineas();
          $crearLinea -> ctrCrearLinea();
        ?>        
    </div> <!-- FIN CLASS MODEL CONTENT -->

  </div> <!-- FIN MODAL DIALOG -->

</div> <!-- FIN MODAL AGREGAR LINEAS -->
  
<!--=====================================
MODAL EDITAR LINEAS
======================================-->
<div id="modalEditarLinea" class="modal fade" role="dialog">

  <div class="modal-dialog" style="width: 80% !important;">

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
                    
              <!--========================================================================== --> 
              <div class="row"> <!-- PRIMERA LINEA DE ENTRADA -->
                 <div class="col-xs-12 col-sm-3"> 
                      <!-- NUMERO ORDEN -->
                      <div class="form-group">
                          <div class="input-group">      
                             <span class="input-group-addon"><i class="fa fa-cog"> Orden</i></span>
                             <input type="hidden" id="eId" name="eId">
                             <input type="hidden" id="eMontoAnte" name="eMontoAnte">
                             <input type="hidden" id="eCostoAnte" name="eCostoAnte"> 
                             <input type="text" class="form-control input-xs" id="eOrden" name="eOrden" readonly>
                          </div>
                      </div>
                  </div><!--fin  item 1-->
                  <div class="col-xs-12 col-sm-3"> 
                      <!-- NUMERO DE PARTE -->
                      <div class="form-group">
                          <div class="input-group">
                             <span class="input-group-addon"><i class="fa fa-cog"></i></span> 
                             <input type="text" class="form-control input-xs" id="eParte" name="eParte" placeholder="# Parte" onfocus=" obtieneFoco('#eParte')" onblur = "pierdeFoco('#eParte')" onkeypress="siguiente(event,'#eCompra')" >
                          </div>
                      </div>
                  </div><!--fin  item 2-->
                  <div class="col-xs-12 col-sm-3"> 
                      <!-- TIPO COMPRA-->
                      <div class="form-group">
                          <div class="input-group">
                              <span class="input-group-addon"><i class="fa fa-file"> Compra</i></span>
                              <select class= "form-control input-xs" name="eCompra" id="eCompra">
                                 <option value="LOCAL">LOCAL</option>
                                 <option value="INVENTARIO">INVENTARIO</option>
                                 <option value="EXTERNA">EXTERNA</option>
                              </select>     
                          </div>
                      </div>
                  </div><!--fin  item3-->  
                  <div class="cInventario col-xs-12 col-sm-3" style ="display: none"> 
                      <!-- SELECION INVENTARIO-->
                      <div class="form-group">
                          <div class="input-group">
                             <span class="input-group-addon"><i class="fa fa-building"></i></span>
                             <input type="text" class="form-control input-xs" id="eArticulo" name="eArticulo" placeholder="Artículo" readonly
                             <span class="input-group-addon"><input type="button"  class="btn btn-xs btn-success btnBucaArticulo" data-toggle="modal" data-target="#modalBuscaArticulo" value="Buscar"></span>  
                          </div>
                      </div>
                  </div><!--fin item 4-->                     
              </div> <!-- FIN PRIMERA LINEA -->
              <br>
              <!--========================================================================== --> 
              <div class="row cExterior" style="display: none"> <!-- SEGUNDA LINEA DE ENTRADA -->
                 <div class="col-xs-12 col-sm-3"> 
                      <!-- NUMERO DE MIA -->
                      <div class="form-group">
                          <div class="input-group">
                             <span class="input-group-addon"><i class="fa fa-barcode"></i></span> 
                             <input type="text" class="form-control input-xs" id="eMia" name="eMia" placeholder="# Mia" onfocus=" obtieneFoco('#eMia')" onblur = "pierdeFoco('#eMia')" onkeypress="siguiente(event,'#eRuta')">
                          </div>
                      </div>    
                  </div><!--fin  item 3--> 
                  <div class="col-xs-12 col-sm-9"> 
                      <!-- NUMERO ORDEN -->
                      <div class="form-group">
                          <div class="input-group">      
                             <span class="input-group-addon"><i class="fa fa-file"> Ruta</i></span>
                             <input type="text" class="form-control input-xs" id="eRuta" name="eRuta" placeholder="Dirección Web" onfocus=" obtieneFoco('#eRuta')" onblur = "pierdeFoco('#eRuta')" onkeypress="siguiente(event,'#eDescri')">
                          </div>
                      </div>
                  </div><!--fin  item 1-->
                  
              </div> <!-- FIN SEGUNDA LINEA -->
              <br>   
              <!--========================================================================== --> 
              <div class="row"> <!-- TERCERA LINEA DE ENTRADA -->
                 <div class="col-xs-12 col-sm-4"> 
                      <!-- DESCRIPCION -->
                      <div class="form-group">
                          <div class="input-group">
                             <span class="input-group-addon"><i class="fa fa-comment"></i></span> 
                             <input type="text" class="form-control input-xs" id="eDescri" name="eDescri" placeholder="Descripción" onfocus=" obtieneFoco('#eDescri')" onblur = "pierdeFoco('#eDescri')" onkeypress="siguiente(event,'#eFactura')">
                          </div>
                      </div>
                  </div><!--fin  item 1-->
                  <div class="col-xs-12 col-sm-2"> 
                      <!-- NUMERO DE FACTURA -->
                      <div class="form-group">   
                          <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-file"></i></span> 
                            <input type="text" class="form-control input-xs" id="eFactura" name="eFactura" placeholder="Factura" onfocus=" obtieneFoco('#eFactura')" onblur = "pierdeFoco('#eFactura')" onkeypress="siguiente(event,'#eFecha')">
                          </div>
                      </div>
                   </div><!--fin  item 2-->
                   <div class="col-xs-12 col-sm-3"> 
                      <!-- NUMERO DE FACTURA -->
                      <div class="form-group">
                          <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-calendar"> Fecha</i></span> 
                            <input type="date" class="form-control input-xs" id="eFecha" name="eFecha">
                          </div>
                      </div>
                   </div><!--fin  item 3-->
                   <div class="col-xs-12 col-sm-3"> 
                      <!-- NUMERO DE FACTURA -->
                      <div class="form-group">
                          <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-file"> Estado</i></span> 
                            <select class= "form-control input-xs" name="eEstado" id="eEstado">
                                 <option value="En Proceso">En Proceso</option>
                                 <option value="Entregado">Entregado</option>
                                 <option value="Pagado">Pagado</option>
                            </select> 
                          </div>   
                      </div>
                   </div><!--fin  item 4--> 

              </div> <!-- FIN TERCERA LINEA -->
              <br>
              <!--========================================================================== --> 
              <div class="row"> <!-- CUARTA LINEA DE ENTRADA -->
                 <div class="col-xs-12 col-sm-4"> 
                      <!-- FECHA PRESENTACION -->
                      <div class="form-group">
                          <div class="input-group">
                             <span class="input-group-addon"><i class="fa fa-calendar"> Precentación</i></span>  
                             <input type="date" class="form-control input-xs" id="ePresenta" name="ePresenta">  
                          </div>
                      </div>
                  </div><!--fin  item 1-->
                  <div class="col-xs-12 col-sm-4"> 
                      <!-- FECHA VENCIMIENTO -->
                      <div class="form-group">
                          <div class="input-group">
                             <span class="input-group-addon"><i class="fa fa-calendar"> Vencimiento</i></span>  
                             <input type="date" class="form-control input-xs" id="eVencimiento" name="eVencimiento">
                          </div>
                      </div>
                   </div><!--fin  item 2-->
                   <div class="col-xs-12 col-sm-4"> 
                      <!-- TIPO COMPRA-->
                      <div class="form-group">
                          <div class="input-group">
                              <span class="input-group-addon"><i class="fa fa-file"> Tipo</i></span>
                              <select class= "form-control input-xs" name="eTipo" id="eTipo">
                                 <option value="ORIGINAL">ORIGINAL</option>
                                 <option value="USADO">USADO</option>
                                 <option value="GENERICO">GENERICO</option>
                              </select>     
                          </div>
                      </div>
                  </div><!--fin  item 4-->
              

              </div> <!-- FIN CUARTA LINEA -->
              <hr>
              <!--========================================================================== --> 
              <div class="row"> <!-- QUINTA LINEA DE ENTRADA -->
                 <div class="col-xs-12 col-sm-3"> 
                      <!-- CANTIDAD VENTAS -->
                      <div class="form-group">
                          <div class="input-group">
                             <span class="input-group-addon"><i class="fa fa-calculator"> Cantidad</i></span> 
                             <input type="number" class="form-control input-xs" id="eCantidad" name="eCantidad" placeholder="Cant.V" onfocus=" obtieneFoco('#eCantidad')" onblur = "pierdeFoco('#eCantidad')" value = 1>
                          </div>
                      </div>
                  </div><!--fin  item 1-->   
                  <div class="col-xs-12 col-sm-3"> 
                      <!-- PRECIO DE VENTA -->
                      <div class="form-group">
                          <div class="input-group">
                             <span class="input-group-addon"><i class="fa fa-money"> P.V.</i></span> 
                             <input type="text" class="form-control input-xs" id="ePVenta" name="ePVenta" placeholder=" Precio Venta" onfocus=" obtieneFoco('#ePVenta')" onblur = "pierdeFoco('#ePVenta')" onkeypress="siguiente(event,'#eImpVenta')">
                          </div>
                      </div>
                  </div><!--fin  item 2-->
                  <div class="col-xs-12 col-sm-3"> 
                      <!-- IMP VENTAS -->
                      <div class="form-group">
                          <div class="input-group">
                             <span class="input-group-addon"><i class="fa fa-money"> Imp V</i></span> 
                             <input type="text" class="form-control input-xs" id="eImpVenta" name="eImpVenta" placeholder=" Imp Venta" onfocus=" obtieneFoco('#eImpVenta')" onblur = "pierdeFoco('#eImpVenta')" onkeypress="siguiente(event,'#ePrecioIva')">
                          </div>
                      </div>    
                  </div><!--fin  item 3-->
                  <div class="col-xs-12 col-sm-3"> 
                      <!-- IMP VENTAS -->
                      <div class="form-group">
                          <div class="input-group">
                             <span class="input-group-addon"><i class="fa fa-money"> Total</i></span> 
                             <input type="text" class="form-control input-xs" id="ePrecioIva" name="ePrecioIva" placeholder=" Precio Iva" onfocus =" obtieneFoco('#ePrecioIva')" onblur = "pierdeFoco('#ePrecioIva')" onkeypress="siguiente(event,'#ePVenta')">
                          </div>
                      </div>
                  </div><!--fin  item 4-->  
              </div> <!-- FIN QUINTA LINEA -->
              <hr> 
              <!--========================================================================== --> 
              <div class="row cLocal" > <!-- SEXTA LINEA DE ENTRADA -->
                  <div class="col-xs-12 col-sm-3"> 
                      <!-- PRECIO DE VENTA -->
                      <div class="form-group">
                          <div class="input-group">
                             <span class="input-group-addon input-xs"><b>Compra Local</b></span>
                          </div>
                      </div>
                  </div><!--fin  item 1-->  
                  <div class="col-xs-12 col-sm-3"> 
                      <!-- PRECIO DE VENTA -->
                      <div class="form-group">
                          <div class="input-group">
                             <span class="input-group-addon"><i class="fa fa-money"> Costo</i></span> 
                             <input type="text" class="form-control input-xs" id="eCostoLocal" name="eCostoLocal" placeholder=" Costo" onfocus=" obtieneFoco('#eCostoLocal')" onblur = "pierdeFoco('#eCostoLocal')" onkeypress="siguiente(event,'#eImpCompra')">
                          </div>  
                      </div>
                  </div><!--fin  item 2-->
                  <div class="col-xs-12 col-sm-3"> 
                      <!-- IMP VENTAS -->
                      <div class="form-group">
                          <div class="input-group">
                             <span class="input-group-addon"><i class="fa fa-money"> Imp C</i></span> 
                             <input type="text" class="form-control input-xs" id="eImpCompra" name="eImpCompra" placeholder=" Imp Compra" onfocus=" obtieneFoco('#eImpCompra')" onblur = "pierdeFoco('#eImpCompra')"  onkeypress="siguiente(event,'#eTCompra')">
                          </div>
                      </div>
                  </div><!--fin  item 3-->
                  <div class="col-xs-12 col-sm-3"> 
                      <!-- IMP VENTAS -->
                      <div class="form-group">
                          <div class="input-group">
                             <span class="input-group-addon"><i class="fa fa-money"> Total</i></span> 
                             <input type="text" class="form-control input-xs" id="eTCompra" name="eTCompra" placeholder=" P.Compra" onfocus=" obtieneFoco('#eTCompra')" onblur = "pierdeFoco('#eTCompra')" onkeypress="siguiente(event,'#eCostoLocal')">
                          </div>
                      </div>
                  </div><!--fin  item 4-->  
              </div> <!-- FIN SEXTA LINEA -->
              <br>
              <!--========================================================================== --> 
              <div class="row cExterior" style="display: none"> <!-- SETIMA LINEA DE ENTRADA -->
                  <div class="col-xs-12 col-sm-3"> 
                      <!-- PRECIO DE VENTA -->
                      <div class="form-group">
                          <div class="input-group">
                             <span class="input-group-addon input-xs"><b>Compra Exterior</b></span>
                          </div>
                      </div>
                  </div><!--fin  item 1-->  
                  <div class="col-xs-12 col-sm-3"> 
                      <!-- PRECIO DE VENTA -->
                      <div class="form-group">
                          <div class="input-group">
                             <span class="input-group-addon"><i class="fa fa-money"> Tipo C.</i></span> 
                             <input type="text" class="form-control input-xs" id="eTCambio" name="eTCambio" placeholder=" TC $" onfocus=" obtieneFoco('#eTCambio')" onblur = "pierdeFoco('#eTCambio')" onkeypress="siguiente(event,'#eCostoUsa')">
                          </div>
                      </div>
                  </div><!--fin  item 2-->
                  <div class="col-xs-12 col-sm-3"> 
                      <!-- IMP VENTAS -->
                      <div class="form-group">
                          <div class="input-group">
                             <span class="input-group-addon"><i class="fa fa-money"> Costo</i></span> 
                             <input type="text" class="form-control input-xs" id="eCostoUsa" name="eCostoUsa" placeholder=" $ Costo" onfocus=" obtieneFoco('#eCostoUsa')" onblur = "pierdeFoco('#eCostoUsa')" onkeypress="siguiente(event,'#eImpImporta')">
                          </div>
                      </div>
                  </div><!--fin  item 3-->
                  <div class="col-xs-12 col-sm-3"> 
                        <!-- COSTO MIA -->
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon">Costo Mia</span> 
                                <input type="text" class="form-control input-xs" id="eCostoMia" name="eCostoMia" placeholder="$ Costo Mia" onfocus=" obtieneFoco('#eCostoMia')" onblur = "pierdeFoco('#eCostoMia')" onkeypress="siguiente(event,'#nCostoUsa')">
                            </div>
                        </div>     
                    </div><!--fin  item 4-->
             
                </div> <!-- FIN SETIMA LINEA -->    
              <br>
              <!--========================================================================== --> 
              <div class="row cExterior" style="display: none"> <!-- NOVENA LINEA DE ENTRADA -->
                    <div class="col-xs-12 col-sm-4"> 
                      <!-- IMP VENTAS -->
                      <div class="form-group">
                          <div class="input-group">
                             <span class="input-group-addon"><i class="fa fa-money"> Total $</i></span> 
                             <input type="text" class="form-control input-xs" id="eTotalUsa" name="eTotalUsa" placeholder=" $ Total" readonly >
                          </div>
                      </div>
                    </div><!--fin  item 3-->
                    <div class="col-xs-12 col-sm-4"> 
                      <!-- IMP VENTAS -->
                      <div class="form-group">
                          <div class="input-group">
                             <span class="input-group-addon"><i class="fa fa-money"> Total ¢</i></span> 
                             <input type="text" class="form-control input-xs" id="eTotalCol" name="eTotalCol" placeholder=" ¢ Total" readonly>
                          </div>
                      </div>
                    </div><!--fin  item 4-->           
              </div> <!-- FIN NOVENA LINEA -->              
           
           </div> <!-- Fin box modal Body -->
      </div>  <!-- Fin modal Body -->


        <!--=====================================
        PIE DEL MODAL
        ======================================-->    
        <div class="modal-footer">
          <div class="row"> <!-- CUARTA LINEA DE ENTRADA -->
              <div class="col-xs-11 col-sm-2">
                <button type="button" class="btn btn-info btn-lg pull-left" data-dismiss="modal">Regresar ..</button> 
              </div><!--fin item 1-->
             
              <div class="col-xs-12 col-sm-2">
                <button type="submit" class="btn btn-lg btn-primary">Actualizar Linea</button>      
              </div><!--fin item 3-->  
            </div> <!-- FIN CUARTA LINEA -->  
         </div>
      
      </form>    
       
        <?php  
           $editarLinea = new ControladorLineas();
           $editarLinea -> ctrEditarLineas();
        ?>        
    </div> <!-- FIN CLASS MODEL CONTENT -->

  </div> <!-- FIN MODAL DIALOG -->

</div> <!-- FIN MODAL EDITAR LINEAS -->

 <!--=====================================
MODAL BUSCAR ARTICULO
======================================-->
<div id="modalBuscaArticulo" class="modal fade" role="dialog">
  <div class="modal-dialog" style="width: 45% !important;">
    <div class="modal-content">
      <div class="modal-header" style="background:#3c8dbc; color:white"> 
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Buscar Artículo</h4>
      </div> <!-- fin div modal-header -->
      
      <div class="modal-body" style="background: cyan;">
        <table class="table table-bordered table-condensed table-striped dt-responsive tablaBuscaArticulo" width="100%"> 
          <thead>
            <tr>
               <th style="width:10px">#</th>
               <th>Artículo</th>
               <th style="width:90px">Costo</th>
               <th>Stock</th>
               <th>Cantidad</th>
               <th>Acciones</th>
            </tr> 
          </thead>  
          <tbody>
              <?php
                  $item = null;    
                  $valor = null; 
                     
                  $clientes = ControladorProductos::ctrMostrarProductos($item, $valor);
                    
                  foreach ($clientes as $key => $value) {
                        $cant = 1;
                        $cantidad = "<input type='number' style='background:#00FFFF; width:60px; color:blue;' class= 'input-xs btnCantidad' value='".$cant."'>";

                        $costo = number_format($value["costoCol"], 2, '.', ','); 
                        echo ' <tr>
                           <td>'.($key+1).'</td>
                           <td>'.$value["descripcion"].'</td>
                           <td style="text-align: right;">'.$costo.'</td>
                           <td>'.$value["stock"].'</td>
                           <td>'.$cantidad.'</td>   
                           <td>
                              <div class="btn-group">
                                 <button class="btn btn-xs btn-warning btnAgregarArticulo" nCantidad = "'.$cantidad.'" nCodigo= "'.$value["parte"].'" nVenta= "'.$value["costoCol"].'" nArticulo="'.$value["descripcion"].'" data-dismiss="modal" ><i class="fa fa-check"> Agregar</i></button>      
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
</div> <!-- fin ventana modalBuscarArticulo -->  

<?php
     
  $borrarLinea = new ControladorLineas();
  $borrarLinea -> ctrBorrarLinea();

?>  

   