<div class="content-wrapper">
  <section class="content-header">
    <h1>
      Control de Expedientes
    </h1>
    <ol class="breadcrumb">
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      <li class="active">Control de Expedientes</li>
    </ol>
  </section> <!--Fin de la seccion-->
   
  <section class="content">
    <div class="box">
      <div class="box-header with-border">
        <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarCaso">
          <i class="fa fa-plus">
             Agregar    
          </i> 
        </button>    
        <form id = "pasarGaleria" action="galerias" method="post">
             <input type="hidden" id="verGaleria" name="idCaso" value="" />
        </form>     
      </div> <!-- Fin box-header-->

      <div class="box-body">
        <table class="table table-bordered table-condensed table-striped dt-responsive  tablaCasos" width="100%">
          <thead>    
            <tr>
               <th style="width:10px">#</th>
               <th style="font-size: x-small;">Expediente</th>
               <th style="font-size: x-small;">Modelo</th>
               <th style="font-size: x-small;">Aseguradora</th>
               <th style="font-size: x-small;">Año</th>
               <th style="font-size: x-small;">Mes</th>
               <th style="font-size: x-small;">Estado</th>
               <th style="font-size: x-small;">Acciones</th>
            </tr> 
          </thead>    
          <tbody>   
              <?php   
                $item = null;   
                $valor = null;
                
                $documentos = ControladorCasos::ctrMostrarCasos($item, $valor);
                         
                foreach ($documentos as $key => $value) {
                                          
                     $expediente = "<button class='btn btn-success btnVerExpediente btn-xs' vIdCaso = '".$value["id"]."'  ><i class='fa fa-plus'>  ".$value["expediente"]."</i></button>";
                     
                     if ($value["aseguradora"] == "INS")
                      $aseguradora = "<button class='btn btn-info btnVerCalculo btn-xs' vIdCaso = '".$value["id"]."' data-toggle='modal'  data-target='#modalVerCalculo' ><i class='fa fa-hand-pointer-o'>  ".$value["aseguradora"]."</i></button>";
                     else
                      $aseguradora =  $value["aseguradora"];
                     echo ' <tr>
                            <td>'.($key+1).'</td>
                            <td style="font-size: x-small;">'.$expediente.'</td>
                            <td style="font-size: x-small;">'.$value["modelo"].'</td>
                            <td style="font-size: x-small;">'.$aseguradora.'</td>
                            <td style="font-size: x-small;">'.$value["ano"].'</td>
                            <td style="font-size: x-small;">'.$value["mes"].'</td>
                            <td style="font-size: x-small;">'.$value["estado"].'</td>    
                            <td>
                               <div class="btn-group">';
                                if($_SESSION["perfil"] == "Administrador"){
                                  echo '<button class="btn btn-warning btn-xs btnEditarCaso" idCaso="'.$value["id"].'" data-toggle="modal"  data-target="#modalEditarCaso"><i class="fa fa-pencil"></i></button>
                                  <button class="btn btn-danger btn-xs btnEliminarCaso" idCaso="'.$value["id"].'"> <i class="fa fa-times"></i></button>';
                                } // fin if
                                echo '
                               </div>      
                            </td>
                          </tr>';
                } // fin for
                  
              ?>  
          </tbody> 
        </table>

      </div>
    </div>
  </section>
</div>
  
<!--=====================================
MODAL AGREGAR CASO
======================================-->
<div id="modalAgregarCaso" class="modal fade" role="dialog">
  <div class="modal-dialog" style="width: 60% !important;">
    <div class="modal-content">
      <form role="form" method="post" enctype="multipart/form-data" onKeypress="if(event.keyCode == 13) event.returnValue = false;">
        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->
        <div class="modal-header" style="background:#3c8dbc; color:white">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Agregar Expediente</h4>
        </div>
        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->
        <div class="modal-body">
           <div class="box-body">
              <div class="row"> <!-- PRIMERA LINEA DE ENTRADA -->
                 <div class="col-xs-12 col-sm-5"> 
                      <!-- ENTRADA PARA EL EXPEDIENTE -->
                      <div class="form-group">
                          <div class="input-group">
                             <span class="input-group-addon"><i class="fa fa-file"></i></span> 
                             <input type="text" class="form-control input-xs" id="nExpediente" name="nExpediente" placeholder="Ingresar Expediente" onfocus=" obtieneFoco('#nExpediente')" onblur = "pierdeFoco('#nExpediente')" required>
                          </div>
                      </div>
                  </div>
                  <div class="col-xs-12 col-sm-2">
                  </div> 
                  <div class="col-xs-12 col-sm-5"> 
                      <!-- ENTRADA ASEGURADORA -->
                      <div class="form-group">  
                          <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-hospital-o"> Aseguradora</i></span>
                             <select class= "form-control input-xs" name="nAseguradora" id="nAseguradora" >
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
                  </div>
            
              </div> <!-- Fin Linea 1 --> 
              <br>
              <div class="row"> <!-- SEGUNDA LINEA DE ENTRADA -->
                <div class="col-xs-12 col-sm-4">
                  <!-- ENTRADA PARA EL MODELO -->
                  <div class="form-group">
                    <div class="input-group">
                      <span class="input-group-addon"><i class="fa fa-car"></i></span> 
                      <input type="text" class="form-control input-xs" name="nModelo" id="nModelo" placeholder="Ingresar Modelo" onfocus=" obtieneFoco('#nModelo')" onblur = "pierdeFoco('#nModelo')" required>
                    </div>
                  </div>
                </div>
                <div class="col-xs-12 col-sm-4  ">
                  <!-- ENTRADA AÑO -->
                  <div class="form-group">  
                    <div class="input-group">
                      <span class="input-group-addon"><i class="fa fa-calendar"> Año</i></span>
                      <select class= "form-control input-xs" name="nAno" id="nAno" >
                        <option value="2014">2014</option> 
                        <option value="2015">2015</option>
                        <option value="2016">2016</option>
                        <option value="2017">2017</option>
                        <option value="2018">2018</option>
                        <option value="2019">2019</option>
                        <option value="2020">2020</option>
                        <option value="2021">2021</option>
                        <option value="2022">2022</option>
                        <option value="2023">2023</option>
                        <option value="2024">2024</option>
                        <option value="2025">2025</option> 
                        <option value="2026">2026</option>
                        <option value="2027">2027</option>
                        <option value="2028">2028</option>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="col-xs-12 col-sm-4">
                  <!-- ENTRADA MES -->
                  <div class="form-group">  
                    <div class="input-group">
                      <span class="input-group-addon"><i class="fa fa-calendar"> Mes</i></span>
                      <select class= "form-control input-xs" name="nMes" id="nMes" >
                        <option value="Enero">Enero</option> 
                        <option value="Febrero">Febrero</option>
                        <option value="Marzo">Marzo</option>
                        <option value="Abril">Abril</option>
                        <option value="Mayo">Mayo</option>
                        <option value="Junio">Junio</option>
                        <option value="Julio">Julio</option>
                        <option value="Agosto">Agosto</option>
                        <option value="Setiembre">Setiembre</option>
                        <option value="Octubre">Octubre</option>
                        <option value="Noviembre">Noviembre</option>
                        <option value="Diciembre">Diciembre</option> 
                      </select>
                    </div>
                  </div>
                </div>
              </div> <!-- Fin Linea 2 -->
              
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
             
              <div class="col-xs-12 col-sm-3">
                <button type="submit" class="btn btn-primary">
                  <i class="fa fa-save">
                      Guardar Expediente
                   </i>    
                </button> 
              </div><!--fin item 3-->  
            </div> <!-- FIN CUARTA LINEA -->  
         </div>
      </form>
        <?php  
          $crearExpediente = new ControladorCasos();
          $crearExpediente -> ctrCrearCaso();
        ?>  
    </div> <!-- FIN CLASS MODEL CONTENT -->
  </div> <!-- FIN MODAL DIALOG -->
</div> <!-- FIN MODAL AGREGAR CASO -->

<!--=====================================
MODAL EDITAR CASO
======================================-->
<div id="modalEditarCaso" class="modal fade" role="dialog">
  <div class="modal-dialog" style="width: 60% !important;">
    <div class="modal-content">
      <form role="form" method="post" enctype="multipart/form-data" onKeypress="if(event.keyCode == 13) event.returnValue = false;">
        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->
        <div class="modal-header" style="background:#3c8dbc; color:white">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Editar Expediente</h4>
        </div>
        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->
        <div class="modal-body">
           <div class="box-body">
              <div class="row"> <!-- PRIMERA LINEA DE ENTRADA -->
                 <div class="col-xs-12 col-sm-4"> 
                      <!-- ENTRADA PARA EL EXPEDIENTE -->
                      <div class="form-group">
                          <div class="input-group">
                             <span class="input-group-addon"><i class="fa fa-file"></i></span> 
                             <input type="hidden" class="form-control input-xs" id="eIdCaso" name="eIdCaso" readonly>  
                             <input type="text" class="form-control input-xs" id="eExpediente" name="eExpediente" readonly>
                          </div>
                      </div>
                  </div>
                  <div class="col-xs-12 col-sm-4"> 
                      <!-- ENTRADA ASEGURADORA -->
                      <div class="form-group">  
                          <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-hospital-o"> Aseguradora</i></span>
                             <select class= "form-control input-xs" name="eAseguradora" id="eAseguradora" >
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
                  </div>
                  <div class="col-xs-12 col-sm-4"> 
                      <!-- ESTADO -->
                      <div class="form-group">  
                          <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-file"> Estado</i></span>
                             <select class= "form-control input-xs" name="eEstado" id="eEstado" >
                                <option value="En Proceso">En Proceso</option> 
                                 <option value="Cerrado">Cerrado</option>
                             </select>
                          </div>
                      </div>
                  </div>
              </div> <!-- Fin Linea 1 --> 
              <br>
              <div class="row"> <!-- SEGUNDA LINEA DE ENTRADA -->
                <div class="col-xs-12 col-sm-4">
                  <!-- ENTRADA PARA EL MODELO -->
                  <div class="form-group">
                    <div class="input-group">
                      <span class="input-group-addon"><i class="fa fa-car"></i></span> 
                      <input type="text" class="form-control input-xs" name="eModelo" id="eModelo" placeholder="Ingresar Modelo" onfocus=" obtieneFoco('#nModelo')" onblur = "pierdeFoco('#nModelo')" required>
                    </div>
                  </div>
                </div>
                <div class="col-xs-12 col-sm-4  ">
                  <!-- ENTRADA AÑO -->
                  <div class="form-group">  
                    <div class="input-group">
                      <span class="input-group-addon"><i class="fa fa-calendar"> Año</i></span>
                      <select class= "form-control input-xs" name="eAno" id="eAno" >
                        <option value="2014">2014</option> 
                        <option value="2015">2015</option>
                        <option value="2016">2016</option>
                        <option value="2017">2017</option>
                        <option value="2018">2018</option>
                        <option value="2019">2019</option>
                        <option value="2020">2020</option>
                        <option value="2021">2021</option>
                        <option value="2022">2022</option>
                        <option value="2023">2023</option>
                        <option value="2024">2024</option>
                        <option value="2025">2025</option> 
                        <option value="2026">2026</option>
                        <option value="2027">2027</option>
                        <option value="2028">2028</option>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="col-xs-12 col-sm-4">
                  <!-- ENTRADA MES -->
                  <div class="form-group">  
                    <div class="input-group">
                      <span class="input-group-addon"><i class="fa fa-calendar"> Mes</i></span>
                      <select class= "form-control input-xs" name="eMes" id="eMes" >
                        <option value="Enero">Enero</option> 
                        <option value="Febrero">Febrero</option>
                        <option value="Marzo">Marzo</option>
                        <option value="Abril">Abril</option>
                        <option value="Mayo">Mayo</option>
                        <option value="Junio">Junio</option>
                        <option value="Julio">Julio</option>
                        <option value="Agosto">Agosto</option>
                        <option value="Setiembre">Setiembre</option>
                        <option value="Octubre">Octubre</option>
                        <option value="Noviembre">Noviembre</option>
                        <option value="Diciembre">Diciembre</option> 
                      </select>
                    </div>
                  </div>
                </div>
              </div> <!-- Fin Linea 2 -->
              
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
             
              <div class="col-xs-12 col-sm-3">
                <button type="submit" class="btn btn-primary">
                  <i class="fa fa-save">
                      Guardar Expediente
                   </i>    
                </button> 
              </div><!--fin item 3-->  
            </div> <!-- FIN CUARTA LINEA -->  
         </div>
      </form>
        <?php  
          $editarExpediente = new ControladorCasos();
          $editarExpediente -> ctrEditarCaso();
        ?>  
    </div> <!-- FIN CLASS MODEL CONTENT -->
  </div> <!-- FIN MODAL DIALOG -->
</div> <!-- FIN MODAL EDITAR CASO -->

<!--=====================================
MODAL VER CALCULO
======================================-->
<div id="modalVerCalculo" class="modal fade" role="dialog">
  <div class="modal-dialog" style="width: 60% !important;">
    <div class="modal-content">
      <form role="form" method="post" enctype="multipart/form-data" onKeypress="if(event.keyCode == 13) event.returnValue = false;">  
        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->
        <div class="modal-header" style="background:#3c8dbc; color:white">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Calculo UT/COLONES</h4>
        </div>
        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->
        <div class="modal-body">
           <div class="box-body">
              <div class="row"> <!-- PRIMERA LINEA DE ENTRADA -->
                <div class="col-xs-12 col-sm-4"> 
                      <!-- ENTRADA PARA EL EXPEDIENTE -->
                      <div class="form-group">
                          <div class="input-group">
                             <span class="input-group-addon"><i class="fa fa-car"># Placa:</i></span>
                             <input type="text" class="form-control input-xs" id="vPlaca" name="vPlaca" value="743556" readonly>
                          </div>
                      </div>
                </div>
                <div class="col-xs-12 col-sm-4">
                  <div class="form-group"> 
                   <div class="input-group">
                      <span class="input-group-addon"><b>Tipo de cambio:</b></span>
                      <input type="text" class="form-control input-xs" id="vTipoCambio" value="¢578,50"/>
                    </div>
                  </div>    
                </div>
                <div class="col-xs-12 col-sm-4">
                  <button type="submit" class="btn btn-danger">
                    <i class="fa fa-print">
                      Reporte
                    </i>    
                  </button>                      
                </div>
              </div> <!-- Fin Linea 1 --> 
              <div class="row btn-info" style="
                  color:white;
                  border: 1px solid rgba(0,0,0,0.3);
                  font-style: italic;
                  box-shadow: 2px 2px 2px rgba(0,0,0,0.3);
                "> <!-- PRIMERA LINEA DE ENTRADA -->
                <div class="col-xs-12 col-sm-4" style="border-right:1px solid rgba(0,0,0,0.3);"> 
                    <h5 style="font-size:12px; margin:0px; padding: 5px;">Descripción</h5>   
                </div>
                <div class="col-xs-12 col-sm-2" style="border-right:1px solid rgba(0,0,0,0.3);"> 
                    <h5 style="font-size:12px; margin:0px; padding: 5px; ">Tarifa/H</h5>   
                </div>
                <div class="col-xs-12 col-sm-2" style="border-right:1px solid rgba(0,0,0,0.3);"> 
                    <h5 style="font-size:12px; margin:0px; padding: 5px;">UT</h5>   
                </div>
                <div class="col-xs-12 col-sm-2" style="border-right:1px solid rgba(0,0,0,0.3);"> 
                    <h5 style="font-size:12px; margin:0px; padding: 5px;">Colones</h5>   
                </div>
                <div class="col-xs-12 col-sm-2" style="border-right:1px solid rgba(0,0,0,0.3);"> 
                    <h5 style="font-size:12px; margin:0px; padding: 5px;">Dólares</h5>   
                </div>
              </div> <!-- Fin Linea 1 -->

              <div class="row" style="
                  border: 0.5px solid rgba(0,0,0,0.3);
                  
              "> <!-- PRIMERA LINEA DE ENTRADA -->
                <div class="col-xs-12 col-sm-4" style="border-right:1px solid rgba(0,0,0,0.3);"> 
                    <h6 style="font-size:10px; margin:0px; padding: 5px;">M.O. LATONERIA</h6>   
                </div>
                <div class="col-xs-12 col-sm-2" style="border-right:1px solid rgba(0,0,0,0.3);"> 
                   <input type="text" style="font-size:10px; margin:0px; padding-right: 18px; border:0px; width: 100px; text-align: right;" value="¢15,970" />   
                </div>
                <div class="col-xs-12 col-sm-2" style="border-right:1px solid rgba(0,0,0,0.3);"> 
                  <input type="text" style="font-size:10px; margin:0px; padding: 0px; border:0px; width:80px; text-align: center;" value="9" />  
                </div>
                <div class="col-xs-12 col-sm-2" style="border-right:1px solid rgba(0,0,0,0.3);"> 
                  <input type="text" style="font-size:10px; margin:0px; padding-right: 10px; border: 0px; width:100px; text-align: right;" value="¢143,730" readonly/>
                </div>
                <div class="col-xs-12 col-sm-2" style="border-right:1px solid rgba(0,0,0,0.3);"> 
                   <input type="text" style="font-size:10px; margin:0px; padding: 0x; border:0px; width:80px; text-align: right;" value="$248,45" readonly/>       
                    
                </div>
              </div> <!-- Fin Linea 2 -->
              
              <div class="row" style="
                  border: 0.5px solid rgba(0,0,0,0.3);
              "> <!-- PRIMERA LINEA DE ENTRADA -->
                <div class="col-xs-12 col-sm-4" style="border-right:1px solid rgba(0,0,0,0.3);"> 
                  <h6 style="font-size:10px; margin:0px; padding: 5px;">PINTURA</h6>   
                </div>
                <div class="col-xs-12 col-sm-2" style="border-right:1px solid rgba(0,0,0,0.3);"> 
                  <input type="text" style="font-size:10px; margin:0px; padding-right: 18px; border: 0px; width:100px; text-align: right;" value="¢17,631"/>     
                </div>
                <div class="col-xs-12 col-sm-2" style="border-right:1px solid rgba(0,0,0,0.3);"> 
                  <input type="text" style="font-size:10px; margin:0px; padding: 0px; border:0px; width:80px; text-align: center;" value="9.1" />      
                </div>
                <div class="col-xs-12 col-sm-2" style="border-right:1px solid rgba(0,0,0,0.3);"> 
                 <input type="text" style="font-size:10px; margin:0px; padding-right: 10px; border: 0px; width:100px; text-align: right;" value="¢160,442" readonly/>      
                </div>
                <div class="col-xs-12 col-sm-2"> 
                <input type="text" style="font-size:10px; margin:0px; padding: 0px; border: 0px; width:80px; text-align: right;" value="$277.34" readonly/>           
                </div>
              </div> <!-- Fin Linea 3 -->

              <div class="row" style="
                  border: 0.5px solid rgba(0,0,0,0.3);
              "> <!-- PRIMERA LINEA DE ENTRADA -->
                <div class="col-xs-12 col-sm-4" style="border-right:1px solid rgba(0,0,0,0.3);"> 
                  <h6 style="font-size:10px; margin:0px; padding: 5px;">VIDRIOS</h6>   
                </div>
                <div class="col-xs-12 col-sm-2" style="border-right:1px solid rgba(0,0,0,0.3);"> 
                  <input type="text" style="font-size:10px; margin:0px; padding-right: 18px; border: 0px; width:100px; text-align: right;" value="¢15,970"/>
                </div>
                <div class="col-xs-12 col-sm-2" style="border-right:1px solid rgba(0,0,0,0.3);"> 
                  <input type="text" style="font-size:10px; margin:0px; padding: 0px; border: 0px; width:80px; text-align: center;" value="0"/>      
                </div>
                <div class="col-xs-12 col-sm-2" style="border-right:1px solid rgba(0,0,0,0.3);"> 
                  <input type="text" style="font-size:10px; margin:0px; padding-right: 10px; border: 0px; width:100px; text-align: right;" value="¢0"/>      
                </div>
                <div class="col-xs-12 col-sm-2"> 
                 <input type="text" style="font-size:10px; margin:0px; padding: 0px; border: 0px; width:80px; text-align: right;" value="$0.00"/>      
                </div>
              </div> <!-- Fin Linea 4 -->

              <div class="row" style="
                  border: 0.5px solid rgba(0,0,0,0.3);
              "> <!-- PRIMERA LINEA DE ENTRADA -->
                <div class="col-xs-12 col-sm-4" style="border-right:1px solid rgba(0,0,0,0.3);"> 
                    <h6 style="font-size:10px; margin:0px; padding: 5px; ">MECANICA</h6>   
                </div>
                <div class="col-xs-12 col-sm-2" style="border-right:1px solid rgba(0,0,0,0.3);"> 
                  <input type="text" style="font-size:10px; margin:0px; padding-right: 18px; border: 0px; width:100px; text-align: right;" value="¢15,970"/>     
                </div>
                <div class="col-xs-12 col-sm-2" style="border-right:1px solid rgba(0,0,0,0.3);"> 
                  <input type="text" style="font-size:10px; margin:0px; padding: 0px; border: 0px; width:80px; text-align: center;" value="0"/>       
                </div>
                <div class="col-xs-12 col-sm-2" style="border-right:1px solid rgba(0,0,0,0.3);"> 
                 <input type="text" style="font-size:10px; margin:0px; padding-right: 10px; border: 0px; width:100px; text-align: right;" value="¢0"/>
                </div>
                <div class="col-xs-12 col-sm-2"> 
                  <input type="text" style="font-size:10px; margin:0px; padding: 0px; border: 0px; width:80px; text-align: right;" value="$0.00"/>      
                </div>
              </div> <!-- Fin Linea 5 -->
              
              <div class="row" style="
                  border: 0.5px solid rgba(0,0,0,0.3);
              "> <!-- PRIMERA LINEA DE ENTRADA -->
                <div class="col-xs-12 col-sm-4" style="border-right:1px solid rgba(0,0,0,0.3);"> 
                  <h6 style="font-size:10px; margin:0px; padding: 5px; ">CHASIS</h6>   
                </div>
                <div class="col-xs-12 col-sm-2" style="border-right:1px solid rgba(0,0,0,0.3);"> 
                  <input type="text" style="font-size:10px; margin:0px; padding-right: 18px; border: 0px; width:100px; text-align: right;" value="¢34,839"/>
                </div>
                <div class="col-xs-12 col-sm-2" style="border-right:1px solid rgba(0,0,0,0.3);"> 
                  <input type="text" style="font-size:10px; margin:0px; padding: 0px; border: 0px; width:80px; text-align: center;" value="0"/>     
                </div>
                <div class="col-xs-12 col-sm-2" style="border-right:1px solid rgba(0,0,0,0.3);"> 
                  <input type="text" style="font-size:10px; margin:0px; padding-right: 10px; border: 0px; width:100px; text-align: right;" value="¢0"/>      
                </div>
                <div class="col-xs-12 col-sm-2"> 
                  <input type="text" style="font-size:10px; margin:0px; padding: 0px; border: 0px; width:80px; text-align: right;" value="$0.00"/>
                </div>
              </div> <!-- Fin Linea 6 -->

              <div class="row" style="
                  border: 0.5px solid rgba(0,0,0,0.3);
              "> <!-- PRIMERA LINEA DE ENTRADA -->
                <div class="col-xs-12 col-sm-4" style="border-right:1px solid rgba(0,0,0,0.3);"> 
                    <h6 style="font-size:10px; margin:0px; padding: 5px; ">CARROCERIA-ESTRUCTURAL</h6>   
                </div>
                <div class="col-xs-12 col-sm-2" style="border-right:1px solid rgba(0,0,0,0.3);"> 
                  <input type="text" style="font-size:10px; margin:0px; padding-right: 18px; border: 0px; width:100px; text-align: right;" value="¢18,872"/>     
                </div>
                <div class="col-xs-12 col-sm-2" style="border-right:1px solid rgba(0,0,0,0.3);"> 
                  <input type="text" style="font-size:10px; margin:0px; padding: 0px; border: 0px; width:80px; text-align: center;" value="2"/>       
                </div>
                <div class="col-xs-12 col-sm-2" style="border-right:1px solid rgba(0,0,0,0.3);"> 
                  <input type="text" style="font-size:10px; margin:0px; padding-right: 10px; border: 0px; width:100px; text-align: right;" value="¢37,744"/> 
                </div>
                <div class="col-xs-12 col-sm-2"> 
                  <input type="text" style="font-size:10px; margin:0px; padding: 0px; border: 0px; width:80px; text-align: right;" value="$62.24"/>
                </div>
              </div> <!-- Fin Linea 7 -->

              <div class="row" style="
                  border: 0.5px solid rgba(0,0,0,0.3);
                  border-top: 2px solid rgba(0,0,0,0.6);
              "> <!-- PRIMERA LINEA DE ENTRADA -->
                <div class="col-xs-12 col-sm-4" style="border-right:1px solid rgba(0,0,0,0.3);"> 
                    <h6 style="font-size:10px; margin:0px; padding: 5px; ">A/C</h6>   
                </div>
                <div class="col-xs-12 col-sm-2" style="border-right:1px solid rgba(0,0,0,0.3);"> 
                  <select name="" id="" style="font-size:10px; margin:0px; padding: 0px; border: 0px; width:100px; text-align-last: right;">
                    <option value="25000">¢25,000</option>
                    <option value="38000">¢38,000</option>
                    <option value="45000">¢45,000</option>
                    <option value="55000">¢55,000</option>
                    <option value="65000">¢65,000</option>   
                  </select>     
                </div>
                <div class="col-xs-12 col-sm-2" style="border-right:1px solid rgba(0,0,0,0.3);"> 
                  <input type="text" style="font-size:10px; margin:0px; padding: 0px; border: 0px; width:80px; text-align: center;" value="0"/>    
                </div>
                <div class="col-xs-12 col-sm-2" style="border-right:1px solid rgba(0,0,0,0.3);"> 
                 <input type="text" style="font-size:10px; margin:0px; padding-right: 10px; border: 0px; width:100px; text-align: right;" value="¢0"/>     
                </div>
                <div class="col-xs-12 col-sm-2"> 
                  <input type="text" style="font-size:10px; margin:0px; padding: 0px; border: 0px; width:80px; text-align: right;" value="$0.00"/>       
                </div>
              </div> <!-- Fin Linea 8 -->

              <div class="row" style="
                  border: 0.5px solid rgba(0,0,0,0.3);
              "> <!-- PRIMERA LINEA DE ENTRADA -->
                <div class="col-xs-12 col-sm-4" style="border-right:1px solid rgba(0,0,0,0.3);"> 
                    <h6 style="font-size:10px; margin:0px; padding: 5px; ">IMPORTE FIJO VIDRIO</h6>   
                </div>
                <div class="col-xs-12 col-sm-2" style="border-right:1px solid rgba(0,0,0,0.3);"> 
                  <select name="" id="" style="font-size:10px; margin:0px; padding: 0px; border: 0px; width:100px; text-align-last: right;">
                    <option value="77625">¢77,625</option>
                    <option value="67275">¢67,275</option>
                    <option value="32085">¢32,085</option>
                  </select>     
                </div>
                <div class="col-xs-12 col-sm-2" style="border-right:1px solid rgba(0,0,0,0.3);"> 
                  <input type="text" style="font-size:10px; margin:0px; padding: 0px; border: 0px; width:80px; text-align: center;" value="0"/>                
                </div>
                <div class="col-xs-12 col-sm-2" style="border-right:1px solid rgba(0,0,0,0.3);"> 
                 <input type="text" style="font-size:10px; margin:0px; padding-right: 10px; border: 0px; width:100px; text-align: right;" value="¢0"/>       
                </div>
                <div class="col-xs-12 col-sm-2"> 
                  <input type="text" style="font-size:10px; margin:0px; padding: 0px; border: 0px; width:80px; text-align: right;" value="$0.00"/>       
                </div>
              </div> <!-- Fin Linea 9 -->

              <div class="row" style="
                  border: 0.5px solid rgba(0,0,0,0.3);
              "> <!-- PRIMERA LINEA DE ENTRADA -->
                <div class="col-xs-12 col-sm-4" style="border-right:1px solid rgba(0,0,0,0.3);"> 
                  <h6 style="font-size:10px; margin:0px; padding: 5px; ">CUADRAR VEHICULO</h6>   
                </div>
                <div class="col-xs-12 col-sm-2" style="border-right:1px solid rgba(0,0,0,0.3);"> 
                 <input type="text" style="font-size:10px; margin:0px; padding-right: 18px; border: 0px; width:100px; text-align: right;" value="¢18,872"/>     
                </div>
                <div class="col-xs-12 col-sm-2" style="border-right:1px solid rgba(0,0,0,0.3);"> 
                  <input type="text" style="font-size:10px; margin:0px; padding: 0px; border: 0px; width:80px; text-align: center;" value="0"/>     
                </div>
                <div class="col-xs-12 col-sm-2" style="border-right:1px solid rgba(0,0,0,0.3);"> 
                 <input type="text" style="font-size:10px; margin:0px; padding-right: 10px; border: 0px; width:100px; text-align: right;" value="¢0"/>      
                </div>
                <div class="col-xs-12 col-sm-2"> 
                 <input type="text" style="font-size:10px; margin:0px; padding: 0px; border: 0px; width:80px; text-align: right;" value="$0.00"/>      
                </div>
              </div> <!-- Fin Linea 10 -->

              <div class="row" style="
                  border: 0.5px solid rgba(0,0,0,0.3);
              "> <!-- PRIMERA LINEA DE ENTRADA -->
                <div class="col-xs-12 col-sm-4" style="border-right:1px solid rgba(0,0,0,0.3);"> 
                    <h6 style="font-size:10px; margin:0px; padding: 5px; ">MEDIR CHASIS</h6>   
                </div>
                <div class="col-xs-12 col-sm-2" style="border-right:1px solid rgba(0,0,0,0.3);"> 
                  <input type="text" style="font-size:10px; margin:0px; padding-right: 18px; border: 0px; width:100px; text-align: right;" value="¢18,872"/>         
                </div>
                <div class="col-xs-12 col-sm-2" style="border-right:1px solid rgba(0,0,0,0.3);"> 
                  <input type="text" style="font-size:10px; margin:0px; padding: 0px; border: 0px; width:80px; text-align: center;" value="0"/>                 
                </div>
                <div class="col-xs-12 col-sm-2" style="border-right:1px solid rgba(0,0,0,0.3);"> 
                  <input type="text" style="font-size:10px; margin:0px; padding-right: 10px; border: 0px; width:100px; text-align: right;" value="¢0"/>        
                </div>
                <div class="col-xs-12 col-sm-2"> 
                 <input type="text" style="font-size:10px; margin:0px; padding: 0px; border: 0px; width:80px; text-align: right;" value="$0.00"/>   
                </div>
              </div> <!-- Fin Linea 11 -->

              <div class="row" style="
                  border: 0.5px solid rgba(0,0,0,0.3);
                  border-top: 2px solid rgba(0,0,0,0.6);
                  background: cyan;
              "> <!-- PRIMERA LINEA DE ENTRADA -->
                <div class="col-xs-12 col-sm-8" style="border-right:1px solid rgba(0,0,0,0.3);"> 
                    <h6 style="font-size:12px; margin:0px; padding: 5px; text-align:center; "><b>Sub-Total Sin IVA: =</b></h6>   
                </div>
                
                <div class="col-xs-12 col-sm-2" style="border-right:1px solid rgba(0,0,0,0.3);"> 
                 <input type="text" style="font-size:12px; background: transparent; margin:0px; padding-right: 10px; border: 0px; width:100px; text-align: right; font-weight: bold;" value="¢419,541"/>            
                </div>
                <div class="col-xs-12 col-sm-2"> 
                 <input type="text" style="font-size:12px; margin:0px;  background: transparent; padding: 0px; border: 0px; width:80px; text-align: right; font-weight: bold;" value="$725.22"/>              
                </div>
              </div> <!-- Fin Linea 8 -->
              
              <div class="row" style="
                  border: 0.5px solid rgba(0,0,0,0.3);
                  background: cyan;
                  
              "> <!-- PRIMERA LINEA DE ENTRADA -->
                <div class="col-xs-12 col-sm-8" style="border-right:1px solid rgba(0,0,0,0.3);">  
                  <h6 style="font-size:12px; margin:0px; padding: 5px; text-align:center;"><b>IVA: =</b></h6>   
                </div>
                
                <div class="col-xs-12 col-sm-2" style="border-right:1px solid rgba(0,0,0,0.3);"> 
                  <input type="text" style="font-size:12px; margin:0px;  background: transparent; padding-right: 10px; border: 0px; width:100px; text-align: right; font-weight: bold;" value="¢54,540"/>     
                </div>
                <div class="col-xs-12 col-sm-2"> 
                 <input type="text" style="font-size:12px; margin:0px;  background: transparent; padding: 0px; border: 0px; width:80px; text-align: right; font-weight: bold;" value="$94.28"/>        
                </div>
              </div> <!-- Fin Linea 9 -->

              <div class="row" style="
                  border: 0.5px solid rgba(0,0,0,0.3);
                  background:cyan;
              "> <!-- PRIMERA LINEA DE ENTRADA -->
                <div class="col-xs-12 col-sm-8" style="border-right:1px solid rgba(0,0,0,0.3);"> 
                    <h6 style="font-size:12px; margin:0px; padding: 5px; text-align:center;"><b>MANO OBRA SIN AUTORIZAR: =</b></h6>   
                </div>
                
                <div class="col-xs-12 col-sm-2" style="border-right:1px solid rgba(0,0,0,0.3);"> 
                 <input type="text" style="font-size:12px; margin:0px;  background: transparent; padding-right: 10px; border: 0px; width:100px; text-align: right; font-weight: bold;" value="¢474,081"/>      
                </div>
                <div class="col-xs-12 col-sm-2"> 
                 <input type="text" style="font-size:12px; margin:0px;  background: transparent; padding: 0px; border: 0px; width:80px; text-align: right; font-weight: bold;" value="$630.94"/>   
                </div>
              </div> <!-- Fin Linea 10 -->

              <div class="row" style="
                  border: 0.5px solid rgba(0,0,0,0.3);
                  background: cyan;
              "> <!-- PRIMERA LINEA DE ENTRADA -->
                <div class="col-xs-12 col-sm-8" style="border-right:1px solid rgba(0,0,0,0.3);"> 
                    <h6 style="font-size:12px; margin:0px; padding: 5px; text-align:center;"><b>MANO OBRA AUTORIZADA: =</b></h6>   
                </div>
                <div class="col-xs-12 col-sm-2" style="border-right:1px solid rgba(0,0,0,0.3);"> 
                  <input type="text" style="font-size:12px; margin:0px;  background: transparent; padding-right: 10px; border: 0px; width:100px; text-align: right; font-weight: bold;" value="¢0"/>     
                </div>
                <div class="col-xs-12 col-sm-2"> 
                 <input type="text" style="font-size:12px; margin:0px;  background: transparent; padding: 0px; border: 0px; width:80px; text-align: right; font-weight: bold;" value="$0.00"/>       
                </div>
              </div> <!-- Fin Linea 11 -->
              
              <div class="row" style="
                  border: 0.5px solid rgba(0,0,0,0.3);
                  border-bottom: 2px solid rgba(0,0,0,0.6);
                  background: cyan;

              "> <!-- PRIMERA LINEA DE ENTRADA -->
                <div class="col-xs-12 col-sm-8" style="border-right:1px solid rgba(0,0,0,0.3);"> 
                    <h6 style="font-size:12px; margin:0px; padding: 5px; text-align:center;"><b>DIFERENCIA: =</b></h6>   
                </div>
                
                <div class="col-xs-12 col-sm-2" style="border-right:1px solid rgba(0,0,0,0.3);"> 
                  <input type="text" style="font-size:12px; margin:0px;  background: transparent; padding-right: 10px; border: 0px; width:100px; text-align: right; font-weight: bold;" value="¢474,081"/>
                </div>
                <div class="col-xs-12 col-sm-2"> 
                 <input type="text" style="font-size:12px; margin:0px;  background: transparent; padding: 0px; border: 0px; width:80px; text-align: right; font-weight: bold;" value="$630.94"/>      
                </div>
              </div> <!-- Fin Linea 12 -->

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
                     Regresar ..                  </i>   
                </button>       

              </div><!--fin item 1-->
             
              <div class="col-xs-1 col-sm-7">
              </div><!--fin item 2-->
             
              <div class="col-xs-12 col-sm-3">
                <button type="submit" class="btn btn-primary">
                  <i class="fa fa-save">
                      Actualizar
                   </i>    
                </button> 
              </div><!--fin item 3-->  
            </div> <!-- FIN CUARTA LINEA -->  
         </div>
      </form>  
          
    </div> <!-- FIN CLASS MODEL CONTENT -->
  </div> <!-- FIN MODAL DIALOG -->
</div> <!-- FIN MODAL VER CALCULO -->


<?php
  $eliminarCaso = new ControladorCasos();
  $eliminarCaso -> ctrEliminarCaso();
?>      
