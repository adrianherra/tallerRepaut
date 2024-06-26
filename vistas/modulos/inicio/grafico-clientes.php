<?php

$ordenes = ControladorOrdenes::ctrSumaClientes();
$colores = array("red","green","yellow","aqua","purple","blue","cyan","magenta","orange","gold");

$totalVentas = ControladorOrdenes::ctrSumaVentas();
           

?>   
   
<!--=====================================
PRODUCTOS MÁS VENDIDOS
======================================-->

<div class="box box-default">
	
	<div class="box-header with-border" style="background:#FF00FF; color:white; text-align: center;">   
  
      <h3 class="box-title">Top de Clientes</h3>

    </div>

	<div class="box-body">
    
      	<div class="row">   

	        <div class="col-md-7">

	 			<div class="chart-responsive">
	            
	            	<canvas id="pieChart" height="150"></canvas>
	          
	          	</div>

	        </div>

		    <div class="col-md-5">
		      	
		  	 	<ul class="chart-legend clearfix">

		  	 	<?php

					for($i = 0; $i < 10; $i++){

					  echo ' <li><i class="fa fa-support text-'.$colores[$i].'"></i>'.substr($ordenes[$i]["taller"],6,15).'<span class="pull-right"> ¢ '. number_format($ordenes[$i]["total"], 2, '.', ',').'</span></li>';
       
					}


		  	 	?>


		  	 	</ul>

		    </div>

		</div>

    </div>   

    <div class="box-footer no-padding">
    	
		<ul class="nav nav-pills nav-stacked">
			
			 <?php
           
          	for($i = 0; $i <6; $i++){
			
          		echo '<li>
						 
						 <a>

						 <i class="fa fa-car"></i> 
             '.$ordenes[$i]["taller"].' 
             
             
						 <span class="pull-right text-'.$colores[$i].'">   
						 '.ceil($ordenes[$i]["total"]*100/$totalVentas["totalVentas"]).'%
						 </span>
							
						 </a>

      				</li>';
           
			}

			?>
  

		</ul>

    </div>

</div>

<script>
	

  // -------------
  // - PIE CHART -
  // -------------
  // Get context with jQuery - using jQuery's .get() method.
  var pieChartCanvas = $('#pieChart').get(0).getContext('2d');
  var pieChart       = new Chart(pieChartCanvas);
  var PieData        = [

  <?php

  for($i = 0; $i < 10; $i++){

  	echo "{
      value    : ".$ordenes[$i]["total"].",
      color    : '".$colores[$i]."',
      highlight: '".$colores[$i]."',
      label    : '".$ordenes[$i]["taller"]."'
    },";

  }
    
   ?>
  ];
  var pieOptions     = {
    // Boolean - Whether we should show a stroke on each segment
    segmentShowStroke    : true,
    // String - The colour of each segment stroke
    segmentStrokeColor   : '#fff',
    // Number - The width of each segment stroke
    segmentStrokeWidth   : 1,
    // Number - The percentage of the chart that we cut out of the middle
    percentageInnerCutout: 50, // This is 0 for Pie charts
    // Number - Amount of animation steps
    animationSteps       : 100,
    // String - Animation easing effect
    animationEasing      : 'easeOutBounce',
    // Boolean - Whether we animate the rotation of the Doughnut
    animateRotate        : true,
    // Boolean - Whether we animate scaling the Doughnut from the centre
    animateScale         : false,
    // Boolean - whether to make the chart responsive to window resizing
    responsive           : true,
    // Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
    maintainAspectRatio  : false,
    // String - A legend template
    legendTemplate       : '<ul class=\'<%=name.toLowerCase()%>-legend\'><% for (var i=0; i<segments.length; i++){%><li><span style=\'background-color:<%=segments[i].fillColor%>\'></span><%if(segments[i].label){%><%=segments[i].label%><%}%></li><%}%></ul>',
    // String - A tooltip template
    tooltipTemplate      : '<%=value %> <%=label%>'
  };
  // Create pie or douhnut chart
  // You can switch between pie and douhnut using the method below.
  pieChart.Doughnut(PieData, pieOptions);
  // -----------------
  // - END PIE CHART -
  // -----------------


</script>