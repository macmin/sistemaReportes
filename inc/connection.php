<?php

	class Connection
	{
		private $host = "localhost";
		public function getHost(){return $this-> host;}
		public function setHost($var){$this-> host = $var;}
		private $user = "root";
		public function getUser(){return $this-> user;}
		public function setUser($var){$this-> user = $var;}
		private $pass ="123" ;
		public function getPass(){return $this-> pass;}
		public function setPass($var){$this-> pass = $var;}
	    private $dbName ="reportes";
	    public function getDbname(){return $this-> dbName;}
		public function setDbname($var){$this-> dbName = $var;}

		private $Mensaje;
		public function getMensaje(){return $this-> Mensaje;}
		public function setMensaje($var){$this-> Mensaje;}
		private $CodMensaje;
		public function getCodMensaje(){return $this-> CodMensaje;}
		public function setCodMensaje($var){$this-> CodMensaje;}
 
 		private $query = "";
 		public function getQuery(){return $this-> query;}
 		public function setQuery($var){$this-> query = $var;}

 		private $isCorrect = "";
 		public function getIsCorrect(){return $this-> isCorrect;}
 		public function setIsCorrect($var){$this-> isCorrect = $var;}
 		
 		private $result;
 		public function getResult(){return $this-> result;}
 		public function setResult($var){$this-> result = $var; }

 		private $connection;
 		public function getConnection(){return $this-> connection;}
 		public function setConnection($var){$this-> connection = $var;}

		function __construct()
		{



		}

		public function Ejecutar()
		{
             
         	$this-> setConnection(
         		new mysqli($this-> getHost(),
         					$this->getUser(),
         					$this->getPass(),
         					$this->getDbname())

         		);
         	
         	try{

         	
            	$this-> setCodMensaje(100);
            	$this -> setMensaje("Movimiento Exitoso");
            	$this -> setIsCorrect(true);
            	$this -> setResult(
            		$this-> getConnection() -> query ( $this -> getQuery(),MYSQLI_USE_RESULT)
            			);


            }catch(Exception $error){

            	$this-> setCodMensaje(200);
            	$this -> setMensaje($this-> getConnection() -> error );
            	$this-> setIsCorrect(false);
            	$this->getConnection() -> close();
            	return false;

            }
         	
         	



		}



	}

?>