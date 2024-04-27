<div class="content-wrapper">

  <section class="content-header">
    <h1>Inspección Vehículos</h1>
            
    <ol class="breadcrumb">
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      <li class="active">Inspección Vehículos</li>
    </ol>
          
  </section> <!--Fin content-header -->
   
  <section class="content">
    <div class="box"> 
        
      <form id='formCanvas' method='post' action='#' ENCTYPE='multipart/form-data'>               
         <div class="box-header with-border">
            <button class="btn btn-warning btnRegresarCasos pull-left">
               <i class="fa fa-mail-reply">
                  Regresar
               </i> 
            </button>
            
            <button type="button" class="btn btn-primary pull-right" onclick="GuardarImg()">
               <i class="fa fa-save">
                  Guardar                      
               </i>           
            </button>  
            <input type='hidden' name='imgCaptura' id='imgCaptura' />
            
         </div>    
         <div class="box-body">
            <!--========================================================================== --> 
            <div class="row"> <!-- PRIMERA LINEA DE ENTRADA -->
               <div class="col-xs-4 col-md-2"> 
                  <div class="form-group">
                     <div class="input-group">    
                        <span class="input-group-addon"><i class="fa fa-car"></i></span> 
                        <input type="text" class="form-control input-xs" id="nPlaca" name="nPlaca" placeholder=" Placa" onfocus=" obtieneFoco('#nPlaca')" onblur = "pierdeFoco('#nPlaca')" onkeypress="siguiente(event,'#nMarca')" required>
                     </div>
                  </div>
               </div><!--fin  item 1-->
               <div class="col-xs-4 col-md-3"> 
                  <div class="form-group">
                     <div class="input-group">    
                        <span class="input-group-addon"><i class="fa fa-car"></i></span> 
                        <input type="text" class="form-control input-xs" id="nMarca" name="nMarca" placeholder=" Marca" onfocus=" obtieneFoco('#nMarca')" onblur = "pierdeFoco('#nMarca')" onkeypress="siguiente(event,'#nModelo')" required>
                     </div>
                  </div>
               </div><!--fin  item 2-->   
               <div class="col-xs-4 col-md-3"> 
                  <div class="form-group">
                     <div class="input-group">    
                        <span class="input-group-addon"><i class="fa fa-car"></i></span> 
                        <input type="text" class="form-control input-xs" id="nModelo" name="nModelo" placeholder=" Modelo" onfocus=" obtieneFoco('#nModelo')" onblur = "pierdeFoco('#nModelo')" onkeypress="siguiente(event,'#nAno')" required>
                     </div>
                  </div>
               </div><!--fin  item 3-->
               <div class="col-xs-4 col-md-2"> 
                  <div class="form-group">
                     <div class="input-group">    
                        <span class="input-group-addon"><i class="fa fa-car"></i></span> 
                        <input type="number" class="form-control input-xs" id="nAno" name="nAno" placeholder=" Año" onfocus=" obtieneFoco('#nAno')" onblur = "pierdeFoco('#nAno')" onkeypress="siguiente(event,'#nKms')" >
                     </div>
                  </div>
               </div><!--fin  item 4-->
               <div class="col-xs-4 col-md-2"> 
                  <div class="form-group">
                     <div class="input-group">    
                        <span class="input-group-addon"><i class="fa fa-tachometer"></i></span> 
                        <input type="number" class="form-control input-xs" id="nKms" name="nKms" placeholder=" Kms" onfocus=" obtieneFoco('#nKms')" onblur = "pierdeFoco('#nKms')" onkeypress="siguiente(event,'#nVin')" >
                     </div>
                  </div>
               </div><!--fin  item 5-->
            </div> <!-- FIN LINEA 1 -->
            <!--========================================================================== --> 
            <div class="row"> <!-- SEGUNDA LINEA DE ENTRADA -->
               <div class="col-xs-5 col-md-3"> 
                  <div class="form-group">
                     <div class="input-group">    
                        <span class="input-group-addon"><i class="fa fa-car"></i></span> 
                        <input type="text" class="form-control input-xs" id="nVin" name="nVin" placeholder=" # Vin" onfocus=" obtieneFoco('#nVin')" onblur = "pierdeFoco('#nVin')" onkeypress="siguiente(event,'#nMotor')" >
                     </div>
                  </div>
               </div><!--fin  item 1-->
               <div class="col-xs-4 col-md-3"> 
                  <div class="form-group">
                     <div class="input-group">    
                        <span class="input-group-addon"><i class="fa fa-car"></i></span> 
                        <input type="text" class="form-control input-xs" id="nMotor" name="nMotor" placeholder=" # Motor" onfocus=" obtieneFoco('#nMotor')" onblur = "pierdeFoco('#nMotor')" onkeypress="siguiente(event,'#nCono')" >
                     </div>
                  </div>   
               </div><!--fin  item 2-->
               <div class="col-xs-3 col-md-2"> 
                  <div class="form-group">
                     <div class="input-group">    
                        <span class="input-group-addon"><i class="fa fa-car"> Cono</i></span> 
                        <input type="number" class="form-control input-xs" id="nCono" name="nCono" value = 0 placeholder=" # Cono" onfocus=" obtieneFoco('#nCono')" onblur = "pierdeFoco('#nCono')" onkeypress="siguiente(event,'#nTanque')" >
                     </div>
                  </div>
               </div><!--fin  item 3-->
               <div class="col-xs-4 col-md-2"> 
                  <div class="form-group">
                     <div class="input-group">    
                        <span class="input-group-addon"><i class="fa fa-compass"></i></span> 
                        <select class= "form-control input-xs" name="nTanque" id="nTanque">
                             <option value="Vacio">Vacio</option>
                             <option value="1/4">1/4 E</option>
                             <option value="1/2">1/2 E</option>
                             <option value="3/4">3/4 E</option>
                             <option value="Lleno">Lleno</option>  
                        </select>
                      </div>
                  </div> 
               </div><!--fin  item 4-->
               <div class="col-xs-4 col-md-2"> 
                  <div class="form-group">
                     <div class="input-group">    
                        <span class="input-group-addon"><i class="fa fa-tint"></i></span> 
                        <select class= "form-control input-xs" name="nTipoComb" id="nTipoComb">
                             <option value="Gasolina">Gasolina</option>
                             <option value="Disel">Disel</option>
                             <option value="Hibrido">Hibrido</option>
                             <option value="Gas">Gas</option>
                             <option value="Electrico">Electrico</option>  
                        </select>
                      </div>
                  </div> 
               </div><!--fin  item 5-->
            </div> <!-- FIN LINEA 2 -->
            <!--========================================================================== --> 
            <div class="row"> <!-- TERCERA LINEA DE ENTRADA -->
               <div class="col-xs-7 col-md-4">
                  <div class="form-group">
                     <div class="input-group">    
                        <span class="input-group-addon"><i class="fa fa-user"> <input type="button" class="btn btn-xs btn-danger" data-toggle="modal" data-target="#modalAgregarCliente" value="+"></i></span>
                        <input type="hidden" id="nIdCliente" name="nIdCliente">
                        <input type="text" class="form-control input-xs" id="nCliente" name="nCliente" placeholder="Cliente" readonly>
                        <span class="input-group-addon"><input type="button" class="btn btn-xs btn-success btnBucarCliente" data-toggle="modal" data-target="#modalBuscarCliente" value="Buscar"></span>  
                     </div>        
                  </div>      
               </div><!--fin  item 1-->   
               <div class="col-xs-5 col-md-3">
                  <div class="form-group">
                     <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-hospital-o"> Aseguradora</i></span>
                        <select class= "form-control input-xs" name="nAseguradora" id="nAseguradora">
                           <option value="Ins">Ins</option>
                           <option value="Qualitas">Qualitas</option>
                           <option value="Mapfre">Mapfre</option>
                           <option value="Lafise">Lafise</option>
                           <option value="Oceanica">Oceanica</option>
                           <option value="Assa">Assa</option>
                           <option value="Repaut">Repaut</option>
                           <option value="Personal">Personal</option>
                        </select>
                     </div>
                  </div>    
               </div><!--fin  item 2-->
               <div class="col-xs-12 col-md-5">
                  <div class="form-group">
                     <div class="input-group">    
                        <span class="input-group-addon"><i class="fa fa-commenting-o"></i></span>
                        <input type="text" class="form-control input-xs" id="nObserva" name="nObserva" placeholder=" Observaciónes" onfocus=" obtieneFoco('#nObserva')" onblur = "pierdeFoco('#nObserva')">
                     </div>
                  </div>   
               </div><!--fin  item 3-->   
            </div> <!-- FIN LINEA 3 --> 
            <!--========================================================================== --> 
            <div class="row"> <!-- CUARTA LINEA DE ENTRADA -->
               <div class="col-xs-12 col-md-5">
                  <h4 style="margin: 5px; margin-left:150px; color:gray;">Inspección</h4>
                  <canvas id="canvas" width="400px" height="300px">
                  </canvas>    
                  <br>
                  <div class="row">
                     <div class="col-xs-6 col-sm-5" style="margin-left: 100px;">
                        <span class="input-group-addon"><i class="fa fa-"> Tipo Colisión</i></span>
                        <select class= "form-control input-xs" name="nColor" id="nColor" style="background:cyan;">
                           <option value="green">Leve</option>
                           <option value="yellow">Mediano</option>
                           <option value="red">Grave</option>
                        </select>       
                     </div>
                  </div>      
               </div> <!--fin  item 1-->   
               <div class="col-xs-12 col-md-7">
                  <h4 style="margin:0px; color:gray; text-align: center;">Accesorios</h4>
                  <div class="row" style="margin:10px; border: 1px solid rgba(0,0,0,0.3);">   
                     <div class="col-xs-6 col-sm-4">
                        <div class="custom-control custom-checkbox">
                           <input type="checkbox" class="custom-control-input" id="nRadio" name="nRadio" value="on">
                           <label class="custom-control-label" for="nRadio">Radio</label>
                           <br>
                           <input type="checkbox" class="custom-control-input" id="nAntena" name="nAntena">
                           <label class="custom-control-label" for="nAntena">Antena</label>
                           <br>
                           <input type="checkbox" class="custom-control-input" id="nTriangulos" name="nTriangulos">
                           <label class="custom-control-label" for="nTriangulos">Triangulos</label>
                           <br>
                           <input type="checkbox" class="custom-control-input" id="nRepuesto" name="nRepuesto">
                           <label class="custom-control-label" for="nRepuesto">Repuesto</label>
                        </div>                
                     </div>
                     <div class="col-xs-6 col-sm-4">
                        <div class="custom-control custom-checkbox">
                           <input type="checkbox" class="custom-control-input" id="nLibros" name="nLibros">
                           <label class="custom-control-label" for="nLibros">Libros</label>
                           <br>
                           <input type="checkbox" class="custom-control-input" id="nLlavero" name="nLlavero">
                           <label class="custom-control-label" for="nLlavero">Llavero</label>
                           <br>
                           <input type="checkbox" class="custom-control-input" id="nCopas" name="nCopas">
                           <label class="custom-control-label" for="nCopas">Copas</label>
                           <br>
                           <input type="checkbox" class="custom-control-input" id="nAlfombras" name="nAlfombras">
                           <label class="custom-control-label" for="nAlfombras">Alfombras</label>
                        </div>                
                     </div>
                     <div class="col-xs-6 col-sm-4">
                        <div class="custom-control custom-checkbox">
                           <input type="checkbox" class="custom-control-input" id="nExtintor" name="nExtintor">
                           <label class="custom-control-label" for="nExtintor">Extintor</label>
                           <br>
                           <input type="checkbox" class="custom-control-input" id="nGata" name="nGata">
                           <label class="custom-control-label" for="nGata">Gata</label>
                           <br>
                           <input type="checkbox" class="custom-control-input" id="nDocumentos" name="nDocumentos">
                           <label class="custom-control-label" for="nDocumentos">Documentos</label>
                           <br>
                           <input type="checkbox" class="custom-control-input" id="nEncendedor" name="nEncendedor">
                           <label class="custom-control-label" for="nEncendedor">Encendedor</label>
                        </div>                
                     </div>
                     <div class="col-sm-6">
                        <label>Radio-Marca </label>
                        <input type="text" id="radioMarca" name="radioMarca" onfocus="obtieneFoco('#radioMarca')" onblur = "pierdeFoco('#radioMarca')">
                     </div>
                     <div class="col-sm-6">
                        <label>Bateria-Marca </label>
                        <input type="text" id="bateriaMarca" name="bateriaMarca" onfocus="obtieneFoco('#bateriaMarca')" onblur = "pierdeFoco('#bateriaMarca')">
                     </div>
                  </div>
                         
                  <h4 style="margin:0px; margin-left:150px; color:gray;">Descripción de Piezas</h4>
                  <textarea name="nPiezas" id="nPiezas" cols="80" rows="8" style="margin:10px;"></textarea>
                 
               </div> <!--fin  item 2-->
            </div> <!-- FIN LINEA 4 -->  
         </div> <!--Fin div box-body -->
      </form>
      <?php    
         $crearEntrada = new ControladorEntradas();
         $crearEntrada -> ctrCrearEntrada();         
      ?>         
    </div> <!--Fin div box -->
  </section> <!--Fin section Content -->
</div> <!--Fin Class Content Wrapper -->  

<!--=====================================
MODAL AGREGAR CLIENTE
======================================-->
<div id="modalAgregarCliente" class="modal fade" role="dialog">
  <div class="modal-dialog" style="width: 65% !important;">
    <div class="modal-content">
      <form role="form" method="post" enctype="multipart/form-data" onKeypress="if(event.keyCode == 13) event.returnValue = false;">
        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->
        <div class="modal-header" style="background:#3c8dbc; color:white">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Agregar cliente</h4>
        </div>
        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->
        <div class="modal-body">
           <div class="box-body">
              <div class="row"> <!-- PRIMERA LINEA DE ENTRADA -->
                 <div class="col-xs-12 col-md-6"> 
                      <!-- ENTRADA PARA EL NOMBRE -->
                      <div class="form-group">
                          <div class="input-group">
                             <span class="input-group-addon"><i class="fa fa-user"></i></span> 
                             <input type="text" class="form-control input-xs" id="nuevoCliente" name="nuevoCliente" placeholder="Ingresar nombre" onfocus=" obtieneFoco('#nuevoCliente')" onblur = "pierdeFoco('#nuevoCliente')" required>
                          </div>
                      </div>
                  </div>
   
                  <div class="col-xs-12 col-md-4">
                      <!-- ENTRADA PARA EL TELEFONO -->
                      <div class="form-group">
                         <div class="input-group">
                             <span class="input-group-addon"><i class="fa fa-phone"></i></span> 
                             <input type="text" class="form-control input-xs" name="nuevoTelefono" id="nuevoTelefono" placeholder="Ingresar teléfono" onfocus=" obtieneFoco('#nuevoTelefono')" onblur = "pierdeFoco('#nuevoTelefono')" required>
                         </div>
                      </div>
                  </div>
              </div> <!-- Fin Linea 1 --> 
              <br>
              <div class="row"> <!-- SEGUNDA LINEA DE ENTRADA -->
                 <div class="col-xs-12 col-md-6"> 
                      <!-- ENTRADA PARA EL EMAIL -->
                      <div class="form-group">
                          <div class="input-group">
                             <span class="input-group-addon"><i class="fa fa-envelope"></i></span> 
                             <input type="text" class="form-control input-xs" id="nuevoEmail" name="nuevoEmail" placeholder="Ingresar email" onfocus=" obtieneFoco('#nuevoEmail')" onblur = "pierdeFoco('#nuevoEmail')" >
                          </div>
                      </div>
                  </div>
          
                  <div class="col-xs-12 col-md-6">
                      <!-- ENTRADA PARA EL DIRECCION -->
                      <div class="form-group">
                         <div class="input-group">
                             <span class="input-group-addon"><i class="fa fa-file"></i></span> 
                             <input type="text" class="form-control input-xs" name="nuevaDireccion" id="nuevaDireccion" placeholder="Ingresar dirección" onfocus=" obtieneFoco('#nuevaDireccion')" onblur = "pierdeFoco('#nuevaDireccion')" >
                         </div>
                      </div>
                  </div>
              </div> <!-- Fin Linea 1 -->

          </div> <!-- Fin box modal Body -->
        </div>  <!-- Fin modal Body -->      
        <!--=====================================
        PIE DEL MODAL
        ======================================-->
        <div class="modal-footer">
          <div class="row"> <!-- CUARTA LINEA DE ENTRADA -->
              <div class="col-xs-6 col-md-2">
                <button type="button" class="btn btn-warning pull-left" data-dismiss="modal">
                  <i class="fa fa-mail-reply"> 
                     Regresar ..
                  </i>
                </button>       
              </div><!--fin item 1-->
             
              <div class="col-xs-1 col-md-7">
              </div><!--fin item 2-->
         
              <div class="col-xs-6 col-md-2">
                <button type="submit" class="btn btn-primary">
                  <i class="fa fa-save">   
                    Guardar Cliente 
                  </i>   
                </button> 
              </div><!--fin item 3-->  
            </div> <!-- FIN CUARTA LINEA -->  
         </div>
      </form>
        <?php  
          $crearCliente = new ControladorClientes();
          $crearCliente -> ctrCrearClienteE();
        ?>    
    </div> <!-- FIN CLASS MODEL CONTENT -->
  </div> <!-- FIN MODAL DIALOG -->
</div> <!-- FIN MODAL AGREGAR CLIENTE -->

<!--=====================================
MODAL BUSCAR CLIENTE
======================================-->
<div id="modalBuscarCliente" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header" style="background:#3c8dbc; color:white"> 
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Buscar Cliente</h4>
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
                                 <button class="btn btn-xs btn-warning btnAgregarCliente" nIdCliente="'.$value["id"].'" nCliente="'.$value["nombre"].'" data-dismiss="modal" ><i class="fa fa-check"> Agregar</i></button>      
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
   