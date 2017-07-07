<!DOCTYPE html>
<html>
	<head>
		<title>Adicionar Productos</title>
		<link rel="stylesheet" type="text/css" href="css/estilos.css">
		<script type="text/javascript" src="js/jquery-3.2.1.js"></script>
	</head>
	<body>
	<header>
		<h1>Adicionar Producto</h1>
	</header>
	<form class="contenedor">
		<h2>EAN:</h2>
		<input type="text" class="cajaTexto" id="txtEan">
		<h2>Nombre:</h2> 
		<input type="text" class="cajaTexto" name="txtNombre" >
		<h2>Descripcion:</h2>
		<input type="text" class="cajaTexto" name="txtDesc" >
		<h2>Codigo Alterno:</h2>
		<input type="text" class="cajaTexto" id="txtcodAlt">	
		<button class="boton" id="btnRegistrar">Registrar</button>	
	</form>


	<script >
		
		$(function(){

			$("#btnRegistrar").click(function(){
				
				
				var cajaEan = $("#txtEan").val();
				var cajaNombre = $("#txtNombre").val();
				var cajaDescripcion = $("#txtDesc").val();
				var cajaCodAlt = $("#txtcodAlt").val();

				
				$.post('/ws/wsProductos.PHP',
					{
						WS:"addProducto",
						ean: cajaEan,
						nombre:cajaNombre,
						descripcion: cajaDescripcion,
						codAlt:cajaCodAlt
						


					},function(Respuesta){

						alert(Respuesta.Mensaje);
						if(Respuesta.codMensaje == 100)
							window.location =window.location;

					},"json");

			});

		});

	</script>

	</body>
</html>