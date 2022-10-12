<?php
session_start(); //Sirve para poder tener variables de sesión
//Recollim valors del formulari
if (isset($_POST["nombre"])) {
  $nombre = $_POST['nombre'];
  $_SESSION['nombre'] = $nombre;
}
if (isset($_POST["email"])) {
  $email = $_POST['email'];
}
if (isset($_POST["lugar"])) {
  $lugar = $_POST['lugar'];
}
if (isset($_POST["fecha"])) {
  $fecha = $_POST['fecha'];
}
if (isset($_POST["invitados"])) {
  $invitados = $_POST['invitados'];
}
if (isset($_POST["descripcion"])) {
  $descripcion = $_POST['descripcion'];
}
if (isset($_POST["verificacio"])) {
  $verificacio = $_POST['verificacio'];
}


//Creem el contingut del missatge
$body = 'Bodas Perfectas ha recibido una nueva solicitud de información. Estos son los datos de contacto y su idea para la boda:<br>Nombre: ' .$nombre. '<br>Correo electrónico: ' .$email .'<br>Lugar de celebración: ' .$lugar. '<br>Fecha aproximada de la boda: ' .$fecha. '<br>Número de invitados: ' .$invitados. '<br>Idea para la boda: ' .$descripcion. '<br>Acepta la política de privacidad' .$verificacio;


//Missatge alternatiu per clients de correu que no donin suport a HTML
$altbody = 'Bodas Perfectas ha recibido una nueva solicitud de información. Estos son los datos de contacto y su idea para la boda:' . "\n" . 'Nombre: ' .$nombre. "\n" . 'Correo electrónico: ' .$email. "\n" . 'Lugar de celebración: ' .$lugar. "\n" . 'Fecha aproximada de la boda: ' .$fecha. "\n" . 'Número de invitados: ' .$invitados. "\n" . 'Idea para la boda: ' .$descripcion. "\n" . 'Acepta la política de privacidad:' . "\n" . $verificacio;

//Importem PHPMailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'utils/Exception.php';
require 'utils/PHPMailer.php';
require 'utils/SMTP.php';

//Instanciem la classe i treballem les excepcions
$mail = new PHPMailer(true);
try {
    $mail->SMTPOptions = array(
      'ssl' => array(
        'verify_peer' => false,
        'verify_peer_name' => false,
        'allow_self_signed' => true
      )
    );
    
    $mail->SMTPDebug = 0;                     // Debug: 0 en producció
    $mail->isSMTP();                          // Enviar utilitzant SMPT
    $mail->Host = 'smtp.gmail.com';           // Indiquem el servei de SMTP que s'utilitzarà
    $mail->SMTPAuth = true;                   // Activem l'autenticació SMTP
    $mail->Username = 'webformulariscursos@gmail.com';   // SMTP username
    $mail->Password = 'qlvi ulic vigp meng';   // Contrasenya SMTP
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
    $mail->Port = 587;  // Port TCP port per connectar, port alternatiu (465)

    //Preparem l'enviament
    $mail->setFrom('webformulariscursos@gmail.com');           // Remitent 
    //$mail->setFrom('webformulariscursos@gmail.com', $nom);           // Remitent 
    $mail->addAddress('ericsalat@protonmail.com', 'Administrador web');     // Destinatari
    $mail->addReplyTo($email, 'Information');
    //$mail->addCC('cc@example.com');
    //$mail->addBCC('bcc@example.com');

    // Enviament de fitxers adjunts
    // if (isset($_FILES['arxiu']) && $_FILES['arxiu']['error'] == UPLOAD_ERR_OK) {
    //     $mail->AddAttachment($_FILES['arxiu']['tmp_name'],
    //     $_FILES['arxiu']['name']);
    // }
    // Content
    $mail->isHTML(true);                                  // Establim format HTML del missatge
    $mail->Subject = 'Enviat des de la web. Informació';
    $mail->Body    = $body;
    $mail->AltBody = $altbody;
    $mail->CharSet = 'UTF-8';
    $mail->send();
    
    header("Location:../feedback.php?n=$nom&c=$correu");  // Arxiu on redirigir l'usuari un cop el correu ha estat enviat 

    } catch (Exception $e) {
        echo "El missatge no s'ha pogut enviar. Error: {$mail->ErrorInfo}";
    }
?>