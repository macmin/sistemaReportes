<?php
set_time_limit(400);
$conexion=new mysqli("localhost","root","","reportes");
//obtenemos el archivo .csv
$tipo = $_FILES['archivo']['type'];
 
$tamanio = $_FILES['archivo']['size'];
 
$archivotmp = $_FILES['archivo']['tmp_name'];
 
//cargamos el archivo
$lineas = file($archivotmp);
 
//inicializamos variable a 0, esto nos ayudará a indicarle que no lea la primera línea
$i=0;
 
//Recorremos el bucle para leer línea por línea
foreach ($lineas as $linea_num => $linea)
{ 
   //abrimos bucle
   /*si es diferente a 0 significa que no se encuentra en la primera línea 
   (con los títulos de las columnas) y por lo tanto puede leerla*/
   if($i != 0) 
   { 
       //abrimos condición, solo entrará en la condición a partir de la segunda pasada del bucle.
       /* La funcion explode nos ayuda a delimitar los campos, por lo tanto irá 
       leyendo hasta que encuentre un ; */
       $datos = explode(",",$linea);
 
       //Almacenamos los datos que vamos leyendo en una variable
       $codigo = trim($datos[0]);
       $codAlterno = trim($datos[1]);
       $nombre = trim($datos[2]);
        
       //guardamos en base de datos la línea leida
      $prueba= $conexion->query("INSERT INTO productos(nombre,descripcion,ean,codigoAlt,userInsert,cantidad) VALUES('$nombre','$nombre','$codigo','$codAlterno',1,0)");
 
       //cerramos condición
   }
 
   /*Cuando pase la primera pasada se incrementará nuestro valor y a la siguiente pasada ya 
   entraremos en la condición, de esta manera conseguimos que no lea la primera línea.*/
   $i++;
   //cerramos bucle
}
?>

<!DOCTYPE html>
<html>
  <head>
    <title>Datos Guardados</title>
    <link rel="stylesheet" href="css/estilos.css">
    <script src="js/link.js"></script>
  </head>
  <body>
    <header>
       <h1 class="encabezado">Datos Guardados</h1>
    </header>
      <div class="marca-de-agua">
        <img src="css/fondo.jpg">
    </div>
    <br>
    <br>
    <br>
    <center>   
      <h2>Los Datos ya Estan Guardados</h2>
      <br>
      <br>
      <br>
      <br>
      <button id="regresar" class="bt-regresar" onclick="menuadministrador()">Regresar</button> 
    </center>
  </body>
  </html>