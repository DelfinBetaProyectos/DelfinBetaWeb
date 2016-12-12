<?php
require("../configuracion/inicio.php");

// Clases
require_once("../clases/clase_suscriptor.php");
require_once("../clases/clase_email.php");

// Objetos
$suscriptor = new Suscriptor($conexion);
$eemail = new Email();

// Recibir Datos
if(isset($_POST['nombre'])) { $nombre = $_POST['nombre']; } else { $nombre = '---'; }
if(isset($_POST['email'])) { $email = $_POST['email']; } else { $email = '---'; }

if(!$suscriptor->email_existe($email, 0)) {
	if($suscriptor->insertar($nombre, $email)) {
		// Enviar Email
		//$eemail->enviar_suscripcion($nombre, $email);

		echo json_encode(array("error" => false, "mensaje" => 'Suscriptor Agregado'));
	} else {
		echo json_encode(array("error" => true, "mensaje" => $suscriptor->error));
	}
} else {
	echo json_encode(array("error" => true, "mensaje" => "Su email ya está registrado"));
}
?>