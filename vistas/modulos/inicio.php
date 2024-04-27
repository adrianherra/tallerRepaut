<div class="content-wrapper">

  <section class="content-header">
    
    <h1>
      
      Inicio
      
      <small>DIMA, S.A.</small>
    
    </h1>
   

  </section>

  <!-- Main content -->
  <section class="content">
    
    <div class= "row">
        <div class="col-xs-12 col-sm-12">
           <?php
              include "inicio/cajas-superiores.php";
           ?>

        </div> 
        <br>
        <div class="col-xs-12 col-sm-12">
          <div class= "row">
            <div class="col-xs-12 col-sm-6">
               <?php
                  include "inicio/grafico-ventas.php";      
                  include "inicio/lineas-pendientes.php";
               ?>
           
               
            </div>
            <div class="col-xs-12 col-sm-6">
               <?php
                  include "inicio/grafico-clientes.php";      
               ?>
            </div> 
          </div> 

        </div>

        <br>   
        <div class="col-xs-12 col-sm-12">       
           <img src="vistas/img/plantilla/fondo2.png" class="img-responsive" style="width: 100%; height: 150px;"> 
        </div>  
        
    </div>
    
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->