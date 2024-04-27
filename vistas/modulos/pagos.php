<div class="content-wrapper">
  <section class="content-header">
    <h1>     
      Control de Gastos
    </h1> 
    <ol class="breadcrumb">     
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      <li class="active">Control de Gastos</li>
    </ol>
  </section>
     
  <section class="content">
    <div class="box">
      <div class="box-header with-border">
        <button class="btn btn-primary btnLimpiaPago" data-toggle="modal" data-target="#modalAgregarPago">
          <i class="fa fa-plus">
           Agregar
          </i>   
        </button>
        <button class="btn btn-danger pull-right" data-toggle="modal" data-target="#modalReportesPagos">
            <i class="fa fa-print">
             Reportes
            </i> 
        </button>
      </div>
           
      <div class="box-body">
        <table class="table table-bordered table-condensed table-striped dt-responsive tablaPagos">
          <thead class="bg-primary text-light">
            <tr>       
               <th style="width:10px;">Id</th>
               <th style="font-size: x-small;">Tipo</th>
               <th style="font-size: x-small;">Documento</th>
               <th style="font-size: x-small;">Fecha</th>     
               <th style="font-size: x-small;">Colones</th>
               <th style="font-size: x-small;">Dólares</th>
               <th style="font-size: x-small;">Observaciones</th>
               <th style="font-size: x-small;">Archivo</th>
               <th style="font-size: x-small;">Acciones</th>
            </tr> 
          </thead>     
          <tbody></tbody>
          <tfoot style="color:#FF00FF;">
            <tr>
                <th colspan="4" style="text-align:center;">Totales :</th>
                <th></th>   
                <th></th>
                <th colspan="3"></th>
            </tr>
          </tfoot>  
        </table>        
        <input type="hidden" value="<?php echo $_SESSION['perfil']; ?>" id="perfilOculto">
      </div>
      <div class="box-footer">
        
      </div>
    </div>
  </section>
  
</div>
<!-- Fin ventana Pagos-->
 
<!--=====================================
MODAL AGREGAR PAGOS 
======================================-->
<div id="modalAgregarPago" class="modal fade" role="dialog">
  <div class="modal-dialog" style="width: 75% !important;">
    <div class="modal-content">
       <form role="form" method="post" enctype="multipart/form-data" onKeypress="if(event.keyCode == 13) event.returnValue = false;">  
        <!-- Cabeza del Modal -->
        <div class="modal-header" style="background:#3c8dbc; color:white"> 
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Agregar Pago</h4>
        </div> <!-- fin div modal-header -->
                   
        <!-- Cuerpo del Modal -->
        <div class="modal-body" style="background: cyan;">
            <div class="row"> <!-- PRIMERA LINEA DE ENTRADA -->           
              <div class="col-xs-12 col-sm-3">
                <div class="input-group">
                   <span class="input-group-addon"><i class="fa fa-file"> Tipo</i></span>
                   <select class= "form-control input-xs" name="nuevoTipo" id="nuevoTipo">
                      <option value="Imp. Ventas">Imp. Ventas</option>
                      <option value="Imp. Renta">Imp. Renta</option>
                      <option value="Planilla">Planilla</option>
                      <option value="CCSS.">CCSS</option>
                      <option value="Combustible">Combustible</option>
                      <option value="Encomienda">Encomienda</option>
                      <option value="Compra Local">Compra Local</option>
                      <option value="Gastos">Gastos</option>
                      <option value="Otros">Otros</option>
                    </select> 
                </div>
              </div> <!--fin item 1-->
              <div class="col-xs-12 col-sm-3" style="display: none" id="detalle">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-file"> Detalle</i></span>
                  <input type="text" class="form-control input-xs" name="nuevoOtro" id="nuevoOtro" onfocus=" obtieneFoco('#nuevoOtro')" onblur = "pierdeFoco('#nuevoOtro')">
                </div>
              </div><!--fin  item 2-->  

              <div class="col-xs-12 col-sm-3">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                  <input type="date" class="form-control input-xs" name="nuevaFecha" id="nuevaFecha">
                </div>
              </div><!--fin  item 2-->
              
              <div class="col-xs-12 col-sm-3">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-file"> Doc.</i></span>
                  <input type="text" class="form-control input-xs" name="nuevoDoc" id="nuevoDoc" onfocus=" obtieneFoco('#nuevoDoc')" onblur = "pierdeFoco('#nuevoDoc')">
                </div>
              </div><!--fin  item 3--> 


            </div> <!--FIN PRIMERA LINEA-->
            <br> 
            
            <div class="row"> <!-- SEGUNDA LINEA DE ENTRADA -->
              
              <div class="col-xs-12 col-sm-2">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-money"> ¢</i></span>
                  <input type="text" class="form-control input-xs" name="nuevoMonto" id="nuevoMonto" onfocus=" obtieneFoco('#nuevoMonto')" onblur = "pierdeFoco('#nuevoMonto')">
                </div>
              </div><!--fin  item 1-->
              
              <div class="col-xs-12 col-sm-2">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-money"> $</i></span>
                  <input type="text" class="form-control input-xs" name="nuevoDolar" id="nuevoDolar" onfocus=" obtieneFoco('#nuevoDolar')" onblur = "pierdeFoco('#nuevoDolar')">
                </div>
              </div><!--fin  item 2-->

              <div class="col-xs-12 col-sm-5">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-file"> Observación</i></span>
                  <input type="text" class="form-control input-xs" name="nuevaObserva" id="nuevaObserva" onfocus=" obtieneFoco('#nuevaObserva')" onblur = "pierdeFoco('#nuevaObserva')">
                </div>
              </div> <!--fin item 3-->
              <div class="col-xs-12 col-sm-2"> 
                  <div class="divFile">  
                      <span class="texto">Subir Pdf/Img</span>
                      <input type="file" class="btnFile nuevoPDF" name="nuevoPDF">
                  </div>
              </div><!--fin  item 1-->

            </div> <!--FIN SEGUNDA LINEA-->
            
        </div> <!-- fin div modal-body -->
           
        <!-- PIE DEL MODAL -->      
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
                     Guardar pago
                  </i>   
                </button> 
              </div><!--fin item 3-->  
            </div> <!-- FIN CUARTA LINEA -->
        </div> <!-- fin div modal-footer -->
        <?php
          $crearPago = new ControladorPagos();
          $crearPago ->ctrCrearPagos();
        ?>

      </form> <!-- fin del form modal -->
    </div> <!-- fin ventana modal-content -->
  </div> <!-- fin ventana modal-dialog -->
</div> <!-- fin ventana modalAgregarOrden --> 
   
<!--=====================================
MODAL EDITAR ORDEN
======================================-->

<div id="modalEditarPago" class="modal fade" role="dialog">
  <div class="modal-dialog" style="width: 75% !important;">
    <div class="modal-content">
       <form role="form" method="post" enctype="multipart/form-data" onKeypress="if(event.keyCode == 13) event.returnValue = false;">  
        <!-- Cabeza del Modal -->
        <div class="modal-header" style="background:#3c8dbc; color:white"> 
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Editar Pago</h4>
        </div> <!-- fin div modal-header -->
                   
        <!-- Cuerpo del Modal -->
        <div class="modal-body" style="background: cyan;">
            <div class="row"> <!-- PRIMERA LINEA DE ENTRADA -->           
              <div class="col-xs-12 col-sm-3">
                <div class="input-group">
                   <input type="hidden" name="editaId" id="editaId">
                   <span class="input-group-addon"><i class="fa fa-file"> Tipo</i></span>
                   <select class= "form-control input-xs" name="editaTipo" id="editaTipo">
                      <option value="Imp. Ventas">Imp. Ventas</option>
                      <option value="Imp. Renta">Imp. Renta</option>
                      <option value="Planilla">Planilla</option>
                      <option value="CCSS">CCSS</option>
                      <option value="Combustible">Combustible</option>
                      <option value="Encomienda">Encomienda</option>
                      <option value="Compra Local">Compra Local</option>
                      <option value="Gastos">Gastos</option>
                      <option value="Otros">Otros</option>
                    </select> 
                </div>
              </div> <!--fin item 1-->
              <div class="col-xs-12 col-sm-3" style="display: none" id="editaDetalle">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-file"> Detalle</i></span>
                  <input type="text" class="form-control input-xs" name="editaOtro" id="editaOtro" onfocus=" obtieneFoco('#editaOtro')" onblur = "pierdeFoco('#editaOtro')" >
                </div>
              </div><!--fin  item 2-->  

              <div class="col-xs-12 col-sm-3">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                  <input type="date" class="form-control input-xs" name="editaFecha" id="editaFecha">
                </div>
              </div><!--fin  item 2-->
              
              <div class="col-xs-12 col-sm-3">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-file"> Doc.</i></span>
                  <input type="text" class="form-control input-xs" name="editaDoc" id="editaDoc" onfocus=" obtieneFoco('#editaDoc')" onblur = "pierdeFoco('#editaDoc')">
                </div>
              </div><!--fin  item 3--> 


            </div> <!--FIN PRIMERA LINEA-->
            <br> 
            
            <div class="row"> <!-- SEGUNDA LINEA DE ENTRADA -->
              
              <div class="col-xs-12 col-sm-2">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-money"> ¢</i></span>
                  <input type="text" class="form-control input-xs" name="editaMonto" id="editaMonto" onfocus=" obtieneFoco('#editaMonto')" onblur = "pierdeFoco('#editaMonto')">
                </div>
              </div><!--fin  item 1-->
              
              <div class="col-xs-12 col-sm-2">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-money"> $</i></span>
                  <input type="text" class="form-control input-xs" name="editaDolar" id="editaDolar" onfocus=" obtieneFoco('#editaDolar')" onblur = "pierdeFoco('#editaDolar')">
                </div>
              </div><!--fin  item 2-->              

              <div class="col-xs-12 col-sm-5">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-file"> Observación</i></span>
                  <input type="text" class="form-control input-xs" name="editaObserva" id="editaObserva" onfocus=" obtieneFoco('#editaObserva')" onblur = "pierdeFoco('#editaObserva')">
                </div>
              </div> <!--fin item 3-->
              
              <div class="col-xs-12 col-sm-2">
                  <div class="divFile">
                    <span class="texto">Actualiza Pdf/Img</span>
                    <input type="file" class="btnFile editaPDF" name="editaPDF">
                    <input type="hidden" name="pdfActual" id="pdfActual">
                  </div>  
               </div><!--fin  item 1-->

            </div> <!--FIN SEGUNDA LINEA-->  
                        
        </div> <!-- fin div modal-body -->
        
        <!-- PIE DEL MODAL -->      
        <div class="modal-footer">
          <div class="row"> <!-- CUARTA LINEA DE ENTRADA -->
              <div class="col-xs-11 col-sm-2">
                <button type="button" class="btn btn-info  pull-left" data-dismiss="modal">Regresar ..</button>       
              </div><!--fin item 1-->
             
              <div class="col-xs-1 col-sm-8">
              </div><!--fin item 2-->
             
              <div class="col-xs-12 col-sm-2">
                <button type="submit" class="btn btn-primary">Actualiza pago</button> 
              </div><!--fin item 3-->  
            </div> <!-- FIN CUARTA LINEA -->
        </div> <!-- fin div modal-footer -->
        <?php
          $editarPago = new ControladorPagos();
          $editarPago ->ctrEditarPagos();
        ?>
   
      </form> <!-- fin del form modal -->
    </div> <!-- fin ventana modal-content -->
  </div> <!-- fin ventana modal-dialog -->
</div> <!-- fin ventana modalEditarPago --> 


<!--=====================================
MODAL VER PDF
======================================-->
<div id="modalVerPago" class="modal fade" role="dialog">
  <div class="modal-dialog" style="width: 80% !important;">
    <div class="modal-content">
        <!-- Cabeza del Modal -->

        <div class="modal-header" style="background:#3c8dbc; color:white"> 
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Ver Pago</h4>
        </div> <!-- fin div modal-header -->
                
        <!-- Cuerpo del Modal -->
        <div class="modal-body" style="background: cyan;">
            <center> 
               <embed id="archivoPDF" src="" type="application/pdf" width="80%" height="auto" style="height: 65vh"/>
            </center>
        </div> <!-- fin div modal-body -->
        
        <!-- PIE DEL MODAL -->      
        <div class="modal-footer">
           <button type="button" class="btn btn-info btn-lg pull-left" data-dismiss="modal">Regresar ..</button>  
           
        </div> <!-- fin div modal-footer -->
        
       
    </div> <!-- fin ventana modal-content -->
  </div> <!-- fin ventana modal-dialog -->
</div> <!-- fin ventana modalVerPago --> 

<!--=====================================
       MODAL REPORTES PAGOS
======================================-->
<div id="modalReportesPagos" class="modal fade" role="dialog">
  <div class="modal-dialog" style="width: 70% !important;">
    <div class="modal-content">
      <form method="post" action="reportes/reportePagos.php">  
        <!-- Cabeza del Modal -->
        <div class="modal-header" style="background:#3c8dbc; color:white"> 
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Reporte x Fecha</h4>
        </div> <!-- fin div modal-header -->
                    
        <!-- Cuerpo del Modal -->
        <div class="modal-body" style="background: cyan;">
          <div class="row"> <!-- Segunda LINEA DE ENTRADA --> 
              <div class="col-xs-12 col-sm-4">
                <!-- ENTRADA PARA FECHA INICIO -->
                <div class="form-group saldos">
                  <div class="input-group">
                     <span class="input-group-addon"><i class="fa fa-calendar"> Fecha Inicial</i></span>
                     <input type="date" class="form-control input-xs" name="fechaInicial" id="fechaInicial" required>
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
                     <input type="date" class="form-control input-xs" name="fechaFinal" id="fechaFinal" required>
                  </div>
                </div>  
              </div><!--fin  item 2-->

          </div> <!-- FIN PRIMERA LINEA -->  
             
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
</div> <!-- fin ventana modalReportesPagos --> 
    
<!--======================
    ELIMINAR PAGO
-->
<?php 
  
  $borrarPago = new ControladorPagos();
 
  $borrarPago ->ctrEliminarPago();

?>  