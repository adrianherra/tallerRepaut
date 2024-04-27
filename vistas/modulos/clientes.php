<div class="content-wrapper">

  <section class="content-header">
    <h1>Administrar clientes</h1>
    
    <ol class="breadcrumb">
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      <li class="active">Administrar clientes</li>
    </ol>
   
  </section> <!--Fin content-header -->

  <section class="content">
    <div class="box">

      <div class="box-header with-border">
         <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarCliente">
          <i class="fa fa-plus"> 
             Agregar
          </i>
         </button>
      </div>

      <div class="box-body">
         <table class="table table-bordered table-condensed table-striped dt-responsive tablas" width="100%">
              <thead class="bg-primary text-light">
                 <tr>
                    <th style="width:10px">#</th>
                    <th>Nombre</th>
                    <th style="width:120px">Teléfono</th>
                    <th>Email</th>
                    <th>Dirección</th>
                    <th style="width:120px">Acciones</th>
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
                           <td class="text-uppercase">'.$value["nombre"].'</td>
                           <td>'.$value["telefono"].'</td> 
                           <td>'.$value["email"].'</td>
                           <td>'.$value["direccion"].'</td> 
                           <td>
                              <div class="btn-group">';
                                if($_SESSION["perfil"] == "Administrador"){
                                  echo'<button class="btn btn-xs btn-warning btnEditarCliente" idCliente="'.$value["id"].'" data-toggle="modal" data-target="#modalEditarCliente"><i class="fa fa-pencil"></i></button>      
                                  <button class="btn btn-xs btn-danger btnEliminarCliente" idCliente="'.$value["id"].'"><i class="fa fa-times"></i></button>';
                                }else {
                                   echo'<i class="fa fa-user"></i>';   
                                }// fin if
                          echo'</div>  
                           </td>    
                       </tr>';
                     } // fin for
              
                  ?>
             </tbody> 
        </table> <!--Fin table -->

      </div> <!--Fin div box-body -->

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
                 <div class="col-xs-12 col-sm-6"> 
                      <!-- ENTRADA PARA EL NOMBRE -->
                      <div class="form-group">
                          <div class="input-group">
                             <span class="input-group-addon"><i class="fa fa-user"></i></span> 
                             <input type="text" class="form-control input-xs" id="nuevoCliente" name="nuevoCliente" placeholder="Ingresar nombre" onfocus=" obtieneFoco('#nuevoCliente')" onblur = "pierdeFoco('#nuevoCliente')" required>
                          </div>
                      </div>
                  </div>
   
                  <div class="col-xs-12 col-sm-4">
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
                 <div class="col-xs-12 col-sm-6"> 
                      <!-- ENTRADA PARA EL EMAIL -->
                      <div class="form-group">
                          <div class="input-group">
                             <span class="input-group-addon"><i class="fa fa-envelope"></i></span> 
                             <input type="text" class="form-control input-xs" id="nuevoEmail" name="nuevoEmail" placeholder="Ingresar email" onfocus=" obtieneFoco('#nuevoEmail')" onblur = "pierdeFoco('#nuevoEmail')" >
                          </div>
                      </div>
                  </div>
          
                  <div class="col-xs-12 col-sm-6">
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
              <div class="col-xs-11 col-sm-2">
                <button type="button" class="btn btn-warning pull-left" data-dismiss="modal">
                  <i class="fa fa-mail-reply"> 
                     Regresar ..
                  </i>
                </button>       
              </div><!--fin item 1-->
             
              <div class="col-xs-1 col-sm-7">
              </div><!--fin item 2-->
         
              <div class="col-xs-12 col-sm-2">
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
          $crearCliente -> ctrCrearCliente();
        ?>  
    </div> <!-- FIN CLASS MODEL CONTENT -->
  </div> <!-- FIN MODAL DIALOG -->
</div> <!-- FIN MODAL AGREGAR CLIENTE -->

<!--=====================================
MODAL EDITAR CLIENTE
======================================-->
<div id="modalEditarCliente" class="modal fade" role="dialog">
  <div class="modal-dialog" style="width: 60% !important;">
    <div class="modal-content">
      <form role="form" method="post" enctype="multipart/form-data" onKeypress="if(event.keyCode == 13) event.returnValue = false;">
        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->
        <div class="modal-header" style="background:#3c8dbc; color:white">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Editar cliente</h4>
        </div>
        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->
        <div class="modal-body">
           <div class="box-body">
              <div class="row"> <!-- PRIMERA LINEA DE ENTRADA -->
                 <div class="col-xs-12 col-sm-6"> 
                      <!-- ENTRADA PARA EL NOMBRE -->
                      <div class="form-group">
                          <div class="input-group">
                             <span class="input-group-addon"><i class="fa fa-user"></i></span> 
                             <input type="text" class="form-control input-xs" id="editaCliente" name="editaCliente"  required>
                          </div>
                      </div>
                  </div>
   
                  <div class="col-xs-12 col-sm-4">
                      <!-- ENTRADA PARA EL TELEFONO -->
                      <div class="form-group">
                         <div class="input-group">
                             <span class="input-group-addon"><i class="fa fa-phone"></i></span> 
                             <input type="text" class="form-control input-xs" name="editaTelefono" id="editaTelefono" placeholder="Ingresar teléfono">
                         </div>
                      </div>
                  </div>
              </div> <!-- Fin Linea 1 --> 
              <br>
              <div class="row"> <!-- SEGUNDA LINEA DE ENTRADA -->
                 <div class="col-xs-12 col-sm-6"> 
                      <!-- ENTRADA PARA EL EMAIL -->
                      <div class="form-group">
                          <div class="input-group">
                             <span class="input-group-addon"><i class="fa fa-envelope"></i></span> 
                             <input type="text" class="form-control input-xs" id="editaEmail" name="editaEmail" placeholder="Ingresar email" >
                          </div>
                      </div>
                  </div>
          
                  <div class="col-xs-12 col-sm-6">
                      <!-- ENTRADA PARA EL DIRECCION -->
                      <div class="form-group">
                         <div class="input-group">
                             <span class="input-group-addon"><i class="fa fa-file"></i></span> 
                             <input type="text" class="form-control input-xs" name="editaDireccion" id="editaDireccion" placeholder="Ingresar dirección" >
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
              <div class="col-xs-11 col-sm-2">
                <button type="button" class="btn btn-info pull-left" data-dismiss="modal">Regresar ..</button>       
              </div><!--fin item 1-->
             
              <div class="col-xs-1 col-sm-8">
              </div><!--fin item 2-->
         
              <div class="col-xs-12 col-sm-2">
                <button type="submit" class="btn btn-primary">Actualiza Cliente</button> 
              </div><!--fin item 3-->  
            </div> <!-- FIN CUARTA LINEA -->  
         </div>
      </form>       
        <?php  
          $editarCliente = new ControladorClientes();
          $editarCliente -> ctrEditarCliente();
        ?>  
    </div> <!-- FIN CLASS MODEL CONTENT -->
  </div> <!-- FIN MODAL DIALOG -->
</div> <!-- FIN MODAL EDITAR CLIENTE -->



<!--======================
    ELIMINAR CLIENTE
-->
<?php 
      
  $borrarCliente = new ControladorClientes();
  $borrarCliente ->ctrBorrarCliente();

?>    