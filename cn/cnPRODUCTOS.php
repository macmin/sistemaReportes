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

		/*$this ->setQuery("select MAX(productoId) as prodId from productos ");
		$this ->Ejecutar();

		while($row = $this -> getResult() -> fetch_array() )
			$res = $row['prodId'];
		

		$this -> setQuery("insert into movimientos(productoId,tipoMovimiento,cantidad,userInsert) values ($res,1,1,$userId)");
		$this -> Ejecutar();

        */
		return $this -> getIsCorrect();
	}

	public function getProductosT()
	{

		$this -> setQuery("select p.nombre, p.descripcion,p.ean,p.codigoAlt,p.numero from productos p");
		$this -> Ejecutar();
		$resultados=[];
		while($row = $this-> getResult() -> fetch_array() )
         
            $resultados[] = $row;

        return $resultados; 
    }

    public function getConsultaEan($Ean,$cantidad)
    {
    	$this-> setQuery("select productoId,ean,nombre,0 cantidad from productos where ean='$Ean' ");
    	$this-> Ejecutar();
    	$resultados=[];
		 

           
			while($row = $this-> getResult() -> fetch_array() ){
	         
	            $resultados[] = $row;
	         
	        }
            
            if(count($resultados) >0){
	        	$resultados[0]["cantidad"]= $cantidad;
	        }


	        return $resultados; 
      

    }
    public function insertMovimiento($prodId,$tipoM,$cantidad,$user)
    {
    	$this -> setQuery("insert into movimientos(productoId,tipoMovimiento,cantidad,userInsert) values($prodId,$tipoM,$cantidad,$user)");
    	$this -> Ejecutar();
        if($tipoM==3){
    	
	        $this -> setQuery("UPDATE productos SET numero=numero+$cantidad WHERE productoId = $prodId ");
	        $this -> Ejecutar();
        }elseif ($tipoM == 4) {
        	$this -> setQuery("UPDATE productos SET numero=numero-$cantidad WHERE productoId = $prodId ");
	        $this -> Ejecutar();
        }

    	return true;

    }
    






}