<?php


//Header
header("Content-Type: application/json");

//Include
include('../Class/Auth.php');


//Switch(Desicion)

switch($_SERVER['REQUEST_METHOD'])
{
    case 'POST':

        $_auth = new Auth();

        $postBody   = file_get_contents("php://input");
        $datosArray = $_auth->login($conn,$postBody);
      
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