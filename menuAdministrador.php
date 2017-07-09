<?php
	
	session_start();

   	if( isset( $_SESSION['name'] ) ){
	
	

	

?>
<!DOCTYPE html>
<html>
	<head>
		<title>Administrador</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1, maximum-scale=1, minimum-scale=1">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flexboxgrid/6.3.1/flexboxgrid.min.css">
		<link rel="stylesheet" href="css/estilos.css">
		<link rel="stylesheet" href="css/font-awesome.min.css">
		<link rel="stylesheet" href="css/flexboxgrid.min.css">
		<script src="js/link.js"></script>
	</head>
	<body>
		<header>
		<div class="row around-xs center-xs">
    		<div class="col-xs-4">
				<h1>Nombre: <?php echo $_SESSION['name'] ?> </h1>
			</div>
			<div class="col-xs-4">		
				<i class="fa fa-user-circle fa-3x icono" aria-hidden="true" onclick="document.getElementById('ventana1').style.visibility='visible'"></i>
			</div>
		</div>
		
		<div class="ventana" id="ventana1">
    		<span class="cerrar" onclick="document.getElementById('ventana1').style.visibility='hidden'">x
    		</span>
    		<center>
	        	<br>
	        	<form>
	            <a href="login.php" class="linkFormato text-black">Salir</a>
	       		</form>
    		</center>
		</header>

			<form class="contenedorAdmin">
				<div class="row around-xs center-xs">
    				<div class="col-xs-6">
						<button class="botonMenu" type="button" onclick="javascript:productos();">Productos</button>
					</div>
					<div class="col-xs-6 center-xs">
						<button class="botonMenu" type="button" onclick="javascript:reportes();">Reportes</button>
					</div>
				</div>
				<br>
				<br>
				<br>
				<div class="row around-xs center-xs">
    				<div class="col-xs-6">
						<button class="botonMenu" type="button" onclick="javascript:configuracion();">Configuracion</button>
					</div>
					<div class="col-xs-6 center-xs">
						<button class="botonMenu" type="button" onclick="javascript:opcionesusuarios();">Usuario</button>
					</div>
				</div>
				<br>
				<br>
				<br>
				<div class="row center-xs">
    				<div class="col-xs-6">
							<button class="botonMenu" type="button" onclick="javascript:registrar();">Registrar Productos</button>
					</div>
				</div>
			</form>
	</body>

<?php
}else{
		echo "no hay session";

	}

?>
</html>