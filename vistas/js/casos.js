             
var tablaCasos = $('.tablaCasos').DataTable( {
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
     }
     
});

/*=======================
    FILTRAR EXPEDIENTES
=========================*/
$(document).ready(function() {
     
    // Setup - add a text input to each footer cell
    //$('.tablaPagos thead tr').clone(true).appendTo( '.tablaPagos thead' );
    $('.tablaCasos thead tr:eq(0) th').each( function (i) {
       if ((i == 1) || (i == 2) || (i == 3) || (i == 4) || (i == 5) || (i == 6) || (i == 7)) {
           var title = $(this).text();
           switch (i) {
               case 1:
                  $(this).html( '<input type="text" placeholder="Placa" style= "width: 70px; background-color: cyan;" />' );    
                  break;
               case 2:
                  $(this).html( '<input type="text" placeholder="Marca" style= "width: 90px; background-color: cyan;"/>' );    
                  break;
               case 3:
                  $(this).html( '<input type="text" placeholder="Modelo" style= "width: 90px; background-color: cyan;"/>' );   
                  break;
               case 4:
                  $(this).html( '<input type="text" placeholder="Año" style= "width: 50px; background-color: cyan;"/>' );  
                  break; 
               case 5:
                  $(this).html( '<input type="text" placeholder="Aseguradora" style= "width: 80px; background-color: cyan;"/>' );    
                  break;     
               case 6:
                  $(this).html( '<input type="text" placeholder="Cliente" style= "width: 120px; background-color: cyan;"/>' );    
                  break;
               case 7:
                  $(this).html( '<input type="text" placeholder="Estado" style= "width: 70px; background-color: cyan;"/>' );    
                  break;   
           }
               
           $( 'input', this ).on( 'keyup change', function () {
             if ( tablaCasos.column(i).search() !== this.value ) {
                tablaCasos
                    .column(i)
                    .search( this.value )
                    .draw();
             }// fin if
          });
       } // fin if 
    });
   
} );  
   
         
/*=======================
    EDITAR CASO    
=========================*/
$(".tablaCasos").on("click", ".btnEditarCaso", function(){

  var idCaso =  $(this).attr("idCaso");
 
  var datos = new FormData();
      
  datos.append("idCaso", idCaso);     
  $.ajax({
        url: "ajax/casos.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType:"json",     
        success: function(respuesta){
          console.log("respuesta:", respuesta);
          $("#eIdCaso").val(respuesta[0]["id"]);
          $("#eExpediente").val(respuesta[0]["expediente"]);
          $("#eModelo").val(respuesta[0]["modelo"]);
          $("#eAseguradora").val(respuesta[0]["aseguradora"]);
          $("#eAno").val(respuesta[0]["ano"]);
          $("#eMes").val(respuesta[0]["mes"]);
          $("#eEstado").val(respuesta[0]["estado"]);
          
        } // fin respuesta

  })// fin ajax
  
}); // fin btnEditarCaso 

/*=============================================
ELIMINAR CASO
=============================================*/
$(".tablaCasos tbody").on("click", "button.btnEliminarCaso", function(){
 
  event.preventDefault(); 
  var idCaso = $(this).attr("idCaso");
   
  swal({        
    title: '¿Está seguro de borrar el Expediente ?',
    text: "¡Si no lo está puede cancelar la accíón!",
    type: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      cancelButtonText: 'Cancelar',
      confirmButtonText: 'Si, borrar expediente!'
  }).then(function(result){

    if (result.value){
        
        window.location = "index.php?ruta=casos&idCaso="+ idCaso;   
           
    }//fin if   

  }) 
 
});

/*=============================================
    PASAR A INCLUCION DE FOTOS
=============================================*/
$(".tablaCasos").on("click","button.btnGaleria",function(){
   event.preventDefault();
   var idCaso =$(this).attr("vIdCaso");
  
   $("#verGaleria").val(idCaso);
   $("#pasarGaleria").submit();
          
});
 
/*=============================================
    GENERAR REPORTE RECEPCION VEHICULO
=============================================*/
$(".tablaCasos").on("click","button.btnReporteCaso",function(){
   event.preventDefault();
   var idCaso =$(this).attr("idCaso");
  
   $("#verReporte").val(idCaso);
   $("#pasarReporte").submit();   


});
/*=============================================
    GENERAR REPORTE RECEPCION VEHICULO 1
=============================================*/
$(".tablaCasos").on("click","button.btnReporteCaso1",function(){
   event.preventDefault();
   var idCaso =$(this).attr("idCaso");
  
   $("#verReporte1").val(idCaso);
   $("#pasarReporte1").submit();   


});


/*=============================================
    ENVIAR POR CORREO
=============================================*/
$(".tablaCasos").on("click","button.btnReporteMail",function(){
   event.preventDefault();
   var idMail =$(this).attr("idCaso");
  
   var datos = new FormData();
   
   swal({
      title: '¿Está seguro de enviar el correo?',
      text: "¡Si no lo está puede cancelar la acción!",
      type: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      cancelButtonText: 'Cancelar',
      confirmButtonText: 'Si, enviar correo!'
   }).then(function(result){
      if(result.value){
         datos.append("idMail", idMail);
                  
         $.ajax({
            url: "ajax/casos.ajax.php",
            method: "POST",
            data: datos,
            cache: false,
            contentType: false,
            processData: false,
            dataType:"json",     
            success: function(respuesta){
               console.log("repuesta: ",respuesta);  
               if (respuesta == "ok") {
                  swal({
                     type: "success",
                     title: "El correo se ha enviado correctamente",
                     showConfirmButton: true,
                     confirmButtonText: "Cerrar"
                     }).then(function(result){
                        if (result.value) {
                           window.location = "casos";
                        }
                  }); 

               } // fin if
            } // fin respuesta
         });// fin ajax
      }// fin if   
   }); // fin swal

});

/*=============================================
  CAMBIAR ESTADO
=============================================*/
$(".tablaCasos").on("click","button.btnEstadoEntrada",function(){
   var idEstado = $(this).attr("idEstado");
   var estadoEntrada = $(this).attr("estadoEntrada");
   
   var datos = new FormData();
      
   datos.append("idEstado", idEstado);
   datos.append("estadoEntrada", estadoEntrada);     
   
   $.ajax({
        url: "ajax/casos.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType:"json",     
        success: function(respuesta){
          console.log("respuesta:", respuesta);
          if (respuesta == 'ok'){
             window.location = "casos";
          }// fin if   
                         
        } // fin respuesta
   });// fin ajax  
         
 });    

/*=============================================
  CARGAR FORMULARIO EMAIL
=============================================*/
$(".tablaCasos").on("click","button.btnCargarEmail",function(){
   var eMail = $(this).attr("eMail");
   var rutaPdf = $(this).attr("rutaPdf");
   var placa = $(this).attr("placa");
   var res = rutaPdf.split("/");
   var tam = res.length;
      
   $("#nMail").val(eMail);
   $("#nAdjunto").val(res[tam-1]);
   $("#nRuta").val(rutaPdf);
   $("#nAsunto").val("Recepcion Vehiculo Placa: " + placa);     
           
 });
 
