<?php
require($GLOBALS['app_root']."/PHPMailer-master/PHPMailerAutoload.php");

class Email {
  ########################################  Atributos  ########################################
  
  private $miPhpMailer;
  public  $error = NULL;
  
  #######################################  Operaciones  #######################################
  
  function __construct() {
    $this->miPhpMailer = new PHPMailer;
    $this->miPhpMailer->Encoding= "base64";
    $this->miPhpMailer->DKIM_domain = 'delfinbeta.com.ve';
    //$this->miPhpMailer->DKIM_private = '/home/cfelabanwk/DKIM/dkimfelabanprivate.key';
    //$this->miPhpMailer->DKIM_selector = '1478633142';
    //$this->miPhpMailer->DKIM_passphrase = '';
    $this->miPhpmailer->Helo = "www.delfinbeta.com.ve";
    $this->error = NULL;
  }
    
  public function recibir_comentario($nombre, $email, $mensaje) {
    $arrhtml_mail = file($GLOBALS['app_root'].'/plantillas/email_comentario.html');
        
    $html_mail = '';
    for($i = 0; $i < count($arrhtml_mail); $i++) {
      $html_mail .= $arrhtml_mail[$i];
    }
    
    $html_mail = str_replace("#NOMBRE#", $nombre, $html_mail);
    $html_mail = str_replace("#EMAIL#", $email, $html_mail);
    $html_mail = str_replace("#MENSAJE#", $mensaje, $html_mail);
    
    $this->miPhpMailer->setFrom('info@delfinbeta.com.ve', 'DelfinBeta');       // Quien envía el email
    $this->miPhpMailer->addReplyTo('info@delfinbeta.com.ve', 'DelfinBeta');    // A quien se regresa el email
    $this->miPhpMailer->addAddress('dkbetancourt@gmail.com', 'DelfinBeta');    // A quien se envía el email
    $this->miPhpMailer->addAddress('info@delfinbeta.com.ve', 'DelfinBeta');    // A quien se envía el email
    $this->miPhpMailer->isHTML(true);                                          // Establecer formato del email a HTML
    $this->miPhpMailer->Subject = "Mensaje de DelfinBeta";                     // Asunto del email
    $this->miPhpMailer->Body = $html_mail;                                     // Contenido del email en formato HTML
    $this->miPhpMailer->AltBody = 'Email en texto plano';                      // Contenido del email en formato de texto plano

    $this->miPhpMailer->DKIM_identity = $this->miPhpMailer->From;

    // Envío del Email
    if($this->miPhpMailer->send()) {
      return true;
    } else {
      $this->error = "PHPMailer Error: ".$this->miPhpMailer->ErrorInfo;
      return false;
    }
  }
    
  public function responder_comentario($email, $usuario, $respuesta) {
    $arrhtml_mail = file($GLOBALS['app_root'].'/plantillas/email_respuesta_comentario.html');
        
    $html_mail = '';
    for($i = 0; $i < count($arrhtml_mail); $i++) {
      $html_mail .= $arrhtml_mail[$i];
    }
    
    $html_mail = str_replace("#USUARIO#", $usuario, $html_mail);
    $html_mail = str_replace("#RESPUESTA#", $respuesta, $html_mail);
    
    $this->miPhpMailer->setFrom('info@delfinbeta.com.ve', 'DelfinBeta');       // Quien envía el email
    $this->miPhpMailer->addReplyTo('info@delfinbeta.com.ve', 'DelfinBeta');    // A quien se regresa el email
    $this->miPhpMailer->addAddress($email, $usuario);                          // A quien se envía el email
    $this->miPhpMailer->isHTML(true);                                          // Establecer formato del email a HTML
    $this->miPhpMailer->Subject = "DelfinBeta Contacto";                       // Asunto del email
    $this->miPhpMailer->Body = $html_mail;                                     // Contenido del email en formato HTML
    $this->miPhpMailer->AltBody = 'Email en texto plano';                      // Contenido del email en formato de texto plano

    $this->miPhpMailer->DKIM_identity = $this->miPhpMailer->From;

    // Envío del Email
    if($this->miPhpMailer->send()) {
      return true;
    } else {
      $this->error = "PHPMailer Error: ".$this->miPhpMailer->ErrorInfo;
      return false;
    }
  }
    
  public function enviar_suscripcion($nombre, $email, $codigo) {
    $arrhtml_mail = file($GLOBALS['app_root'].'/plantillas/email_suscripcion.html');
        
    $html_mail = '';
    for($i = 0; $i < count($arrhtml_mail); $i++) {
      $html_mail .= $arrhtml_mail[$i];
    }
    
    $html_mail = str_replace("#NOMBRE#", $nombre, $html_mail);
    $html_mail = str_replace("#EMAIL#", $email, $html_mail);
    $html_mail = str_replace("#CODIGO#", $codigo, $html_mail);
    
    $this->miPhpMailer->setFrom('info@delfinbeta.com.ve', 'DelfinBeta');       // Quien envía el email
    $this->miPhpMailer->addReplyTo('info@delfinbeta.com.ve', 'DelfinBeta');    // A quien se regresa el email
    $this->miPhpMailer->addAddress('info@delfinbeta.com.ve', 'DelfinBeta');    // A quien se envía el email
    $this->miPhpMailer->addAddress($email, $nombre);                           // A quien se envía el email
    $this->miPhpMailer->isHTML(true);                                          // Establecer formato del email a HTML
    $this->miPhpMailer->Subject = "DelfinBeta // Bienvenid@ y gracias";         // Asunto del email
    $this->miPhpMailer->Body = $html_mail;                                     // Contenido del email en formato HTML
    $this->miPhpMailer->AltBody = 'Email en texto plano';                      // Contenido del email en formato de texto plano

    $this->miPhpMailer->DKIM_identity = $this->miPhpMailer->From;

    // Envío del Email
    if($this->miPhpMailer->send()) {
      return true;
    } else {
      $this->error = "PHPMailer Error: ".$this->miPhpMailer->ErrorInfo;
      return false;
    }
  }
}
?>
