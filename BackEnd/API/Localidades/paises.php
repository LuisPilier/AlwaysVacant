<?php


 
/**/

//Header
header("Content-Type: application/json");

//Include
include('../../Controllers/PaisesController.php');

//Switch(Desicion)
switch($_SERVER['REQUEST_METHOD'])
{
    case 'GET':

        $listaPaises = PaisesController::ObtenerPaises();

        if (isset($listaPaises["result"]["error_id"])) 
        {
            // code...
            $responseCode = $listaPaises["result"]["error_id"];
            http_response_code($responseCode);
        }
        else
        {
          http_response_code(200);
        }

        echo json_encode($listaPaises);
        break;
    
    //Solicitud no encontrada  
    default:
        $resultado["mensaje"] = "Enviaste una solicitud incorrecta";
        http_response_code(405);
        echo json_encode($resultado["mensaje"]);
        break;         
}





?>