<?php
require("../configuracion/inicio.php");

// Clases
require_once("../clases/clase_articulo.php");
require_once("../clases/clase_general.php");

// Objetos
$articulo = new Articulo($conexion);
$general = new General($conexion);

// Listar Clientes
$listado = $articulo->listado(1);
$total = $articulo->total_listado(1);

if($total > 0) {
	$cont = 0;
	foreach($listado as $registro) {
		$fecha = explode("-", $registro->fecha_registro);
		$fecha_unix = mktime(0, 0, 0, $fecha[1], $fecha[2], $fecha[0]);

		if(($cont % 2) == 0) {
			echo '<div class="row articulo">';
			echo '<div class="col-xs-12 col-md-4">';
			echo '<div class="img">';
			echo '<a href="articulo.php?id='.$registro->obtener_id().'"><img src="archivos_articulos/'.$registro->imagen.'" alt="'.$registro->titulo.'" title="'.$registro->titulo.'" class="img-responsive"></a>';
			echo '</div>';
			echo '</div>';
			echo '<div class="col-xs-12 col-md-8">';
			echo '<h2><a href="articulo.php?id='.$registro->obtener_id().'">'.$registro->titulo.'</a></h2>';
			echo '<h4>'.date('d', $fecha_unix).' de '.$general->mes($registro->fecha_registro).' de '.date('Y', $fecha_unix).'</h4>';
			echo '<ul class="botones_compartir">';
			echo '<li><a href="https://twitter.com/share" class="twitter-share-button" data-via="delfinbeta" data-size="large" data-text="'.$registro->titulo.'" data-url="http://delfinbeta.com.ve/articulo.php?id='.$registro->obtener_id().'">Tweet</a></li>';
			echo '<li><div class="g-plusone" data-href="http://delfinbeta.com.ve/articulo.php?id='.$registro->obtener_id().'" data-annotation="inline" data-width="200"></div></li>';
			echo '<li><div class="fb-like" data-href="http://delfinbeta.com.ve/articulo.php?id='.$registro->obtener_id().'" data-layout="button_count" data-action="like" data-show-faces="false" data-share="true"></div></li>';
			echo '</ul>';
			echo '</div>';
			echo '</div>';
		} else {
			echo '<div class="row articulo text-right">';
			echo '<div class="col-xs-12 col-md-8">';
			echo '<h2><a href="articulo.php?id='.$registro->obtener_id().'">'.$registro->titulo.'</a></h2>';
			echo '<h4>'.date('d', $fecha_unix).' de '.$general->mes($registro->fecha_registro).' de '.date('Y', $fecha_unix).'</h4>';
			echo '<ul class="botones_compartir">';
			echo '<li><a href="https://twitter.com/share" class="twitter-share-button" data-via="delfinbeta" data-size="large" data-text="'.$registro->titulo.'" data-url="http://delfinbeta.com.ve/articulo.php?id='.$registro->obtener_id().'">Tweet</a></li>';
			echo '<li><div class="g-plusone" data-href="http://delfinbeta.com.ve/articulo.php?id='.$registro->obtener_id().'" data-annotation="inline" data-width="200"></div></li>';
			echo '<li><div class="fb-like" data-href="http://delfinbeta.com.ve/articulo.php?id='.$registro->obtener_id().'" data-layout="button_count" data-action="like" data-show-faces="false" data-share="true"></div></li>';
			echo '</ul>';
			echo '</div>';
			echo '<div class="col-xs-12 col-md-4">';
			echo '<div class="img">';
			echo '<a href="articulo.php?id='.$registro->obtener_id().'"><img src="archivos_articulos/'.$registro->imagen.'" alt="'.$registro->titulo.'" title="'.$registro->titulo.'" class="img-responsive"></a>';
			echo '</div>';
			echo '</div>';
			echo '</div>';
		}

		$cont++;
	}
} else {
	echo "<p>No hay Artículos Disponibles</p>";
}
?>