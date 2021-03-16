<?php


//Header que retorna el JSON
header("Content-Type: application/json");

//Header de Acces Control
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Credentials: true");
header("Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIOS");
header('Access-Control-Max-Age: 1000');
header('Access-Control-Allow-Headers: Origin, Content-type, X-Auth-Token, Authorization');

//Include
include('../Controllers/Auth.php');


//Switch(Desicion)

switch($_SERVER['REQUEST_METHOD'])
{
    case 'POST':

        $postBody   = json_decode(file_get_contents("php://input"),true);

        $datosArray = Auth::login($postBody);
      
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
        http_response_code(405);
        echo json_encode($resultado["mensaje"]);
        break;
          


}

?>