<!--=====================================
MODAL EDITAR PRODUCTO
======================================-->
<div id="modalEditarProduc" class="modal fade" role="dialog">
  <div class="modal-dialog" style="width: 80% !important;">
    <div class="modal-content">
      <form role="form" method="post" enctype="multipart/form-data" onKeypress="if(event.keyCode == 13) event.returnValue = false;">
        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->
        <div class="modal-header" style="background:#3c8dbc; color:white">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Editar producto</h4>
        </div>
        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->
        <div class="modal-body">
           <div class="box-body">
              <div class="row"> <!-- PRIMERA LINEA DE ENTRADA -->
                  <div class="col-xs-12 col-sm-3">
                      <!-- ENTRADA PARA SELECCIONAR CATEGORÍA -->
                      <div class="form-group">
                          <div class="input-group">
                              <span class="input-group-addon"><i class="fa fa-th"></i></span> 
                              <select class="form-control input-lg" id="editarCategoria" name="editarCategoria" required>
                                   <option value="">Selecionar categoría</option>
                                   <?php
                                      $item = null;
                                      $valor = null;
                                      $categorias = ControladorCategorias::ctrMostrarCategorias($item, $valor);
                                      foreach ($categorias as $key => $value) {
                                         echo '<option value="'.$value["id"].'">'.$value["categoria"].'</option>';
                                      }
                                   ?>
                              </select>
                          </div>
                      </div>
                  </div>
                     
                  <div class="col-xs-12 col-sm-3"> 
                      <!-- ENTRADA PARA EL CÓDIGO -->
                      <div class="form-group">
                          <div class="input-group">
                             <span class="input-group-addon"><i class="fa fa-code"></i></span> 
                             <input type="text" class="form-control input-lg" id="editarCodigo" name="editarCodigo" placeholder="Ingresar código" onfocus=" obtieneFoco('#editarCodigo')" onblur = "pierdeFoco('#editarCodigo')" required>
                          </div>
                      </div>
                  </div>
   
                  <div class="col-xs-12 col-sm-6">
                      <!-- ENTRADA PARA LA DESCRIPCIÓN -->
                      <div class="form-group">
                         <div class="input-group">
                             <span class="input-group-addon"><i class="fa fa-product-hunt"></i></span> 
                             <input type="text" class="form-control input-lg" name="editarDescripcion" id="editarDescripcion" placeholder="Ingresar descripción" onfocus=" obtieneFoco('#editarDescripcion')" onblur = "pierdeFoco('#editarDescripcion')" required>
                         </div>
                      </div>
                  </div>
              </div> <!-- Fin Linea 1 --> 
              <br>
              <div class="row"> <!-- SEGUNDA LINEA DE ENTRADA -->
                  <div class="col-xs-12 col-sm-3">  
                      <!-- ENTRADA PARA MARCA -->
                      <div class="form-group">
                          <div class="input-group">
                              <span class="input-group-addon"><i class="fa fa-car"></i></span> 
                              <input type="text" class="form-control input-lg" name="editaMarca" id="editaMarca" placeholder="Marca" onfocus=" obtieneFoco('#editaMarca')" onblur = "pierdeFoco('#editaMarca')" >
                          </div>
                      </div>
                   </div>

                   <div class="col-xs-12 col-sm-3">
                      <!-- ENTRADA PARA MODELO -->
                      <div class="input-group">
                           <span class="input-group-addon"><i class="fa fa-car"></i></span> 
                           <input type="text" class="form-control input-lg" id="editaModelo" name="editaModelo" placeholder="Modelo" onfocus=" obtieneFoco('#editaModelo')" onblur = "pierdeFoco('#editaModelo')">
                      </div>
                   </div>
                
                   <div class="col-xs-12 col-sm-3">
                       <!-- ENTRADA PARA ANO -->
                       <div class="input-group">
                           <span class="input-group-addon"><i class="fa fa-calendar"></i></span> 
                           <input type="number" class="form-control input-lg" id="editaAno" name="editaAno" placeholder="Año" onfocus=" obtieneFoco('#editaAno')" onblur = "pierdeFoco('#editaAno')">
                       </div>
                   </div>
                  
                   <div class="col-xs-12 col-sm-3">  
                      <!-- ENTRADA PARA STOCK -->
                      <div class="form-group">
                          <div class="input-group">
                              <span class="input-group-addon"><i class="fa fa-check"></i></span> 
                              <input type="number" class="form-control input-lg" name="editarStock" id="editarStock" min="0" placeholder="Stock" required onfocus=" obtieneFoco('#editarStock')" onblur = "pierdeFoco('#editarStock')">
                          </div>
                      </div>
                   </div> 
              </div> <!-- Fin Linea 2 -->  
    
              <div class="row"> <!-- TERCERA LINEA DE ENTRADA -->
                  
                   <div class="col-xs-12 col-sm-3">
                      <!-- ENTRADA PARA PRECIO COMPRA -->
                      <div class="input-group">
                           <span class="input-group-addon"><i class="fa fa-arrow-up"></i></span> 
                           <input type="number" class="form-control input-lg" id="editarPrecioCompra" name="editarPrecioCompra" min="0" step="any" placeholder="Precio de compra" required>
                      </div>
                   </div>
                
                   <div class="col-xs-12 col-sm-3">
                       <!-- ENTRADA PARA PRECIO VENTA -->
                       <div class="input-group">
                           <span class="input-group-addon"><i class="fa fa-arrow-down"></i></span> 
                           <input type="number" class="form-control input-lg" id="editarPrecioVenta" name="editarPrecioVenta" min="0" step="any" placeholder="Precio de venta" required>
                       </div>
                   </div>
                  
                   <div class="col-xs-3">
                       <!-- CHECKBOX PARA PORCENTAJE -->
                       <div class="form-group">
                          <label>
                             <input type="checkbox" class="minimal porcentaje" checked>
                              Utilizar procentaje
                          </label>
                       </div>
                   </div>
                   
                   <div class="col-xs-2">
                      <!-- ENTRADA PARA PORCENTAJE -->  
                      <div class="input-group">
                          <input type="number" class="form-control input-lg editarPorcentaje" min="0" value="40" required>
                          <span class="input-group-addon"><i class="fa fa-percent"></i></span>
                      </div>
                   </div> 

              </div> <!-- Fin Linea 2 -->
              <br>  
              <div class="row"> <!-- SEGUNDA TERCERA DE ENTRADA -->
                   <div class="col-xs-4"> 
                      <div class="form-group">
                          <span><strong>Subir Foto 1</strong></span> 
                          <input type="file" class="nuevaImagen" name="editarImagen">
                          <input type="text" name="imagenActual" id="imagenActual" value="11">
                          <br>
                          <img src="vistas/img/productos/default/vehiculo.png" class="img-thumbnail previsualizar" width="100px">
                      </div>
                   </div>    
                    
              </div> <!-- Fin Linea 3 -->

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
             
              <div class="col-xs-1 col-sm-8">
              </div><!--fin item 2-->
         
              <div class="col-xs-12 col-sm-2">
                <button type="submit" class="btn btn-lg btn-primary">Actualiza Producto</button> 
              </div><!--fin item 3-->  
            </div> <!-- FIN CUARTA LINEA -->  
         </div>
      </form>
          
    </div> <!-- FIN CLASS MODEL CONTENT -->
  </div> <!-- FIN MODAL DIALOG -->
</div> <!-- FIN MODAL EDITAR PRODUCTO -->
