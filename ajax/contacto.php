<?php
require("../configuracion/inicio.php");

// Clases
require_once("../clases/clase_comentario.php");
require_once("../clases/clase_suscriptor.php");
require_once("../clases/clase_email.php");

// Objetos
$comentario = new Comentario($conexion);
$suscriptor = new Suscriptor($conexion);
$eemail = new Email();

// Recibir Datos
if(isset($_POST['nombre'])) { $nombre = $_POST['nombre']; } else { $nombre = '---'; }
if(isset($_POST['email'])) { $email = $_POST['email']; } else { $email = '---'; }
if(isset($_POST['mensaje'])) { $mensaje = $_POST['mensaje']; } else { $mensaje = '---'; }
if(isset($_POST['suscripcion'])) { $suscripcion = $_POST['suscripcion']; } else { $suscripcion = 0; }

if($comentario->insertar($nombre, $email, $mensaje)) {
	// Enviar Email
	$eemail->recibir_comentario($nombre, $email, $mensaje);

	if(($suscripcion > 0) && !$suscriptor->email_existe($email, 0)) { $suscriptor->insertar($nombre, $email); }

	echo json_encode(array("error" => false, "mensaje" => 'Comentario Agregado'));
} else {
	echo json_encode(array("error" => true, "mensaje" => $comentario->error));
}
?>