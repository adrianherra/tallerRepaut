<div class="content-wrapper">
  <section class="content-header">
    <h1>
      Recepción de Vehículos
    </h1>
    <ol class="breadcrumb">
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      <li class="active">Recepción de Vehículos</li>
    </ol>
  </section> <!--Fin de la seccion-->
   
  <section class="content">
    <div class="box">
      <div class="box-header with-border">
        <form action="entradas" method="post">
          <button type="submit" class="btn btn-primary" >
            <i class="fa fa-plus">
               Agregar    
            </i> 
          </button>    
        </form>      
        <form id="pasarGaleria" action="galerias" method="post">
          <input type="hidden" id="verGaleria" name="idCaso" />
        </form>    
        <form id="pasarReporte" method="post" action="reportes/reporteRecepcion.php" target="_blank" > 
          <input type="hidden" id="verReporte" name="idReporte" />    
        </form>
        <form id="pasarReporte1" method="post" action="reportes/reporteRecepcion2.php" target="_blank" > 
          <input type="hidden" id="verReporte1" name="idReporte1" />    
        </form>     
        <form id="pasarMail" method="post" action="reportes/enviarMail.php" > 
          <input type="hidden" id="enviarMail" name="enviarMail" />    
        </form>     
              
      </div> <!-- Fin box-header-->

      <div class="box-body">
        <table class="table table-bordered table-condensed table-striped dt-responsive  tablaCasos" width="100%">
          <thead>    
            <tr>
               <th style="width:10px">#</th>
               <th style="font-size: x-small;">Placa</th>
               <th style="font-size: x-small;">Marca</th>
               <th style="font-size: x-small;">Modelo</th>
               <th style="font-size: x-small;">Aseguradora</th>
               <th style="font-size: x-small;">Cliente</th>
               <th style="font-size: x-small;">Año</th>
               <th style="font-size: x-small;">Estado</th>
               <th style="font-size: x-small;">Acciones</th>
            </tr> 
          </thead>    
          <tbody>   
              <?php   
                $item = null;   
                $valor = null;
                
                //$documentos = ControladorEntradas::ctrMostrarEntradas($item, $valor);
                $documentos = ModeloEntradas::mdlMostrarEntradasC($item, $valor);                
                foreach ($documentos as $key => $value) {
                                                  
                     $placa = "<button class='btn btn-warning btnGaleria btn-xs' vIdCaso = '".$value["id"]."'  ><i class='fa fa-plus'>  ".$value["placa"]." </i></button>"; 
                         
                     $cliente = $value["nombre"];    
                     $tipo = $value["estado"];
                     $email = $value["email"];
                     $rutaPdf =  $value["rutaPdf"]; 
                     $nPlaca =  $value["placa"];
                     if ($tipo == "Activo") { 
                       $estado = "<button class='btn btn-primary btnEstadoEntrada btn-xs' idEstado='".$value["id"]."' estadoEntrada= 'Cerrado'>".$tipo."</button>";
                     }else {
                       $estado = "<button class='btn btn-warning btnEstadoEntrada btn-xs' idEstado='".$value["id"]."' estadoEntrada= 'Activo'>".$tipo."</button>";
                     } // fin if
                                 
                       
                     echo ' <tr>
                            <td>'.($key+1).'</td>
                            <td style="font-size: x-small;">'.$placa.'</td>
                            <td style="font-size: x-small;">'.$value["marca"].'</td>
                            <td style="font-size: x-small;">'.$value["modelo"].'</td>
                            <td style="font-size: x-small;">'.$value["ano"].'</td>
                            <td style="font-size: x-small;">'.$value["aseguradora"].'</td>
                            <td style="font-size: x-small;">'.$cliente.'</td>
                            <td style="font-size: x-small;">'.$estado.'</td>    
                            <td>
                               <div class="btn-group">         
                                  <button class="btn btn-warning btn-xs btnReporteCaso" idCaso="'.$value["id"].'" ><i class="fa fa-eye"></i></button>
                               </div>
                               <div class="btn-group">         
                                  <button class="btn btn-info btn-xs btnReporteCaso1" idCaso="'.$value["id"].'" ><i class="fa fa-photo"></i></button>
                               </div>     
                               <div class="btn-group">         
                                  <!--button class="btn btn-primary btn-xs btnReporteMail" idCaso="'.$value["id"].'" ><i class="fa fa-envelope"></i></button-->
                                  <button class="btn btn-xs btn-primary btnCargarEmail" placa="'.$nPlaca.'" rutaPdf="'.$rutaPdf.'" eMail="'.$email.'"  data-toggle="modal" data-target="#modalEnviarEmail"><i class="fa fa-envelope"></i></button>
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
   ENVIAR  EMAIL
======================================-->
<div id="modalEnviarEmail" class="modal fade" role="dialog">
  <div class="modal-dialog" style="width: 55% !important;">
    <div class="modal-content">
      <form role="form" method="post" enctype="multipart/form-data" onKeypress="if(event.keyCode == 13) event.returnValue = false;">
        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->
        <div class="modal-header" style="background:#3c8dbc; color:white">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Enviar Email</h4>
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
                             <span class="input-group-addon"><i class="fa fa-user"> Asunto:</i></span> 
                             <input type="text" class="form-control input-xs" id="nAsunto" name="nAsunto"  onfocus=" obtieneFoco('#nAsunto')"
                               onblur = "pierdeFoco('#nAsunto')" value="Recepcion Vehiculo" required>
                          </div>
                     </div>
                  </div>
   
                  <div class="col-xs-12 col-sm-12">
                      <!-- ENTRADA PARA EMAIL -->
                      <div class="form-group">
                         <div class="input-group">
                             <span class="input-group-addon"><i class="fa fa-envelope-o"> Email:</i></span> 
                             <input type="email" class="form-control input-xs" name="nMail" id="nMail" onfocus="obtieneFoco('#nMail')" onblur = "pierdeFoco('#nMail')" required>
                         </div>
                      </div>
                  </div>
              </div> <!-- Fin Linea 1 --> 
              <div class="row"> <!-- SEGUNDA LINEA DE ENTRADA -->
                
                  <h4 style="margin:0px; margin-left:15px; color:gray;"> Detalle:</h4>
                  <textarea name="nDetalle" id="nDetalle" cols="85" rows="6" style="margin:10px; margin-left:18px;" 
                  onfocus="obtieneFoco('#nDetalle')" onblur = "pierdeFoco('#nDetalle')">Le adjuntamos la recepción de su vehículo. Repaut y sus asesores, le agradecen su preferencia. Cualquier inconformidad o comentario será bien recibido a través de la siguiente dirección de email: notificaciones@repaut.com  "Taller y Carroceria Reaput, S.A." 
                  </textarea>
                
              </div> <!-- Fin Linea 1 -->
              <div class="row"> <!-- TERCERA LINEA DE ENTRADA -->
                <div class="col-xs-12 col-sm-8">
                  <!-- SELECCION ARCHIVO -->
                  <div class="form-group">
                    <div class="input-group">
                      <span class="input-group-addon"><i class="fa fa-file"> Adjunto:</i></span> 
                      <input type="hidden" class="form-control input-xs" name="nRuta" id="nRuta"  readonly>
                      <input type="text" class="form-control input-xs" name="nAdjunto" id="nAdjunto"  readonly>

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
                  <i class="fa fa-forward">   
                     Enviar ..  
                  </i>   
                </button>   
              </div><!--fin item 3-->  
            </div> <!-- FIN CUARTA LINEA -->  
         </div>
      </form>
        <?php  
          $enviaMail = new ControladorCasos();
          $enviaMail -> ctrEnviarEmail();
                   
        ?>  
    </div> <!-- FIN CLASS MODEL CONTENT -->
  </div> <!-- FIN MODAL DIALOG -->
</div> <!-- FIN ENVIAR EMAIL -->

<?php
  $eliminarCaso = new ControladorEntradas();
  $eliminarCaso -> ctrEliminarEntrada();
?>      
