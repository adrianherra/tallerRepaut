<div class="content-wrapper">

  <section class="content-header">
    <h1>Dima Old</h1>
         
    <ol class="breadcrumb">
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      <li class="active">Dima Old</li>
    </ol>
   
  </section> <!--Fin content-header -->

  <section class="content">
          
    <div class="box">                
         
      <div class="box-header with-border">
         <button class="btn btn-primary pull-left" data-toggle="modal" data-target="#modalAgregarOrden">
            <i class="fa fa-plus">
             Agregar orden
            </i> 
         </button>
         <button class="btn btn-danger pull-right" data-toggle="modal" data-target="#modalReportesOrden">
            <i class="fa fa-print">
             Reportes
            </i> 
         </button>
         <form id = "pasarOld" action="lineasDima" method="post">
             <input type="hidden" id="verLineas" name="idOrden" value="" />
         </form>  
                      
                   
      </div>
          
      <div class="box-body">
         <table class="table table-bordered table-striped table-condensed dt-responsive tablaOrdenes" width="100%">
              <thead>
                 <tr> 
                    <th style="width:10px; font-size: x-small;">#</th>
                    <th style="width:80px; font-size: x-small;">Orden</th>
                    <th style="width:70px; font-size: x-small;">Aseguradora</th>
                    <th style="width:60px; font-size: x-small;">F. Orden</th>
                    <th style="font-size: x-small;">Placa</th>
                    <th style="font-size: x-small;">Marca</th>
                    <th style="font-size: x-small;">Plazo</th>
                    <th style="font-size: x-small;">Monto</th>
                    <th style="font-size: x-small;">Costo</th>
                    <th style="font-size: x-small;">Utilidad</th>
                    <th style="font-size: x-small;">% Utl</th>
                    <th style="font-size: x-small;">Saldo</th>
                    <th style="font-size: x-small;">Estado</th>
                    <th style="width:120px; font-size: x-small;">Acciones</th>
                 </tr> 
              </thead>
              <tbody>
                 
                  <?php   
                     
                      $item = null;
                      $valor = null;  

                      $ordenes = ControladorOrdenesDima::ctrMostrarOrdenes($item, $valor);
   
                      foreach ($ordenes as $key => $value) {
                                  
                        $orden = "<button class='btn btn-warning btnVerDetalleOld btn-xs' vIdOrden = '".$value["id"]."'  >".$value["orden"]."</button>";
                           
                        $venta = $value["montoOrden"];
                        $costo = $value["costoOrden"];
                        $utilidad = $venta - $costo;

                        if (($costo != 0) && ($utilidad != 0)) { 
                           $porUtl = ($utilidad / $costo) * 100;
                        } else { 
                           $porUtl = 0;
                        }// fin if
                        $tipo = $value["estado"];  
                        $costo =  number_format($costo, 2, '.', '');
                        $venta =  number_format($venta, 2, '.', '');
                        $utilidad = number_format($utilidad, 2, '.', '');  
                        $porUtl = number_format($porUtl, 2, '.', '');
                              
                                  
                        if ($tipo == "Sin Lineas")
                          $estado = "<button class='btn btn-danger btn-xs' >".$tipo."</button>"; 
                        if ($tipo == "En Proceso")
                           $estado = "<button class='btn btn-primary btn-xs' >".$tipo."</button>";
                        if ($tipo == "Entregado")
                           $estado = "<button class='btn btn-warning btn-xs' >".$tipo."</button>";
                        
                        if ($tipo == "Pagado") { 
                           $estado = "<button class='btn btn-info btn-xs' >".$tipo."</button>";
                           $saldo = 0;      
                        }else {
                           $saldo = $value["saldo"];
                        } // fin if
                        $saldo = number_format($saldo, 2, '.', '');
        
                        echo ' <tr>
                           <td style="font-size: x-small;">'.($key+1).'</td>
                           <td style="font-size: x-small;">'.$orden.'</td>
                           <td style="font-size: x-small;">'.$value["aseguradora"].'</td>
                           <td style="font-size: x-small;">'.$value["fechaOrden"].'</td> 
                           <td style="font-size: x-small;">'.$value["placa"].'</td>
                           <td style="font-size: x-small;">'.$value["marca"].'</td>
                           <td style="font-size: x-small;">'.$value["plazo"].'</td>
                           <td style="font-size: x-small;">'.$venta.'</td> 
                           <td style="font-size: x-small;">'.$costo.'</td>
                           <td style="font-size: x-small;">'.$utilidad.'</td>
                           <td style="font-size: x-small;">'.$porUtl.'</td>
                           <td style="font-size: x-small;">'.$saldo.'</td>    
                           <td style="font-size: x-small;">'.$estado.'</td>    
                           <td>
                              <div class="btn-group">';
                                if($_SESSION["perfil"] == "Administrador"){
                                  echo '<button class="btn btn-warning btn-xs btnEditarOrden" idOrden="'.$value["id"].'" data-toggle="modal" data-target="#modalEditarOrden"><i class="fa fa-pencil"></i></button>
                                  <button class="btn btn-danger btn-xs btnEliminarOrden" idOrden="'.$value["id"].'"> <i class="fa fa-times"></i></button>';
                                } // fin if
                                echo '<button data-toggle="modal" data-target="#modalVerOrdenes" class="btn btn-primary btn-xs btnVerOrdenes" idOrden="'.$value["id"].'"><i class="fa fa-eye"></i></button>
                                
                               </div>  
                           </td>
                       </tr>';
                     } // fin for
                  
                  ?>
            </tbody>
            <tfoot style="color:#FF00FF;">
              <tr>
                  <th colspan="7" style="text-align:center;">Totales :</th>
                  <th></th>
                  <th></th>
                  <th></th> 
                  <th></th>
                  <th></th>
                  <th colspan="2"></th>
              </tr>
            </tfoot>    
        </table> <!--Fin table -->

      </div> <!--Fin div box-body -->

    </div> <!--Fin div box -->
    
  </section> <!--Fin section Content -->

</div> <!--Fin Class Content Wrapper -->  
        

<!--=====================================
MODAL AGREGAR ORDEN
======================================-->
<div id="modalAgregarOrden" class="modal fade" role="dialog">
  <div class="modal-dialog" style="width: 80% !important;">
    <div class="modal-content">
      <form role="form" method="post" enctype="multipart/form-data" onKeypress="if(event.keyCode == 13) event.returnValue = false;">
        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->
        <div class="modal-header" style="background:#3c8dbc; color:white">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Agregar orden</h4>
        </div>      
        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->
        <div class="modal-body">
           <div class="box-body">
             
             <!--========================================================================== --> 
              <div class="row"> <!-- PRIMERA LINEA DE ENTRADA -->
                 <div class="col-xs-12 col-sm-2"> 
                      <!-- ENTRADA PARA EL NOMBRE -->
                      <div class="form-group">
                          <div class="input-group">    
                             <span class="input-group-addon"><i class="fa fa-file"></i></span> 
                             <input type="text" class="form-control input-xs" id="nuevaOrden" name="nuevaOrden" placeholder="# Orden" onfocus=" obtieneFoco('#nuevaOrden')" onblur = "pierdeFoco('#nuevaOrden')" onkeypress="siguiente(event,'#nuevaAseguradora')" required>
                          </div>
                      </div>
                  </div><!--fin  item 1-->
   
                  <div class="col-xs-12 col-sm-3">
                      <!-- ENTRADA PARA ASEGURADORA -->
                      <div class="form-group">
                         <div class="input-group">
                             <span class="input-group-addon"><i class="fa fa-file"> Aseguradora</i></span>
                             <select class= "form-control input-xs" name="nuevaAseguradora" id="nuevaAseguradora" >
                                 <option value="Mapfre">Mapfre</option>
                                 <option value="INS">Ins</option>
                                 <option value="Qualitas">Qualitas</option>
                                 <option value="Lafise">Lafise</option>
                                 <option value="Oceanica">Oceanica</option>
                                 <option value="Assa">Assa</option>
                                 <option value="Repaut">Repaut</option>
                                 <option value="Otros">Otros</option>
                             </select>
                          </div>
                      </div>
                   </div><!--fin  item 2-->   
                    
                    <div class="col-xs-12 col-sm-4"> 
                      <!-- ENTRADA PARA EL TALLER -->
                      <div class="form-group">
                          <div class="input-group">
                             <span class="input-group-addon"><i class="fa fa-building"></i></span>
                             <input type="text" class="form-control input-xs" id="nuevoTaller" name="nuevoTaller" placeholder="Taller" readonly>
                             <span class="input-group-addon"><input type="button"  class="btn btn-xs btn-success btnBucarTaller" data-toggle="modal" data-target="#modalBuscarTaller" value="Buscar"></span>  
      
                          </div>
                      </div>
                    </div><!--fin  item 3-->
                     
                    <div class="col-xs-12 col-sm-3">
                       <!-- ENTRADA PARA FECHA ORDEN -->
                       <div class="input-group">
                         <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                         <input type="date" class="form-control input-xs" name="nuevaFecha" id="nuevaFecha" onkeypress="siguiente(event,'#nuevaPlaca')">
                       </div>
                     </div><!--fin  item 4-->

              </div> <!-- Fin Linea 1 --> 
              <br>
              <!--========================================================================== -->
              <div class="row"> <!-- SEGUNDA LINEA DE ENTRADA -->
                 <div class="col-xs-12 col-sm-2"> 
                      <!-- ENTRADA PARA EL PLACA-->
                      <div class="form-group">
                          <div class="input-group">
                             <span class="input-group-addon"><i class="fa fa-car"></i></span> 
                             <input type="text" class="form-control input-xs" id="nuevaPlaca" name="nuevaPlaca" placeholder="# Placa" onfocus=" obtieneFoco('#nuevaPlaca')" onblur = "pierdeFoco('#nuevaPlaca')" onkeypress="siguiente(event,'#nuevaMarca')">
                          </div>
                      </div>
                  </div> <!--fin  item 1-->
          
                  <div class="col-xs-12 col-sm-3">
                      <!-- ENTRADA PARA LA MARCA -->
                      <div class="form-group">
                         <div class="input-group">
                             <span class="input-group-addon"><i class="fa fa-car"></i></span> 
                             <input type="text" class="form-control input-xs" name="nuevaMarca" id="nuevaMarca" placeholder="Marca" onfocus=" obtieneFoco('#nuevaMarca')" onblur = "pierdeFoco('#nuevaMarca')" onkeypress="siguiente(event,'#nuevoModelo')">
                         </div>
                      </div>
                  </div><!--fin  item 2-->
                  
                  <div class="col-xs-12 col-sm-3">
                      <!-- ENTRADA PARA LA MODELO -->
                      <div class="form-group">
                         <div class="input-group">
                             <span class="input-group-addon"><i class="fa fa-car"></i></span> 
                             <input type="text" class="form-control input-xs" name="nuevoModelo" id="nuevoModelo" placeholder="Modelo" onfocus=" obtieneFoco('#nuevoModelo')" onblur = "pierdeFoco('#nuevoModelo')" onkeypress="siguiente(event,'#nuevoAno')">
                         </div>
                      </div>
                  </div><!--fin  item 3-->

                  <div class="col-xs-12 col-sm-2">
                      <!-- ENTRADA PARA LA AÑO -->
                      <div class="form-group">
                         <div class="input-group">
                             <span class="input-group-addon"><i class="fa fa-file"></i></span> 
                             <input type="number" class="form-control input-xs" name="nuevoAno" id="nuevoAno" placeholder="Año" onfocus=" obtieneFoco('#nuevoAno')" onblur = "pierdeFoco('#nuevoAno')" onkeypress="siguiente(event,'#nuevoPlazo')" >
                         </div>
                      </div>
                  </div><!--fin  item 4-->                 
                    
                  <div class="col-xs-12 col-sm-2">
                      <!-- ENTRADA PARA LA PLAZO -->
                      <div class="form-group">
                         <div class="input-group">
                              <span class="input-group-addon"><i class="fa fa-file"></i></span> 
                              <input type="number" class="form-control input-xs" name="nuevoPlazo" id="nuevoPlazo" placeholder="Plazo" onfocus=" obtieneFoco('#nuevoPlazo')" onblur = "pierdeFoco('#nuevoPlazo')" onkeypress="siguiente(event,'#nuevoSiniestro')" >
                         </div>
                      </div>
                  </div> <!--fin  item 5--> 
              </div> <!-- FIN SEGUNDA LINEA -->
              <br>
              <!--========================================================================== -->
              <div class="row"> <!-- TERCERA LINEA DE ENTRADA -->
                 <div class="col-xs-12 col-sm-2">
                    <!-- ENTRADA SINIESTRO-->
                    <div class="input-group">
                       <span class="input-group-addon"><i class="fa fa-flash"></i></span>
                       <input type="text" class="form-control input-xs" name="nuevoSiniestro" id="nuevoSiniestro"  placeholder="Siniestro" onfocus=" obtieneFoco('#nuevoSiniestro')" onblur = "pierdeFoco('#nuevoSiniestro')" onkeypress="siguiente(event,'#nuevaFVenc')" >
                    </div>
                 </div><!--fin  item 1-->
                 <div class="col-xs-12 col-sm-4">
                    <!-- ENTRADA PARA FECHA VENCIMIENTO-->
                    <div class="input-group">
                       <span class="input-group-addon"><i class="fa fa-calendar"> Vencimiento</i></span>
                       <input type="date" class="form-control input-xs" name="nuevaFVenc" id="nuevaFVenc" onkeypress="siguiente(event,'#nuevaObserva')">
                    </div>
                 </div><!--fin  item 2--> 
                 <div class="col-xs-12 col-sm-6"> 
                      <!-- ENTRADA PARA EL OBSERVACIONES-->
                      <div class="form-group">
                          <div class="input-group">
                             <span class="input-group-addon"><i class="fa fa-file"></i></span> 
                             <input type="text" class="form-control input-xs" id="nuevaObserva" name="nuevaObserva"  placeholder="Observaciónes" onfocus=" obtieneFoco('#nuevaObserva')" onblur = "pierdeFoco('#nuevaObserva')" >
                          </div>
                      </div>    
                  </div><!--fin  item 3-->
              </div> <!-- FIN TERCERA LINEA -->        
              <!--========================================================================== -->
              <div class="row"> <!-- CUARTA LINEA DE ENTRADA -->
                 <div class="col-xs-12 col-sm-2"> 
                      <!-- ENTRADA PARA PDF 1-->
                      <div class="divFile">
                         <span class="texto">Subir Orden</span>
                         <input class="btnFile" type="file" class="nuevoPdf1" name="nuevoPdf1">
                      </div>
                 </div><!--fin  item 1-->
                 <div class="col-xs-12 col-sm-2"> 
                      <!-- ENTRADA PARA PDF 2-->
                      <div class="divFile">
                         <span class="texto">Subir Factura 1</span>
                         <input class="btnFile" type="file" class="nuevoPdf2" name="nuevoPdf2">
                      </div>
                 </div><!--fin  item 2--> 
                 <div class="col-xs-12 col-sm-2"> 
                      <!-- ENTRADA PARA PDF 3-->
                      <div class="divFile">
                         <span class="texto">Subir Factura 2</span>
                         <input class= "btnFile" type="file" class="nuevoPdf3" name="nuevoPdf3">
                      </div>
                 </div><!--fin  item 3--> 
                 <div class="col-xs-12 col-sm-2"> 
                      <!-- ENTRADA PARA PDF 4-->
                      <div class="divFile">
                         <span class="texto">Subir Factura 3</span>
                         <input class="btnFile" type="file" class="nuevoPdf4" name="nuevoPdf4">
                      </div>
                 </div><!--fin  item 1--> 
                 <div class="col-xs-12 col-sm-2"> 
                      <!-- ENTRADA PARA PDF 5-->
                      <div class="divFile">
                         <span class="texto">Subir Factura 4</span>
                         <input class="btnFile" type="file" class="nuevoPdf5" name="nuevoPdf5">
                      </div>
                 </div><!--fin  item 2-->  

              </div> <!-- FIN CUARTA LINEA -->
              
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
             
              <div class="col-xs-1 col-sm-8">
              </div><!--fin item 2-->
         
              <div class="col-xs-12 col-sm-2">
                <button type="submit" class="btn btn-primary">
                   <i class="fa fa-save">
                      Guardar Orden
                   </i> 
                 </button> 
              </div><!--fin item 3-->  
            </div> <!-- FIN CUARTA LINEA -->  
         </div>
      </form>     
        <?php  
          $crearOrden = new ControladorOrdenesDima();
          $crearOrden -> ctrCrearOrden();
        ?>  
    </div> <!-- FIN CLASS MODEL CONTENT -->
  </div> <!-- FIN MODAL DIALOG -->
</div> <!-- FIN MODAL AGREGAR ORDEN -->
    
<!--=====================================
MODAL VER PDFS
======================================-->
<div id="modalVerOrdenes" class="modal fade" role="dialog">
  <div class="modal-dialog" style="width: 80% !important;">
    <div class="modal-content">
        <!-- Cabeza del Modal -->

        <div class="modal-header" style="background:#3c8dbc; color:white"> 
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Ver Pdf's</h4>
        </div> <!-- fin div modal-header -->
                
        <!-- Cuerpo del Modal -->
        <div class="modal-body" style="background: cyan;">
            <div class="row"> <!-- PRIMERA LINEA DE ENTRADA -->
            
              <div class="col-xs-1 col-sm-5">
                 <div class="form-group">
                    <div class="input-group"> 
                        <span class="input-group-addon"><i class="fa fa-file"> Archivo PDF</i></span>
                        <select class= "form-control input-xs" name="verPdf" id="verPdf">
                             <option value="pdf1">Orden Compra</option>
                             <option value="pdf2">Factura 1</option>
                             <option value="pdf3">Factura 2</option>
                             <option value="pdf4">Factura 3</option>
                             <option value="pdf5">Factura 4</option>  
                        </select>
                    </div>  
                 </div>
              </div><!--fin item 1-->
               
            </div> <!-- FIN PRIMERA LINEA -->  
            <center> 
              <embed id="archivoPDF1" src="" type="application/pdf" width="80%" height="auto" style="height: 65vh; display:block"/>
              <embed id="archivoPDF2" src="" type="application/pdf" width="80%" height="auto" style="height: 65vh; display:none"/>
              <embed id="archivoPDF3" src="" type="application/pdf" width="80%" height="auto" style="height: 65vh; display:none"/>
              <embed id="archivoPDF4" src="" type="application/pdf" width="80%" height="auto" style="height: 65vh; display:none"/>
              <embed id="archivoPDF5" src="" type="application/pdf" width="80%" height="auto" style="height: 65vh; display:none"/>
            </center>
            

        </div> <!-- fin div modal-body -->
        
        <!-- PIE DEL MODAL -->      
        <div class="modal-footer">
           <button type="button" class="btn btn-info pull-left" data-dismiss="modal">Regresar ..</button>  
           
        </div> <!-- fin div modal-footer -->
        
       
    </div> <!-- fin ventana modal-content -->
  </div> <!-- fin ventana modal-dialog -->
</div> <!-- fin ventana modalVerOrdenes --> 
        
<!--=====================================
MODAL EDITAR ORDEN
======================================-->
<div id="modalEditarOrden" class="modal fade" role="dialog">
  <div class="modal-dialog" style="width: 80% !important;">
    <div class="modal-content">
      <form role="form" method="post" enctype="multipart/form-data" onKeypress="if(event.keyCode == 13) event.returnValue = false;">
        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->
        <div class="modal-header" style="background:#3c8dbc; color:white">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Editar orden</h4>
        </div>     
        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->
        <div class="modal-body">
           <div class="box-body">
             
             <!--========================================================================== --> 
              <div class="row"> <!-- PRIMERA LINEA DE ENTRADA -->
                 <div class="col-xs-12 col-sm-2"> 
                      <!-- ENTRADA PARA EL NOMBRE -->
                      <div class="form-group">
                          <div class="input-group">
                             <span class="input-group-addon"><i class="fa fa-file"></i></span>
                             <input type="hidden" id="editaIdOrden" name="editaIdOrden">      
                             <input type="text" class="form-control input-xs" id="editaOrden" name="editaOrden" placeholder="# Orden" onfocus=" obtieneFoco('#editaOrden')" onblur = "pierdeFoco('#editaOrden')" required>
                          </div>
                      </div>
                  </div><!--fin  item 1-->
   
                  <div class="col-xs-12 col-sm-3">
                      <!-- ENTRADA PARA ASEGURADORA -->
                      <div class="form-group">
                         <div class="input-group">
                             <span class="input-group-addon"><i class="fa fa-file"> Aseguradora</i></span>
                             <select class= "form-control input-xs" name="editaAseguradora" id="editaAseguradora">
                                 <option value="INS">INS</option>
                                 <option value="Qualitas">Qualitas</option>
                                 <option value="Mapfre">Mapfre</option>
                                 <option value="Lafise">Lafise</option>
                                 <option value="Oceanica">Oceanica</option>
                                 <option value="Assa">Assa</option>
                                 <option value="Repaut">Repaut</option>
                                 <option value="Otros">Otros</option>
                             </select>
                          </div>
                      </div>
                   </div><!--fin  item 2-->   
                    
                    <div class="col-xs-12 col-sm-4"> 
                      <!-- ENTRADA PARA EL TALLER -->
                      <div class="form-group">
                          <div class="input-group">
                             <span class="input-group-addon"><i class="fa fa-building"></i></span>
                             <input type="text" class="form-control input-xs" id="editaTaller" name="editaTaller" placeholder="Taller" readonly>
                             <span class="input-group-addon"><input type="button" class="btn btn-xs btn-success btnBucarTaller" data-toggle="modal" data-target="#modalBuscarTaller" value="Buscar"></span>  
      
                          </div>
                      </div>
                    </div><!--fin  item 3-->
                     
                    <div class="col-xs-12 col-sm-3">
                       <!-- ENTRADA PARA FECHA ORDEN -->
                       <div class="input-group">
                         <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                         <input type="date" class="form-control input-xs" name="editaFecha" id="editaFecha">
                       </div>
                     </div><!--fin  item 4-->

              </div> <!-- Fin Linea 1 --> 
              <br>
              <!--========================================================================== -->
              <div class="row"> <!-- SEGUNDA LINEA DE ENTRADA -->
                 <div class="col-xs-12 col-sm-2"> 
                      <!-- ENTRADA PARA EL PLACA-->
                      <div class="form-group">
                          <div class="input-group">
                             <span class="input-group-addon"><i class="fa fa-car"></i></span> 
                             <input type="text" class="form-control input-xs" id="editaPlaca" name="editaPlaca" placeholder="# Placa" onfocus=" obtieneFoco('#editaPlaca')" onblur = "pierdeFoco('#editaPlaca')" >
                          </div>
                      </div>
                  </div> <!--fin  item 1-->
          
                  <div class="col-xs-12 col-sm-3">
                      <!-- ENTRADA PARA LA MARCA -->
                      <div class="form-group">
                         <div class="input-group">
                             <span class="input-group-addon"><i class="fa fa-car"></i></span> 
                             <input type="text" class="form-control input-xs" name="editaMarca" id="editaMarca" placeholder="Marca" onfocus=" obtieneFoco('#editaMarca')" onblur = "pierdeFoco('#editaMarca')" >
                         </div>
                      </div>
                  </div><!--fin  item 2-->
                  
                  <div class="col-xs-12 col-sm-3">
                      <!-- ENTRADA PARA LA MODELO -->
                      <div class="form-group">
                         <div class="input-group">
                             <span class="input-group-addon"><i class="fa fa-car"></i></span> 
                             <input type="text" class="form-control input-xs" name="editaModelo" id="editaModelo" placeholder="Modelo" onfocus=" obtieneFoco('#editaModelo')" onblur = "pierdeFoco('#editaModelo')" >
                         </div>
                      </div>
                  </div><!--fin  item 3-->

                  <div class="col-xs-12 col-sm-2">
                      <!-- ENTRADA PARA LA AÑO -->
                      <div class="form-group">
                         <div class="input-group">
                             <span class="input-group-addon"><i class="fa fa-file"></i></span> 
                             <input type="number" class="form-control input-xs" name="editaAno" id="editaAno" placeholder="Año" onfocus=" obtieneFoco('#editaAno')" onblur = "pierdeFoco('#editaAno')" >
                         </div>
                      </div>
                  </div><!--fin  item 4-->                 
                    
                  <div class="col-xs-12 col-sm-2">
                      <!-- ENTRADA PARA LA PLAZO -->
                      <div class="form-group">
                         <div class="input-group">
                              <span class="input-group-addon"><i class="fa fa-file"></i></span> 
                              <input type="number" class="form-control input-xs" name="editaPlazo" id="editaPlazo" placeholder="Plazo" onfocus=" obtieneFoco('#editaPlazo')" onblur = "pierdeFoco('#editaPlazo')" >
                         </div>
                      </div>
                  </div> <!--fin  item 5--> 
              </div> <!-- FIN SEGUNDA LINEA -->
              <br>
              <!--========================================================================== -->
              <div class="row"> <!-- TERCERA LINEA DE ENTRADA -->
                 <div class="col-xs-12 col-sm-2">
                    <!-- ENTRADA SINIESTRO-->
                    <div class="input-group">
                       <span class="input-group-addon"><i class="fa fa-flash"></i></span>
                       <input type="text" class="form-control input-xs" name="editaSiniestro" id="editaSiniestro"  placeholder="Siniestro" onfocus=" obtieneFoco('#editaSiniestro')" onblur = "pierdeFoco('#editaSiniestro')" >
                    </div>
                 </div><!--fin  item 1-->
                 <div class="col-xs-12 col-sm-4">
                    <!-- ENTRADA PARA FECHA VENCIMIENTO-->
                    <div class="input-group">
                       <span class="input-group-addon"><i class="fa fa-calendar"> Vencimiento</i></span>
                       <input type="date" class="form-control input-xs" name="editaFVenc" id="editaFVenc">
                    </div>
                 </div><!--fin  item 2--> 
                 <div class="col-xs-12 col-sm-6"> 
                      <!-- ENTRADA PARA EL OBSERVACIONES-->
                      <div class="form-group">
                          <div class="input-group">
                             <span class="input-group-addon"><i class="fa fa-file"></i></span> 
                             <input type="text" class="form-control input-xs" id="editaObserva" name="editaObserva"  placeholder="Observaciónes" onfocus=" obtieneFoco('#editaObserva')" onblur = "pierdeFoco('#editaObserva')" >
                          </div>
                      </div>
                  </div><!--fin  item 3-->
              </div> <!-- FIN TERCERA LINEA -->        
              <!--========================================================================== -->
              <div class="row"> <!-- CUARTA LINEA DE ENTRADA -->
                 <div class="col-xs-12 col-sm-2"> 
                      <!-- ENTRADA PARA PDF 1-->
                      <div class="divFile">     
                         <span class="texto">Subir Orden</span>
                         <input type="file" class="btnFile editaPdf1" name="editaPdf1">
                         <input type="hidden" name="pdfActual1" id="pdfActual1">
                      </div>
                 </div><!--fin  item 1-->
                 <div class="col-xs-12 col-sm-2"> 
                      <!-- ENTRADA PARA PDF 2-->
                      <div class="divFile">
                         <span class="texto">Subir Facura 1</span>
                         <input type="file" class="btnFile editaPdf2" name="editaPdf2">
                         <input type="hidden" name="pdfActual2" id="pdfActual2">
                      </div>
                 </div><!--fin  item 2--> 
                 <div class="col-xs-12 col-sm-2"> 
                      <!-- ENTRADA PARA PDF 3-->
                      <div class="divFile">
                         <span class="texto">Subir Factura 2</span>
                         <input type="file" class="btnFile editaPdf3" name="editaPdf3">
                         <input type="hidden" name="pdfActual3" id="pdfActual3">
                      </div>
                 </div><!--fin  item 3--> 
                 <div class="col-xs-12 col-sm-2"> 
                      <!-- ENTRADA PARA PDF 4-->
                      <div class="divFile">
                         <span class="texto">Subir Factura 3</span>
                         <input type="file" class="btnFile editaPdf4" name="editaPdf4">
                         <input type="hidden" name="pdfActual4" id="pdfActual4">
                      </div>
                 </div><!--fin  item 1--> 
                 <div class="col-xs-12 col-sm-2"> 
                      <!-- ENTRADA PARA PDF 5-->
                    <div class="divFile">
                         <span class="texto">Subir Factura 4</span>
                         <input type="file" class="btnFile editaPdf5" name="editaPdf5">
                         <input type="hidden" name="pdfActual5" id="pdfActual5">
                    </div>
                 </div><!--fin  item 2--> 
                
              </div> <!-- FIN CUARTA LINEA -->
             
          </div> <!-- Fin box modal Body -->
        </div>  <!-- Fin modal Body -->      
        <!--=====================================
        PIE DEL MODAL
        ======================================-->    
        <div class="modal-footer">
          <div class="row"> <!-- CUARTA LINEA DE ENTRADA -->
              <div class="col-xs-11 col-sm-2">
                <button type="button" class="btn btn-info pull-left" data-dismiss="modal">Regresar ..</button>       
              </div><!--fin item 1-->
             
              <div class="col-xs-1 col-sm-8">
              </div><!--fin item 2-->
         
              <div class="col-xs-12 col-sm-2">
                <button type="submit" class="btn btn-primary">Actualizar Orden</button> 
              </div><!--fin item 3-->  
            </div> <!-- FIN CUARTA LINEA -->  
         </div>
      </form>     
        <?php     
          $editarOrden = new ControladorOrdenesDima();
          $editarOrden -> ctrEditarOrden();
        ?>  
    </div> <!-- FIN CLASS MODEL CONTENT -->
  </div> <!-- FIN MODAL DIALOG -->
</div> <!-- FIN MODAL EDITAR ORDEN -->

<!--=====================================
MODAL BUSCAR TALLER
======================================-->
<div id="modalBuscarTaller" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header" style="background:#3c8dbc; color:white"> 
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Buscar Taller</h4>
      </div> <!-- fin div modal-header -->
      
      <div class="modal-body" style="background: cyan;">
        <table class="table table-bordered table-condensed table-striped dt-responsive tablas" width="100%"> 
          <thead>
            <tr>
               <th style="width:10px">#</th>
               <th style="width:120px">Taller</th>
               <th>Teléfono</th>
               <th>Acciones</th>
            </tr> 
          </thead>  
          <tbody>
              <?php
                  $item = null;
                  $valor = null;
                 
                  $clientes = ControladorClientes::ctrMostrarClientes($item, $valor);

                  foreach ($clientes as $key => $value) {
                        echo ' <tr>
                           <td>'.($key+1).'</td>
                           <td>'.$value["nombre"].'</td>
                           <td>'.$value["telefono"].'</td> 
                           <td>
                              <div class="btn-group">
                                 <button class="btn btn-xs btn-warning btnAgregarTaller" nTaller="'.$value["nombre"].'" data-dismiss="modal" ><i class="fa fa-check"> Agregar</i></button>      
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
</div> <!-- fin ventana modalBuscarCliente -->  

<!--=====================================
       MODAL REPORTES ORDEN
======================================-->
<div id="modalReportesOrden" class="modal fade" role="dialog">
  <div class="modal-dialog" style="width: 70% !important;">
    <div class="modal-content">
      <form method="post" action="reportes/reporteOrdenesOld.php">  
        <!-- Cabeza del Modal -->
        <div class="modal-header" style="background:#3c8dbc; color:white"> 
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Generar Reportes</h4>
        </div> <!-- fin div modal-header -->
                
        <!-- Cuerpo del Modal -->
        <div class="modal-body" style="background: cyan;">
            <div class="row"> <!-- PRIMERA LINEA DE ENTRADA -->
               <div class="col-xs-12 col-sm-4">
                  <!-- SELECCION REPORTE -->
                  <div class="form-group"> 
                     <div class="input-group"> 
                        <span class="input-group-addon"><i class="fa fa-print"> Reporte</i></span>
                        <select class= "form-control input-xs" name="sReporte" id="sReporte" style="width:200px">
                           <option value="xFecha">X Fecha</option>
                           <option value="xFactura">X Factura</option>
                           <option value="xSaldos">Saldos</option>   
                        </select>
                     </div> <!-- Fin input-group -->
                  </div>
               </div> <!-- Fin item 1 -->
              
               <div class="col-xs-12 col-sm-4">
                  <!-- ENTRADA PARA ASEGURADORA -->
                  <div class="form-group saldos">
                     <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-file"> Aseg.</i></span>
                        <select class= "form-control input-xs" name="sAseguradora" id="sAseguradora">
                           <option value="Todas">Todas</option>
                           <option value="INS">INS</option>
                           <option value="Qualitas">Qualitas</option>
                           <option value="Mapfre">Mapfre</option>
                           <option value="Lafise">Lafise</option>
                           <option value="Oceanica">Oceanica</option>
                           <option value="Assa">Assa</option>
                           <option value="Repaut">Repaut</option>
                           <option value="Otros">Otros</option>
                        </select>
                     </div>
                  </div> 
               </div> <!-- Fin item 2 -->

               <div class="col-xs-12 col-sm-3">
                <!-- SELECCION TIPO -->
                <div class="form-group saldos" >  
                   <div class="input-group">
                     <span class="input-group-addon"><i class="fa fa-newspaper-o"> Tipo</i></span>
                     <select class= "form-control input-xs" name="sTipo" id="sTipo" style="width:150px; background-color: cyan">
                        <option value="resumido" selected>Resumido</option>
                        <option value="detallado">Detallado</option>
                     </select> 
                  </div>
                </div>  
               </div><!--fin  item 3-->

            </div>     
            <br>
            <div class="row"> <!-- Segunda LINEA DE ENTRADA --> 
              <div class="col-xs-12 col-sm-4">
                <!-- ENTRADA PARA FECHA INICIO -->
                <div class="form-group saldos">
                  <div class="input-group">
                     <span class="input-group-addon"><i class="fa fa-calendar"> Fecha Inicial</i></span>
                     <input type="date" class="form-control input-xs" name="fechaInicial" id="fechaInicial">
                  </div>
                </div>
              </div><!--fin  item 1-->
              <div class="col-xs-12 col-sm-3">
              </div>   
              <div class="col-xs-12 col-sm-4">
                <!-- ENTRADA PARA FECHA FIN -->
                <div class="form-group saldos">
                  <div class="input-group">
                     <span class="input-group-addon"><i class="fa fa-calendar"> Fecha Final</i></span>
                     <input type="date" class="form-control input-xs" name="fechaFinal" id="fechaFinal">
                  </div>
                </div>  
              </div><!--fin  item 2-->

            </div> <!-- FIN SEGUNDA LINEA -->  
             
        </div> <!-- fin div modal-body -->
        
        <!-- PIE DEL MODAL -->      
        <div class="modal-footer">
           <button type="button" class="btn btn-warning btnCierreReporte pull-left" data-dismiss="modal">
              <i class="fa fa-mail-reply">
                  Regresar ..
              </i>
           </button> 
           <button type="submit" class="btn btn-danger pull-right" formtarget="_blank">
              <i class="fa fa-hourglass-1">
                  Procesar
              </i>   
           </button>
           
        </div> <!-- fin div modal-footer -->
      
      </form> <!-- fin form -->   
    </div> <!-- fin ventana modal-content -->
  </div> <!-- fin ventana modal-dialog -->
</div> <!-- fin ventana modalReportesOrden --> 

             
<?php     
                
  $borrarOrden = new ControladorOrdenesDima();
  $borrarOrden -> ctrEliminarOrden();
       
?>  
       
        