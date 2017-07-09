<?php

include_once("../inc/connection.php");

class PRODUCTOS extends Connection
{

	public function __construct()
	{
        
	}
					
	public function insertProduc($ean,$nombre,$desc,$codAlt,$userId)
	{
		$this-> setQuery("insert into productos(nombre,descripcion,ean,codigoAlt,userInsert) values ('$nombre','$desc','$ean','$codAlt',$userId)");
		$this-> Ejecutar();

		return $this -> getIsCorrect();
	}
    






}