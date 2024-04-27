/*$.ajax({

  url: "ajax/datatable-lineas.ajax.php",
  success:function(respuesta1){
    console.log("respuesta1",respuesta1);
  }
             
})*/                
                     
var tablaLineas = $('.tablaLineas').DataTable( {
    "footerCallback": function ( row, data, start, end, display ) {
      var api = this.api(), data;
    },
    "deferRender": true,
    "retrieve": true,
    "orderCellsTop": true,    
    "fixedHeader": true,
    "bAutoWidth": false,
    "pageLength": 50,
    "language": {
      "processing": true,
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
          if (aData[5] > 0 )
          {
              $("td:eq(5)", nRow).text(parseFloat(aData[5], 10).toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, "$1,").toString());
              $("td:eq(5)", nRow).css("text-align", "right");
              $("td:eq(5)", nRow).css("font-size", "x-small");
          } else {
             $("td:eq(5)", nRow).css("text-align", "right");
             $("td:eq(5)", nRow).css("font-size", "x-small");             
          }

          if (aData[6] > 0)
          {
              $("td:eq(6)", nRow).text(parseFloat(aData[6], 10).toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, "$1,").toString());
              $("td:eq(6)", nRow).css("text-align", "right");
          } else {
             $("td:eq(6)", nRow).css("text-align", "right");
          }

          if (aData[7] > 0)
          {
              $("td:eq(7)", nRow).text(parseFloat(aData[7], 10).toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, "$1,").toString());
              $("td:eq(7)", nRow).css("text-align", "right");
          } else {
             $("td:eq(7)", nRow).css("text-align", "right");
          }
          if (aData[8] > 0)
          {
              $("td:eq(8)", nRow).text(parseFloat(aData[8], 10).toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, "$1,").toString());
              $("td:eq(8)", nRow).css("text-align", "right");
          } else {
             $("td:eq(8)", nRow).css("text-align", "right");
          } 


                    
   },
     
    "footerCallback": function ( row, data, start, end, display ) {
        var api = this.api();

        nb_cols = api.columns().nodes().length;
      
        //Totales de monto en colones       
        var montoCol = api
            .column( 5, { page: 'current'} )
            .data()
            .reduce( function (a, b) {
             return Number(a) + Number(b);
        }, 0 );
        $(api.column(5).footer()).html('¢ '+ parseFloat(montoCol, 10).toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, "$1,").toString());
        $(api.column(5).footer()).css("text-align", "right");
        $(api.column(5).footer()).css("font-size", "x-small");
        // Totales de costo en colones
        var costoCol= api
            .column( 6, { page: 'current'} )
            .data()
            .reduce( function (a, b) {
              return Number(a) + Number(b);
        }, 0 );
        $(api.column(6).footer()).html('¢ '+ parseFloat(costoCol, 10).toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, "$1,").toString());
        $(api.column(6).footer()).css("text-align", "right");
        $(api.column(6).footer()).css("font-size", "x-small");        
        //Totales de Utilidad en Colones 
        var utilidadCol = api
            .column( 7, { page: 'current'} )
            .data()
            .reduce( function (a, b) {
              return Number(a) + Number(b);
        }, 0 );
        $(api.column(7).footer()).html('¢ '+ parseFloat(utilidadCol, 10).toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, "$1,").toString());
        $(api.column(7).footer()).css("text-align", "right"); 
        $(api.column(7).footer()).css("font-size", "x-small");
        var porUtl = 0; 
        if ((utilidadCol != 0) && (costoCol != 0))  
            porUtl = (utilidadCol / costoCol) * 100;
        
        $(api.column(8).footer()).html('% '+ parseFloat(porUtl, 10).toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, "$1,").toString());
        $(api.column(8).footer()).css("font-size", "x-small");
        $(api.column(8).footer()).css("text-align", "right");        
       
    }

});

/*=======================
    FILTRAR LINEAS
=========================*/
$(document).ready(function() {
        
    // Setup - add a text input to each footer cell
    //$('.tablaPagos thead tr').clone(true).appendTo( '.tablaPagos thead' );
    $('.tablaLineas thead tr:eq(0) th').each( function (i) {
       if ((i == 1) || (i == 2) || (i == 3) || (i == 4) || (i == 9) || (i == 10) || (i == 11) ) {
           var title = $(this).text();
           switch (i) {
               case 1:
                  $(this).html( '<input type="text" placeholder="# Parte" style= "width: 60px; background-color: cyan;" />' );    
                  break;
               case 2:
                  $(this).html( '<input type="text" placeholder="# Mia" style= "width: 100px; background-color: cyan; font-size: x-small;"/>' );    
                  break;
               case 3:
                  $(this).html( '<input type="text" placeholder="Compra" style= "width: 45px; background-color: cyan;"/>' );    
                  break; 
               case 4:
                  $(this).html( '<input type="text" placeholder="Descripcíon" style= "width: 140px; background-color: cyan; font-size: x-small;"/>' );    
                  break;
               case 9:
                  $(this).html( '<input type="text" placeholder="F.Prec" style= "width: 80px; background-color: cyan;"/>' );    
                  break;   
               case 10:
                  $(this).html( '<input type="text" placeholder="Factura" style= "width: 40px; background-color: cyan;"/>' );    
                  break;
               case 11:
                  $(this).html( '<input type="text" placeholder="Estado" style= "width: 70px; background-color: cyan;"/>' );    
                  break;   
           }
           
           $( 'input', this ).on( 'keyup change', function () {
             if ( tablaLineas.column(i).search() !== this.value ) {
                tablaLineas
                    .column(i)
                    .search( this.value )
                    .draw();
             }// fin if
          });
       } // fin if 
    });
   
} );  


/*=============================================
tabla BuscarArticulo
=============================================*/

var tablaBuscaArticulo = $(".tablaBuscaArticulo").DataTable({
  "footerCallback": function ( row, data, start, end, display ) {
    var api = this.api(), data;
  },
  "deferRender": true,
  "retrieve": true,
  "processing": true,
  "orderCellsTop": true,    
  "fixedHeader": true,
  "bAutoWidth": false,
  //"autoWidth": false,
  "pageLength": 25,

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
    }, // fin oPaginate
    "oAria": {
      "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
      "sSortDescending": ": Activar para ordenar la columna de manera descendente"
    }// fin oAria

  }// fin language
   
});

/*=============================================
ELIMINAR LINEA
=============================================*/
$(".tablaLineas tbody").on("click", "button.btnEliminarLinea", function(){
 
  event.preventDefault(); 
  var idLinea = $(this).attr("idLinea");
  var idOrden = $(this).attr("idOrden");
  var montoOrden = - $(this).attr("montoOrden");
  var costoOrden = - $(this).attr("costoOrden");
  var estado = $(this).attr("estado");

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
        
        window.location = "index.php?ruta=lineas&idLinea="+ idLinea + "&idOrden="+ idOrden + "&montoOrden="+ montoOrden + "&costoOrden="+ costoOrden + "&estado="+ estado;   
           
    }//fin if   

  }) 
 
});
    
 /*=============================================        
               CANTIDAD ARTICULO
=============================================*/
var nCantidad = 1;

$(".btnCantidad").change(function(){
  nCantidad = Number($(this).prop('value'));
   
}); // fin cantidad
 /*=============================================        
                AGREGAR ARTICULO
=============================================*/
$(document).on("click", ".btnAgregarArticulo", function(){
    var nVenta = Number($(this).attr("nVenta"));
    
    var nVenta = nVenta * nCantidad;

    var nImp = nVenta * .13;
    var nTotal = nVenta + nImp;
    var nArticulo = $(this).attr("nArticulo");
    var nCodigo = $(this).attr("nCodigo");
    
    $("#nParte").val(nCodigo);
    $("#nArticulo").val(nCodigo);
    $("#nDescri").val(nArticulo);
    $("#nCostoLocal").val(nVenta.toFixed(2));
    $("#nImpCompra").val(nImp.toFixed(2));  
 
    $("#nTCompra").val(nTotal.toFixed(2));
    alert(nTotal);  
    $("#eParte").val(nCodigo);
    $("#eArticulo").val(nCodigo);
    $("#eDescri").val(nArticulo);
    $("#eCostoLocal").val(nVenta.toFixed(2));
    $("#eImpCompra").val(nImp.toFixed(2));  
    $("#eTCompra").val(nTotal.toFixed(2));
   
});

//=================================
function soloNumeros(evt) {
  var charCode = (evt.which) ? evt.which : event.keyCode
  if (charCode <= 13 || (charCode >= 48 && charCode <= 57) || charCode == 46)
    return true;
  return false;
}; // fin funcion soloNumeros

function siguiente(e,id){
  tecla = (document.all) ? e.keyCode : e.which;
  if (tecla==13) {
    x = $(id);
    sig = $("#eCompra").val();
    sig1 = $("#nCompra").val();
    if ((x.attr("id")=="ePVenta") && (sig == "LOCAL"))
      $("#eCostoLocal").focus();
    else if ((x.attr("id")=="ePVenta") && (sig == "EXTERNA"))
      $("#eTCambio").focus();
    else if ((x.attr("id")=="nPVenta") && (sig1 == "LOCAL"))
      $("#nCostoLocal").focus();
    else if ((x.attr("id")=="nPVenta") && (sig1 == "EXTERNA"))
      $("#nTCambio").focus();
    else
      x.focus();
  }// fin if
   
};


function cambiaColor(){
  x = $("#nuevoPago");

  if(x.hasClass( "btn-info")) {
       x.removeClass('btn-info');
       x.addClass('btn-success');
       x.html('No Pagó');
       $("#nuevoPago1").val('0');
      
  } else {
       x.removeClass('btn-success');
       x.addClass('btn-info');
       x.html('Si Pagó');
       $("#nuevoPago1").val('1');
      
  } // fin if  
};

function editaColor(){
  x = $("#editaPago");
  if(x.hasClass( "btn-info")) {
       x.removeClass('btn-info');
       x.addClass('btn-success');
       x.html('No Pagó');  
       $("#editaPago1").val('0'); 
  } else {
       x.removeClass('btn-success');
       x.addClass('btn-info');
       x.html('Si Pagó');
       $("#editaPago1").val('1');
  } // fin if  
};
  
$("#nPVenta").change(function(){

   var vPVenta= Number($("#nPVenta").val());  
   var impuesto = (vPVenta * 0.13);
     
   var total = vPVenta + impuesto;   
   
   $("#nPVenta").val(vPVenta);
   $("#nPVenta").number(true,2);
   
   $("#nImpVenta").val(impuesto);
   $("#nImpVenta").number(true,2);
   
   $("#nPrecioIva").val(total);
   $("#nPrecioIva").number(true,2);
   
 });

$("#ePVenta").change(function(){

   var vPVenta= Number($("#ePVenta").val());  
   var impuesto = (vPVenta * 0.13);
   var total = vPVenta + impuesto;   
   
   $("#ePVenta").val(vPVenta);
   $("#ePVenta").number(true,2);
   
   $("#eImpVenta").val(impuesto);
   $("#eImpVenta").number(true,2);
   
   $("#ePrecioIva").val(total);
   $("#ePrecioIva").number(true,2);
   
 });

$("#nImpVenta").change(function(){

   var vPVenta= Number($("#nPVenta").val());  
   var vImpVenta= Number($("#nImpVenta").val());
   var total = vPVenta + vImpVenta;   
   
   $("#nImpVenta").val(vImpVenta);
   $("#nImpVenta").number(true,2);
   
   $("#nPrecioIva").val(total);
   $("#nPrecioIva").number(true,2);
 
});

$("#eImpVenta").change(function(){

   var vPVenta= Number($("#ePVenta").val());  
   var vImpVenta= Number($("#eImpVenta").val());
   var total = vPVenta + vImpVenta;   
   
   $("#eImpVenta").val(vImpVenta);
   $("#eImpVenta").number(true,2);
   
   $("#ePrecioIva").val(total);
   $("#ePrecioIva").number(true,2);

});

$("#nMia").change(function(){
   var nMia =  $("#nMia").val();
   if (nMia != "") {
       var ruta = "https://myaccount.aeropost.com/es/PackageInformation/" + nMia; 
       $("#nRuta").val(ruta);
   }//fin if
   
});


$("#nPrecioIva").change(function(){

   var vPrecioIva= Number($("#nPrecioIva").val());  
   var monto = (vPrecioIva /1.13);
   var impuesto = monto * .13;   
   
   $("#nPVenta").val(monto);
   $("#nPVenta").number(true,2);
   
   $("#nImpVenta").val(impuesto);
   $("#nImpVenta").number(true,2);
   
   $("#nPrecioIva").val(vPrecioIva);
   $("#nPrecioIva").number(true,2);
   
   
 });

$("#ePrecioIva").change(function(){

   var vPrecioIva= Number($("#ePrecioIva").val());  
   var monto = (vPrecioIva /1.13);
   var impuesto = monto * .13;   
   
   $("#ePVenta").val(monto);
   $("#ePVenta").number(true,2);
   
   $("#eImpVenta").val(impuesto);
   $("#eImpVenta").number(true,2);
   
   $("#ePrecioIva").val(vPrecioIva);
   $("#ePrecioIva").number(true,2);
   
   
});


$("#nCostoLocal").change(function(){

   var nCostoLocal = Number($("#nCostoLocal").val()); 
   var nImpuesto = nCostoLocal * .13;
   var nTotal = nCostoLocal + nImpuesto;

   $("#nCostoLocal").val(nCostoLocal);
   $("#nCostoLocal").number(true,2);
   
   $("#nImpCompra").val(nImpuesto);
   $("#nImpCompra").number(true,2);
   
   $("#nTCompra").val(nTotal);
   $("#nTCompra").number(true,2);
   

});

$("#eCostoLocal").change(function(){

   var eCostoLocal = Number($("#eCostoLocal").val()); 
   var eImpuesto = eCostoLocal * .13;
   var eTotal = eCostoLocal + eImpuesto;
  
   $("#eCostoLocal").val(eCostoLocal);
   $("#eCostoLocal").number(true,2);
   
   $("#eImpCompra").val(eImpuesto);
   $("#eImpCompra").number(true,2);
   
   $("#eTCompra").val(eTotal);
   $("#eTCompra").number(true,2);
  
});

$("#nImpCompra").change(function(){

   var nCostoLocal = Number($("#nCostoLocal").val()); 
   var nImpuesto = Number($("#nImpCompra").val());
   var nTotal = nCostoLocal + nImpuesto;
    
   $("#nCostoLocal").val(nCostoLocal);
   $("#nCostoLocal").number(true,2);
   
   $("#nImpCompra").val(nImpuesto);
   $("#nImpCompra").number(true,2);
   
   $("#nTCompra").val(nTotal);
   $("#nTCompra").number(true,2);
  
 });

$("#eImpCompra").change(function(){

   var eCostoLocal = Number($("#eCostoLocal").val()); 
   var eImpuesto = Number($("#eImpCompra").val());
   var eTotal = eCostoLocal + eImpuesto;

   $("#eCostoLocal").val(eCostoLocal);
   $("#eCostoLocal").number(true,2);
   
   $("#eImpCompra").val(eImpuesto);
   $("#eImpCompra").number(true,2);
   
   $("#eTCompra").val(eTotal);
   $("#eTCompra").number(true,2);
  

 });

$("#nTCompra").change(function(){

   var nTCompra = Number($("#nTCompra").val()); 
   var nMonto = nTCompra / 1.13;
   var nImpuesto = nMonto *.13 ;   

   $("#nCostoLocal").val(nMonto);
   $("#nCostoLocal").number(true,2);
   
   $("#nImpCompra").val(nImpuesto);
   $("#nImpCompra").number(true,2);
   
   $("#nTCompra").val(nTCompra);
   $("#nTCompra").number(true,2);
  
   
 });

$("#eTCompra").change(function(){

   var eTCompra = Number($("#eTCompra").val()); 
   var eMonto = eTCompra / 1.13;
   var eImpuesto = eMonto *.13 ;   
   
   $("#eCostoLocal").val(eMonto);
   $("#eCostoLocal").number(true,2);
   
   $("#eImpCompra").val(eImpuesto);
   $("#eImpCompra").number(true,2);
   
   $("#eTCompra").val(eTCompra);
   $("#eTCompra").number(true,2);
   

 });



 $("#nTCambio").change(function(){
   
   var cambio = Number($("#nTCambio").val());
   var costo = Number($("#nCostoUsa").val());
   var mia = Number($("#nCostoMia").val()); 
   var usa = costo + mia;
   var col = usa * cambio;

   $("#nTCambio").val(cambio);
   $("#nTCambio").number(true,2);
   
   $("#nTotalUsa").val(usa);
   $("#nTotalUsa").number(true,2);

   $("#nTotalCol").val(col);
   $("#nTotalCol").number(true,2);
   
 });

$("#eTCambio").change(function(){

   var cambio = Number($("#eTCambio").val());
   var costo  = Number($("#eCostoUsa").val());
   var mia    = Number($("#eCostoMia").val()); 
   var usa    = costo + mia;
   var col    = usa * cambio;

   $("#eTCambio").val(cambio);
   $("#eTCambio").number(true,2);
   
   $("#eTotalUsa").val(usa);
   $("#eTotalUsa").number(true,2);

   $("#eTotalCol").val(col);
   $("#eTotalCol").number(true,2);
   
 });

$("#nCostoUsa, #nCostoMia").change(function(){

   var cambio = Number($("#nTCambio").val());
   var costo  = Number($("#nCostoUsa").val());
   var mia    = Number($("#nCostoMia").val()); 
   var usa    = costo + mia;
   var col    = usa * cambio;

   $("#nTCambio").val(cambio);
   $("#nTCambio").number(true,2);

   $("#nCostoUsa").val(costo);
   $("#nCostoUsa").number(true,2);
   
   $("#nCostoMia").val(mia);
   $("#nCostoMia").number(true,2);
   
   $("#nTotalUsa").val(usa);
   $("#nTotalUsa").number(true,2);

   $("#nTotalCol").val(col);
   $("#nTotalCol").number(true,2);
   
 });

$("#eCostoUsa, #eCostoMia").change(function(){

   var cambio = Number($("#eTCambio").val());
   var costo  = Number($("#eCostoUsa").val());
   var mia    = Number($("#eCostoMia").val()); 
   var usa    = costo + mia;
   var col    = usa * cambio;

   $("#eTCambio").val(cambio);
   $("#eTCambio").number(true,2);

   $("#eCostoUsa").val(costo);
   $("#eCostoUsa").number(true,2);
   
   $("#eCostoMia").val(mia);
   $("#eCostoMia").number(true,2);
   
   $("#eTotalUsa").val(usa);
   $("#eTotalUsa").number(true,2);

   $("#eTotalCol").val(col);
   $("#eTotalCol").number(true,2);
   
 });

/*=======================
    EDITAR LINEA
=========================*/
$(".tablaLineas").on("click", ".btnEditarLinea", function(){

  var idLinea = $(this).attr("idLinea");
     
  var datos = new FormData();
  datos.append("idLinea", idLinea);
  $.ajax({   
        url: "ajax/lineas.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType:"json",     
        success: function(respuesta){
          console.log("respuesta:", respuesta);
          var eCompra = respuesta[0]["compra"];
          $("#eId").val(respuesta[0]["id"]);
          $("#eOrden").val(respuesta[0]["idOrden"]);
          $("#eParte").val(respuesta[0]["numParte"]);
          $("#eCompra").val(respuesta[0]["compra"]);
          $("#eMia").val(respuesta[0]["numMia"]);
          $("#eRuta").val(respuesta[0]["rutaMia"]);
          $("#eDescri").val(respuesta[0]["descripcion"]);
          $("#eFactura").val(respuesta[0]["numFactura"]);
          $("#eFecha").val(respuesta[0]["fechaFactura"]);
          $("#ePresenta").val(respuesta[0]["presentacion"]);
          $("#eVencimiento").val(respuesta[0]["vencimiento"]);
          $("#eTipo").val(respuesta[0]["tipo"]);
          $("#eCantidad").val(respuesta[0]["cantidad"]);
          $("#ePVenta").val(respuesta[0]["pVenta"]);
          $("#eImpVenta").val(respuesta[0]["impVenta"]);
          $("#ePrecioIva").val(respuesta[0]["totalVenta"]);
          $("#eCostoLocal").val(respuesta[0]["costoLocal"]);
          $("#eImpCompra").val(respuesta[0]["impLocal"]);
          $("#eTCompra").val(respuesta[0]["TCompra"]);
          $("#eTCambio").val(respuesta[0]["TCambio"]); 
          $("#eCostoUsa").val(respuesta[0]["costoUsa"]);
          $("#eCostoMia").val(respuesta[0]["costoMia"]);
          $("#eTotalUsa").val(respuesta[0]["totalUsa"]);
          $("#eTotalCol").val(respuesta[0]["totalCol"]);
          $("#eEstado").val(respuesta[0]["estado"]);
          $("#eMontoAnte").val(respuesta[0]["totalVenta"]);       
          $("#eCostoAnte").val(respuesta[0]["TCompra"] + respuesta[0]["totalCol"] );
          if (eCompra == "EXTERNA") {
            $('.cLocal').css('display','none');
            $('.cExterior').css('display','block');
          } else {
            $('.cLocal').css('display','block');
            $('.cExterior').css('display','none');
          }// fin       
          if (eCompra == "INVENTARIO") {
            $('.cInventario').css('display','block');
          }// fin if
          
        } // fin respuesta
        
      })// fin ajax
      
      
    }); // fin btnEditarLinea 
    
/*=======================
    EDITAR LINEA OLD
=========================*/
   
$(".tablaLineas").on("click", ".btnEditarLineaOld", function(){

  var idLineaOld = $(this).attr("idLinea");
     
  var datos = new FormData();
  datos.append("idLineaOld", idLineaOld);
  $.ajax({   
        url: "ajax/lineas.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType:"json",     
        success: function(respuesta){
          console.log("respuesta:", respuesta);  
          var eCompra = respuesta[0]["compra"];
          $("#eId").val(respuesta[0]["id"]);
          $("#eOrden").val(respuesta[0]["idOrden"]);
          $("#eParte").val(respuesta[0]["numParte"]);
          $("#eCompra").val(respuesta[0]["compra"]);
          $("#eMia").val(respuesta[0]["numMia"]);
          $("#eRuta").val(respuesta[0]["rutaMia"]);
          $("#eDescri").val(respuesta[0]["descripcion"]);
          $("#eFactura").val(respuesta[0]["numFactura"]);
          $("#eFecha").val(respuesta[0]["fechaFactura"]);
          $("#ePresenta").val(respuesta[0]["presentacion"]);
          $("#eVencimiento").val(respuesta[0]["vencimiento"]);
          $("#eTipo").val(respuesta[0]["tipo"]);
          $("#eCantidad").val(respuesta[0]["cantidad"]);
          $("#ePVenta").val(respuesta[0]["pVenta"]);
          $("#eImpVenta").val(respuesta[0]["impVenta"]);
          $("#ePrecioIva").val(respuesta[0]["totalVenta"]);
          $("#eCostoLocal").val(respuesta[0]["costoLocal"]);
          $("#eImpCompra").val(respuesta[0]["impLocal"]);
          $("#eTCompra").val(respuesta[0]["TCompra"]);
          $("#eTCambio").val(respuesta[0]["TCambio"]); 
          $("#eCostoUsa").val(respuesta[0]["costoUsa"]);
          $("#eImpImporta").val(respuesta[0]["impImporta"]);
          $("#eEnvio").val(respuesta[0]["envioUsa"]);
          $("#eCostoMia").val(respuesta[0]["costoMia"]);
          $("#eAduana").val(respuesta[0]["impAduana"]);
          $("#eImpMia").val(respuesta[0]["impMia"]);
          $("#eEnvioMia").val(respuesta[0]["emvioMia"]);
          $("#eTotalUsa").val(respuesta[0]["totalUsa"]);
          $("#eTotalCol").val(respuesta[0]["totalCol"]);
          $("#eEstado").val(respuesta[0]["estado"]);
          $("#eMontoAnte").val(respuesta[0]["totalVenta"]);       
          $("#eCostoAnte").val(respuesta[0]["TCompra"] + respuesta[0]["totalCol"] );
          if (eCompra == "EXTERNA") {
            $('.cLocal').css('display','none');
            $('.cExterior').css('display','block');
          } else {
            $('.cLocal').css('display','block');
            $('.cExterior').css('display','none');
          }// fin       
          if (eCompra == "INVENTARIO") {
            $('.cInventario').css('display','block');
          }// fin if
          
        } // fin respuesta
        
      })// fin ajax
      
      
    }); // fin btnEditarLinea 

/*=======================
    ACTUALIZAR ESTADO
=========================*/
$(".btnVerEstado").change(function(){

  var nLinea =  $(this).attr("nLinea");     
  var nEstado = $(this).prop('value');
    
  var datos = new FormData();
  datos.append("nLinea", nLinea);
  datos.append("nEstado", nEstado);
 
  $.ajax({
        url: "ajax/lineas.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,  
        dataType:"json",
        success: function(respuesta){
            window.location = "lineas"; 
        } // fin respuesta

  })// fin ajax 
 
}); // fin btnVerEstado 

/*=======================
    ACTUALIZAR ESTADO
=========================*/
$(".btnVerEstadoOld").change(function(){

  var nLineaOld =  $(this).attr("nLinea");     
  var nEstadoOld = $(this).prop('value');

  var datos = new FormData();
  datos.append("nLineaOld", nLineaOld);
  datos.append("nEstadoOld", nEstadoOld);
  //alert(nLineaOld + " - " + nEstadoOld);     
 
  $.ajax({
          url: "ajax/lineas.ajax.php",
          method: "POST",
          data: datos,
          cache: false,
          contentType: false,
          processData: false,  
          dataType:"json",
          success: function(respuesta){
            window.location = "lineasDima"; 
          } // fin respuesta
          
  });// fin ajax 
 
}); // fin btnVerEstadoOld 

/*=======================
    ACTUALIZAR FECHA PRESENTACION
=========================*/
$(".btnVerPresentacion").change(function(){

  var nLinea =    $(this).attr("nLinea");     
 
  var nPresenta = $("#nFPre").val();;
    
  var datos = new FormData();
  datos.append("nLinea", nLinea);
  datos.append("nPresenta", nPresenta);
            
  $.ajax({
        url: "ajax/lineas.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType:"json",
        success: function(respuesta){
            console.log("respuesta:", respuesta);
            window.location = "lineas"; 
        } // fin respuesta

  })// fin ajax 
  
}); // fin btnVerPresentacion
/*=======================
    LINEA NUEVA
=========================*/
$(document).on("click", "button.btnAgregarLineas", function(){
   $('.cLocal').css('display','block');
   $('.cInventario').css('display','none');
   $('.cExterior').css('display','none');
   $("#nParte").val("");
   $("#nRuta").val("");
   $("#nDescri").val("");
   $("#nFactura").val("");
   $("#nFecha").val("");
   $("#nPresenta").val("");  
   $("#nVencimiento").val("");
   $("#nCantidad").val("1");

   $("#nPVenta").val(0);
   $("#nPVenta").number(true,2);
   
   $("#nImpVenta").val(0);
   $("#nImpVenta").number(true,2);
   
   $("#nPrecioIva").val(0);
   $("#nPrecioIva").number(true,2);
   
   $("#nCompra").val("LOCAL");
   $("#nArticulo").val("");

   $("#nMia").val("");
   
   $("#nTCambio").val(0);
   $("#nTCambio").number(true,2);
   
   $("#nCostoUsa").val(0);
   $("#nCostoUsa").number(true,2);
   
   $("#nCostoMia").val(0);
   $("#nCostoMia").number(true,2);
   
   $("#nTotalUsa").val(0);
   $("#nTotalUsa").number(true,2);
   
   $("#nTotalCol").val(0);
   $("#nTotalCol").number(true,2);
   
   $("#nCostoLocal").val(0);
   $("#nCostoLocal").number(true,2);
   
   $("#nImpCompra").val(0);
   $("#nImpCompra").number(true,2);
   
   $("#nTCompra").val(0);
   $("#nTCompra").number(true,2);
   
});

/*=======================
    ACTUALIZAR ESTADO
=========================*/
$(document).on("click", "button.btnRegresar", function(){

  var nValor =  $(this).attr("nValor"); 
  var idOrden = $(this).attr("nId"); 
  var nSaldo = $(this).attr("nSaldo");
  var nMonto = $(this).attr("nMonto");
  var nCosto = $(this).attr("nCosto");
 
  var datos = new FormData();
  
  datos.append("nValor", nValor);
  datos.append("idOrden", idOrden);
  datos.append("nSaldo", nSaldo);
  datos.append("nMonto", nMonto);
  datos.append("nCosto", nCosto);
   
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
            window.location = "ordenes"; 
        } // fin respuesta

  })// fin ajax 
  
}); // fin btnVerEstado 

/*=======================
    ACTUALIZAR ESTADO
=========================*/
$(document).on("click", "button.btnRegresarOld", function(){
  
  var nValorOld =  $(this).attr("nValor"); 
  var idOrdenOld = $(this).attr("nId"); 
  var nSaldoOld = $(this).attr("nSaldo");
  var nMontoOld = $(this).attr("nMontoOld");
  var nCostoOld = $(this).attr("nCostoOld");
        
  var datos = new FormData();
                
  datos.append("nValorOld", nValorOld);
  datos.append("idOrdenOld", idOrdenOld);
  datos.append("nSaldoOld", nSaldoOld);
  datos.append("nMontoOld", nMontoOld);
  datos.append("nCostoOld", nCostoOld);

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
            window.location = "ordenesDima"; 
        } // fin respuesta

  })// fin ajax 
   
   
}); // fin btnVerEstadoOld 

/*=======================
  TIPO DE COMPRA EDITAR
=========================*/
$("#eCompra").change(function(){
   var eCompra =$('#eCompra').val();
    if (eCompra == "EXTERNA") {
       $('.cLocal').css('display','none');
       $('.cInventario').css('display','none');
       $('.cExterior').css('display','block');
       $("#eCostoLocal").val("");
       $("#eImpCompra").val("");
       $("#eTCompra").val("");
       $("#eMia").val("");
       $("#eRuta").val("");   
    } else {
       $('.cLocal').css('display','block');
       $('.cInventario').css('display','none');
       $('.cExterior').css('display','none');
       $("#eMia").val("");
       $("#eDescri").val("");
       $("#eMia").val("");
       $("#eRuta").val("");
       $("#eArticulo").val(""); 
       $("#eTCambio").val("");
       $("#eCostoUsa").val("");
       $("#eCostoMia").val("");
       $("#eTotalUsa").val("");
       $("#eTotalCol").val("");
    }// fin
    
    if (eCompra == "INVENTARIO") {
       $('.cInventario').css('display','block');
       $('.cLocal').css('display','block');
       $('.cExterior').css('display','none');
       $("#eMia").val("");
       $("#eDescri").val(""); 
       $("#eArticulo").val("");
       $("#eTCambio").val("");
       $("#eCostoUsa").val("");
       $("#eCostoMia").val("");
       $("#eTotalUsa").val("");
       $("#eTotalCol").val("");

    }// fin if  
       
 });

/*=======================
  TIPO DE COMPRA NUEVO
=========================*/
    
$('#nCompra').change(function(){
    var nCompra =$('#nCompra').val();
    if (nCompra == "EXTERNA") {
       $('.cLocal').css('display','none');
       $('.cInventario').css('display','none');
       $('.cExterior').css('display','block');
       $("#nCostoLocal").val("");
       $("#nImpCompra").val("");
       $("#nTCompra").val("");
       $("#nArticulo").val("");
       $("#nMia").val("");
       $("#nRuta").val("");
       $("#nTCambio").val("");
       $("#nCostoUsa").val("");
       $("#nCostoMia").val("");
       $("#nTotalUsa").val("");
       $("#nTotalCol").val("");
    } else {
       $('.cLocal').css('display','block');
       $('.cInventario').css('display','none');
       $('.cExterior').css('display','none');
       $("#nMia").val("");
       $("#nRuta").val("");
       $("#nArticulo").val("");
       $("#nCostoLocal").val("");
       $("#nImpCompra").val("");
       $("#nTCompra").val("");
       $("#nTCambio").val("");
       $("#nCostoUsa").val("");
       $("#nCostoMia").val("");
       $("#nTotalUsa").val("");
       $("#nTotalCol").val("");
    }// fin
   
    if (nCompra == "INVENTARIO") {
       $('.cInventario').css('display','block');
       $('.cLocal').css('display','block');
       $('.cExterior').css('display','none');
       $("#nMia").val("");
       $("#nRuta").val("");
       $("#nArticulo").val("");
       $("#nCostoLocal").val("");
       $("#nImpCompra").val("");
       $("#nTCompra").val("");
       $("#nTCambio").val("");
       $("#nCostoUsa").val("");
       $("#nCostoMia").val("");
       $("#nTotalUsa").val("");
       $("#nTotalCol").val("");
    }// fin if
     
}); 

$('#ePresenta').change(function(){
    var ePresenta =$('#ePresenta').val();
    var ano = ePresenta.substring(0,4);
    var nAno = parseInt(ano) + 1;
    nAno = nAno.toString();
    var mes = ePresenta.substring(5,7);
    var dia = ePresenta.substring(8,10);
    var nMes = mes;
    switch (mes) {
        case "01":
           nMes = "02";
          break;  
        case "02":
          nMes = "03";
          break;
        case "03":
          nMes = "04";
          break;
        case "04":
          nMes = "05";
          break;
        case "05":
          nMes = "06";
          break;
        case "06":
          nMes = "07";
          break;
        case "07":
          nMes = "08";
          break;
        case "08":
          nMes = "09";
          break;
        case "09":
          nMes = "10";
          break;
        case "10":
          nMes = "11";
          break;
        case "11":
          nMes = "12";
          break;
        case "12":
          nMes = "01";
          ano = nAno;   
          break;                                
    } // fin switch
    var ePresenta = ano + "-" + nMes + "-" + dia;
    try{
      $("#eVencimiento").val(ePresenta);
    }catch(err){
       console.log("error"); 
    }// fin try

}); // fin funcion cambio de fecha vencimiento

$('#nPresenta').change(function(){
  var nPresenta =$('#nPresenta').val();
  var ano = nPresenta.substring(0,4);
  var nAno = parseInt(ano) + 1;
  nAno = nAno.toString();
  var mes = nPresenta.substring(5,7);
  var dia = nPresenta.substring(8,10);
  var nMes = mes;
  switch (mes) {
      case "01":
         nMes = "02";
        break;  
      case "02":
        nMes = "03";
        break;
      case "03":
        nMes = "04";
        break;
      case "04":
        nMes = "05";
        break;
      case "05":
        nMes = "06";
        break;
      case "06":
        nMes = "07";
        break;
      case "07":
        nMes = "08";
        break;
      case "08":
        nMes = "09";
        break;
      case "09":
        nMes = "10";
        break;
      case "10":
        nMes = "11";
        break;
      case "11":
        nMes = "12";
        break;
      case "12":
        nMes = "01";
        ano = nAno;   
        break;                                
  } // fin switch
  var nPresenta = ano + "-" + nMes + "-" + dia;
  try {
    $("#nVencimiento").val(nPresenta);
  } catch(err){
    console.log("error");
  }  
}); // fin funcion cambio de fecha vencimiento


  