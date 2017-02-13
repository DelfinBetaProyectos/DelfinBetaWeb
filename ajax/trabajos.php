<?php
require("../configuracion/inicio.php");

// Clases
require_once("../clases/clase_cliente.php");

// Objetos
$cliente = new Cliente($conexion);

// Listar Clientes
$listado = $cliente->listado(1);
$total = $cliente->total_listado(1);

if($total > 0) {
	echo '<div class="row">';
	foreach($listado as $registro) {
		echo '<div class="col-xs-12 col-sm-6 col-md-4">';
		echo '<article class="trabajo ih-item square effect6 from_top_and_bottom">';
		echo '<div class="img"><img src="archivos_clientes/'.$registro->imagen.'" alt="'.$registro->nombre.'" class="img-responsive" /></div>';
		echo '<div class="info">';
		echo '<h3>'.$registro->nombre.'</h3>';
		echo '<p><a href="http://'.$registro->enlace.'" target="_blank">'.$registro->enlace.'</a></p>';
		echo '</div>';
		echo '</article>';
		echo '</div>';
	}
	echo '</div>';
} else {
	echo "<p>No hay Trabajos Disponibles</p>";
}
?>