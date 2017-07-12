<!DOCTYPE html>
<html>
	<head>
		<title>Cargar Archivo</title>
		<link rel="stylesheet" href="css/estilos.css">
		<script type="text/javascript" src="js/jquery-3.2.1.js"></script>
		<script src="js/link.js"></script>
		<script src="js/Loading.js"></script>
	</head>
	<body>
		<header>
			<h1 class="encabezado">Cargar Archivo</h1>
		</header>
		<center>
			<form class="cont-cargarArchivo" action="modulo.php" enctype="multipart/form-data" method="post" onsubmit="return validar();">
   				<input id="archivo" accept=".csv" name="archivo" type="file"> 
   				<span class="bt-cargarArchivo">Seleccionar Archivo</span>
   				<br>
   				<input name="MAX_FILE_SIZE" type="hidden"  value="20000"> 
   				<br>
   				<br>
   				<br>
   				<br>
   				<input class="botones-cargarArchivo" name="enviar" type="submit" value="Importar">
   				<br>
			</form>
				<br>
   				<br>
			<button id="regresar" class="bt-regresar" onclick="menuadministrador()">Regresar</button> 
		</center>

		<script>
		$(".bt-cargarArchivo").bind("click",function(){
				$("#archivo").click();
		});
			function validar(){
				var contenedor = document.getElementById("archivo").value;
				if(contenedor==""){
					alert("Tienes que seleccionar primero un archivo")
					return false;
				}

				if(contenedor!=""){
					var mensaje = confirm("El archivo: "+contenedor+" ¿ Es correcto  ?");
					if (mensaje) {
						$.Loading(true,"Cargando datos");
						return true;
					}
					else {
					 return false;
					}
				}

			}
		</script>
	</body>
</html>


