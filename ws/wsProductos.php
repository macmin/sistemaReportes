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

           case 'addProducto':

                $ean = $this-> getPOST("ean");
                $nombre = $this-> getPOST("nombre");
                $desc = $this -> getPOST("descipcion");
                $codAlt = $this -> getPOST("codAlt");

                $errors = array();

                if(empty($ean) )
                    $errors[] = "codigo ean requerido";
                if(empty($nombre))
                    $errors[] = "campo nombre requerido";
                if(empty($desc) )
                    $errors[] = "campo descripcion requerido";
                if(empty($codAlt))
                    $errors[]= "campo codigo alterno requerido";
                if(count($errors) == 0){

                    $ingresar = $this -> producto -> insertProduc($ean,$nombre,$desc,$codAlt);

                    $respuesta[];

                    if($ingresar){

                         $respuesta = array("Mensaje" => "Producto Ingresado",
                                                "codMensaje" => 100,
                                                "Datos" => []
                                                );

                        echo json_encode($respuesta);

                    }else{

                         $respuesta = array("Mensaje" => "Producto No ingresado",
                                                "codMensaje" => 200,
                                                "Datos" => []
                                                );

                        echo json_encode($respuesta);



                    }
                }

 
                
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
