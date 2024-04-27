<?php
  //mail("adrianherra@gmail.com","probando mercury","hola probando");
  use PHPMailer\PHPMailer\PHPMailer;
  use PHPMailer\PHPMailer\Exception;
   
  require 'PHPMailer/Exception.php';
  require 'PHPMailer/PHPMailer.php';
  require 'PHPMailer/SMTP.php';

  // Instantiation and passing `true` enables exceptions
$mail = new PHPMailer(true);
header('Content-type: text/html; charset=UTF-8');

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
    $mail->addAddress('adrianherra@gmail.com');     // Add a recipient
    $mail->SMTPKeepAlive = true;
    $mail->Mailer = "smtp";
    // Attachments
    $mail->addAttachment('..\vistas\img\recepcion\RecepcionMazda-252356.pdf');         // Add attachments
   
    // Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = htmlspecialchars('Recepcion Vehiculo');
    $mail->Body    = htmlspecialchars('Le adjuntamos la recepción de su vehículo.
    Repaut y sus asesores, le agradecen su preferencia.'). '<br>'
    .htmlspecialchars('Cualquier inconformidad o comentario será bien recibido a través de la siguiente dirección de e mail: notificaciones@repaut.com') . '<br>' 
    .htmlspecialchars('Consultas telefónicas: 2591 7532').'<br>'   
    .'<br><b>Taller y Carroceria Reaput, S.A.<b>'; 
    
    $mail->send();
    echo '<script>
     
      window.history.back();
    
      </script>';
   	  
     
} catch (Exception $e) {
    echo "Mensaje no enviado";
}

    