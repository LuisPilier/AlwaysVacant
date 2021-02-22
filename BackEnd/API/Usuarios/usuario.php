<?php


//Header que retorna el JSON
header("Content-Type: application/json");

//Header de Acces Control
header("Access-Control-Allow-Origin: *");

//Include
include('../../Class/Usuarios/Usuario.php');

//Instancia
$_usuario = new Usuario();


//Switch(Desicion)
switch($_SERVER['REQUEST_METHOD']){


    case 'GET':

        //Recibiendo los datos del JSON
        $array = json_decode(file_get_contents("php://input"),true);

         //Si recibimos el ID del usuario
        if(isset($array['ID_Usuario']))
        {
             //Retorna el usuario especificada por el ID
          $listaUsuario = $_usuario->Obtener($conn,$array);
        }
        else
        {
            //Retorna todas los usuarios que se encuentren registrados
            $listaUsuario = $_usuario->ObtenerTodo($conn,$array);
        }
        
        //Mostrar el contenido
         echo json_encode($listaUsuario);
      
        break;

    case 'POST':

        //Recibiendo los datos del JSON
        $postBody = file_get_contents("php://input");
                   
         //Llamando al metodo guardar que se encuentra en la clase Usuario   
        $datosArray = $_usuario->Guardar($conn,$postBody);

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
        $postBody = file_get_contents("php://input");
                    
         //Llamando al metodo eliminar que se encuentra en la clase Usuario 
        $datosArray = $_usuario->Eliminar($conn,$postBody);

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
        $resultado["mensaje"] = "Enviaste una solicitud incorrecta";
        echo json_encode($resultado["mensaje"]);
        break;
          


}

?>