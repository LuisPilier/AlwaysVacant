<?php



//Header que retorna el JSON
header("Content-Type: application/json");

//Header de Acces Control
header("Access-Control-Allow-Origin: *");


//Include
include($_SERVER['DOCUMENT_ROOT'].'/AlwaysVacant/BackEnd/Controllers/RolController.php');


switch($_SERVER['REQUEST_METHOD'])
{

    case 'GET':
      
        $lista_rol = RolController::ObtenerRoles();
        echo json_encode($lista_rol);
        break;

    //Solicitud no encontrada  
    default:
        $resultado["mensaje"] = "Enviaste una solicitud incorrecta";
        http_response_code(405);
        echo json_encode($resultado["mensaje"]);
        break;
}


?>