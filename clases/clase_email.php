<?php
class Email {
  public function enviar_contrasena($correo, $contrasena, $nombre, $apellido) {
    $arrhtml_mail = file($GLOBALS['app_root'].'/plantillas/email_contrasena.html');

    $html_mail = '';
    for($i = 0; $i < count($arrhtml_mail); $i++) {
      $html_mail .= $arrhtml_mail[$i];
    }
    
    $html_mail = str_replace("#NOMBRE#", $nombre, $html_mail);
    $html_mail = str_replace("#APELLIDO#", $apellido, $html_mail);
    $html_mail = str_replace("#CONTRASENA#", $contrasena, $html_mail);
    
    $contenido = $html_mail;
    $asunto = "Mariofs - Recuperar Contraseña";
    
    $headers = "MIME-Version: 1.0\r\n";
    $headers .= "Content-type: text/html; charset=utf-8\r\n";
    $headers .= "From: Mariofs <hey@mariofernandezs.com>\r\n";
    mail($correo, $asunto, $contenido, $headers); #ENVIO DEL EMAIL CON LOS DATOS#
  }
    
  public function enviar_comentario($nombre, $email, $telefono, $mensaje, $suscripcion) {
    $arrhtml_mail = file($GLOBALS['app_root'].'/plantillas/email_comentario.html');
        
    $html_mail = '';
    for($i = 0; $i < count($arrhtml_mail); $i++) {
      $html_mail .= $arrhtml_mail[$i];
    }
    
    $html_mail = str_replace("#NOMBRE#", $nombre, $html_mail);
    $html_mail = str_replace("#EMAIL#", $email, $html_mail);
    $html_mail = str_replace("#TELEFONO#", $telefono, $html_mail);
    $html_mail = str_replace("#MENSAJE#", $mensaje, $html_mail);
    $html_mail = str_replace("#SUSCRIPCION#", $suscripcion, $html_mail);
    
    $contenido = $html_mail;
    $asunto = "Mariofs - Mensaje";
    
    $headers = "MIME-Version: 1.0\r\n";
    $headers .= "Content-type: text/html; charset=utf-8\r\n";
    $headers .= "From: Mariofs <hey@mariofernandezs.com>\r\n";
    mail('hey@mariofernandezs.com', $asunto, $contenido, $headers); #ENVIO DEL EMAIL CON LOS DATOS#
  }
    
  public function enviar_respuesta_comentario($email, $usuario, $respuesta) {
    $arrhtml_mail = file($GLOBALS['app_root'].'/plantillas/email_respuesta_comentario.html');
        
    $html_mail = '';
    for($i = 0; $i < count($arrhtml_mail); $i++) {
      $html_mail .= $arrhtml_mail[$i];
    }
    
    $html_mail = str_replace("#USUARIO#", $usuario, $html_mail);
    $html_mail = str_replace("#RESPUESTA#", $respuesta, $html_mail);
    
    $contenido = $html_mail;
    $asunto = "Mariofs - Mensaje de Respuesta";
    
    $headers = "MIME-Version: 1.0\r\n";
    $headers .= "Content-type: text/html; charset=utf-8\r\n";
    $headers .= "From: Mariofs <hey@mariofernandezs.com>\r\n";
    mail($email, $asunto, $contenido, $headers); #ENVIO DEL EMAIL CON LOS DATOS#
  }
}
?>