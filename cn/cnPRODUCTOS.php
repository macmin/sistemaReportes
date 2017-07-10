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

		$this ->setQuery("select MAX(productoId) as prodId from productos ");
		$this ->Ejecutar();

		while($row = $this -> getResult() -> fetch_array() )
			$res = $row['prodId'];
		

		$this -> setQuery("insert into movimientos(productoId,tipoMovimiento,cantidad,userInsert) values ($res,1,1,$userId)");
		$this -> Ejecutar();


		return $this -> getIsCorrect();
	}

	public function getProductosT()
	{

		$this -> setQuery("select p.nombre,p.descripcion,p.ean,p.codigoAlt,m.cantidad from productos p join movimientos m on p.productoId=m.productoId");
		$this -> Ejecutar();
		$resultados=[];
		while($row = $this-> getResult() -> fetch_array() )
         
            $resultados[] = $row;

        return $resultados; 
 

	}
    






}