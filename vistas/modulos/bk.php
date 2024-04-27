
<!--=====================================
MODAL AGREGAR LINEAS
======================================-->
<div id="modalAgregarLinea" class="modal fade" role="dialog">
  <div class="modal-dialog" style="width: 60% !important;">
    <div class="modal-content">
      <form role="form" method="post" enctype="multipart/form-data" onKeypress="if(event.keyCode == 13) event.returnValue = false;">
        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->
        <div class="modal-header" style="background:#3c8dbc; color:white">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Agregar Linea</h4>
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
                             <input type="text" class="form-control input-xs" id="nOrden" name="nOrden" readonly>
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
                                 <option value="EXTERNA">EXTERNA</option>
                              </select>     
                          </div>
                      </div>
                  </div><!--fin  item 4-->  
                  <div class="col-xs-12 col-sm-3 cExterior" style="display: none"> 
                      <!-- NUMERO DE MIA -->
                      <div class="form-group">
                          <div class="input-group">
                             <span class="input-group-addon"><i class="fa fa-barcode"></i></span> 
                             <input type="text" class="form-control input-xs" id="nMia" name="nMia" placeholder="# Mia" onfocus=" obtieneFoco('#nMia')" onblur = "pierdeFoco('#nMia')" onkeypress="siguiente(event,'#nDescri')">
                          </div>
                      </div>
                  </div><!--fin  item 3--> 
                  
              </div> <!-- FIN PRIMERA LINEA -->
              <br>
              <!--========================================================================== --> 
              <div class="row"> <!-- SEGUNDA LINEA DE ENTRADA -->
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
                            <input type="date" class="form-control input-xs" id="nFecha" name="nFecha">
                          </div>
                      </div>
                   </div><!--fin  item 2-->
              </div> <!-- FIN SEGUNDA LINEA -->
              <br>
              <!--========================================================================== --> 
              <div class="row"> <!-- TERCERA LINEA DE ENTRADA -->
                 <div class="col-xs-12 col-sm-4"> 
                      <!-- FECHA PRESENTACION -->
                      <div class="form-group">
                          <div class="input-group">
                             <span class="input-group-addon"><i class="fa fa-calendar"> Precentación</i></span>  
                             <input type="date" class="form-control input-xs" id="nPresenta" name="nPresenta">  
                          </div>
                      </div>
                  </div><!--fin  item 1-->
                  <div class="col-xs-12 col-sm-4"> 
                      <!-- FECHA VENCIMIENTO -->
                      <div class="form-group">
                          <div class="input-group">
                             <span class="input-group-addon"><i class="fa fa-calendar"> Vencimiento</i></span>  
                             <input type="date" class="form-control input-xs" id="nVencimiento" name="nVencimiento">
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


              </div> <!-- FIN TERCERA LINEA -->
              <hr>
              <!--========================================================================== --> 
              <div class="row"> <!-- CUARTA LINEA DE ENTRADA -->
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
              </div> <!-- FIN CUARTA LINEA -->
              <hr> 
              <!--========================================================================== --> 
              <div class="row cLocal" > <!-- QUINTA LINEA DE ENTRADA -->
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
              </div> <!-- FIN QUINTA LINEA -->
              <br>
              <!--========================================================================== --> 
              <div class="row cExterior" style="display: none"> <!-- SEXTA LINEA DE ENTRADA -->
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
                             <input type="text" class="form-control input-xs" id="nCostoUsa" name="nCostoUsa" placeholder=" $ Costo" onfocus=" obtieneFoco('#nCostoUsa')" onblur = "pierdeFoco('#nCostoUsa')" onkeypress="siguiente(event,'#nImpImporta')">
                          </div>
                      </div>
                  </div><!--fin  item 3-->
                  <div class="col-xs-12 col-sm-3"> 
                      <!-- IMP VENTAS -->
                      <div class="form-group">
                          <div class="input-group">
                             <span class="input-group-addon"><i class="fa fa-money"> Imp</i></span> 
                             <input type="text" class="form-control input-xs" id="nImpImporta" name="nImpImporta" placeholder="$ Import" onfocus=" obtieneFoco('#nImpImporta')" onblur = "pierdeFoco('#nImpImporta')" onkeypress="siguiente(event,'#nEnvio')">
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
                             <span class="input-group-addon"><i class="fa fa-money"> Envio</i></span> 
                             <input type="text" class="form-control input-xs" id="nEnvio" name="nEnvio" placeholder="$ Envio" onfocus=" obtieneFoco('#nEnvio')" onblur = "pierdeFoco('#nEnvio')" onkeypress="siguiente(event,'#nAduana')">
                          </div>
                      </div>
                  </div><!--fin  item 1-->  
                  <div class="col-xs-12 col-sm-3"> 
                      <!-- PRECIO DE VENTA -->
                      <div class="form-group">
                          <div class="input-group">
                             <span class="input-group-addon"><i class="fa fa-money"> Aduana</i></span> 
                             <input type="text" class="form-control input-xs" id="nAduana" name="nAduana" placeholder="$ Aduana" onfocus=" obtieneFoco('#nAduana')" onblur = "pierdeFoco('#nAduana')" onkeypress="siguiente(event,'#nCostoUsa')">
                          </div>
                      </div>
                  </div><!--fin  item 2-->
                  <div class="col-xs-12 col-sm-3"> 
                      <!-- IMP VENTAS -->
                      <div class="form-group">
                          <div class="input-group">
                             <span class="input-group-addon"><i class="fa fa-money"> Total $</i></span> 
                             <input type="text" class="form-control input-xs" id="nTotalUsa" name="nTotalUsa" placeholder=" $ Total" readonly >
                          </div>
                      </div>
                  </div><!--fin  item 3-->
                  <div class="col-xs-12 col-sm-3"> 
                      <!-- IMP VENTAS -->
                      <div class="form-group">
                          <div class="input-group">
                             <span class="input-group-addon"><i class="fa fa-money"> Total ¢</i></span> 
                             <input type="text" class="form-control input-xs" id="nTotalCol" name="nTotalCol" placeholder=" ¢ Total" readonly>
                          </div>
                      </div>
                  </div><!--fin  item 4-->  
              </div> <!-- FIN SEXTIMA LINEA -->  
  
           
           </div> <!-- Fin box modal Body -->
        </div>  <!-- Fin modal Body -->


        <!--=====================================
        PIE DEL MODAL
        ======================================-->    
        <div class="modal-footer">
          <div class="row"> <!-- CUARTA LINEA DE ENTRADA -->
              <div class="col-xs-11 col-sm-2">
                  <!--input type="button" class="btn btn-warning btn-lg btnAgregarLinea" value="Guardar"-->
                  <button type="submit" class="btn btn-sm btn-primary">Guardar</button> 
              </div><!--fin item 1-->
              <div class="col-xs-1 col-sm-8">
              </div><!--fin item 2-->
              <div class="col-xs-11 col-sm-2">
                 <button type="button" class="btn btn-info btn-sm pull-left" data-dismiss="modal">Regresar ..</button> 
              </div><!--fin item 1-->


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

