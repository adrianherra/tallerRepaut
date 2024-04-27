<div class="content-wrapper">

  <section class="content-header">
    <h1>Administrar aseguradoras</h1>
    
    <ol class="breadcrumb">
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      <li class="active">Administrar aseguradoras</li>
    </ol>
   
  </section> <!--Fin content-header -->

  <section class="content">
    <div class="box">

      <div class="box-header with-border">
         <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarAseguradora">
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
                    <th style="width:120px">Acciones</th>
                 </tr> 
              </thead>
              <tbody>
                  <?php
                      //$clientes = ControladorClientes::ctrMostrarClientes($item, $valor);
                      $aseguradoras = ModeloOrdenes::mdlMostrarAseguradoras();

                      foreach ($aseguradoras as $key => $value) {
                        echo ' <tr>
                           <td>'.($key+1).'</td>
                           <td class="text-uppercase">'.$value["Nombre"].'</td>
                           <td>
                              <div class="btn-group">';
                                if($_SESSION["perfil"] == "Administrador"){
                                  echo'<button class="btn btn-xs btn-warning btnEditarAseguradora" idAseguradora="'.$value["id"].'" data-toggle="modal" data-target="#modalEditarAseguradora"><i class="fa fa-pencil"></i></button>      
                                  <button class="btn btn-xs btn-danger btnEliminarAseguradora" idAseguradora="'.$value["id"].'"><i class="fa fa-times"></i></button>';
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
<div id="modalAgregarAseguradora" class="modal fade" role="dialog">
  <div class="modal-dialog" style="width: 65% !important;">
    <div class="modal-content">
      <form role="form" method="post" enctype="multipart/form-data" onKeypress="if(event.keyCode == 13) event.returnValue = false;">
        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->
        <div class="modal-header" style="background:#3c8dbc; color:white">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Agregar aseguradora</h4>
        </div>
        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->
        <div class="modal-body">
           <div class="box-body">
              <div class="row"> <!-- PRIMERA LINEA DE ENTRADA -->
                 <div class="col-xs-12 col-sm-12"> 
                      <!-- ENTRADA PARA EL NOMBRE -->
                      <div class="form-group">
                          <div class="input-group">
                             <span class="input-group-addon"><i class="fa fa-user"></i></span> 
                             <input type="text" class="form-control input-xs" id="nuevaAseguradora" name="nuevaAseguradora" placeholder="Ingresar nombre" onfocus=" obtieneFoco('#nuevaAseguradora')" onblur = "pierdeFoco('#nuevaAseguradora')" required>
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
                    Guardar Aseguradora 
                  </i>   
                </button> 
              </div><!--fin item 3-->  
            </div> <!-- FIN CUARTA LINEA -->  
         </div>
      </form>
        <?php  
          $crearAseguradora = new ControladorAseguradoras();
          $crearAseguradora -> ctrCrearAseguradora();
        ?>  
    </div> <!-- FIN CLASS MODEL CONTENT -->
  </div> <!-- FIN MODAL DIALOG -->
</div> <!-- FIN MODAL AGREGAR ASEGURADORA -->

<!--=====================================
MODAL EDITAR ASEGURADORA
======================================-->
<div id="modalEditarAseguradora" class="modal fade" role="dialog">
  <div class="modal-dialog" style="width: 60% !important;">
    <div class="modal-content">
      <form role="form" method="post" enctype="multipart/form-data" onKeypress="if(event.keyCode == 13) event.returnValue = false;">
        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->
        <div class="modal-header" style="background:#3c8dbc; color:white">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Editar aseguradora</h4>
        </div>
        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->
        <div class="modal-body">
           <div class="box-body">
              <div class="row"> <!-- PRIMERA LINEA DE ENTRADA -->
                 <div class="col-xs-12 col-sm-12"> 
                      <!-- ENTRADA PARA EL NOMBRE -->
                      <div class="form-group">
                          <div class="input-group">
                             <span class="input-group-addon"><i class="fa fa-user"></i></span> 
                             <input type="text" class="form-control input-xs" id="editaAseguradora" name="editaAseguradora"  required>
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
                <button type="submit" class="btn btn-primary">Actualiza Aseguradora</button> 
              </div><!--fin item 3-->  
            </div> <!-- FIN CUARTA LINEA -->  
         </div>
      </form>       
        <?php  
          $editarAseguradora = new ControladorAseguradora();
          $editarAseguradora -> ctrEditarAseguradora();
        ?>  
    </div> <!-- FIN CLASS MODEL CONTENT -->
  </div> <!-- FIN MODAL DIALOG -->
</div> <!-- FIN MODAL EDITAR CLIENTE -->



<!--======================
    ELIMINAR CLIENTE
-->
<?php 
      
  $borrarAseguradora = new ControladorAseguradora();
  $borrarAseguradora ->ctrBorrarAseguradora();

?>    