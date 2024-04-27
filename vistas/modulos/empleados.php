<div class="content-wrapper">
  <section class="content-header">
    <h1>
      Mantenimiento Empleados
    </h1>
    <ol class="breadcrumb">
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      <li class="active">Mantenimiento Empleados</li>
    </ol>
  </section> <!--Fin de la seccion-->

  <section class="content">
    <div class="box">
      <div class="box-header with-border">
        <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarEmpleado">
           Agregar Empleado
        </button>
      </div> <!-- Fin box-header-->

      <div class="box-body">
        <table class="table table-bordered table-condensed table-striped dt-responsive tablaEmpleados" width="100%">
          <thead>
            <tr>
              <th style="width:10px">#</th>
              <th>Nombre</th>
              <th>Cédula</th>
              <th>Télefono</th>
              <th>Puesto</th>
              <th>Salario</th>
              <th>Jornada</th>
              <th>Estado</th>
              <th>Acciones</th>
            </tr> 
          </thead>
          <tbody>
            <?php
              $item = null;
              $valor = null;

              $empleados = ControladorEmpleados::ctrMostrarEmpleados($item, $valor);
              
              foreach ($empleados as $key => $value) {
                  
                if($value["estado"] != "Desactivo"){
                  $estado = '<button class="btn btn-info btn-xs btnActivarE" idEmpleado="'.$value["id"].'" estadoEmpleado="Activo">Activo</button>';
                }else{
                  $estado = '<button class="btn btn-success btn-xs btnActivarE" idEmpleado="'.$value["id"].'" estadoEmpleado="Desactivo">Desactivo</button>';
                } // fin if             
                       
                echo ' <tr>
                          <td>'.($key+1).'</td>
                          <td class="text-uppercase">'.$value["nombre"].'</td>
                          <td>'.$value["cedula"].'</td>
                          <td>'.$value["telefono"].'</td>
                          <td>'.$value["puesto"].'</td>
                          <td>'.$value["salario"].'</td>
                          <td>'.$value["jornada"].'</td>
                          <td>'.$estado.'</td>
                          <td>
                            <div class="btn-group">';
                              if($_SESSION["perfil"] == "Administrador"){
                                 echo' <button class="btn btn-xs btn-warning btnEditarEmpleado" idEmpleado="'.$value["id"].'" data-toggle="modal" data-target="#modalEditarEmpleado"><i class="fa fa-pencil"></i></button>

                                <button class="btn btn-xs btn-danger btnEliminarEmpleado" idEmpleado="'.$value["id"].'"><i class="fa fa-times"></i></button>';
                              }else {
                                echo '<i class="fa fa-th"></i>';
                              }//fin if
                         echo' </div>  
                           </td>
                      </tr>';
              } // fin for

            ?>
          </tbody>
           <tfoot style="color:#FF00FF;">
              <tr>
                <th colspan="6" style="text-align:center;">Totales :</th>
                <th colspan="3"></th>
              </tr>
           </tfoot> 
        </table>
      </div>
    </div>
  </section>
</div>

<!--=====================================
MODAL AGREGAR EMPLEADO
======================================-->
  
<div id="modalAgregarEmpleado" class="modal fade" role="dialog">
   <div class="modal-dialog" style="width: 80% !important;">
      <div class="modal-content">
          <form role="form" method="post" enctype="multipart/form-data" onKeypress="if(event.keyCode == 13) event.returnValue = false;">
              <!--=====================================
                      CABEZA DEL MODAL
              ======================================-->
              <div class="modal-header" style="background:#3c8dbc; color:white">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title">Agregar Empleado</h4>
              </div>
              <!--=====================================
                      CUERPO DEL MODAL
              ======================================-->
              <div class="modal-body">
                <div class="box-body">
                    <!--========================================================================== -->
                    <div class="row"> <!-- PRIMERA LINEA DE ENTRADA -->
                        
                        <div class="col-xs-12 col-sm-6">
                           <!-- ENTRADA NOMBRE-->
                           <div class="input-group">
                               <span class="input-group-addon"><i class="fa fa-user"></i></span>
                               <input type="text" class="form-control input-xs" name="nEmpleado" id="nEmpleado"  placeholder="Nombre Completo" onfocus=" obtieneFoco('#nEmpleado')" onblur = "pierdeFoco('#nEmpleado')" onkeypress="siguiente(event,'#nCedula')" >
                           </div>
                        </div><!--fin  item 1-->

                        <div class="col-xs-12 col-sm-3">
                            <!-- ENTRADA CEDULA -->
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-credit-card"></i></span>
                                <input type="text" class="form-control input-xs" name="nCedula" id="nCedula" onfocus="obtieneFoco('#nCedula')" onblur = "pierdeFoco('#nCedula')" placeholder="Cédula" onkeypress="siguiente(event,'#nTelefono')">
                            </div>
                        </div><!--fin  item 2-->
  
                        <div class="col-xs-12 col-sm-3"> 
                           <!-- ENTRADA TELEFONO-->
                           <div class="form-group">
                              <div class="input-group">
                                 <span class="input-group-addon"><i class="fa fa-phone"></i></span> 
                                 <input type="text" class="form-control input-xs" id="nTelefono" name="nTelefono"  placeholder="Télefono" onfocus=" obtieneFoco('#nTelefono')" onblur = "pierdeFoco('#nTelefono')" >
                              </div>
                           </div>    
                        </div><!--fin  item 3-->

                   </div> <!-- FIN PRIMERA LINEA -->       
                    
                    <!--========================================================================== -->
                    <div class="row"> <!-- SEGUNDA LINEA DE ENTRADA -->
                        
                        <div class="col-xs-12 col-sm-4">
                           <!-- ENTRADA NACIMIENTO-->
                           <div class="input-group">
                               <span class="input-group-addon"><i class="fa fa-calendar"> F.Nacimiento</i></span>
                               <input type="date" class="form-control input-xs" name="nNacimiento" id="nNacimiento" onkeypress="siguiente(event,'#nIngreso')" >
                           </div>
                        </div><!--fin  item 1-->

                        <div class="col-xs-12 col-sm-4">
                            <!-- ENTRADA INGRESO -->
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-calendar"> F.Ingreso</i></span>
                                <input type="date" class="form-control input-xs" name="nIngreso" id="nIngreso" onkeypress="siguiente(event,'#nPuesto')">
                            </div>
                        </div><!--fin  item 2-->
  
                        <div class="col-xs-12 col-sm-4"> 
                           <!-- ENTRADA PUESTO-->
                           <div class="form-group">
                              <div class="input-group">
                                 <span class="input-group-addon"><i class="fa fa-street-view"></i></span> 
                                 <input type="text" class="form-control input-xs" id="nPuesto" name="nPuesto"  placeholder="Puesto" onfocus=" obtieneFoco('#nPuesto')" onblur = "pierdeFoco('#nPuesto')" >
                              </div>
                           </div>    
                        </div><!--fin  item 3-->

                   </div> <!-- FIN SEGUNDA LINEA --> 
                   
                   <!--========================================================================== -->
                    <div class="row"> <!-- TERCERA DE ENTRADA -->
                        
                        <div class="col-xs-12 col-sm-3">
                           <!-- ENTRADA SALARIO-->
                           <div class="input-group">
                               <span class="input-group-addon"><i class="fa fa-money"></i></span>
                               <input type="text" class="form-control input-xs" name="nSalario" id="nSalario"  placeholder=" Salario" onfocus=" obtieneFoco('#nSalario')" onblur = "pierdeFoco('#nSalario')" onkeypress="siguiente(event,'#nJornada')" >
                           </div>
                        </div><!--fin  item 1-->

                        <div class="col-xs-12 col-sm-3">
                            <!-- ENTRADA JORNADA -->
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-asterisk"> Jornada</i></span>
                                <select class= "form-control input-xs" name="nJornada" id="nJornada">
                                    <option value="Semanal">Semanal</option>
                                    <option value="Quincenal">Quincenal</option>
                                    <option value="Mensual">Mensual</option>
                                </select>
                            </div>
                        </div><!--fin  item 2-->
  
                        <div class="col-xs-12 col-sm-6"> 
                           <!-- ENTRADA EMAIL-->
                           <div class="form-group">
                              <div class="input-group">
                                 <span class="input-group-addon"><i class="fa fa-at"></i></span> 
                                 <input type="email" class="form-control input-xs" id="nEmail" name="nEmail"  placeholder="Email" onfocus=" obtieneFoco('#nEmail')" onblur = "pierdeFoco('#nEmail')" >
                              </div>
                           </div>    
                        </div><!--fin  item 3-->

                   </div> <!-- FIN TERCERA LINEA -->       
                  
                    <!--========================================================================== -->
                    <div class="row"> <!-- CUARTA  DE ENTRADA -->
                        
                        <div class="col-xs-12 col-sm-6">
                           <!-- ENTRADA SALARIO-->
                           <div class="input-group">
                               <span class="input-group-addon"><i class="fa fa-sun-o"></i></span>
                               <input type="text" class="form-control input-xs" name="nDireccion" id="nDireccion"  placeholder=" Dirección" onfocus=" obtieneFoco('#nDireccion')" onblur = "pierdeFoco('#nDireccion')" onkeypress="siguiente(event,'#nObservacion')" >
                           </div>
                        </div><!--fin  item 1-->

                        <div class="col-xs-12 col-sm-6">
                            <!-- ENTRADA JORNADA -->
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-commenting-o"></i></span>
                                <input type="text" class="form-control input-xs" name="nObservacion" id="nObservacion" onfocus="obtieneFoco('#nObservacion')" onblur = "pierdeFoco('#nObservacion')" placeholder="Observación">
                            </div>
                        </div><!--fin  item 2-->
  
                       
                   </div> <!-- FIN CUARTA LINEA -->             
      
                 </div> <!--Final box-body-->
              </div> <!--Final modal-body-->
              <!--=====================================
                        PIE DEL MODAL
              ======================================-->
              <div class="modal-footer">
                <button type="button" class="btn btn-info pull-left" data-dismiss="modal">Regresar..</button>
                <button type="submit" class="btn btn-primary">Guardar Empleado</button>
              </div>
              <?php
                $crearEmpleado = new ControladorEmpleados();
                $crearEmpleado -> ctrCrearEmpleado();
              ?>
    
        </form>
     </div>
  </div>
</div>

<!--=====================================
MODAL EDITAR EMPLEADO
======================================-->
  
<div id="modalEditarEmpleado" class="modal fade" role="dialog">
   <div class="modal-dialog" style="width: 80% !important;">
      <div class="modal-content">
          <form role="form" method="post" enctype="multipart/form-data" onKeypress="if(event.keyCode == 13) event.returnValue = false;">
              <!--=====================================
                      CABEZA DEL MODAL
              ======================================-->
              <div class="modal-header" style="background:#3c8dbc; color:white">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title">Editar Empleado</h4>
              </div>
              <!--=====================================
                      CUERPO DEL MODAL
              ======================================-->
              <div class="modal-body">
                <div class="box-body">
                    <!--========================================================================== -->
                    <div class="row"> <!-- PRIMERA LINEA DE ENTRADA -->
                        
                        <div class="col-xs-12 col-sm-6">
                           <!-- ENTRADA NOMBRE-->
                           <div class="input-group">
                               <span class="input-group-addon"><i class="fa fa-user"></i></span>
                               <input type="text" class="form-control input-xs" name="eEmpleado" id="eEmpleado"  placeholder="Nombre Completo" onfocus=" obtieneFoco('#eEmpleado')" onblur = "pierdeFoco('#eEmpleado')" onkeypress="siguiente(event,'#eCedula')" >
                           </div>
                        </div><!--fin  item 1-->

                        <div class="col-xs-12 col-sm-3">
                            <!-- ENTRADA CEDULA -->
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-credit-card"></i></span>
                                <input type="text" class="form-control input-xs" name="eCedula" id="eCedula" onfocus="obtieneFoco('#eCedula')" onblur = "pierdeFoco('#eCedula')" placeholder="Cédula" onkeypress="siguiente(event,'#eTelefono')">
                            </div>
                        </div><!--fin  item 2-->
  
                        <div class="col-xs-12 col-sm-3"> 
                           <!-- ENTRADA TELEFONO-->
                           <div class="form-group">
                              <div class="input-group">
                                 <span class="input-group-addon"><i class="fa fa-phone"></i></span> 
                                 <input type="text" class="form-control input-xs" id="eTelefono" name="eTelefono"  placeholder="Télefono" onfocus=" obtieneFoco('#eTelefono')" onblur = "pierdeFoco('#eTelefono')" >
                              </div>
                           </div>    
                        </div><!--fin  item 3-->

                   </div> <!-- FIN PRIMERA LINEA -->       
                    
                    <!--========================================================================== -->
                    <div class="row"> <!-- SEGUNDA LINEA DE ENTRADA -->
                        
                        <div class="col-xs-12 col-sm-4">
                           <!-- ENTRADA NACIMIENTO-->
                           <div class="input-group">
                               <span class="input-group-addon"><i class="fa fa-calendar"> F.Nacimiento</i></span>
                               <input type="date" class="form-control input-xs" name="eNacimiento" id="eNacimiento" onkeypress="siguiente(event,'#eIngreso')" >
                           </div>
                        </div><!--fin  item 1-->

                        <div class="col-xs-12 col-sm-4">
                            <!-- ENTRADA INGRESO -->
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-calendar"> F.Ingreso</i></span>
                                <input type="date" class="form-control input-xs" name="eIngreso" id="eIngreso" onkeypress="siguiente(event,'#ePuesto')">
                            </div>
                        </div><!--fin  item 2-->
  
                        <div class="col-xs-12 col-sm-4"> 
                           <!-- ENTRADA PUESTO-->
                           <div class="form-group">
                              <div class="input-group">
                                 <span class="input-group-addon"><i class="fa fa-street-view"></i></span> 
                                 <input type="text" class="form-control input-xs" id="ePuesto" name="ePuesto"  placeholder="Puesto" onfocus=" obtieneFoco('#ePuesto')" onblur = "pierdeFoco('#ePuesto')" >
                              </div>
                           </div>    
                        </div><!--fin  item 3-->

                   </div> <!-- FIN SEGUNDA LINEA --> 
                   
                   <!--========================================================================== -->
                    <div class="row"> <!-- TERCERA DE ENTRADA -->
                        
                        <div class="col-xs-12 col-sm-3">
                           <!-- ENTRADA SALARIO-->
                           <div class="input-group">
                               <span class="input-group-addon"><i class="fa fa-money"></i></span>
                               <input type="text" class="form-control input-xs" name="eSalario" id="eSalario"  placeholder=" Salario" onfocus=" obtieneFoco('#eSalario')" onblur = "pierdeFoco('#eSalario')" onkeypress="siguiente(event,'#eJornada')" >
                           </div>
                        </div><!--fin  item 1-->

                        <div class="col-xs-12 col-sm-3">
                            <!-- ENTRADA JORNADA -->
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-asterisk"> Jornada</i></span>
                                <select class= "form-control input-xs" name="eJornada" id="eJornada">
                                    <option value="Semanal">Semanal</option>
                                    <option value="Quincenal">Quincenal</option>
                                    <option value="Mensual">Mensual</option>
                                </select>
                            </div>
                        </div><!--fin  item 2-->
  
                        <div class="col-xs-12 col-sm-6"> 
                           <!-- ENTRADA EMAIL-->
                           <div class="form-group">
                              <div class="input-group">
                                 <span class="input-group-addon"><i class="fa fa-at"></i></span> 
                                 <input type="email" class="form-control input-xs" id="eEmail" name="eEmail"  placeholder="Email" onfocus=" obtieneFoco('#eEmail')" onblur = "pierdeFoco('#eEmail')" >
                              </div>
                           </div>    
                        </div><!--fin  item 3-->

                   </div> <!-- FIN TERCERA LINEA -->       
                  
                    <!--========================================================================== -->
                    <div class="row"> <!-- CUARTA  DE ENTRADA -->
                        
                        <div class="col-xs-12 col-sm-6">
                           <!-- ENTRADA SALARIO-->
                           <div class="input-group">
                               <span class="input-group-addon"><i class="fa fa-sun-o"></i></span>
                               <input type="text" class="form-control input-xs" name="eDireccion" id="eDireccion"  placeholder=" Dirección" onfocus=" obtieneFoco('#eDireccion')" onblur = "pierdeFoco('#eDireccion')" onkeypress="siguiente(event,'#eObservacion')" >
                           </div>
                        </div><!--fin  item 1-->

                        <div class="col-xs-12 col-sm-6">
                            <!-- ENTRADA JORNADA -->
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-commenting-o"></i></span>
                                <input type="text" class="form-control input-xs" name="eObservacion" id="eObservacion" onfocus="obtieneFoco('#eObservacion')" onblur = "pierdeFoco('#eObservacion')" placeholder="Observación">
                            </div>
                        </div><!--fin  item 2-->
  
                       
                   </div> <!-- FIN CUARTA LINEA -->             
      
                 </div> <!--Final box-body-->
              </div> <!--Final modal-body-->
              <!--=====================================
                        PIE DEL MODAL
              ======================================-->
              <div class="modal-footer">
                <button type="button" class="btn btn-info pull-left" data-dismiss="modal">Regresar..</button>
                <button type="submit" class="btn btn-primary">Actualizar Empleado</button>
              </div>
              <?php
                $editarEmpleado = new ControladorEmpleados();
                $editarEmpleado -> ctrEditarEmpleado();
              ?>
    
        </form>
     </div>
  </div>
</div>

<?php       
                
  $borrarEmpleado = new ControladorEmpleados();
  $borrarEmpleado -> ctrBorrarEmpleado();
       
?>  
       
        