<?php
require("configuracion/inicio.php");

// Clases
require_once("clases/clase_suscriptor.php");

// Objetos
$suscriptor = new Suscriptor($conexion);

echo "Hola insertemos un suscriptor:<br />";

if($suscriptor->insertar("Dayan Betancourt", "dkbetancourt@gmail.com")) {
	echo "INSERTADO";
} else {
	echo "ERROR: ".$suscriptor->error;
}
?>