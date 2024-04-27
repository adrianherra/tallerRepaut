<div class="content-wrapper">

  <section class="content-header">
    <h1>Administrar Proveedores</h1>
    
    <ol class="breadcrumb">
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      <li class="active">Administrar Proveedores</li>
    </ol>
   
  </section> <!--Fin content-header -->

  <section class="content">
    <div class="box">

      <div class="box-header with-border">
        <div class="row"> 
          <div class="col-xs-12 col-sm-1">
            <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarProveedor">
              <i class="fa fa-plus">
                Agregar
              </i>
            </button>
          </div>
          <div class="col-xs-12 col-sm-10">
          </div>
          <div class="col-xs-12 col-sm-1">
            <form method="post" action="reportes/reporteProveedores.php">  
              <button type="submit" class="btn btn-danger pull-right" formtarget="_blank">
                <i class="fa fa-print">
                  Reporte
                </i>        
              </button>
            </form>
          </div>
        </div> 
      </div>

      <div class="box-body">
         <table class="table table-bordered table-condensed table-striped dt-responsive tablaProveedores" width="100%">
              <thead class="bg-primary text-light">
                 <tr>
                    <th style="width:10px">#</th>
                    <th>Nombre</th>
                    <th style="width:120px">Teléfono</th>
                    <th>Email</th>
                    <th>Contacto</th>
                    <th>Dirección</th>
                    <th>Observación</th>
                    <th style="width:120px">Acciones</th>
                 </tr> 
              </thead>
              <tbody>
                  <?php
                      $item = null;  
                      $valor = null;
                      $clientes = ControladorProveedores::ctrMostrarProveedores($item, $valor);

                      foreach ($clientes as $key => $value) {
                        echo ' <tr>
                           <td>'.($key+1).'</td>
                           <td class="text-uppercase">'.$value["nombre"].'</td>
                           <td>'.$value["telefono"].'</td> 
                           <td>'.$value["email"].'</td>
                           <td>'.$value["contacto"].'</td>
                           <td>'.$value["direccion"].'</td> 
                           <td>'.$value["observacion"].'</td>
                           <td> 
                              <div class="btn-group">';
                                if($_SESSION["perfil"] == "Administrador"){
                                  echo'<button class="btn btn-xs btn-warning btnEditarProveedor" idProveedor="'.$value["id"].'" data-toggle="modal" data-target="#modalEditarProveedor"><i class="fa fa-pencil"></i></button>      
                                  <button class="btn btn-xs btn-danger btnEliminarProveedor" idProveedor="'.$value["id"].'"><i class="fa fa-times"></i></button>';
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
MODAL AGREGAR PROVEEDOR
======================================-->
<div id="modalAgregarProveedor" class="modal fade" role="dialog">
  <div class="modal-dialog" style="width: 70% !important;">
    <div class="modal-content">
      <form role="form" method="post" enctype="multipart/form-data" onKeypress="if(event.keyCode == 13) event.returnValue = false;">
        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->
        <div class="modal-header" style="background:#3c8dbc; color:white">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Agregar Proveedor</h4>
        </div>
        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->
        <div class="modal-body">
           <div class="box-body">
              <div class="row"> <!-- PRIMERA LINEA DE ENTRADA -->
                 <div class="col-xs-12 col-sm-4"> 
                      <!-- ENTRADA PARA EL NOMBRE -->
                      <div class="form-group">
                          <div class="input-group">
                             <span class="input-group-addon"><i class="fa fa-steam"></i></span> 
                             <input type="text" class="form-control input-xs" id="nProveedor" name="nProveedor" placeholder="Ingresar nombre" onfocus=" obtieneFoco('#nProveedor')" onblur = "pierdeFoco('#nProveedor')" required>
                          </div>
                      </div>
                  </div>
                 
                  <div class="col-xs-12 col-sm-3">
                      <!-- ENTRADA PARA EL TELEFONO -->
                      <div class="form-group">
                         <div class="input-group">
                             <span class="input-group-addon"><i class="fa fa-phone"></i></span> 
                             <input type="text" class="form-control input-xs" name="nTelefono" id="nTelefono" placeholder="Ingresar teléfono" onfocus=" obtieneFoco('#nTelefono')" onblur = "pierdeFoco('#nTelefono')" required>
                         </div>
                      </div>
                  </div>
                  
              </div> <!-- Fin Linea 1 --> 
              <div class="row"> <!-- SEGUNDA LINEA DE ENTRADA -->
                 <div class="col-xs-12 col-sm-6"> 
                      <!-- ENTRADA PARA EL EMAIL -->
                      <div class="form-group">
                          <div class="input-group">
                             <span class="input-group-addon"><i class="fa fa-envelope"></i></span> 
                             <input type="email" class="form-control input-xs" id="nEmail" name="nEmail" placeholder="Ingresar email" onfocus=" obtieneFoco('#nEmail')" onblur = "pierdeFoco('#nEmail')" >
                          </div>
                      </div>
                  </div>
          
                  <div class="col-xs-12 col-sm-6">
                      <!-- ENTRADA PARA EL DIRECCION -->
                      <div class="form-group">
                         <div class="input-group">
                             <span class="input-group-addon"><i class="fa fa-user"></i></span> 
                             <input type="text" class="form-control input-xs" name="nContacto" id="nContacto" placeholder="Ingresar contacto" onfocus=" obtieneFoco('#nContacto')" onblur = "pierdeFoco('#nContacto')" >
                         </div>
                      </div>
                  </div>
              </div> <!-- Fin Linea 2 -->
              <div class="row"> <!-- TERCERA LINEA DE ENTRADA -->
                <div class="col-xs-12 col-sm-6">
                  <!-- ENTRADA PARA EL DIRECCION -->
                  <div class="form-group">
                    <div class="input-group">
                      <span class="input-group-addon"><i class="fa fa-building-o"></i></span> 
                      <input type="text" class="form-control input-xs" name="nDireccion" id="nDireccion" placeholder="Ingresar dirección" onfocus=" obtieneFoco('#nDireccion')" onblur = "pierdeFoco('#nDireccion')" >
                    </div>
                  </div>
                </div>        
                <div class="col-xs-12 col-sm-6">
                  <!-- ENTRADA PARA EL OBSERVACION -->
                  <div class="form-group">
                    <div class="input-group">
                      <span class="input-group-addon"><i class="fa fa-file"></i></span> 
                      <input type="text" class="form-control input-xs" name="nObservacion" id="nObservacion" placeholder="Ingresar observación" onfocus=" obtieneFoco('#nObservacion')" onblur = "pierdeFoco('#nObservacion')" >
                    </div>
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
                    Guardar
                  </i>  
                </button> 
              </div><!--fin item 3-->  
            </div> <!-- FIN CUARTA LINEA -->  
         </div>
      </form>
        <?php  
          $crearProveedor = new ControladorProveedores();
          $crearProveedor -> ctrCrearProveedor();
        ?>  
    </div> <!-- FIN CLASS MODEL CONTENT -->
  </div> <!-- FIN MODAL DIALOG -->
</div> <!-- FIN MODAL AGREGAR PROVEEDOR -->

<!--=====================================
MODAL EDITAR PROVEEDOR
======================================-->
<div id="modalEditarProveedor" class="modal fade" role="dialog">
  <div class="modal-dialog" style="width: 70% !important;">
    <div class="modal-content">
      <form role="form" method="post" enctype="multipart/form-data" onKeypress="if(event.keyCode == 13) event.returnValue = false;">
        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->
        <div class="modal-header" style="background:#3c8dbc; color:white">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Editar Proveedor</h4>
        </div>
        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->
        <div class="modal-body">
           <div class="box-body">
              <div class="row"> <!-- PRIMERA LINEA DE ENTRADA -->
                 <div class="col-xs-12 col-sm-4"> 
                      <!-- ENTRADA PARA EL NOMBRE -->
                      <div class="form-group">
                          <div class="input-group">
                             <span class="input-group-addon"><i class="fa fa-steam"></i></span> 
                             <input type="hidden" id="idProveedor" name="idProveedor">
                             <input type="text" class="form-control input-xs" id="eProveedor" name="eProveedor" placeholder="Ingresar nombre" onfocus=" obtieneFoco('#eProveedor')" onblur = "pierdeFoco('#eProveedor')" required>
                          </div>
                      </div>
                  </div>
                 
                  <div class="col-xs-12 col-sm-3">
                      <!-- ENTRADA PARA EL TELEFONO -->
                      <div class="form-group">
                         <div class="input-group">
                             <span class="input-group-addon"><i class="fa fa-phone"></i></span> 
                             <input type="text" class="form-control input-xs" name="eTelefono" id="eTelefono" placeholder="Ingresar teléfono" onfocus=" obtieneFoco('#eTelefono')" onblur = "pierdeFoco('#eTelefono')" required>
                         </div>
                      </div>
                  </div>
                  
              </div> <!-- Fin Linea 1 --> 
              <div class="row"> <!-- SEGUNDA LINEA DE ENTRADA -->
                 <div class="col-xs-12 col-sm-6"> 
                      <!-- ENTRADA PARA EL EMAIL -->
                      <div class="form-group">
                          <div class="input-group">
                             <span class="input-group-addon"><i class="fa fa-envelope"></i></span> 
                             <input type="email" class="form-control input-xs" id="eEmail" name="eEmail" placeholder="Ingresar email" onfocus=" obtieneFoco('#eEmail')" onblur = "pierdeFoco('#eEmail')" >
                          </div>
                      </div>
                  </div>
          
                  <div class="col-xs-12 col-sm-6">
                      <!-- ENTRADA PARA EL DIRECCION -->
                      <div class="form-group">
                         <div class="input-group">
                             <span class="input-group-addon"><i class="fa fa-user"></i></span> 
                             <input type="text" class="form-control input-xs" name="eContacto" id="eContacto" placeholder="Ingresar contacto" onfocus=" obtieneFoco('#eContacto')" onblur = "pierdeFoco('#eContacto')" >
                         </div>
                      </div>
                  </div>
              </div> <!-- Fin Linea 2 -->
              <div class="row"> <!-- TERCERA LINEA DE ENTRADA -->
                <div class="col-xs-12 col-sm-6">
                  <!-- ENTRADA PARA EL DIRECCION -->
                  <div class="form-group">
                    <div class="input-group">
                      <span class="input-group-addon"><i class="fa fa-building-o"></i></span> 
                      <input type="text" class="form-control input-xs" name="eDireccion" id="eDireccion" placeholder="Ingresar dirección" onfocus=" obtieneFoco('#eDireccion')" onblur = "pierdeFoco('#eDireccion')" >
                    </div>
                  </div>
                </div>
                <div class="col-xs-12 col-sm-6">
                  <!-- ENTRADA PARA EL OBSERVACION -->
                  <div class="form-group">
                    <div class="input-group">
                      <span class="input-group-addon"><i class="fa fa-file"></i></span> 
                      <input type="text" class="form-control input-xs" name="eObservacion" id="eObservacion" placeholder="Ingresar observación" onfocus=" obtieneFoco('#eObservacion')" onblur = "pierdeFoco('#eObservacion')" >
                    </div>
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
          $editarProveedor = new ControladorProveedores();
          $editarProveedor -> ctrEditarProveedor();
        ?>  
    </div> <!-- FIN CLASS MODEL CONTENT -->
  </div> <!-- FIN MODAL DIALOG -->
</div> <!-- FIN MODAL EDITAR PROVEEDOR -->

<!--======================
    ELIMINAR PROVEEDOR
-->   
<?php 
      
  $borrarProveedor = new ControladorProveedores();
  $borrarProveedor ->ctrBorrarProveedor();

?>    