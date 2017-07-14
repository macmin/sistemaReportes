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
		<link rel="stylesheet" href="css/flexboxgrid.min.css">
	</head>
	<body>
		<header class="header">
			<div class="row around-xs center-xs">
                <div class="col-xs-4">
                    <h1 class="header__title">Opciones Usuario</h1>
                </div>
                <div class="col-xs-4">
                    <nav class="header__nav">
                        <ul class="header__tabs">
                            <li class="header__tab">
                                <a class="header__link" href="opcionUsuario.php">Usuarios</a>
                            </li>
                            <li class="header__tab">
                                <a class="header__link" href="productos.php">Productos</a>
                            </li>
                            <li class="header__tab">
                                <a class="header__link" href="cargarArchivo.php">Archivo</a>
                            </li>
                        </ul>
                    </nav>
                </div>
                <div class="col-xs-4">
                    <i class="fa fa-user-circle fa-3x icono" style="color:white;" aria-hidden="true" onclick="document.getElementById('ventana1').style.visibility='visible'"></i>
                </div>     
            </div>
            <div class="ventana" id="ventana1">
                <span class="cerrar" onclick="document.getElementById('ventana1').style.visibility='hidden'">x
                </span>
                <center>
                    <br>
                    <form>
                        <a href="cerrar_session.php" class="linkFormato text-black">Salir</a>
                    </form>
                </center>
            </div>
        </header> 
        <!--termina la navegacion-->
		    <div class="marca-de-agua">
                <img src="css/fondo.jpg">
            </div>
		<center>
			<form class="contenedorOpciones">
					<button class="boton" type="button" onclick="javascript:usuarios();">Adicionar Usuario</button>
					<br>
					<br>
					<br>
					<br>
					<br>
					<button class="boton" type="button" onclick="javascript:modificarusuarios();">Modificar Usuario</button>
			</form>

     </center>

	<?php 
		}else{
			echo "No hay sesion";
		}

	?>

	</body>
</html>