<?php


ini_set('display_errors',1); 
error_reporting(E_ALL);


//Header
header("Content-Type: application/json");

//Include
include('../../Class/Localidades/Paises.php');

$pais = new Paises();

//Switch(Desicion)
switch($_SERVER['REQUEST_METHOD'])
{
    case 'GET':

        $datos = json_decode(file_get_contents("php://input"),true);
        $listaPaises = $pais->ObtenerPaises($conn,$datos);

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