/*=============================================
CARGAR LA TABLA DINÁMICA DE PRODUCTOS
=============================================*/
var tablaProductos = $('.tablaProductos').DataTable( {
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
      if (aData[8] > 0 )
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
   },
   
   "footerCallback": function ( row, data, start, end, display ) {
      var api = this.api();
      nb_cols = api.columns().nodes().length;
 
      //Totales de monto en colones       
      var montoCol = api
          .column( 8, { page: 'current'} )
          .data()
          .reduce( function (a, b) {
           return Number(a) + Number(b);
      }, 0 );
      $(api.column(8).footer()).html('¢ '+ parseFloat(montoCol, 10).toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, "$1,").toString());
      $(api.column(8).footer()).css("text-align", "right");
      $(api.column(8).footer()).css("font-size", "x-small");  
  
      // Totales de monto en dolares
      var costoCol= api
          .column( 9, { page: 'current'} )
          .data()
          .reduce( function (a, b) {
            return Number(a) + Number(b);
      }, 0 );
      $(api.column(9).footer()).html('$ '+ parseFloat(costoCol, 10).toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, "$1,").toString());
      $(api.column(9).footer()).css("text-align", "right");
      $(api.column(9).footer()).css("font-size", "x-small");
   }
    
 });
/*=======================
    FILTRAR PRODUCTOS
=========================*/
$(document).ready(function() {
        
    $('.tablaProductos thead tr:eq(0) th').each( function (i) {
       if ((i == 1) || (i == 2) || (i == 3) || (i == 4) || (i == 5) || (i == 6) || (i == 10) || (i == 11)) {
           var title = $(this).text();
           switch (i) {
               case 1:  
                  $(this).html( '<input type="text" placeholder="#Parte" style= "width: 80px; background-color: cyan; font-size: x-small;"/>' );    
                  break;
               case 2:
                  $(this).html( '<input type="text" placeholder="Descripción" style= "width: 140px; background-color: cyan; font-size: x-small;"/>' );    
                  break;
               case 3:
                  $(this).html( '<input type="text" placeholder="Proveedor" style= "width: 100px; background-color: cyan; font-size: x-small;"/>' );    
                  break;    
               case 4:
                  $(this).html( '<input type="text" placeholder="Marca" style= "width: 70px; background-color: cyan; font-size: x-small;"/>' );    
                  break;
               case 5:
                  $(this).html( '<input type="text" placeholder="Modelo" style= "width: 70px; background-color: cyan; font-size: x-small;"/>' );    
                  break;   
               case 6:
                  $(this).html( '<input type="text" placeholder="Año" style= "width: 50px; background-color: cyan; font-size: x-small;"/>' );    
                  break;
               case 10:
                  $(this).html( '<input type="text" placeholder="Tipo" style= "width: 50px; background-color: cyan; font-size: x-small;"/>' );    
                  break;   
               case 11:
                  $(this).html( '<input type="text" placeholder="Ubicación" style= "width: 80px; background-color: cyan; font-size: x-small;"/>' );    
                  break;   
                  
           }
           
           $( 'input', this ).on( 'keyup change', function () {
             if ( tablaProductos.column(i).search() !== this.value ) {
                tablaProductos
                    .column(i)
                    .search( this.value )
                    .draw();
             }// fin if
          });
       } // fin if 
    });
   
});  

/*=============================================
   AGREGAR PROVEEDOR
=============================================*/
$(document).on("click", ".btnAgregarProveedor", function(){
   var nProveedor = $(this).attr("nProveedor");
   var nIdProveedor = $(this).attr("nIdProveedor");

   $("#nIdProveedor").val(nIdProveedor);
   $("#eIdProveedor").val(nIdProveedor);

   $("#nProveedor").val(nProveedor);
   $("#eProveedor").val(nProveedor);
});

/*=============================================
   AGREGAR Imagen
=============================================*/
$(document).on("click", ".agregarImg", function(){
   var rutaImagen = "vistas/img/productos/default/vehiculo.png";
   $(".previsualizar").attr("src", rutaImagen); 
   $(".previsualizar1").attr("src", rutaImagen);
   $(".previsualizar2").attr("src", rutaImagen);  
});// fin funcion Agregar Imagen


/*=============================================
SUBIENDO LA FOTO DEL PRODUCTO
=============================================*/
$(".nImagen").change(function(){

   var imagen = this.files[0];
         
	/*=============================================
  	   VALIDAMOS EL FORMATO DE LA IMAGEN SEA JPG O PNG
   =============================================*/
      
  	if(imagen["type"] != "image/jpeg" && imagen["type"] != "image/png"){
  		$(".nImagen").val("");
  		 swal({
		      title: "Error al subir la imagen",
		      text: "¡La imagen debe estar en formato JPG o PNG!",
		      type: "error",
		      confirmButtonText: "¡Cerrar!"
		    });
  	}else if(imagen["size"] > 2000000){
  		$(".nImagen").val("");
  		 swal({
		      title: "Error al subir la imagen",
		      text: "¡La imagen no debe pesar más de 2MB!",
		      type: "error",
		      confirmButtonText: "¡Cerrar!"
		    });
  	}else{
  		var datosImagen = new FileReader;
  		datosImagen.readAsDataURL(imagen);
  		$(datosImagen).on("load", function(event){
           var rutaImagen = event.target.result;
           
           $(".previsualizar").attr("src", rutaImagen);
                   
  		});
   } // fin imagen
     
});
 
/*=============================================
SUBIENDO LA FOTO 2 DEL PRODUCTO
=============================================*/
$(".nImagen1").change(function(){

   var imagen = this.files[0];
         
	/*=============================================
  	   VALIDAMOS EL FORMATO DE LA IMAGEN SEA JPG O PNG
   =============================================*/
      
  	if(imagen["type"] != "image/jpeg" && imagen["type"] != "image/png"){
  		$(".nImagen1").val("");
  		 swal({
		      title: "Error al subir la imagen",
		      text: "¡La imagen debe estar en formato JPG o PNG!",
		      type: "error",
		      confirmButtonText: "¡Cerrar!"
		    });
  	}else if(imagen["size"] > 2000000){
  		$(".nImagen1").val("");
  		 swal({
		      title: "Error al subir la imagen",
		      text: "¡La imagen no debe pesar más de 2MB!",
		      type: "error",
		      confirmButtonText: "¡Cerrar!"
		    });
  	}else{
  		var datosImagen = new FileReader;
  		datosImagen.readAsDataURL(imagen);
  		$(datosImagen).on("load", function(event){
           var rutaImagen = event.target.result;
           
           $(".previsualizar1").attr("src", rutaImagen);
                   
  		});
   } // fin imagen
     
});

/*=============================================
SUBIENDO LA FOTO 3 DEL PRODUCTO
=============================================*/
$(".nImagen2").change(function(){

   var imagen = this.files[0];
             
	/*=============================================
  	   VALIDAMOS EL FORMATO DE LA IMAGEN SEA JPG O PNG
   =============================================*/
      
  	if(imagen["type"] != "image/jpeg" && imagen["type"] != "image/png"){
  		$(".nImagen2").val("");
  		 swal({
		      title: "Error al subir la imagen",
		      text: "¡La imagen debe estar en formato JPG o PNG!",
		      type: "error",
		      confirmButtonText: "¡Cerrar!"
		    });
  	}else if(imagen["size"] > 2000000){
  		$(".nImagen2").val("");
  		 swal({
		      title: "Error al subir la imagen",
		      text: "¡La imagen no debe pesar más de 2MB!",
		      type: "error",
		      confirmButtonText: "¡Cerrar!"
		    });
  	}else{
  		var datosImagen = new FileReader;
  		datosImagen.readAsDataURL(imagen);
  		$(datosImagen).on("load", function(event){
           var rutaImagen = event.target.result;
           
           $(".previsualizar2").attr("src", rutaImagen);
                   
  		});
   } // fin imagen
     
});


/*=======================
    EDITAR PRODUCTOS
=========================*/
$(".tablaProductos").on("click", ".btnEditarProducto", function(){

   var idProducto= $(this).attr("idProducto");
   
   var datos = new FormData();
   datos.append("idProducto", idProducto);
 
   $.ajax({
         url: "ajax/productos.ajax.php",
         method: "POST",
         data: datos,
         cache: false,
         contentType: false,
         processData: false,
         dataType:"json",   
         success: function(respuesta){
           console.log("respuesta:", respuesta);
           $("#eIdPr").val(respuesta["id"]); 
           $("#eParte").val(respuesta["parte"].toUpperCase());
           $("#eDescri").val(respuesta["descripcion"].toUpperCase());
           $("#eMarca").val(respuesta["marca"].toUpperCase()); 
           $("#eModelo").val(respuesta["modelo"].toUpperCase());
           $("#eAno").val(respuesta["ano"]);
           $("#eStock").val(respuesta["stock"]);
           $("#eCol").val(respuesta["costoCol"]);
           $("#eDol").val(respuesta["costoDol"]);
           $("#eTipo").val(respuesta["tipo"]);
           $("#eUbica").val(respuesta["ubicacion"].toUpperCase());
           $("#eActual").val(respuesta["foto"]);
           $("#eActual1").val(respuesta["foto1"]);
           $("#eActual2").val(respuesta["foto2"]);
         
           var rutaImagen = "vistas/img/productos/default/vehiculo.png";       
           if((respuesta["foto"] != null) && (respuesta["foto"] != "")  ){
              $(".previsualizar").attr("src", respuesta["foto"]);
           } else {
              $(".previsualizar").attr("src", rutaImagen);   
           }// fin if 
           if((respuesta["foto1"] != null) && (respuesta["foto1"] != "")){
              $(".previsualizar1").attr("src", respuesta["foto1"]);
           } else {
              $(".previsualizar1").attr("src", rutaImagen); 
           }// fin if
           if((respuesta["foto2"] != null) && (respuesta["foto2"] != "")  ){
              $(".previsualizar2").attr("src", respuesta["foto2"]);
           } else {
              $(".previsualizar2").attr("src", rutaImagen);   
           }// fin if
             
           $("#eUbica").val(respuesta["ubicacion"]);
           $("#eProveedor").val(respuesta["nombre"]); 
           $("#eIdProveedor").val(respuesta["idProveedor"]);     
         }// fin respuesta
    });// fin ajax
}); // fin btnEditarProducto    

/*=============================================
ELIMINAR PRODUCTO
=============================================*/
$(".tablaProductos").on("click", ".btnEliminarProducto", function(){
   var idProducto = $(this).attr("idProducto");
   var imagen = $(this).attr("imagen");  
   swal({
      title: '¿Está seguro de borrar el artículo?',
      text: "¡Si no lo está puede cancelar la acción!",
      type: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      cancelButtonText: 'Cancelar',
      confirmButtonText: 'Si, borrar el artículo!'
   }).then(function(result){
      if(result.value){
         window.location = "index.php?ruta=productos&idProducto="+idProducto +"&imagen="+imagen  ;
      } // fin if 
   }); // fin swal
});

/*=============================================
VER LA FOTO DEL PRODUCTO
=============================================*/
$(".tablaProductos").on("click", ".btnVerImagen", function(){
   var rutaImagen =  $(this).attr("vFoto");  
   var rutaImagen1 =  $(this).attr("vFoto1");
   var rutaImagen2 =  $(this).attr("vFoto2");
   $(".verImagen").attr("src", rutaImagen);
   $(".verImagen1").attr("src", rutaImagen1);  
   $(".verImagen2").attr("src", rutaImagen2);
});
   