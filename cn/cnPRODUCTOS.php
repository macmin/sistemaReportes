<?php

include_once("../inc/connection.php");

class PRODUCTOS extends Connection
{

	public function __construct()
	{
        
	}

	public function insertProduc($ean,$nombre,$desc,$codAlt)
	{
		$this-> setQuery("insert into productos ... ");
		$this-> Ejecutar();

		$this->getIsCorrect();
	}
    






}