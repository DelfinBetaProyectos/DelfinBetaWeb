<?php
require("configuracion/inicio.php");

// Clases
require_once("clases/clase_suscriptor.php");

// Objetos
$suscriptor = new Suscriptor($conexion);

// Recibir Datos
if(isset($_GET['email'])) { $email = $_GET['email']; } else { $email = ''; }
if(isset($_GET['cod'])) { $codigo = $_GET['cod']; } else { $codigo = ''; }
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	
	<title>DelfinBeta</title>
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
</head>

<body class="espaciado-menu">
	<nav class="navbar navbar-default navbar-fixed-top encabezado" role="navigation">
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
					<li class="active"><a href="index.html">Inicio</a></li>
					<li><a href="delfinbeta.html">¿Quién es DelfinBeta?</a></li>
					<li><a href="trabajos.html">Mis Trabajos</a></li>
					<li><a href="compartir.html">Para Compartir</a></li>
					<li><a href="contacto.html">Contacto</a></li>
				</ul>
			</div>
		</div>
	</nav>

	<section>
		<div class="container">
			<h2>Cancelar Suscripción</h2>
			<p>Lamento que nos dejes, pero siempre respetamos tus deseos, sigue adelante compartiendo tu conocimiento :).</p>
			<?php if($suscriptor->cancelar_suscripcion($email, $codigo)) { ?>
			<div class="col-xs-12 text-center">
				<p class="bg-success text-success"><i class="icon-check"></i> Chao, se ha cancelado tu suscripción</p>
			</div>
			<?php } else { ?>
			<div class="col-xs-12 text-center">
				<p class="bg-danger text-danger"><i class="icon-times"></i> <span id="msjError">Error: <?=$suscriptor->error?></span></p>
			</div>
			<?php } ?>
			<div style="height: 260px;">&nbsp;</div>
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
  <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script type="text/javascript" src="js/bootstrap.min.js"></script>
	<script type="text/javascript" src="js/delfinbeta.js"></script>
</body>
</html>