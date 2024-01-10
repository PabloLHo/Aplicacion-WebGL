<?php
////////////////// CONEXION A LA BASE DE DATOS ////////////////////////////////////
include("Recursos/php/conectar.php");
session_start();

$clave = $_SESSION['usuario'];

if( $clave == null || (time() - $_SESSION['tiempo']) > 43200){
header("location:index.php");
};
?>

<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="description" content="">
	<meta name="author" content="">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
	<title>Potree Viewer</title>

	<link rel="stylesheet" type="text/css" href="./Recursos/Potree/libs/potree/potree.css">
	<link rel="stylesheet" type="text/css" href="./Recursos/Potree/libs/jquery-ui/jquery-ui.min.css">
	<link rel="stylesheet" type="text/css" href="./Recursos/Potree/libs/openlayers3/ol.css">
	<link rel="stylesheet" type="text/css" href="./Recursos/Potree/libs/spectrum/spectrum.css">
	<link rel="stylesheet" type="text/css" href="./Recursos/Potree/libs/jstree/themes/mixed/style.css">
</head>

<body>
	<script src="./Recursos/Potree/libs/jquery/jquery-3.1.1.min.js"></script>
	<script src="./Recursos/Potree/libs/spectrum/spectrum.js"></script>
	<script src="./Recursos/Potree/libs/jquery-ui/jquery-ui.min.js"></script>
	<script src="./Recursos/Potree/libs/other/BinaryHeap.js"></script>
	<script src="./Recursos/Potree/libs/tween/tween.min.js"></script>
	<script src="./Recursos/Potree/libs/d3/d3.js"></script>
	<script src="./Recursos/Potree/libs/proj4/proj4.js"></script>
	<script src="./Recursos/Potree/libs/openlayers3/ol.js"></script>
	<script src="./Recursos/Potree/libs/i18next/i18next.js"></script>
	<script src="./Recursos/Potree/libs/jstree/jstree.js"></script>
	<script src="./Recursos/Potree/libs/potree/potree.js"></script>
	<script src="./Recursos/Potree/libs/plasio/js/laslaz.js"></script>
	
	<!-- INCLUDE ADDITIONAL DEPENDENCIES HERE -->
	<!-- INCLUDE SETTINGS HERE -->
	
	<div class="potree_container" style="position: absolute; width: 100%; height: 100%; left: 0px; top: 0px; ">
		<div id="potree_render_area"></div>
		<div id="potree_sidebar_container"> </div>
	</div>
	
	<script>
		window.onload = function() {
			window.viewer = new Potree.Viewer(document.getElementById("potree_render_area"));

			viewer.setEDLEnabled(true);
			viewer.setFOV(60);
			viewer.setPointBudget(2_000_000);
			<!-- INCLUDE SETTINGS HERE -->
			viewer.loadSettingsFromURL();

			viewer.setDescription("");

			viewer.loadGUI(() => {
				viewer.setLanguage('en');
				$("#menu_appearance").next().show();
				$("#menu_tools").next().show();
				$("#menu_clipping").next().show();
				viewer.toggleSidebar();
			});

			var remplaza = /\+/gi;
			var url = window.location.href;
			url = unescape(url);
			url = url.replace(remplaza, " ");
			url = url.toUpperCase();
			variable = "nube";
			var variable_may = variable.toUpperCase();
			var variable_pos = url.indexOf(variable_may);
			if (variable_pos != -1) {
				var pos_separador = url.indexOf("&", variable_pos);
				if (pos_separador != -1) {
					valor = url.substring(variable_pos + variable_may.length + 1, pos_separador);
				} else {
					valor = url.substring(variable_pos + variable_may.length + 1, url.length);
				}
			} else {
				alert("NO_ENCONTRADO");
			}

			pagina = url.substring(0, url.indexOf("?"));
			pagina = pagina.substring(pagina.lastIndexOf("/") + 1, pagina.length).toLowerCase();
			valor = valor.toLowerCase();

			if (valor.indexOf("#") != -1) {
				valor = valor.substring(0, valor.indexOf("#"));
			}

			nombre_Modelo = valor;
			console.log(nombre_Modelo);

			Potree.loadPointCloud("./Recursos/Potree/pointclouds/" + nombre_Modelo + "/metadata.json", "modeloPotree", e => {
				let scene = viewer.scene;
				let pointcloud = e.pointcloud;

				let material = pointcloud.material;
				material.size = 1;
				material.pointSizeType = Potree.PointSizeType.ADAPTIVE;
				material.shape = Potree.PointShape.SQUARE;
				material.activeAttributeName = "rgba";

				scene.addPointCloud(pointcloud);

				viewer.fitToScreen();
			});
		}
		
		
	</script>
	
	
  </body>
</html>
