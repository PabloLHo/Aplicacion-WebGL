<?php
////////////////// CONEXION A LA BASE DE DATOS ////////////////////////////////////
include("Recursos/php/conectar.php");
session_start();

$clave = $_SESSION['usuario'];

if( $clave == null || (time() - $_SESSION['tiempo']) > 43200){
	header("location:index.php");
};

?>

<html lang="es">
	<head>
		<!-- Required meta tags -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
		
		<link rel="icon" type="image/x-icon" href="Recursos/imagenes/logo.png">
		
		<!-- Bootstrap CSS -->
		<link rel="stylesheet" type="text/css" href="Recursos/css/dashboard.css" media="all">
		<link rel="stylesheet" type="text/css" href="Recursos/css/mensajes.css" media="all">
		<link rel="stylesheet" href="Recursos/fonts/fontawesome-all.min.css">
		<link rel="stylesheet" href="Recursos/css/ol-layerswitcher.css" type="text/css">
		<link rel="stylesheet" type="text/css" href="Recursos/css/bootstrap.min.css" media="all">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<link rel="stylesheet" type="text/css" href="Recursos/css/mapa.css" media="all">
		<link rel="stylesheet" href="https://cdn.rawgit.com/openlayers/openlayers.github.io/master/en/v5.3.0/css/ol.css" type="text/css">
		<link rel="stylesheet" type="text/css" href="Recursos/js/Mapa/ol-ext/ol-ext.css" media="all">

		
		
		
		<script src="https://cdn.rawgit.com/openlayers/openlayers.github.io/master/en/v5.3.0/build/ol.js"></script>
		<script src="Recursos/js/Mapa/ol-ext/ol-ext.js"></script>
		<script src="Recursos/js/Externo/jquery-6.0.0-min.js"></script>
		<script src="Recursos/js/Externo/Bootstrap/bootstrap.bundle.js"></script>
		<script src="Recursos/js/Externo/Bootstrap/bootstrap.js"></script>
		<script src="Recursos/js/Externo/Bootstrap/bootstrap.min.js"></script>
		<script src="Recursos/js/Mapa/ol-layerswitcher.js"></script>
		
		<!-- Script para poner los datos de usuario -->
		<script>
			window.onload = function() {
				var datos = $.ajax({
					url: 'Recursos/php/gestionPerfiles.php',
					data: { nombre: "<?php echo $clave;?>", funcion: "permisos" },
					dataType: 'text',
					async: false
				}).responseText;

			datos = datos.split("&");
			document.getElementById("fotoPerfilNav").src = "Recursos/imagenes/usuarios/" + datos[1];
		}
		</script>
		
		<title>Bienvenida</title>
	</head>
  
	<body class="host">

		<!-- Cabecera -->
		<section class="container-fluid">
			<section>
				<nav class="navbar navbar-expand shadow topbar static-top bg-success" style="height: 100px">
					<div class="container-fluid" >
						<a href="Home.php" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-dark text-decoration-none">
							<img src="Recursos/imagenes/logo.png"  alt=".logo" width="auto" height="100px" hspace="40" align="left">
							<span class="fs-4 text-dark"><b>El olivar en Jaén</b></span>
						</a>
						<ul class="navbar-nav flex-nowrap ms-auto">
							<div class="d-none d-sm-block topbar-divider"></div>
							<li class="nav-item dropdown no-arrow">
								<div class="nav-item dropdown no-arrow">
									<a class="dropdown-toggle nav-link" aria-expanded="false" data-bs-toggle="dropdown" href="#">
										<span class="d-none d-lg-inline me-2 text-dark-600 small"><b> <?php echo $clave;?> </b></span>
										<img class="border rounded-circle img-profile" id="fotoPerfilNav">
									</a>
									<div class="dropdown-menu shadow dropdown-menu-end animated--grow-in">
										<a class="dropdown-item" href="Perfil.php"><i class="fas fa-user fa-sm fa-fw me-2 text-gray-400"></i>&nbsp;Usuario</a>
										<div class="dropdown-divider"></div>
										<form action="Recursos/php/cierreSesion.php" method="post">
											<button class="dropdown-item" href="#"><i class="fas fa-sign-out-alt fa-sm fa-fw me-2 text-gray-400"></i> &nbsp;Cerrar Sesión</button>
										</form>
									</div>
								</div>
							</li>
						</ul>
					</div>
				</nav>
			</section>

			<!--Mapa --> 
			<section id="principal">
				<br><br>
				<h1 class="tituloMapa"><center> Mapa Agricola Español </center></h1>
				<br>
				<div id="mensaje" class="info-msg" style="width: 100%; display: none">
					 <a onclick="mensaje.style.display = 'none'"><i class="fa fa-times "></i>
						La selección no se encuentra activa
					</a>
				</div>
				<div id="map" class="map"></div>
				<script type="text/javascript" src="Recursos/js/Mapa/mapa.js"></script>

			</section>		
				
			<!-- Información adicional de la aplicación -->
			<section class="text-center bg-light features-icons container-fluid" style="margin-top:10%">
				<div>
					<h2 class="mb-5 tituloMapa">Características del sistema</h2>
					<div class="row">
						<div class="col-lg-3">
							<div class="mx-auto features-icons-item mb-5 mb-lg-0 mb-lg-3">
								<div class="d-flex features-icons-icon"><i class="fa fa-area-chart m-auto text-primary" data-bss-hover-animate="pulse"></i></div>
								<h3>Análisis Historico de Datos Multisensoriales</h3>
								<p class="lead mb-0">Analiza la situación historica de tu parcela mediante la extracción de conocmiento por gráficas</p>
							</div>
						</div>
						<div class="col-lg-3">
							<div class="mx-auto features-icons-item mb-5 mb-lg-0 mb-lg-3">
								<div class="d-flex features-icons-icon"><i class="fa fa-cube m-auto text-primary" data-bss-hover-animate="pulse"></i></div>
								<h3>Modelado 3D</h3>
								<p class="lead mb-0">Representación tridimensional de cualquiera parcela, interactua con ella desde cualquier lugar</p>
							</div>
						</div>
						<div class="col-lg-3">
							<div class="mx-auto features-icons-item mb-5 mb-lg-0 mb-lg-3">
								<div class="d-flex features-icons-icon"><i class="fa fa-object-group m-auto text-primary" data-bss-hover-animate="pulse"></i></div>
								<h3>Detección de olivos</h3>
								<p class="lead mb-0">Consigue información costosa y tediosa en un momento con la detección automatica de olivos en nuestra parcela</p>
							</div>
						</div>
						<div class="col-lg-3">
							<div class="mx-auto features-icons-item mb-5 mb-lg-0 mb-lg-3">
								<div class="d-flex features-icons-icon"><i class="fa fa-line-chart m-auto text-primary" data-bss-hover-animate="pulse"></i></div>
								<h3>Prototipo expandible</h3>
								<p class="lead mb-0">Aplicación limitada a su uso en parcelas concretas pero con grandes posibilidades de expansión</p>
							</div>
						</div>
					</div>
					<div class="col">
							<div class="mx-auto features-icons-item mb-5 mb-lg-0 mb-lg-3">
								<div class="d-flex features-icons-icon"><i class="fa fa-book m-auto text-primary" data-bss-hover-animate="pulse"></i></div>
								<h3>Manual de usuario</h3>
								<p class="lead mb-0">Es posible disponer del <a href="#">Manual de usuario</a> para el control del sistema</p>
							</div>
					</div>
				</div>
			</section>	
				
			<section id="Informacion_2" class="showcase container-fluid">
			<br>
			</section>

			<section id="informacion_4" class="text-center bg-light testimonials container-fluid">
				<div>
					<h2 class="mb-5 tituloMapa">Participantes</h2>
					<div class="row">
						<div class="col-lg-4">
							<div class="mx-auto testimonial-item mb-5 mb-lg-0"><img class="rounded-circle img-fluid mb-3" src="recursos/imagenes/usuarios/Sin_Usuario.jpg">
								<h5>Miembro 1</h5>
							</div>
						</div>
						<div class="col-lg-4">
							<div class="mx-auto testimonial-item mb-5 mb-lg-0"><img class="rounded-circle img-fluid mb-3" src="recursos/imagenes/usuarios/Sin_Usuario.jpg">
								<h5>Miembro 2</h5>
							</div>
						</div>
						<div class="col-lg-4">
							<div class="mx-auto testimonial-item mb-5 mb-lg-0">
								<img class="rounded-circle img-fluid mb-3" src="recursos/imagenes/usuarios/Sin_Usuario.jpg">
								<h5>Miembro 3</h5>
							</div>
						</div>
					</div>
				</div>
			</section>
			
			<footer class="bg-white sticky-footer">
				<div class="container my-auto">
					<div class="text-center my-auto copyright"><span>Copyright © Pablo Latorre Hortelano 2023</span></div>
				</div>
			</footer>
		</section>


		<style>
			.ol-zoomslider button{
				height: 10%;
				width: 100%;
			}
		</style>
	</body>
</html>