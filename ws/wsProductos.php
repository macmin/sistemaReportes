<?php

include_once("../cn/cnPRODUCTOS.php");

    set_time_limit(0);
class wsProductos
{
	protected $producto;
    protected $WS;

    public function numero($value)
    {
    	try{
    		return intval($value) > -1 ? true : false;
    	}catch(Exception $e){  return false; }
    }

    function convertir($array0,$padre){
	    $res="";
	    foreach ($array0 as $key0 => $array) {
	    	$res .= "<$padre>";
		    foreach ($array as $key => $value) {
		    		$res .= "<$key>$value</$key>";

		    }
	    	$res .= "</$padre>";
	    }
	    return $res;
	}

    public function __construct()
    { 
        
       header('Content-Type: application/json');
        $this-> producto = new PRODUCTOS();
        $this-> WS = $this -> getPOST("WS");

        switch ($this-> WS) {

             case 'addProducto':

                $ean = $this -> getPOST("ean");
                $nombre = $this-> getPOST("nombre");
                $desc = $this -> getPOST("descripcion");
                $codAlt = $this -> getPOST("codAlt");
                $userId = $this -> getPOST("userId");


                $errors = array();

                if(empty($ean) )
                    $errors[] = "codigo ean requerido";
                if(empty($nombre))
                    $errors[] = "campo nombre requerido";
                if(empty($desc) )
                    $errors[] = "campo descripcion requerido";
                if(empty($codAlt))
                    $errors[]= "campo codigo alterno requerido";
                if(empty($userId))
                    $errors = "fatal error";

                $respuesta=[];

                if(count($errors) == 0 ){

                    $ingresar = $this -> producto -> insertProduc($ean,$nombre,$desc,$codAlt,$userId);
                    
                    if($ingresar){
                                    $respuesta = array("Mensaje" => "Producto registrado",
                                                "codMensaje" => 100,
                                                "Datos" => []
                                                );

                                 echo json_encode($respuesta);
                        
                           


                    } else {
                            $respuesta = array("Mensaje" => "¡Error!, no inserto el producto ",
                                    "codMensaje" => 200,
                                    "Datos" => []
                                    );

                                 echo json_encode($respuesta);
                    } 
                    
                }

                if(isset($errors) and count($errors) > 0 ){

                    
                    $respuesta = array("Mensaje" => "Error",
                                    "codMensaje" => 200,
                                    "Datos" => $errors
                                    );
                        echo json_encode($respuesta);
                }  
                



                
                break;

            case 'getProductos':

                $consulta = $this -> producto -> getProductosT();
				 $respuesta = array("Mensaje" => "Error",
				                                    "codMensaje" => 100,
				                                    "Datos" => $consulta
				                                    );
				                        echo json_encode($respuesta);
                break;

            case 'consultaEan':

                $Ean= $this-> getPOST("ean"); 
                $cantidad = $this->getPOST("cantidad");


                $errors=array();


                if(empty($Ean))
                    $errors[]="No ingresaste el codigo de barras";

                if(count($errors) == 0  ){ 

                    $consulta = $this-> producto -> getConsultaEan($Ean,$cantidad);
                

                    if($consulta) {

                    			if(count($consulta) > 0 ){

	                                $respuesta = array("Mensaje" => "Producto obtenido",
	                                                    "codMensaje" => 100,
	                                                    "Datos" => $consulta
	                                                    
	                                                    );

	                                     echo json_encode($respuesta);
	                               
                                }else{

                                	 $respuesta = array("Mensaje" => "¡Error!, no existe el producto ",
                                        "codMensaje" => 200,
                                        "Datos" => []
                                        );

                                     echo json_encode($respuesta);

                                }

                                

                    }else {

                            $respuesta = array("Mensaje" => "¡Error!, no existe el producto ",
                                        "codMensaje" => 200,
                                        "Datos" => []
                                        );

                                     echo json_encode($respuesta);
                    }

                }

                if(isset($errors) and count($errors) > 0 ){

                    
                    $respuesta = array("Mensaje" => "Error",
                                    "codMensaje" => 200,
                                    "Datos" => $errors
                                    );
                        echo json_encode($respuesta);
                }  


                break;

            case 'addMovimiento':

            	$prodId = $this -> getPOST("productoId");
            	$tipoM= $this-> getPOST("tipoM");
            	$cantidad = $this -> getPOST("cantidad");
            	$user = $this -> getPOST("user");


            	$movimiento = $this -> producto -> insertMovimiento($prodId,$tipoM,$cantidad,$user);

                if($movimiento) {

                    			 
                                $respuesta = array("Mensaje" => "Movimiento de productos correcto ",
                                                    "codMensaje" => 100,
                                                    "Datos" => []
                                                   );

                                     echo json_encode($respuesta);

                               
                                	
                                
                }else {

                            $respuesta = array("Mensaje" => "¡Error!, no se registro la entrada ",
                                        "codMensaje" => 200,
                                        "Datos" => []
                                        );

                                     echo json_encode($respuesta);
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
