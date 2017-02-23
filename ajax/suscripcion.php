<?php
require("../configuracion/inicio.php");

// Clases
require_once("../clases/clase_suscriptor.php");
require_once("../clases/clase_general.php");
require_once("../clases/clase_email.php");

// Objetos
$suscriptor = new Suscriptor($conexion);
$general = new General($conexion);
$eemail = new Email();

// Recibir Datos
if(isset($_POST['nombre'])) { $nombre = $_POST['nombre']; } else { $nombre = '---'; }
if(isset($_POST['email'])) { $email = $_POST['email']; } else { $email = '---'; }

$codigo = $general->generarCodigo(10, true, true, false);

if(!$suscriptor->email_existe($email, 0)) {
	if($suscriptor->insertar($nombre, $email, $codigo)) {
		// Enviar Email
		$eemail->enviar_suscripcion($nombre, $email, $codigo);

		echo json_encode(array("error" => false, "mensaje" => 'Suscriptor Agregado'));
	} else {
		echo json_encode(array("error" => true, "mensaje" => $suscriptor->error));
	}
} else {
	echo json_encode(array("error" => true, "mensaje" => "Su email ya está registrado"));
}
?>