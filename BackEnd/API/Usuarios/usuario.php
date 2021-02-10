<?php

//Header
//header("Content-Type: application/json");

//Include

ini_set('display_errors',1); 
 error_reporting(E_ALL);


include('../../Class/Usuarios/Usuario.php');

$_usuario = new Usuario();


//Switch(Desicion)

switch($_SERVER['REQUEST_METHOD']){


    case 'GET':
        
        $array = json_decode(file_get_contents("php://input"),true);

        if(isset($array['ID_Usuario']))
        {
          $listaUsuario = $_usuario->Obtener($conn,$array);
        }
        else
        {
            $listaUsuario = $_usuario->ObtenerTodo($conn,$array);
        }
        
    
        echo json_encode($listaUsuario);
      
        break;

    case 'POST':

        $postBody = file_get_contents("php://input");
                    
        $datosArray = $_usuario->Guardar($conn,$postBody);

        if (isset($datosArray["result"]["error_id"])) {
            // code...
            $responseCode = $datosArray["result"]["error_id"];
            http_response_code($responseCode);
        } else {
            // code...
            http_response_code(200);
        }

        echo json_encode($datosArray);




        break;
    
 
         
    case 'DELETE':

        $postBody = file_get_contents("php://input");
                    
        $datosArray = $_usuario->Eliminar($conn,$postBody);

        if (isset($datosArray["result"]["error_id"])) {
            // code...
            $responseCode = $datosArray["result"]["error_id"];
            http_response_code($responseCode);
        } else {
            // code...
            http_response_code(200);
        }

        echo json_encode($datosArray);
       break;
    
    //Solicitud no encontrada  
    default:
        $resultado["mensaje"] = "Enviaste una solicitud incorrecta";
        echo json_encode($resultado["mensaje"]);
        break;
          


}

?>