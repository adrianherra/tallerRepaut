<?php
      
require_once "../controladores/casos.controlador.php";
require_once "../modelos/casos.modelo.php";

require_once "../controladores/entradas.controlador.php";
require_once "../modelos/entradas.modelo.php";

require_once "../controladores/clientes.controlador.php";
require_once "../modelos/clientes.modelo.php";

  
//use PHPMailer\PHPMailer\PHPMailer;
//use PHPMailer\PHPMailer\Exception;
   
//require '../PHPMailer/Exception.php';
//require '../PHPMailer/PHPMailer.php';
//require '../PHPMailer/SMTP.php';


class AjaxCasos{

  public $idCaso;
  public $idMail;
  public $idEstado;
  public $estadoEntrada;
  /*=============================================
  ENVIAR MAIL
  =============================================*/ 
  public function ajaxEnviarEmail(){

  /*  $item = "id";
    $valor = $this->idMail;
    //$valor = "28";
                
    $respuesta = ControladorEntradas::ctrMostrarEntradas($item, $valor);
    $rutaPdf = $respuesta[0]["rutaPdf"];
    
    $valor = $respuesta[0]["idCliente"];
    $respuesta = ControladorClientes::ctrMostrarClientes($item, $valor);
      
    $emailCliente = $respuesta["email"];
    
        
    // Instantiation and passing `true` enables exceptions
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
      $mail->addAddress($emailCliente);
      $mail->SMTPKeepAlive = true;
      $mail->Mailer = "smtp";
      // Attachments
      //$mail->addAttachment('..\vistas\img\recepcion\RecepcionToyota-123.pdf');         // Add attachments
      $mail->addAttachment($rutaPdf);
      // Content   
      $mail->isHTML(true);                                  // Set email format to HTML
      $mail->Subject = htmlspecialchars('Recepcion Vehiculo');
      $mail->Body    = htmlspecialchars('Le adjuntamos la recepción de su vehículo.
      Repaut y sus asesores, le agradecen su preferencia.'). '<br>'
      .htmlspecialchars('Cualquier inconformidad o comentario será bien recibido a través de la siguiente dirección de e mail: notificaciones@repaut.com') . '<br>' 
      .htmlspecialchars('Consultas telefónicas: 2591 7532').'<br>'   
      .'<br><b>Taller y Carroceria Reaput, S.A.<b>'; 
      
      $mail->send();
      $mensaje = "ok";
    } catch (Exception $e) {
      $mensaje = "error";
    }
   
    echo json_encode($mensaje); 
    */ 
    
  } // fin funcion ajaxEnviarEmail
  
  /*=============================================
  EDITAR CLIENTE
  =============================================*/ 
  public function ajaxEditarCaso(){

    $item = "id";
    $valor = $this->idCaso;
      
    $respuesta = ControladorCasos::ctrMostrarCasos($item, $valor);

    echo json_encode($respuesta);  

  } // fin funcion ajaxEditarCaso
   
  /*=============================================
   CAMBIAR ESTADO
  =============================================*/ 
  public function ajaxCambiarEstado(){

    $valor = $this->idEstado;
    $valor1 = $this->estadoEntrada;
           
    $respuesta = ControladorEntradas::ctrCambiarEstado($valor,$valor1);
       
    echo json_encode($respuesta);  

  } // fin funcion ajaxCambiarEstado
    
}// fin class AjaxCasos

/*=============================================
EDITAR CASOS
=============================================*/
if(isset($_POST["idCaso"])){
  $editar = new AjaxCasos();
  $editar -> idCaso = $_POST["idCaso"];
  $editar -> ajaxEditarCaso();
} // fin if 

/*=============================================
ENVIO DE EMAIL 
=============================================*/
if(isset($_POST["idMail"])){
  $email = new AjaxCasos();
  $email -> idMail = $_POST["idMail"];
  $email -> ajaxEnviarEmail();
} // fin if 

/*=============================================
CAMBIO DE ESTADO 
=============================================*/
if(isset($_POST["idEstado"])){
  $estado = new AjaxCasos();
  $estado -> idEstado = $_POST["idEstado"];
  $estado -> estadoEntrada = $_POST["estadoEntrada"];
  $estado -> ajaxCambiarEstado();  
} // fin if 

