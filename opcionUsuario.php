<?php
session_start();
    
    if( isset( $_SESSION['name'] ) and isset( $_SESSION['userId'] ) ) {


?>

<!DOCTYPE html>
<html>
	<head>
		<title>Usuarios</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1, maximum-scale=1, minimum-scale=1">
		<link rel="stylesheet" href="css/estilos.css">
		<link rel="stylesheet" href="css/font-awesome.min.css">
		<script src="js/link.js"></script>
	</head>
	<body>
		<header>
			<h1>Opciones para Usuarios</h1>
		</header>
			<form class="contenedor">
				<center>
					<button class="boton" type="button" onclick="javascript:usuarios();">Adicionar Usuario</button>
					<br>
					<br>
					<br>
					<br>
					<br>
					<button class="boton" type="button" onclick="javascript:modificarusuarios();">Modificar Usuario</button>
					<br>
					<br>
					<br>
					<br>
					<br>
					<button class="boton" type="button" onclick="javascript:menuadministrador();">Regresar</button>
				</center>
			</form>


	<?php
		}else{
			echo "No hay sesion";
		}

	?>
	</body>
</html>