<!DOCTYPE html>
<html>
	<head>
		<title>Cargar Archivo</title>
		<link rel="stylesheet" href="css/estilos.css">
		<script type="text/javascript" src="js/jquery-3.2.1.js"></script>
		<script src="js/link.js"></script>
		<script src="js/Loading.js"></script>
		<link rel="stylesheet" href="css/font-awesome.min.css">
		<link rel="stylesheet" href="css/flexboxgrid.min.css">
	</head>
	<body>
		    <header class="header">
            <div class="row around-xs center-xs">
                <div class="col-xs-4">
                    <h1 class="header__title">Cargar Archivo</h1>
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


