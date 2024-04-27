<?php

 //  $ventas = ControladorOrdenes::ctrSumaVentas();
 //  $costos = ControladorLineas::ctrTotalCostos();
   echo '<script>';
   echo 'console.log('. json_encode( $costos ) .')';
   echo '</script>';    
?>
   


<div class="col-lg-3 col-xs-6">

  <div class="small-box bg-aqua">
    
    <div class="inner">
      
      <h3>¢<?php 
        //echo number_format($ventas["totalVentas"],2); 
      ?></h3>

      <p>Ventas</p>
    
    </div>
    
    <div class="icon">
      
      <i class="ion ion-social-usd"></i>
    
    </div>
    
    <a href="" class="small-box-footer">
      
      Más info <i class="fa fa-arrow-circle-right"></i>
    
    </a>

  </div>

</div>

<div class="col-lg-3 col-xs-6">

  <div class="small-box bg-green">
    
    <div class="inner">
    
      <h3>¢<?php //echo number_format($ventas["totalCostos"],2); ?></h3>

      <p>Costos</p>
    
    </div>
    
    <div class="icon">
    
      <i class="ion ion-clipboard"></i>
    
    </div>
    
     
      <a data-toggle="modal" data-target="#modalVerVentas" class="small-box-footer">
          Más info  <i class="fa fa-arrow-circle-right"></i>
      </a>
     
  </div>

</div>

<div class="col-lg-3 col-xs-6">

  <div class="small-box bg-yellow">
    
    <div class="inner">
    
      <h3>¢<?php //echo number_format(($ventas["totalVentas"] - $ventas["totalCostos"]),2); ?></h3>

      <p>Utilidad</p>
  
    </div>
    
    <div class="icon">
    
      <i class="ion ion-calculator"></i>
    
    </div>
    
    <a href="" class="small-box-footer">

      Más info <i class="fa fa-arrow-circle-right"></i>

    </a>

  </div>

</div>

<div class="col-lg-3 col-xs-6">

  <div class="small-box bg-red">    
  
    <div class="inner">
    
      <h3>¢<?php //echo number_format($ventas["totalSaldos"],2); ?></h3>

      <p>Saldo</p>
    
    </div>
    
    <div class="icon">
      
      <i class="ion ion-cash"></i>
    
    </div>
    
    <a href="" class="small-box-footer">
      
      Más info <i class="fa fa-arrow-circle-right"></i>
    
    </a>

  </div>

<!--=====================================
MODAL VER VENTAS
======================================-->
<div id="modalVerVentas" class="modal fade" role="dialog">
  <div class="modal-dialog" style="width: 60% !important;">
    <div class="modal-content">
        <!-- Cabeza del Modal -->

        <div class="modal-header" style="background:forestgreen; color:white"> 
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Detalle de Costos</h4>
        </div> <!-- fin div modal-header -->
                
        <!-- Cuerpo del Modal -->
        <div class="modal-body" style="background: cyan;">
            <div class="row"> <!-- PRIMERA LINEA DE ENTRADA -->
                    
              <div class="col-xs-1 col-sm-5">
                 <!-- COSTO LOCAL -->
                 <div class="form-group">
                    <div class="input-group">
                      <span class="input-group-addon"><i class="fa fa-money"> Local</i></span> 
                      <input type="text" class="form-control input-lg" value="¢ <?php echo number_format($costos["local"],2);?>" readonly>
                    </div>
                  </div>
              </div><!--fin item 1-->
              <div class="col-xs-1 col-sm-5">
                 <!-- COSTO LOCAL -->
                 <div class="form-group">
                    <div class="input-group">
                      <span class="input-group-addon"><i class="fa fa-money"> Exterior</i></span> 
                      <input type="text" class="form-control input-lg" value="¢ <?php echo number_format($costos["externo"],2);?>" readonly>
                    </div>
                  </div>
              </div><!--fin item 2-->  

         
            </div> <!-- FIN PRIMERA LINEA -->  
           
        </div> <!-- fin div modal-body -->
        
        <!-- PIE DEL MODAL -->      
        <div class="modal-footer">
           <button type="button" class="btn btn-warning pull-left" data-dismiss="modal">Regresar ..</button>  
           
        </div> <!-- fin div modal-footer -->
        
       
    </div> <!-- fin ventana modal-content -->
  </div> <!-- fin ventana modal-dialog -->
</div> <!-- fin ventana modalVerVentas --> 

