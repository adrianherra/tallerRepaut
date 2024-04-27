 
<?php  
  if (isset($_POST["idCaso"])) {
    $_SESSION['numeroCaso'] = $_POST["idCaso"];                
  } // fin if
  $ver = "todo";

  if (isset($_POST["seleccion"])) {
    $_SESSION['tipo'] = $_POST["seleccion"];

  } // fin if
  
  if (isset($_SESSION['tipo'])) {
    $ver = $_SESSION['tipo'];

  } // fin if

  $idCaso =  $_SESSION['numeroCaso'];
   
  $item = "idCaso";
  $valor = $idCaso;
 
  $valor2 = $ver;
    

  $documentos = ControladorGalerias::ctrMostrarGalerias($item, $valor, $valor2);
    
  $item = "id";
  $valor = $idCaso;
  
  $caso = ControladorCasos::ctrMostrarCasos($item, $valor); 

  $expediente = $caso[0]["expediente"];
  $placa = $caso[0]["placa"];

  if(isset($_POST['verTipo']))  
  {  
    if(extension_loaded('zip'))  
    { 
     
      $zip = new ZipArchive(); // Load zip library
      $zip_name = "Caso-".$expediente."_Placa-".$placa."-".time().".zip";
      $zip->open($zip_name, ZIPARCHIVE::CREATE);
      $directorio = "comprimido/";
     
      if(!file_exists($directorio)) {
        mkdir($directorio, 0755);  
      }  
      $archivos = array();
      
      foreach ($documentos as $key => $value) {
        
        if ($ver == "todo") 
        { 
          $destino = $directorio.$value["titulo"];
          $origen = $value["ruta"];
          copy($origen,$destino);
          $archivos[$key] = $destino;
          $zip->addFile($destino); // Adding files into zip
        } else if ($ver == $value["tipo"]){
          $destino = $directorio.$value["titulo"];
          $origen = $value["ruta"];
          copy($origen,$destino);
          $archivos[$key] = $destino;
          
          $zip->addFile($destino); // Adding files into zip
        } // fin if
      }
      
      $zip->close();  
      if(file_exists($zip_name))  
      {
        
        foreach ($archivos as  $valor) {
          
           unlink($valor);
        } // fin foreach
        echo'<script>

        swal({
            type: "success",
            title: "El archivo Zip ha sido creado",
            showConfirmButton: true,
            confirmButtonText: "Cerrar"
            }).then(function(result){
              if (result.value) {
                event.preventDefault();  
                window.location = "galerias";
              }
            })

        </script>';
        echo "<embed src='".$zip_name."' type='application/pdf' width='0%' style='height: 0vh; display:block'/>";
      }// fin if
       
    }// fin if    
  }// fin if  
 ?>

<div class="content-wrapper">

  <section class="content-header">
    <h1>
      Administrar Galerias
    </h1>

    <ol class="breadcrumb">
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      <li class="active">Administrar Galerias</li>
    </ol>
  </section>
         
  <section class="content">
    <div class="box">
      <div class="box-header with-border">
        <div class="row">
          <div class="col-xs-6 col-sm-2"> 
           <button class="btn btn-warning pull-left btnRegresarGaleria">
              <i class="fa fa-mail-reply">
                Regresar ..
              </i>   
            </button>
          </div>
            
          <form id = "zips" action="galerias" method="post">
            <input type="hidden" id="verTipo" name="verTipo" value="" />    
            <div class="col-xs-6 col-sm-2">   
              <button class="btn btn-danger btnDescargarZip pull-left" vTipo = "<?php echo $ver;?>">
                <i class="fa fa-download">
                   Descargar Zip
                </i>   
              </button>  
            </div>
          </form> 

          <div class="col-xs-6 col-sm-3">   
            <!-- TIPO VISTA-->
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-eye"> Ver..</i></span>
                <form name="vista" id="vista" action="galerias" method="post">
                  <select class= "form-control input-xs btn-info" id="seleccion" name="seleccion" onchange="this.form.submit()">
                    <option>Selección Documentos</option>
                    <?php 
                      if ($ver == "todo")
                        echo '<option value="todo" selected="true" >Todos Documentos</option>';
                      else 
                        echo '<option value="todo">Todos Documentos</option>';
                      if ($ver == "img")
                        echo '<option value="img" selected="true">Solo Imagenes</option>';
                      else
                        echo '<option value="img">Solo Imagenes</option>';
                      if ($ver == "otro")
                        echo'<option value="otro" selected="true">Otros Documentos</option>';
                      else
                        echo'<option value="otro">Otros Documentos</option>';
                    ?>
                  </select>
                </form>
              </div>
            </div>
          </div>
          
          <div class="col-xs-6 col-sm-5">
            <button class="btn btn-primary pull-right" data-toggle="modal" data-target="#modalAgregarImagen">
              <i class="fa fa-plus">
                  Agregar     
              </i> 
            </button>
          </div>
        </div> <!-- Fin row -->
      </div> <!-- Fin box-header -->

      <div class="box-body">
        <div class="row"> 
          <div class="col-xs-12 col-sm-7"> 
            <div class="container">
              <ul class="list-image">
                <?php
                   
                  foreach ($documentos as $key => $value) {
                    $extencion = explode(".",$value["ruta"]);
                                         
                      echo '<li>
                            <div class="container__image">';
                            if (($extencion[1] == 'jpg') or ($extencion[1] == 'jpge') or ($extencion[1] == 'png') or ($extencion[1] == 'bmp'))  
                              echo '<img src="'.$value["ruta"].'" alt="Imagen" class="image__"/>';
                            else 
                              echo '<img src="vistas/img/galeria/otros.png" alt="'.$value["ruta"].'" class="image__"/>';   
                           echo '<div class="information__image">
                                   <p class="titulo__image">'.$value["titulo"].'</p>
                                   <button class="btn btn-danger btn-xs minus__image btnEliminarImagen" idImagen="'.$value["id"].'" idRuta="'.$value["ruta"].'">
                                     <i class="fa fa-minus">
                                         
                                     </i> 
                                   </button> 
                                 </div>  
                            </div>
                          </li>';  
                      
                  } // fin for
                  
                ?> 
              </ul>
            </div> <!--Fin Div container -->
          </div> <!-- Fin linea 1-->
          <div class="col-xs-12 col-sm-5 ver__image">
            <div class="visorImagen">  
               <img src="" class="imagePrincipal divImagen" />
            </div>
            <div class="visorPDF" style ="display: none">
              <center> 
                <embed id="visorPDF" src="" type="application/pdf" width="100%" height="auto" style="height: 100vh; display:block"/>
              </center>
            </div>
          </div> <!-- Fin linea 2 -->
        </div> <!-- Fin row -->   
      </div> <!-- Fin Div box-body -->
  
    </div> <!-- Fin Div box -->
  </section> <!-- Fin section --> 
</div> <!-- Fin content-wrapper -- >

<!--=====================================
MODAL AGREGAR IMAGEN
======================================-->
<div id="modalAgregarImagen" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <form role="form" method="post" enctype="multipart/form-data">
        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->
        <div class="modal-header" style="background:#3c8dbc; color:white">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Agregar</h4>
        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->
        <div class="modal-body">
          <div class="box-body">
            
            <!-- ENTRADA PARA SUBIR FOTO -->
            <div class="row"> <!-- Incio Row -->
              
              <div class="col-xs-12 col-sm-4">
                <div class="divFile">
                  <span class="texto">
                    <i class="fa fa-sign-in">
                      Añadir Documento   
                    </i>   
                  </span>
                  
                  <input type="file" class="btnFile nGaleria form-control"  id="nGaleria[]" name="nGaleria[]" multiple="">
                  
                </div>
              </div> <!-- col1 -->   
               
              <div class="galeriaImg col-xs-12 col-sm-8">
                <img src="vistas/img/galeria/vacio.jpg" class="img-thumbna  il previsualizar" width="150px">      
              </div>  <!-- col2 --> 
              <div class="galeriaPdf col-xs-12 col-sm-8" style ="display: none">
                 <center> 
                   <embed class="previsualizar" id="archivoPDF" src="vistas/img/galeria/vacio.jpg" type="application/pdf" width="80%" height="auto" style="height: 45vh"/>
                 </center>       
              </div>  <!-- col2 -->  
            </div> <!--Fin Row -->
            <br>
            <!-- ENTRADA PARA EL NOMBRE -->
            <div class="form-group">
              <div class="input-group">
                <input type="hidden" class="form-control input-xs" name="nCaso" id="nCaso" value="<?php echo $idCaso;?>" readonly>
                
                <!--span class="input-group-addon"><i class="fa fa-image"> Nombre</i></span--> 
                <input type="hidden" class="form-control input-xs" id="nTituloImg" name="nTituloImg" 
                placeholder="Imagen" style="background-color: cyan;" required>
              
              </div>
            </div> 
               

          </div> <!--Fin box-body -->
        </div> <!--Fin modal-body -->   

        <!--=====================================
        PIE DEL MODAL
        ======================================-->
        <div class="modal-footer">
          <button type="button" class="btn btn-warning pull-left" data-dismiss="modal">
            <i class="fa fa-mail-reply">
              Regresar ..
            </i>   
          </button>       
          <button type="submit" class="btn btn-primary pull-right">
            <i class="fa fa-save">
              Guardar Imagen
            </i> 
          </button> 
        </div>

        <?php

          $crearImagen = new ControladorGalerias();
          $crearImagen -> ctrCrearGaleria();

        ?>
  
      </form>
    </div>
  </div>
</div>

 <?php    
                
  $borrarImagen = new ControladorGalerias();
  $borrarImagen -> ctrEliminarImagen();
        
?>  
