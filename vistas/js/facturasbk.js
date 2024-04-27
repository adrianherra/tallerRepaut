/*=============================================
CARGAR LA TABLA DINÁMICA DE FACTURAS
=============================================*/

var tablaFacturas = $('.tablaFacturas').DataTable( {
   "footerCallback": function ( row, data, start, end, display ) {
      var api = this.api(), data;
    },

   "searching": false,
   "deferRender": true,
   "retrieve": true,  
   "processing": true,   
   "orderCellsTop": true,    
   "fixedHeader": true,
   "bAutoWidth": false,
   "lengthMenu": [10 ,15, 20],
   "pageLength": 15,
   "bLengthChange": false,
   
   "language": {
       "sProcessing":     "Procesando...",
       "sLengthMenu":     "Mostrar _MENU_ registros",
       "sZeroRecords":    "No se encontraron resultados",
       "sEmptyTable":     "Ningún dato disponible en esta tabla",
       "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_",
       "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0",
       "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
       "sInfoPostFix":    "",
       "sSearch":         "Buscar:",
       "sUrl":            "",
       "decimal": ",",
       "thousands": ".",
       "sInfoThousands":  ",",
       "sLoadingRecords": "Cargando...",
       "oPaginate": {
       "sFirst":    "Primero",
       "sLast":     "Último",
       "sNext":     "Siguiente",
       "sPrevious": "Anterior"
       },
       "oAria": {
          "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
         "sSortDescending": ": Activar para ordenar la columna de manera descendente"
       }
    },
     
    "fnRowCallback": function( nRow, aData, iDisplayIndex, iDisplayIndexFull ) {
      if (aData[4] > 0 )
      {
          $("td:eq(4)", nRow).text(parseFloat(aData[4], 10).toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, "$1,").toString());
          $("td:eq(4)", nRow).css("text-align", "right");
          $("td:eq(4)", nRow).css("font-size", "x-small");
      } else {
         $("td:eq(4)", nRow).css("text-align", "right");
         $("td:eq(4)", nRow).css("font-size", "x-small");             
      }

      if (aData[5] > 0)
      {
          $("td:eq(5)", nRow).text(parseFloat(aData[5], 10).toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, "$1,").toString());
          $("td:eq(5)", nRow).css("text-align", "right");
          $("td:eq(5)", nRow).css("font-size", "x-small");
      } else {
         $("td:eq(5)", nRow).css("text-align", "right");
         $("td:eq(5)", nRow).css("font-size", "x-small");
      }
   },
   
   "footerCallback": function ( row, data, start, end, display ) {
      var api = this.api();
      nb_cols = api.columns().nodes().length;
 
      //Sub-Total Dolares      
      var subTotal = api
          .column( 4, { page: 'current'} )
          .data()
          .reduce( function (a, b) {
           return Number(a) + Number(b);
      }, 0 );
      $(api.column(4).footer()).html('$ '+ parseFloat(subTotal, 10).toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, "$1,").toString());
      $(api.column(4).footer()).css("text-align", "right");
      $(api.column(4).footer()).css("font-weight", "bold");  
        
      // Totales Dolares
      var total= api
          .column( 5, { page: 'current'} )
          .data()
          .reduce( function (a, b) {
            return Number(a) + Number(b);
      }, 0 );
      $(api.column(5).footer()).html('$ '+ parseFloat(total, 10).toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, "$1,").toString());
      $(api.column(5).footer()).css("text-align", "right");
      $(api.column(5).footer()).css("font-weight", "bold");
   }
    
 });
     

/*=============================================
ELIMINAR LINEA
=============================================*/
$(".tablaFacturas tbody").on("click", "button.btnBorrarLn", function(){
    
   event.preventDefault(); 
   var lnFactura = $(this).attr("lnFactura");
   window.location = "index.php?ruta=facturas&lnFactura="+ lnFactura;   
   
});

/*=============================================
FACTURA NUEVA
=============================================*/
$(document).on("click", "button.btnNuevaFactura", function(){   
   var fecha =  $(this).attr("nFecha");
   event.preventDefault(); 
   var datos = new FormData();
   datos.append("nFecha", nFecha);
             
   $.ajax({
        url: "ajax/facturas.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,  
        dataType:"json",
        success: function(respuesta){
            console.log("respuesta:", respuesta); 
            $("#nFactura").val(respuesta[0]["siguiente"]);
            $("#nIdFactura").val(respuesta[0]["siguiente"]); 
            $('.btnNuevaFactura').css('display','none');
            $('.btnBuscarFactura').css('display','none');
            $('.btnFinFactura').css('display','block');  
            $('.btnAddLinea').css('display','block');
            $('.entTrack').css('display','block');
            $("#nTrack").focus(); 
               
         } // fin respuesta
   });// fin ajax     
     
});  
/*=============================================
ACTUALIZAR TRACKING
=============================================*/
$(".btnActulizaTracking").change(function(){
   //var nTracking = $("#nTrack").val();
   //var nFactura = $("#nFactura").val();

}); // fin actualizaTracking

/*=============================================
ACTIVAR  FACTURA
=============================================*/
$(document).on("click", "button.btnActivaFactura", function(){   
   //event.preventDefault();
   var idFactura =  $(this).attr("idFactura");
   var datos = new FormData();
   datos.append("idFactura", idFactura);
   //alert(idFactura);
        
   $.ajax({
        url: "ajax/facturas.ajax.php",
        method: "POST", 
        data: datos,
        cache: false,
        contentType: false,   
        processData: false,  
        dataType:"json",
        success: function(respuesta){
            console.log("respuesta:", respuesta);
                
            window.location = "facturas";   
               
         } // fin respuesta
   });// fin ajax     
   
});  
  
/*=======================
    EDITAR FACTURA
=========================*/
$(".tablaFacturas").on("click", ".btnEditarFactura", function(){
     
   var lnFactura = $(this).attr("lnFactura");
            
   var datos = new FormData();
   datos.append("lnFactura", lnFactura);
 
   $.ajax({
         url: "ajax/facturas.ajax.php",
         method: "POST",
         data: datos,
         cache: false,
         contentType: false,
         processData: false,
         dataType:"json",     
         success: function(respuesta){
           console.log("respuesta:", respuesta);
           $("#eIdFactura").val(respuesta[0]["id"]);
           $("#eCanti").val(respuesta[0]["cantidad"]);
           $("#eParte").val(respuesta[0]["parte"]);
           $("#eDescri").val(respuesta[0]["descripcion"]);
           $("#eMonto").val(respuesta[0]["monto"]);
             
         } // fin respuesta
    });// fin ajax
 }); // fin btnEditarLinea 
 
/*=======================
    ADD FACTURA
=========================*/
$(".tablaFacturas").on("click", ".btnAddLinea", function(){
   $("#nCanti").focus();  
}); // fin btnAddLinea 
 

     