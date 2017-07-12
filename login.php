<?php
 	session_start();


?>
<!DOCTYPE html>
<html>
	<head>
		<title>Login</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1, maximum-scale=1, minimum-scale=1">
		<link rel="stylesheet" href="css/estilos.css">
		<link rel="stylesheet" href="css/flexboxgrid.min.css">
		
		<script type="text/javascript" src="js/alert.js"></script>
	</head>
	<body>

		<?php
			if(isset($_SESSION['no_session'] ) ){

	 			?>
	 			<script>
	 				alertMensaje();
	 			</script>
	 			<?php
	 			unset($_SESSION['no_session']);
	            session_unset();

				session_destroy();  
 			}
		?>
		<header>
			<h1 class="encabezado">Sistema de Inventario</h1>
		</header>
		<div class="row around-xs center-xs margenes">
    		<div class="col-xs-6">
    			<div class="logo">
					<img src="css/logo.png" width="450" height="200">
				</div>
			</div>
			<div class="col-xs-6">
				<form class="contenedor" method="post" action="ws/wsUsuarios.php">
					<h2 class="titutloFormulario">Iniciar sesión</h2>
					<br>
					<h4 class="texto">Introduce tu usuario</h4>
					<input type="hidden" name="WS" value="sigIn">
					<input type="text" class="cajaTexto" id="usuario" placeholder="&#128272; usuario" required name="usuario">
					<h4 class="texto">Introduce tu contraseña</h4>
					<input  type="password" class="cajaTexto" required id="clave" placeholder=" &#128272; contraseña" name="password">
					<input type="submit" class="boton" value="Ingresar" >
				</form>
			</div>
		</div>

	</body>
</html>
