

/*=============================================
EDITAR CLIENTES
=============================================*/
$(".tablas").on("click", ".btnEditarCliente", function(){
   
  var idCliente= $(this).attr("idCliente");
   
  var datos = new FormData();
  datos.append("idCliente", idCliente);
        
  $.ajax({
        url: "ajax/clientes.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType:"json",
        success: function(respuesta){
        
           $("#editaCliente").val(respuesta["nombre"]);
           $("#editaTelefono").val(respuesta["telefono"]);
           $("#editaEmail").val(respuesta["email"]);
           $("#editaDireccion").val(respuesta["direccion"]); 

      }

  })


})
/*=============================================
ELIMINAR CLIENTES
=============================================*/
$(".tablas").on("click", ".btnEliminarCliente", function(){

     
	 var idCliente = $(this).attr("idCliente");

	 swal({
	 	title: '¿Está seguro de borrar el cliente?',
	 	text: "¡Si no lo está puede cancelar la acción!",
	 	type: 'warning',
	 	showCancelButton: true,
	 	confirmButtonColor: '#3085d6',
	 	cancelButtonColor: '#d33',
	 	cancelButtonText: 'Cancelar',
	 	confirmButtonText: 'Si, borrar el cliente!'
	 }).then(function(result){

	 	if(result.value){

	 		window.location = "index.php?ruta=clientes&idCliente="+idCliente;

	 	}

	 })

})

