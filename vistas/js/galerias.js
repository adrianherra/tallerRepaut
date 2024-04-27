/*=============================================
SUBIENDO LA FOTO DE LA GALERIA
=============================================*/
$(".nGaleria").change(function(){
  
  var imagen = this.files[0];
  
  var nombre = "vistas/img/galeria/" + imagen['name'];
  

  /*=============================================
    VALIDAMOS EL FORMATO DE LA IMAGEN SEA JPG O PNG
    =============================================*/
    var datosImagen = new FileReader;
    datosImagen.readAsDataURL(imagen);
     
    if((imagen["type"] == "image/jpeg") || 
      (imagen["type"] == "image/png") || (imagen["type"] == "image/bmp")){
      $('.galeriaImg').css('display','block');
      $('.galeriaPdf').css('display','none');
      $(datosImagen).on("load", function(event){
        var rutaImagen = event.target.result;
        $(".previsualizar").attr("src",rutaImagen);
      });   
    }

    if (imagen["type"] == "application/pdf") {
      $('.galeriaImg').css('display','none');
      $('.galeriaPdf').css('display','block');
      $(datosImagen).on("load", function(event){
        var rutaImagen = event.target.result;
        $(".previsualizar").attr("src", rutaImagen);
      });
    } else {
      $('.galeriaImg').css('display','block');
      $('.galeriaPdf').css('display','none');
      var rutaImagen = "vistas/img/galeria/otros.png";
      $(".previsualizar").attr("src", rutaImagen);
    } // fin if
    

});         

$('.image__').click(function(){ 
    var alt = $(this).attr('alt'); 
    var src = $(this).attr('src');
    if (alt == "Imagen"){
      $('.visorImagen').css('display','block');
      $('.visorPDF').css('display','none'); 
      $(".imagePrincipal").attr("src", src);
    
    } else {
      $('.visorImagen').css('display','none');
      $('.visorPDF').css('display','block');
      $("#visorPDF").attr("src", alt); 
     
    }// fin if
   
});
   
/*=============================================
      BORRAR IMGEN
=============================================*/
$(document).on("click", ".btnEliminarImagen", function(){ 
  event.preventDefault(); 
  
  var idImagen = $(this).attr("idImagen");
  var idRuta = $(this).attr("idRuta");
    
  swal({        
    title: '¿Está seguro de borrar la imagen?',
    text: "¡Si no lo está puede cancelar la accíón!",
    type: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      cancelButtonText: 'Cancelar',
      confirmButtonText: 'Si, borrar imagen!'
  }).then(function(result){

    if (result.value){
         
        window.location = "index.php?ruta=galerias&idImagen="+ idImagen + "&idRuta="+idRuta;   
           
    }//fin if   

  }) 
 
});

/*=============================================
    REGRESAR GALERIA
=============================================*/
$(document).on("click", "button.btnRegresarGaleria", function(){
  window.location = "casos";
   
}); // fin btnEliminarImagen
  
/*=============================================
    DESCARGAR ZIP
=============================================*/
$(document).on("click", ".btnDescargarZip", function(){ 
  event.preventDefault(); 
  var vTipo= $(this).attr("vTipo");
  
  $("#verTipo").val(vTipo);

  $("#zips").submit(); 

    
}); // fin btnVerEstado 