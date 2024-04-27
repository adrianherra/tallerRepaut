/*$.ajax({

  url: "ajax/datatable-lineas.ajax.php",
  success:function(respuesta1){
    console.log("respuesta1",respuesta1);
  }
            
})*/          
             
var tablaProveedores = $('.tablaProveedores').DataTable( {
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
  FILTRAR ORDENES
=========================*/
$(document).ready(function() {
 
  $('.tablaProveedores thead tr:eq(0) th').each( function (i) {
     if ((i == 1) || (i == 2) || (i == 3) || (i == 4) || (i == 5) || (i == 6) ) {
         var title = $(this).text();
         switch (i) {
             case 1:
                $(this).html( '<input type="text" placeholder="Nombre" style= "width: 150px; background-color: cyan; font-size: x-small;" />' );    
                break;
             case 2:
                $(this).html( '<input type="text" placeholder="Teléfono" style= "width: 100px; background-color: cyan; font-size: x-small;"/>' );    
                break;
             case 3:
                $(this).html( '<input type="text" placeholder="Email" style= "width: 130px; background-color: cyan; font-size: x-small;"/>' );    
                break; 
             case 4:
                $(this).html( '<input type="text" placeholder="Contacto" style= "width:130px; background-color: cyan; font-size: x-small;"/>' );    
                break;
             case 5:
                $(this).html( '<input type="text" placeholder="Dirección" style= "width:200px; background-color: cyan; font-size: x-small;"/>' );    
                break;   
             case 6:
                $(this).html( '<input type="text" placeholder="Observación" style= "width:150px; background-color: cyan; font-size: x-small;"/>' );    
                break;   
                  
               
         } 
         
         $( 'input', this ).on( 'keyup change', function () {
           if ( tablaProveedores.column(i).search() !== this.value ) {
              tablaProveedores
                  .column(i)
                  .search( this.value )
                  .draw();
           }// fin if
        });
     } // fin if 
  });
 
});  

/*=============================================
EDITAR PROVEEDORES
=============================================*/
$(".tablaProveedores").on("click", ".btnEditarProveedor", function(){
   
  var idProveedor= $(this).attr("idProveedor");
  
  var datos = new FormData();
  datos.append("idProveedor", idProveedor);
        
  $.ajax({
        url: "ajax/proveedores.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType:"json",
        success: function(respuesta){
           $("#idProveedor").val(respuesta["id"]); 
           $("#eProveedor").val(respuesta["nombre"]);
           $("#eTelefono").val(respuesta["telefono"]);
           $("#eEmail").val(respuesta["email"]);
           $("#eContacto").val(respuesta["contacto"]);
           $("#eDireccion").val(respuesta["direccion"]); 
           $("#eObservacion").val(respuesta["observacion"]);
      }

  })   


})
/*=============================================
ELIMINAR PROVEEDORES
=============================================*/
$(".tablaProveedores").on("click", ".btnEliminarProveedor", function(){
	 var idProveedor = $(this).attr("idProveedor");
   
	 swal({
	 	title: '¿Está seguro de borrar el proveedor?',
	 	text: "¡Si no lo está puede cancelar la acción!",
	 	type: 'warning',
	 	showCancelButton: true,
	 	confirmButtonColor: '#3085d6',
	 	cancelButtonColor: '#d33',
	 	cancelButtonText: 'Cancelar',
	 	confirmButtonText: 'Si, borrar el proveedor!'
	 }).then(function(result){

	 	if(result.value){
        
	 		window.location = "index.php?ruta=proveedores&idProveedor="+idProveedor;

	 	}

	 });

});

