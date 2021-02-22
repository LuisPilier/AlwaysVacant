<?php


ini_set('display_errors',1); 
error_reporting(E_ALL);

//Header
header("Content-Type: application/json");

//Include
include($_SERVER['DOCUMENT_ROOT'].'/AlwaysVacant/BackEnd/Controllers/UsuarioController.php');

//Switch(Desicion)
switch($_SERVER['REQUEST_METHOD']){

    case 'GET':

        //Recibiendo los datos del JSON
        $datos = json_decode(file_get_contents("php://input"),true);

         //Si recibimos el ID del usuario
        if(isset($datos['ID_Usuario']))
        {
             //Retorna el usuario especificada por el ID
             $listaUsuario = UsuarioController::Obtener($datos);
        }
        else
        {
            //Retorna todas los usuarios que se encuentren registrados
            $listaUsuario = UsuarioController::ObtenerTodo($datos);
        }

        //Si Hay errores al retornar las vacantes
        if (isset($listaUsuario["result"]["error_id"])) 
        {
            // code...
            $responseCode = $listaUsuario["result"]["error_id"];
            http_response_code($responseCode);
        }
        else
        {
          http_response_code(200);
        }
        
        //Mostrar el contenido
         echo json_encode($listaUsuario);
      
        break;

    case 'POST':

        //Recibiendo los datos del JSON
        $postBody = json_decode(file_get_contents("php://input"),true);
                   
         //Llamando al metodo guardar que se encuentra en la clase Usuario   
        $datosArray = UsuarioController::Guardar($postBody);

        // Si existe algun error al guardar el usurio
        if (isset($datosArray["result"]["error_id"])) {
            // code...
            $responseCode = $datosArray["result"]["error_id"];
            http_response_code($responseCode);
        } else {
            // code...
            http_response_code(200);
        }

        //Mostrar el contenido
        echo json_encode($datosArray);

        break;
    
 
         
    case 'DELETE':

        //Recibiendo los datos del JSON 
        $postBody = json_decode(file_get_contents("php://input"),true);
                    
         //Llamando al metodo eliminar que se encuentra en la clase Usuario 
        $datosArray = UsuarioController::Eliminar($postBody);

         // Si existe algun error al eliminar la categoria
        if (isset($datosArray["result"]["error_id"])) {
            // code...
            $responseCode = $datosArray["result"]["error_id"];
            http_response_code($responseCode);
        } else {
            // code...
            http_response_code(200);
        }

         //Retornar el contenido
        echo json_encode($datosArray);
       break;
    
    //Solicitud no encontrada  
    default:
        http_response_code(405);
        $resultado["mensaje"] = "Enviaste una solicitud incorrecta";
        echo json_encode($resultado["mensaje"]);
        break;
          


}

?>