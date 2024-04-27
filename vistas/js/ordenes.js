/*$.ajax({

  url: "ajax/datatable-lineas.ajax.php",
  success:function(respuesta1){
    console.log("respuesta1",respuesta1);
  }
            
})*/          
             
var tablaOrdenes = $('.tablaOrdenes').DataTable( {
    "footerCallback": function ( row, data, start, end, display ) {
      var api = this.api(), data;
    },
    "deferRender": true,
    "retrieve": true,
    "processing": true,   
    "orderCellsTop": true,    
    "fixedHeader": true,
    "bAutoWidth": false,
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
          if (aData[7] > 0 )
          {
              $("td:eq(7)", nRow).text(parseFloat(aData[7], 10).toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, "$1,").toString());
              $("td:eq(7)", nRow).css("text-align", "right");
              $("td:eq(7)", nRow).css("font-size", "x-small");
          } else {
             $("td:eq(7)", nRow).css("text-align", "right");
             $("td:eq(7)", nRow).css("font-size", "x-small");             
          }

          if (aData[8] > 0)
          {
              $("td:eq(8)", nRow).text(parseFloat(aData[8], 10).toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, "$1,").toString());
              $("td:eq(8)", nRow).css("text-align", "right");
              $("td:eq(8)", nRow).css("font-size", "x-small");
          } else {
             $("td:eq(8)", nRow).css("text-align", "right");
             $("td:eq(8)", nRow).css("font-size", "x-small");
          }

          if (aData[9] > 0)
          {
              $("td:eq(9)", nRow).text(parseFloat(aData[9], 10).toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, "$1,").toString());
              $("td:eq(9)", nRow).css("text-align", "right");
              $("td:eq(9)", nRow).css("font-size", "x-small");
          } else {
             $("td:eq(9)", nRow).css("text-align", "right");
             $("td:eq(9)", nRow).css("font-size", "x-small");
          }

          if (aData[10] > 0)
          {
              $("td:eq(10)", nRow).text(parseFloat(aData[10], 10).toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, "$1,").toString());
              $("td:eq(10)", nRow).css("text-align", "right");
              $("td:eq(10)", nRow).css("font-size", "x-small");
          } else {
             $("td:eq(10)", nRow).css("text-align", "right");
             $("td:eq(10)", nRow).css("font-size", "x-small");
          } 
          
          if (aData[11] > 0)
          {
              $("td:eq(11)", nRow).text(parseFloat(aData[11], 10).toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, "$1,").toString());
              $("td:eq(11)", nRow).css("text-align", "right");
              $("td:eq(11)", nRow).css("font-size", "x-small");
          } else {
             $("td:eq(11)", nRow).css("text-align", "right");
             $("td:eq(11)", nRow).css("font-size", "x-small");
          }

                    
    },
      
    "footerCallback": function ( row, data, start, end, display ) {
        var api = this.api();

        nb_cols = api.columns().nodes().length;
      
        //Totales de monto en colones       
        var montoCol = api
            .column( 7, { page: 'current'} )
            .data()
            .reduce( function (a, b) {
             return Number(a) + Number(b);
        }, 0 );
        $(api.column(7).footer()).html('¢ '+ parseFloat(montoCol, 10).toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, "$1,").toString());
        $(api.column(7).footer()).css("text-align", "right");
        $(api.column(7).footer()).css("font-size", "x-small");  
        // Totales de costo en colones
        var costoCol= api
            .column( 8, { page: 'current'} )
            .data()
            .reduce( function (a, b) {
              return Number(a) + Number(b);
        }, 0 );
        $(api.column(8).footer()).html('¢ '+ parseFloat(costoCol, 10).toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, "$1,").toString());
        $(api.column(8).footer()).css("text-align", "right");
        $(api.column(8).footer()).css("font-size", "x-small");

        //Totales de Utilidad en Colones 
        var utilidadCol = api
            .column( 9, { page: 'current'} )
            .data()
            .reduce( function (a, b) {
              return Number(a) + Number(b);
        }, 0 );
        $(api.column(9).footer()).html('¢ '+ parseFloat(utilidadCol, 10).toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, "$1,").toString());
        $(api.column(9).footer()).css("text-align", "right");
        $(api.column(9).footer()).css("font-size", "x-small");
        
        //Totales de Porcentajes en Colones
        var porUtl = 0; 
        if ((utilidadCol != 0) && (costoCol != 0))  
            porUtl = (utilidadCol / costoCol) * 100;
        $(api.column(10).footer()).html('% '+ parseFloat(porUtl, 10).toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, "$1,").toString());
        $(api.column(10).footer()).css("text-align", "right");
        $(api.column(10).footer()).css("font-size", "x-small");

        //Totales de Saldo en Colones 
        var utilidadCol = api
            .column( 11, { page: 'current'} )
            .data()
            .reduce( function (a, b) {
              return Number(a) + Number(b);
        }, 0 );
        $(api.column(11).footer()).html('¢ '+ parseFloat(utilidadCol, 10).toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, "$1,").toString());
        $(api.column(11).footer()).css("text-align", "right");
        $(api.column(11).footer()).css("font-size", "x-small");
     

    }

});

/*=======================
    FILTRAR ORDENES
=========================*/
$(document).ready(function() {
     
    // Setup - add a text input to each footer cell
    //$('.tablaPagos thead tr').clone(true).appendTo( '.tablaPagos thead' );
    $('.tablaOrdenes thead tr:eq(0) th').each( function (i) {
       if ((i == 1) || (i == 2) || (i == 3) || (i == 4) || (i == 5) || (i == 12)) {
           var title = $(this).text();
           switch (i) {
               case 1:
                  $(this).html( '<input type="text" placeholder="Orden" style= "width: 80px; background-color: cyan; font-size: x-small;" />' );    
                  break;
               case 2:
                  $(this).html( '<input type="text" placeholder="Aseguradora" style= "width: 70px; background-color: cyan; font-size: x-small;"/>' );    
                  break;
               case 3:
                  $(this).html( '<input type="text" placeholder="F.Orden" style= "width: 60px; background-color: cyan; font-size: x-small;"/>' );    
                  break; 
               case 4:
                  $(this).html( '<input type="text" placeholder="Placa" style= "width: 70px; background-color: cyan; font-size: x-small;"/>' );    
                  break;
               case 5:
                  $(this).html( '<input type="text" placeholder="Marca" style= "width: 80px; background-color: cyan; font-size: x-small;"/>' );    
                  break;   
               case 12:
                  $(this).html( '<input type="text" placeholder="Estado" style= "width: 60px; background-color: cyan; font-size: x-small;"/>' );    
                  break;   
                 
           } 
           
           $( 'input', this ).on( 'keyup change', function () {
             if ( tablaOrdenes.column(i).search() !== this.value ) {
                tablaOrdenes
                    .column(i)
                    .search( this.value )
                    .draw();
             }// fin if
          });
       } // fin if 
    });
   
} );  

/*=============================================
AGREGA VER DETALLE
=============================================*/
$(".tablaOrdenes tbody").on("click", "button.btnVerDetalle", function(){   
   event.preventDefault();
   var idOrden= $(this).attr("vIdOrden");
   
   $("#verLineas").val(idOrden);
   $("#pasar").submit();             
     
}); // fin btnVerDetalle

/*=============================================
AGREGA VER DETALLE
=============================================*/
$(".tablaOrdenes tbody").on("click", "button.btnVerDetalleOld", function(){   
  event.preventDefault();
  var idOrden= $(this).attr("vIdOrden");
  
  $("#verLineas").val(idOrden);
  $("#pasarOld").submit();             
    
}); // fin btnVerDetalleOld
  

  
/*=============================================
AGREGAR TALLER
=============================================*/
$(document).on("click", ".btnAgregarTaller", function(){
    var nTaller = $(this).attr("nTaller");
    $("#nuevoTaller").val(nTaller);
    $("#editaTaller").val(nTaller);
});

/*=============================================
BORRAR ORDEN
=============================================*/
$(".tablaOrdenes tbody").on("click", "button.btnEliminarOrden", function(){
 
  //event.preventDefault(); 
  
  var idOrden = $(this).attr("idOrden");
  
  swal({        
    title: '¿Está seguro de borrar la linea?',
    text: "¡Si no lo está puede cancelar la accíón!",
    type: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      cancelButtonText: 'Cancelar',
      confirmButtonText: 'Si, borrar orden!'
  }).then(function(result){

    if (result.value){
        
        window.location = "index.php?ruta=ordenes&idOrden="+ idOrden;   
           
    }//fin if   

  }); 
 
});
  
/*=======================
    EDITAR ORDENES
=========================*/
$(".tablaOrdenes").on("click", ".btnEditarOrden", function(){
  var vIdOrden= $(this).attr("idOrden");
  var datos = new FormData();
  datos.append("vIdOrden", vIdOrden);

  $.ajax({
        url: "ajax/ordenes.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType:"json",   
        success: function(respuesta){
          console.log("respuesta:", respuesta);
           $("#editaIdOrden").val(respuesta["id"]);
           $("#editaOrden").val(respuesta["orden"]);
           $("#editaAseguradora").val(respuesta["aseguradora"]);
           $("#editaTaller").val(respuesta["taller"]);
           $("#editaFecha").val(respuesta["fechaOrden"]); 
           $("#editaPlaca").val(respuesta["placa"]);
           $("#editaMarca").val(respuesta["marca"]);
           $("#editaModelo").val(respuesta["modelo"]);
           $("#editaAno").val(respuesta["ano"]);
           $("#editaPlazo").val(respuesta["plazo"]);
           $("#editaSiniestro").val(respuesta["siniestro"]);
           $("#editaFVenc").val(respuesta["fechaVencimiento"]);
           $("#editaObserva").val(respuesta["observacion"]);
           $("#editaEnvio").val(respuesta["envio"]); 
           $("#editaFlete").val(respuesta["flete"]);
           $("#editaImpAduanas").val(respuesta["impAduanas"]);
           if(respuesta["pdf1"] != ""){ 
             $("#pdfActual1").val(respuesta["pdf1"]); 
           }//fin if 
           if(respuesta["pdf2"] != ""){ 
             $("#pdfActual2").val(respuesta["pdf2"]); 
           }//fin if
           if(respuesta["pdf3"] != ""){ 
             $("#pdfActual3").val(respuesta["pdf3"]); 
           }//fin if
           if(respuesta["pdf4"] != ""){ 
             $("#pdfActual4").val(respuesta["pdf4"]); 
           }//fin if
           if(respuesta["pdf5"] != ""){ 
             $("#pdfActual5").val(respuesta["pdf5"]); 
           }//fin if
              
           //$("#editaPdf1").val(respuesta["pdf1"]);
           //$("#editaPdf2").val(respuesta["pdf2"]);
           //$("#editaPdf3").val(respuesta["pdf3"]);
           //$("#editaPdf4").val(respuesta["pdf4"]);
           //$("#editaPdf5").val(respuesta["pdf5"]);
        }

  })
     

});    
   
    
/*=======================
    VER PDFs
=========================*/
             
$(".tablaOrdenes").on("click", ".btnVerOrdenes", function(){

  var vIdOrden= $(this).attr("idOrden");
  var verPdf =$('#verPdf').val(); 
  var datos = new FormData();
  datos.append("vIdOrden", vIdOrden);
  

   $.ajax({
    url: "ajax/ordenes.ajax.php",
    method: "POST",
        data: datos,   
        cache: false,
      contentType: false,
      processData: false,
      dataType:"json",
      success: function(respuesta){
         $("#archivoPDF1").attr('src',respuesta["pdf1"]);
         $("#archivoPDF2").attr('src',respuesta["pdf2"]);
         $("#archivoPDF3").attr('src',respuesta["pdf3"]);
         $("#archivoPDF4").attr('src',respuesta["pdf4"]);
         $("#archivoPDF5").attr('src',respuesta["pdf5"]);
      }

  }) 


});


$('#verPdf').change(function(){
    var verPdf =$('#verPdf').val();
    switch(verPdf){
        case "pdf1":
          $('#archivoPDF1').show();
          $('#archivoPDF2').hide();
          $('#archivoPDF3').hide();
          $('#archivoPDF4').hide();
          $('#archivoPDF5').hide();  
          break;
        case "pdf2":
          $('#archivoPDF1').hide();
          $('#archivoPDF2').show();
          $('#archivoPDF3').hide();
          $('#archivoPDF4').hide();
          $('#archivoPDF5').hide();
          break;
        case "pdf3":
          $('#archivoPDF1').hide();
          $('#archivoPDF2').hide();
          $('#archivoPDF3').show();
          $('#archivoPDF4').hide();
          $('#archivoPDF5').hide();
          break;
        case "pdf4":
          $('#archivoPDF1').hide();
          $('#archivoPDF2').hide();
          $('#archivoPDF3').hide();
          $('#archivoPDF4').show();
          $('#archivoPDF5').hide();
          break;
        case "pdf5":
          $('#archivoPDF1').hide();
          $('#archivoPDF2').hide();
          $('#archivoPDF3').hide();
          $('#archivoPDF4').hide();
          $('#archivoPDF5').show();
          break;

    } // fin switch

});

/*=======================
    VER REPORTES ORDENES
=========================*/
$(document).on("click", "button.btnReporteOrden", function(){
    
  var sReporte=  $("#sReporte").val();
  var fechaInicial= $("#fechaInicial").val();
  var fechaFinal= $("#fechaFinal").val();
  var sTipo = $("#sTipo").val(); 
  
  var datos = new FormData();
  datos.append("sReporte", sReporte);
  datos.append("fechaInicial", fechaInicial);
  datos.append("fechaFinal", fechaFinal);
  datos.append("sTipo", sTipo);
     
  $.ajax({
    url: "reportes/ordenes.ajax.php",
    method: "POST",
    data: datos,       
    cache: false, 
    contentType: false,
    processData: false,
    dataType:"json",
    success: function(respuesta){
       console.log("respuesta:", respuesta); 
          
    } // fin respuesta

  }); 

   
}); // FIN REPORTES ORDENES

/*=======================
  CAMBIO DE SELECCION
=========================*/
$('#sReporte, #fechaInicio, #fechaFin, #sTipo').change(function(){
   $('#aReporte').hide();

});

/*=======================
    CIERRE REPORTES
=========================*/
$(document).on("click", "button.btnCierreReporte", function(){

  $('#aReporte').hide();
  $("#sReporte").val("xFecha");
  $("#fechaInicial").val("");
  $("#fechaFinal").val("");
  //$("#sTipo").val("resumido");

});  

/*=======================
    REPORTE X SALDOS
=========================*/
$('#sReporte').change(function(){
  var tipo=  $("#sReporte").val();
  if (tipo == "xSaldos") {
    $('.saldos').hide();
  } else {
    $('.saldos').show();    
  } // fin if
});