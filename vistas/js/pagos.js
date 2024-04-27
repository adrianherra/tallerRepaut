
var perfilOculto = $("#perfilOculto").val();

var tablaPagos = $('.tablaPagos').DataTable( {
  "ajax": "ajax/datatable-pagos.ajax.php?perfilOculto="+perfilOculto,
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
      $("td:eq(1)", nRow).css("text-align", "left");
      $("td:eq(1)", nRow).css("font-size", "x-small");
      $("td:eq(1)", nRow).css("width", "80px");

      $("td:eq(2)", nRow).css("text-align", "left");
      $("td:eq(2)", nRow).css("font-size", "x-small");
      $("td:eq(2)", nRow).css("width", "90px");
      
      $("td:eq(3)", nRow).css("text-align", "center");
      $("td:eq(3)", nRow).css("font-size", "x-small");
      $("td:eq(3)", nRow).css("width", "70px");

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

      $("td:eq(6)", nRow).css("text-align", "left");
      $("td:eq(6)", nRow).css("font-size", "x-small");
      $("td:eq(6)", nRow).css("width", "270px");
  }, // fin fnRowCallback

  "footerCallback": function ( row, data, start, end, display ) {
      var api = this.api();
      nb_cols = api.columns().nodes().length;
       
      var montoTotal = api
        .column( 4, { page: 'current'} )
        .data()
        .reduce( function (a, b) {
        return Number(a) + Number(b);
      }, 0 );
      
      $(api.column(4).footer()).html('¢'+ parseFloat(montoTotal, 10).toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, "$1,").toString());
      $(api.column(4).footer()).css("text-align", "right");
      $(api.column(4).footer()).css("font-size", "x-small");
      var dolarTotal = api
        .column( 5, { page: 'current'} )
        .data()
        .reduce( function (a, b) {
        return Number(a) + Number(b);
      }, 0 );
         
      $(api.column(5).footer()).html('$'+ parseFloat(dolarTotal, 10).toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, "$1,").toString());
      $(api.column(5).footer()).css("text-align", "right");  
      $(api.column(5).footer()).css("font-size", "x-small"); 
    } // fin footerCallBack 

} );

/*=======================
    FILTRAR ORDEN
=========================*/
$(document).ready(function() {
        
    $('.tablaPagos thead tr:eq(0) th').each( function (i) {
       if ((i == 1) || (i == 2) || (i == 3) || (i == 6)) {
           var title = $(this).text();
           switch (i) {
               case 1:
                  $(this).html( '<input type="text" placeholder="Tipo" style= "width: 80px; background-color: cyan; font-size: x-small;" />' );    
                  break;
               case 2:
                  $(this).html( '<input type="text" placeholder="Documento" style= "width: 90px; background-color: cyan; font-size: x-small;"/>' );    
                  break;
               case 3:
                  $(this).html( '<input type="text" placeholder="Fecha" style= "width: 70px; background-color: cyan; font-size: x-small;"/>' );    
                  break; 
               case 6:
                  $(this).html( '<input type="text" placeholder="Observaciones" style= "width: 270px; background-color: cyan; font-size: x-small;"/>' );    
                  break;
            }
           
           $( 'input', this ).on( 'keyup change', function () {
             if ( tablaPagos.column(i).search() !== this.value ) {
                tablaPagos
                    .column(i)
                    .search( this.value )
                    .draw();
             }// fin if
          });
       } // fin if 
    });
   
} );  
   
/*=============================================
ELIMINAR ORDEN
=============================================*/
$(document).on("click", ".btnEliminarPago", function(){

  var idPago = $(this).attr("idPago");
  
  swal({
    title: '¿Está seguro de borrar el pago?',
    text: "¡Si no lo está puede cancelar la accíón!",
    type: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      cancelButtonText: 'Cancelar',
      confirmButtonText: 'Si, borrar pago!'
  }).then(function(result){

    if (result.value){

      window.location = "index.php?ruta=pagos&idPago="+ idPago;

    }//fin if

  })

})
   
/*=======================
    EDITAR PAGO
=========================*/
   
$(".tablaPagos").on("click", ".btnEditarPago", function(){

  var idPago= $(this).attr("idPago");
   
  var datos = new FormData();
  datos.append("idPago", idPago);
      
  $.ajax({
    url: "ajax/pagos.ajax.php",
    method: "POST",
        data: datos,
        cache: false,
      contentType: false,
      processData: false,
      dataType:"json",
      success: function(respuesta){
        $("#editaId").val(respuesta["id"]);
        $("#editaTipo").val(respuesta["tipo"]);
        $("#editaDoc").val(respuesta["numero"]);
        $("#editaFecha").val(respuesta["fecha"]);
        $("#editaMonto").val(respuesta["monto"]);
        $("#editaDolar").val(respuesta["dolares"]);
        $("#editaObserva").val(respuesta["observacion"]);
        if(respuesta["pdf"] != ""){ 
           $("#pdfActual").val(respuesta["pdf"]);
        }         
      }   

  })


})
     

/*=======================
    VER PDF
=========================*/
   
$(".tablaPagos").on("click", ".btnVerPDF", function(){

  var idPago= $(this).attr("idPago");
   
  var datos = new FormData();
  datos.append("idPago", idPago);
  

   $.ajax({
    url: "ajax/pagos.ajax.php",
    method: "POST",
        data: datos,
        cache: false,
      contentType: false,
      processData: false,
      dataType:"json",
      success: function(respuesta){
         
         $("#archivoPDF").attr('src',respuesta["pdf"]);
         
      }

  }) 


})


//=================================
function soloNumeros(evt) {
  var charCode = (evt.which) ? evt.which : event.keyCode
  if (charCode <= 13 || (charCode >= 48 && charCode <= 57) || charCode == 46)
    return true;
  return false;
} // fin funcion soloNumeros

 
   
/*=============================================
SUBIENDO LA FOTO DE LAS ORDENES
=============================================*/

$(".nuevoPDF").change(function(){

  var pdf = this.files[0];
     
  /*=============================================
    VALIDAMOS EL FORMATO DE LA IMAGEN SEA PDF O PNG
    =============================================*/
        
    if(pdf["type"] != "application/pdf"){
      
      $(".nuevoPDF").val("");

       swal({
          title: "Error al subir el pdf",
          text: "¡La archivo debe estar en formato PDF!",
          type: "error",
          confirmButtonText: "¡Cerrar!"
        });
    } 
})

/*=======================
    EDITAR ORDEN
=========================*/
   
$("#nuevoTipo").change(function(){
   
   var tipo = $("#nuevoTipo").val();
   var detalle = $("#detalle");
   var otro = $("#nuevoOtro");
   if (tipo == "Otros") {
      detalle.show();
      otro.val("");      
      otro.focus();  
   }else {
      otro.val(tipo);
      detalle.hide();
      $("#nuevaFecha").focus();      
   }
   

}); 

$("#editaTipo").change(function(){
   
   var tipo = $("#editaTipo").val();
   var detalle = $("#editaDetalle");
   var otro = $("#editaOtro");
   if (tipo == "Otros") {
      detalle.show();
      otro.val("");      
      otro.focus();  
   }else {
      otro.val(tipo);
      detalle.hide();
      $("#editaFecha").focus();      
   }
   
});


 
     


