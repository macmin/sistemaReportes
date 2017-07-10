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
		<link rel="stylesheet" href="css/flexboxgrid.min.css">

		<script src="js/link.js"></script>

	</head>
	<body>
	<header>
		<h1>Adicionar Producto</h1>
	</header>

	<input type="hidden" id="hiddenId" value="<?php echo $_SESSION['userId'];?>">

	<div class="contenedorProductos">
		<div class="row around-xs center-xs">
    		<div class="col-xs-6">
				<h2>EAN:</h2>
				<input type="text" class="cajaTexto" id="txtEan" required>
			</div>
			<div class="col-xs-6">
				<h2>Codigo Alterno:</h2>
				<input type="text" class="cajaTexto" id="txtcodAlt">
			</div>
		</div>

		<div class="row around-xs center-xs">
    		<div class="col-xs-6">
				<h2>Nombre:</h2> 
				<input type="text" class="cajaTexto" id="txtNombre" >
			</div>
			<div class="col-xs-6">
				<h2>Descripcion:</h2>
				<input type="text" class="cajaTexto" id="txtDesc" >
			</div>
		</div>
		<br>
		<br>
		<div class="row around-xs center-xs">
    		<div class="col-xs-6">
				<button class="boton" type="button" onclick="javascript:productos();">Regresar</button>
			</div>
			<div class="col-xs-6">
				<button class="boton" id="btnRegistrar">Registrar</button>	
			</div>
		<div>

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
						else if(Respuesta.codMensaje==200)
							alert(Respuesta.Datos);


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