<!DOCTYPE html>
<html>
	<head>
		<title>Usuarios</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1, maximum-scale=1, minimum-scale=1">
		<link rel="stylesheet" href="css/estilos.css">
		<link rel="stylesheet" href="css/font-awesome.min.css">
	</head>
	<body>
		<header>
			<h1>Usuarios</h1>
		</header>
			<form class="contenedor">
				<center>
					<i class="fa fa-user-circle fa-5x centrar" aria-hidden="true"></i>
					<input type="text" class="cajaTexto" placeholder="Nombre">
					<input type="text" class="cajaTexto" placeholder="Usuario">
					<input type="password" class="cajaTexto" placeholder="Contraseña">
					<br>
					<select class="selectRol">
						<option disabled selected>Rol del Usuario</option>
						<option value="" >Administrador</option>
						<option value="" >Usuario</option>
					</select>
					<br>
					<br>
					<button class="boton">Registrar</button>
				</center>
			</form>
	</body>
</html>