<input type="text" name="bookId" id="bookId" value=""/>  
<script>
  var dato = $('#bookId').val();
    $.ajax({
      data: {"dato" : dato},
      url: "vistas/modulos/prueba.php",
      type: "post",
      success:  function (response) {
        alert(response);
      }
    });
 </script>   

 <?php
    $var = $_POST['dato'];
    echo $var; 
?>