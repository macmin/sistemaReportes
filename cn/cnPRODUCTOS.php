<?php

include_once("../inc/connection.php");
    set_time_limit(0);
class PRODUCTOS extends Connection
{

	public function __construct()
	{
        
	}
					
	public function insertProduc($ean,$nombre,$desc,$codAlt,$userId)
	{
		

		$this-> setQuery("insert into productos(nombre,descripcion,ean,codigoAlt,userInsert,numero) values ('$nombre','$desc','$ean','$codAlt',$userId,0)");
		$this-> Ejecutar();

	
		return $this -> getIsCorrect();
	}

	public function getProductosT()
	{
 		$this->setQuery("SET NAMES 'utf8'");
        $this -> Ejecutar();
		$this -> setQuery("select nombre,ean,descripcion,codigoAlt,numero from productos");
		$this -> Ejecutar();
		$resultados=[];
		while($row = $this-> getResult() -> fetch_array() )
            $resultados[] = $row;


        return $resultados; 
    }

    public function getConsultaEan($Ean,$cantidad)
    {
    	$this-> setQuery("select productoId,ean,nombre,0 cantidad from productos where ean='$Ean' and numero > 0 ");
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

      public function getConsultaEanE($Ean,$cantidad)
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

    public function insertMovimientoS($prodId,$tipoM,$cantidad,$user)
    {   

    	$this-> setQuery("select numero from productos where productoId= $prodId and numero > 0 ");
    	$this-> Ejecutar();
    	$res=[];
		   
			while($rows = $this-> getResult() -> fetch_array() ){
	         
	            $res[] = $rows['numero'];
	         
	        }

	        if(   $res[0] >= $cantidad  ){

		    	$this -> setQuery("insert into movimientos(productoId,tipoMovimiento,cantidad,userInsert) values($prodId,$tipoM,$cantidad,$user)");
		    	$this -> Ejecutar();
		        
	        	$this -> setQuery("UPDATE productos SET numero=numero-$cantidad WHERE productoId = $prodId and numero >0 ");
		        $this -> Ejecutar();    

    			return true;
    			exit;
	        
	        }else{
	        	
	        	return false;
	        	
	        }
   
   	    

    }
    






}