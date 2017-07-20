<?php
require("configuracion/inicio.php");

// Clases
require_once("clases/clase_articulo.php");
require_once("clases/clase_general.php");

// Objetos
$articulo = new Articulo($conexion);
$general = new General($conexion);

if(isset($_GET['id'])) { $id_articulo = $_GET['id']; } else { $id_articulo = 0; }

if(!$articulo->datos($id_articulo)) {
	header("location: index.html");
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	
	<title><?=$articulo->titulo?> // DelfinBeta</title>
	<meta name="creator" content="www.delfinbeta.com.ve" />
	<meta name="description" content="DelfinBeta es una Desarrolladora Web Venezolana, mi nombre es Dayan Betancourt desarrollo Frontend y Backend y también soy Emprendedora." />
	<meta name="distribution" content="global" />
	<meta name="revisit-after" content="1 days" />
	<meta name="googlebot" content="index, follow" />
	<meta name="robots" content="index, follow" />

	<!-- Bootstrap -->
  <link rel="stylesheet" href="css/bootstrap.min.css" />

  <!-- Icomoon -->
  <link rel="stylesheet" href="icomoon/style.css" />

  <!-- Font Awesome -->
  <link rel="stylesheet" href="font-awesome-4.7.0/css/font-awesome.min.css" />

	<link rel="stylesheet" href="css/delfinbeta.css" />

	<!--<link rel="shortcut icon" href="img/favicon/favicon.ico" />-->
	<link rel="apple-touch-icon" sizes="57x57" href="img/favicon/apple-icon-57x57.png" />
	<link rel="apple-touch-icon" sizes="60x60" href="img/favicon/apple-icon-60x60.png" />
	<link rel="apple-touch-icon" sizes="72x72" href="img/favicon/apple-icon-72x72.png" />
	<link rel="apple-touch-icon" sizes="76x76" href="img/favicon/apple-icon-76x76.png" />
	<link rel="apple-touch-icon" sizes="114x114" href="img/favicon/apple-icon-114x114.png" />
	<link rel="apple-touch-icon" sizes="120x120" href="img/favicon/apple-icon-120x120.png" />
	<link rel="apple-touch-icon" sizes="144x144" href="img/favicon/apple-icon-144x144.png" />
	<link rel="apple-touch-icon" sizes="152x152" href="img/favicon/apple-icon-152x152.png" />
	<link rel="apple-touch-icon" sizes="180x180" href="img/favicon/apple-icon-180x180.png" />
	<link rel="icon" type="image/png" sizes="192x192"  href="img/favicon/android-icon-192x192.png" />
	<link rel="icon" type="image/png" sizes="32x32" href="img/favicon/favicon-32x32.png" />
	<link rel="icon" type="image/png" sizes="96x96" href="img/favicon/favicon-96x96.png" />
	<link rel="icon" type="image/png" sizes="16x16" href="img/favicon/favicon-16x16.png" />
	<link rel="manifest" href="img/favicon/manifest.json" />
	<meta name="msapplication-TileColor" content="#ffffff" />
	<meta name="msapplication-TileImage" content="img/favicon/ms-icon-144x144.png" />
	<meta name="theme-color" content="#ffffff" />

  <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <meta property="og:url" content="http://delfinbeta.com.ve/articulo.php?id=<?=$id_articulo?>" />
  <meta property="og:type" content="website" />
  <meta property="og:title" content="<?=$articulo->titulo?>" />
  <meta property="og:description" content="<?=$articulo->descripcion?>" />
  <meta property="og:image" content="http://delfinbeta.com.ve/archivos_articulos/<?=$articulo->imagen?>" />

  <meta name="twitter:card" content="summary" />
	<meta name="twitter:site" content="@delfinbeta" />
	<meta name="twitter:title" content="<?=$articulo->titulo?>" />
	<meta name="twitter:description" content="<?=$articulo->descripcion?>" />
	<meta name="twitter:image" content="http://delfinbeta.com.ve/archivos_articulos/<?=$articulo->imagen?>" />
</head>

<body>
	<div id="fb-root"></div>
	<script>(function(d, s, id) {
	  var js, fjs = d.getElementsByTagName(s)[0];
	  if (d.getElementById(id)) return;
	  js = d.createElement(s); js.id = id;
	  js.src = "//connect.facebook.net/es_ES/sdk.js#xfbml=1&version=v2.8";
	  fjs.parentNode.insertBefore(js, fjs);
	}(document, 'script', 'facebook-jssdk'));</script>

	<nav class="navbar navbar-default navbar-fixed-top encabezado-inicio" role="navigation">
		<div class="container">
			<div class="navbar-header">
				<button id="botonMenu" type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#menuWeb" aria-expanded="false">
	        <span class="sr-only">Toggle navigation</span>
	        <span class="icon-bar"></span>
	        <span class="icon-bar"></span>
	        <span class="icon-bar"></span>
	      </button>
				<a class="navbar-brand" href="index.html">
					<img src="img/DelfinBeta-Blanco.png" alt="DelfinBeta" title="DelfinBeta" class="logo" />
				</a>
			</div>
			<div id="menuWeb" class="collapse navbar-collapse">
				<ul class="nav navbar-nav navbar-right">
					<li><a href="index.html">Inicio</a></li>
					<li><a href="delfinbeta.html">¿Quién es DelfinBeta?</a></li>
					<li><a href="trabajos.html">Mis Trabajos</a></li>
					<li class="active"><a href="compartir.html">Para Compartir</a></li>
					<li><a href="contacto.html">Contacto</a></li>
				</ul>
			</div>
		</div>
	</nav>

	<section class="portadaArt">
		<div class="container">
			<div class="row portadaArt-titular">
				<div class="col-xs-8 col-xs-offset-2 text-center">
					<h1><?=$articulo->titulo?></h1>
					<hr />
					<?php $fecha = explode("-", $articulo->fecha_registro);
								$fecha_unix = mktime(0, 0, 0, $fecha[1], $fecha[2], $fecha[0]); ?>
					<h4><?=date('d', $fecha_unix)?> de <?=$general->mes($articulo->fecha_registro)?> de <?=date('Y', $fecha_unix)?></h4>
				</div>
			</div>
		</div>
	</section>

	<section class="articulo2">
		<div class="container">
			<?=$articulo->contenido?>
			<div class="row">
				<div class="col-xs-12">
					<ul class="botones_compartir">
						<li><a href="https://twitter.com/share" class="twitter-share-button" data-via="delfinbeta" data-size="large" data-text="<?=$articulo->titulo?>" data-url="http://delfinbeta.com.ve/articulo.php?id=<?=$id_articulo?>">Tweet</a></li>
						<li><div class="g-plusone" data-href="http://delfinbeta.com.ve/articulo.php?id=<?=$id_articulo?>" data-annotation="inline" data-width="200"></div></li>
						<li><div class="fb-like" data-href="http://delfinbeta.com.ve/articulo.php?id=<?=$id_articulo?>" data-layout="button_count" data-action="like" data-show-faces="false" data-share="true"></div></li>
					</ul>
				</div>
			</div>
		</div>
	</section>

	<section class="suscripcion jumbotron">
		<div class="container">
			<div class="row">
				<div class="col-xs-10 col-xs-offset-1 col-md-8 col-md-offset-2">
					<div class="col-xs-12">
						<h2>Suscríbete<br /><small>Déjame tu email y compartiré contigo info sobre el mundo web.</small></h2>
					</div>
					<div id="suscripcion_exito" class="col-xs-12 text-center hidden">
						<p class="bg-success text-success"><i class="icon-check"></i> ¡Gracias! por unirte a mi comunidad <i class="icon-heart"></i></p>
					</div>
					<div id="suscripcion_error" class="col-xs-12 text-center hidden">
						<p class="bg-danger text-danger"><i class="icon-times"></i> <span id="msjError"></span></p>
					</div>
					<form id="form_suscripcion" name="form_suscripcion" action="suscripcion.php" method="post" role="form">
						<div class="col-xs-12 col-md-4 form-group">
							<label for="nombre" class="sr-only">Nombre:</label>
							<input type="text" name="nombre" class="form-control" placeholder="Tu Nombre" required aria-describedby="bloqueErrorNombre" />
							<span id="bloqueErrorNombre" class="help-block"></span>
						</div>
						<div class="col-xs-12 col-md-4 form-group">
							<label for="email" class="sr-only">Email:</label>
							<input type="email" name="email" class="form-control" placeholder="tu@email.com" required aria-describedby="bloqueErrorEmail" />
							<span id="bloqueErrorEmail" class="help-block"></span>
						</div>
						<div class="col-xs-12 col-md-4">
							<button type="submit" class="btn btn-default btn-accion2">Enviar</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</section>

	<footer class="piePag">
		<div class="container">
			<div class="row">
				<div class="col-xs-12 col-md-6 text-center">
					<h2>Contacto</h2>
					<ul class="lista-cero">
						<li><i class="icon-map-marker"></i> Maracay - Venezuela</li>
						<li><i class="icon-whatsapp"></i> +58 (426) 533.81.67</li>
						<li><i class="icon-envelope"></i> <a href="mailto:dkbetancourt@gmail.com">dkbetancourt@gmail.com</a></li>
					</ul>
				</div>
				<div class="col-xs-12 col-md-6 text-center">
					<h2>Redes Sociales >> @delfinbeta</h2>
					<ul class="redes">
						<li><a href="https://twitter.com/delfinbeta" target="_blank"><i class="icon-twitter-square"></i></a></li>
						<li><a href="https://www.facebook.com/delfinbeta" target="_blank"><i class="icon-facebook-official"></i></a></li>
						<li><a href="https://ve.linkedin.com/in/delfinbeta" target="_blank"><i class="icon-linkedin-square"></i></a></li>
						<li><a href="https://github.com/delfinbeta" target="_blank"><i class="icon-github-square"></i></a></li>
						<li><a href="https://www.instagram.com/delfinbeta/" target="_blank"><i class="icon-instagram"></i></a></li>
					</ul>
				</div>
			</div>
			<hr />
			<p class="derechos"><i class="icon-trademark"></i> DelfinBeta // 2016 Derechos Reservados // UI: <a href="http://mariofernandezs.com/" target="_blank">Mariosf</a> // Desarrollo Web: DelfinBeta</p>
		</div>
	</footer>

	<!-- Scripts -->
	<script>
	  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
	  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
	  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
	  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

	  ga('create', 'UA-92590416-1', 'auto');
	  ga('send', 'pageview');
	</script>
  <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script type="text/javascript" src="js/bootstrap.min.js"></script>
	<script type="text/javascript" src="js/delfinbeta.js"></script>
	<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
	<script src="https://apis.google.com/js/platform.js" async defer>{lang: 'es'}</script>
</body>
</html>