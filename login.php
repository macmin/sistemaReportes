<!DOCTYPE html>
<html>
	<head>
		<title>Login</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1, maximum-scale=1, minimum-scale=1">
		<link rel="stylesheet" href="css\estilos.css">
	
	</head>
	<body>
		<header>
			<h1>Sistema de Inventario</h1>
		</header>
		

		<form class="contenedor" method="post" action="ws/wsUsuarios.php">
			
			<h2>Iniciar sesión</h2>
			<h4>Introduce tu usuario</h4>
			<input type="hidden" name="WS" value="sigIn">
			<input type="text" class="cajaTexto" id="usuario" placeholder="&#128272; usuario" name="usuario">
			<h4>Introduce tu contraseña</h4>
			<input  type="password" class="cajaTexto" id="clave" placeholder=" &#128272; contraseña" name="password">
			<input type="submit" class="boton" value="Ingresar">
		
		</form>
	

	</body>
</html>
