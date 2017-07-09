<?php

	session_start();
    
    if( isset( $_SESSION['name'] ) and isset( $_SESSION['userId'] ) ) {

?>
<!DOCTYPE html>
<html>
	<head>
		<title>Adicionar Producto</title>
		<link rel="stylesheet" type="text/css" href="css/estilos.css">
		<script type="text/javascript" src="js/jquery-3.2.1.js"></script>

		<script src="js/link.js"></script>

	</head>
	<body>
	<header>
		<h1>Adicionar Producto</h1>
	</header>

	<input type="hidden" id="hiddenId" value="<?php echo $_SESSION['userId'];?>">

	<div class="contenedor">
		<h2>EAN:</h2>
		<input type="text" class="cajaTexto" id="txtEan">
		<h2>Nombre:</h2> 
		<input type="text" class="cajaTexto" id="txtNombre" >
		<h2>Descripcion:</h2>
		<input type="text" class="cajaTexto" id="txtDesc" >
		<h2>Codigo Alterno:</h2>
		<input type="text" class="cajaTexto" id="txtcodAlt">	

		<button class="boton" id="btnRegistrar">Registrar</button>
		<br>
		<br>
		<button class="boton" type="button" onclick="javascript:productos();">Regresar</button>

	</div>


	<script >
		
		$(function(){

			$("#btnRegistrar").click(function(){
				
				
				var cajaEan = $("#txtEan").val();
				var cajaNombre = $("#txtNombre").val();
				var cajaDescripcion = $("#txtDesc").val();
				var cajaCodAlt = $("#txtcodAlt").val();
				var cajaUserId = $("#hiddenId").val();

				
				$.post('ws/wsProductos.php',
					{
						WS:"addProducto",
						ean: cajaEan,
						nombre:cajaNombre,
						descripcion: cajaDescripcion,
						codAlt:cajaCodAlt,
						userId:cajaUserId
						


					},function(Respuesta){

						alert(Respuesta.Mensaje);
						if(Respuesta.codMensaje == 100)
							window.location =window.location;

					},"json");

			});

		});

	</script>

	</body>

<?php
	
	}else{
		echo "no hay sesion";

	}

?>
</html>