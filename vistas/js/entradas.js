  var canvas= document.getElementById('canvas');

  canvas.style.border = "1px solid rgba(0,0,0,0.3)";

  var ctx = canvas.getContext('2d');
  var rect = canvas.getBoundingClientRect();
  var x=0, y=0, color='red', grosor='2';
  var img = new Image();

  img.src="vistas/img/recepcion/vehiculo.png";

  posX = canvas.clientWidth;
  posY = canvas.clientHeight;

img.onload = function(){
    ctx.drawImage(img, 0, 0,posX,posY);
}

canvas.addEventListener("click",function(e){
   var x1 = $(window).scrollTop();
   x=e.clientX - rect.left;
   y=e.clientY - rect.top + x1;
   circulo(x,y);

});

function circulo(x1,y1){
   ctx.beginPath();
   var color = $("#nColor").val();
   ctx.strokeStyle=color;
   ctx.lineWidth=grosor;
   ctx.arc(x1, y1, 8, 0, 2 * Math.PI);
   ctx.fillStyle = color;
   ctx.fill();
   ctx.stroke();
   ctx.closePath();     
}

var idCanvas='canvas';
var idForm='formCanvas';
var inputImagen='imgCaptura';

var imagen=document.getElementById(inputImagen);

/*=============================================
  GUARDAR ENTRADA
=============================================*/
function GuardarImg(){
  imagen.value=document.getElementById(idCanvas).toDataURL('image/png');
  $("#formCanvas").submit();   
             
} 
   
/*=============================================
  AGREGAR CLIENTE
=============================================*/
$(document).on("click", ".btnAgregarCliente", function(){
  var nCliente = $(this).attr("nCliente");
  var nIdCliente = $(this).attr("nIdCliente");
  $("#nCliente").val(nCliente);
  $("#nIdCliente").val(nIdCliente);
});    

/*=============================================
    REGRESAR CASOS
=============================================*/
$(document).on("click", "button.btnRegresarCasos", function(){
  window.location = "casos";
      
}); // fin btnRegresarCasos



 