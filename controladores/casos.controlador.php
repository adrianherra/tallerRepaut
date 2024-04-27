<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

    
class ControladorCasos{
	     
	/*=============================================
	MOSTRAR CASOS
	=============================================*/
	static public function ctrMostrarCasos($item,$valor){
		$tabla = "casos";
       	$respuesta = ModeloCasos::mdlMostrarCasos($tabla, $item, $valor);		
		return $respuesta;
	}// fin metodo ctrMostrarCasos
 	      
 	/*=============================================
	REGISTRO DE CASO
	=============================================*/
	static public function ctrCrearCaso(){
    	if(isset($_POST["nExpediente"])){
        	$tabla = "casos";
            $estado = "En Proceso";
                        
			$datos = array("expediente" => $_POST["nExpediente"],
			       		   "modelo" => $_POST["nModelo"],
						   "aseguradora" => $_POST["nAseguradora"],
						   "ano" => $_POST["nAno"],
						   "mes" => $_POST["nMes"],
						   "estado" => $estado);
                 
               
   			$respuesta = ModeloCasos::mdlIngresarCaso($tabla,$datos);
              
            if ($respuesta == "ok") {    	
				echo '<script>
	    			swal({
						type: "success",
						title: "¡El caso ha sido guardado correctamente..!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"

					}).then(function(result){
						if(result.value){
							window.location = "casos";
						}    
					});
				</script>';
    		}// fin if

		} // fin isset(POST)
	
	} // fin funcion ctrCrearCasos

	/*=============================================
	    EDITAR DE CASO
	=============================================*/
	static public function ctrEditarCaso(){
    	if(isset($_POST["eExpediente"])){
			$tabla = "casos";  
                                   
			$datos = array("id"=> $_POST["eIdCaso"],
						   "expediente" => $_POST["eExpediente"],
 				 		   "modelo" => $_POST["eModelo"],
						   "aseguradora" => $_POST["eAseguradora"],
						   "ano" => $_POST["eAno"],  
						   "mes" => $_POST["eMes"],
						   "estado" => $_POST["eEstado"]);
                        
            $respuesta = ModeloCasos::mdlEditarCaso($tabla,$datos);
                 
            if ($respuesta == "ok") {    	
				echo '<script>
	    	    		swal({
							type: "success",
							title: "¡El caso ha sido actualizado correctamente..!",
							showConfirmButton: true,
							confirmButtonText: "Cerrar"
						}).then(function(result){
							if(result.value){
						  		window.location = "casos";
							} // fin if    
						});
					</script>';
    			}// fin if
				
		} // fin isset(POST)
	} // fin funcion ctrEditarCasos
   	
	/*=============================================
	ELIMINAR CATEGORIA
	=============================================*/
	static public function ctrEliminarCaso(){
		if(isset($_GET["idCaso"])){
			$tabla ="casos";
			$datos = $_GET["idCaso"];
     
			$respuesta = ModeloCasos::mdlBorrarCaso($tabla, $datos);

			if($respuesta == "ok"){
				echo'<script>   
					swal({
						  type: "success",
						  title: "El expediente ha sido borrado correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "casos";

									}
								})

					</script>';
			} // fin if
		} // fin if
	} // fin funcion Eliminar Caso	  

	/*=============================================
	ELIMINAR CATEGORIA
	=============================================*/
	static public function ctrEnviarEmail(){
		if(isset($_POST["nMail"])){
            $nMail = $_POST["nMail"];    
			$nRuta =  $_POST["nRuta"];
			$nAsunto =  $_POST["nAsunto"];
			$nDetalle =  $_POST["nDetalle"];

			$mail = new PHPMailer(true);
    		header('Content-type: text/html; charset=UTF-8');
    		$mensaje = "error";		 
            try {
				//Server settings
				$mail->SMTPOptions = array(
				  'ssl' => array(
				  'verify_peer' => false,
				  'verify_peer_name' => false,
				  'allow_self_signed' => true
				  )
				);
				$mail->SMTPDebug = 0;                      // Enable verbose debug output
				$mail->isSMTP();                                            // Send using SMTP
				$mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
				$mail->SMTPAuth   = true;                                   // Enable SMTP authentication
				$mail->Username   = 'info@repaut.com';                     // SMTP username
				$mail->Password   = 'Repaut123';                               // SMTP password
				$mail->SMTPSecure = 'tls';         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
				$mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above
			
				//Recipients   
				$mail->setFrom('info@repaut.com', 'Repaut');
				$mail->addAddress($nMail);
				$mail->SMTPKeepAlive = true;
				$mail->Mailer = "smtp";
				// Attachments
				$mail->addAttachment($nRuta);
				// Content   
				$mail->isHTML(true);                                  // Set email format to HTML
				$mail->Subject = htmlspecialchars($nAsunto);
				$mail->Body    = htmlspecialchars($nDetalle);

				$mail->send();
				$mensaje = "ok";
			} catch (Exception $e) {
				$mensaje = "error";
			}
			if ($mensaje == "ok") { 
			  echo'<script>   
				swal({
				  type: "success",
				  title: "El Correo se ha enviado correctamente",
				  showConfirmButton: true,
				  confirmButtonText: "Cerrar"
				  }).then(function(result){
					if (result.value) {
						window.location = "casos";
					} // fin if
				  });
				</script>';
			} // fin if		  
		} // fin if	
	} // fin funcion Enviar Email	  
		

} // fin clase ControladorCasos
	

 