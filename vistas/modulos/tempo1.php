/*=============================================
 AÑADIR LINEA
=============================================*/
$(document).on("click", ".btnFactuLn", function(){
   event.preventDefault(); 
   var linea = $("#tablaFactura >tbody >tr").length;    
   
   var cantidad = $("#nCanti").val();
   var parte = $("#nParte").val();
   var descripcion = $("#nDescri").val();
   var precio = $("#nMonto").val();
   var total=parseFloat(cantidad)*parseFloat(precio);

	var name_table=document.getElementById("tablaFactura");

    var row = name_table.insertRow(0+1);
    var cell1 = row.insertCell(0);
    var cell2 = row.insertCell(1);
    var cell3 = row.insertCell(2);
    var cell4 = row.insertCell(3);
    var cell5 = row.insertCell(4);
    var cell6 = row.insertCell(5);
    //var cell7 = row.insertCell(6);
         
    //cell1.innerHTML = '<p>'+linea+'</p>';
    cell1.innerHTML = '<p name="aCanti[]">'+cantidad+'</p>';
    cell2.innerHTML = '<p name="aParte[]">'+descripcion+'</p>';
    cell3.innerHTML = '<p name="aDescri[]">'+cantidad+'</p>';
    cell4.innerHTML = '<p name="aPrecio[]">'+precio+'</p>';
    cell5.innerHTML = '<p name="aTotal[]">'+total+'</p>';
    cell6.innerHTML = '<span class="icon fa fa-times"></span>';
    $("#nCanti").val("");
    $("#nParte").val("");
    $("#nDescri").val("");
    $("#nMonto").val("");
});

/*=============================================
 BORRAR LINEA
=============================================*/
$(document).on("click", ".fa-times", function(){
   //Guardando la referencia del objeto presionado
   var _this = this;

   //Obtener las filas los datos de la fila que se va a elimnar
	var array_fila=getRowSelected(_this);

	$(this).parent().parent().fadeOut("slow",function(){$(this).remove();});
});

/*=============================================
  getRowSelected
=============================================*/
function getRowSelected(objectPressed){
	//Obteniendo la linea que se esta eliminando
	var a=objectPressed.parentNode.parentNode;
	//b=(fila).(obtener elementos de clase columna y traer la posicion 0).(obtener los elementos de tipo parrafo y traer la posicion0).(contenido en el nodo)
	let linea=a.getElementsByTagName("td")[0].getElementsByTagName("p")[0].innerHTML;
	let cantidad=a.getElementsByTagName("td")[1].getElementsByTagName("p")[0].innerHTML;
	let parte=a.getElementsByTagName("td")[2].getElementsByTagName("p")[0].innerHTML;
	let descripcion=a.getElementsByTagName("td")[3].getElementsByTagName("p")[0].innerHTML;
	let precio=a.getElementsByTagName("td")[4].getElementsByTagName("p")[0].innerHTML;
	let total=a.getElementsByTagName("td")[5].getElementsByTagName("p")[0].innerHTML;
	
	var array_fila = [cantidad, parte, descripcion, precio, total];

	return array_fila;
	//console.log(numero+' '+codigo+' '+descripcion);
}

