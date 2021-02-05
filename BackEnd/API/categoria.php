<?php


//Header
header("Content-Type: application/json");

//Include
include('../Class/Categoria.php');

$_categoria= new categoria();
//Switch(Desicion)

switch($_SERVER['REQUEST_METHOD']){


    case 'GET':
      

        break;
    
    case 'POST':
        
            $postBody = file_get_contents("php://input");
                    
            $datosArray = $_categoria->Guardar($conn,$postBody);

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


    case 'PUT':

      break;   
         
         
    case 'DELETE':

       break;


    //Solicitud no encontrada  
    default:
        $resultado["mensaje"] = "Enviaste una solicitud incorrecta";
        echo json_encode($resultado["mensaje"]);
        break;
          


}






?>