<?php

include_once("../cn/cnPRODUCTOS.php");

class wsProductos
{
	protected $producto;
	protected $WS;

	public function __construct()
	{ 
		
        header('Content-Type: application/json');
		$this-> producto = new PRODUCTOS();
        $this-> WS = $this->getPOST("WS");
        
        switch ($this-> WS) {

           case 'help':

                
                break;
           
           
        	case 'N0':

        		$res= array ("Mensaje" => "El webservice no puede estar vacio", "codMensaje" => 200);
        		echo json_encode($res);

        		break;
        	
        	default:

        		$res= array ("Mensaje" => "El webservice no existe", "codMensaje" => 200 );
        		echo json_encode($res);
        		break;
        }


	}

	public function getPOST($var)
	{
    	if(isset($_POST[$var]) )
       		return $_POST[$var];
    	else
    		return "N0";
    }

   



}

new wsProductos();

?>
