<?php


//Header
header("Content-Type: application/json");

//Include de la clase Categoria para utilizar los metodos
include('../Controllers/CategoriaController.php');


//Switch(Desicion)
switch($_SERVER['REQUEST_METHOD'])
{

    case 'GET':
        //Recibiendo los datos del JSON
        $datos = json_decode(file_get_contents("php://input"),true);
       
        //Si recibimos el ID de la categoria
        if(isset($datos['ID_Categoria']))
        {
            //Retorna la categoria especificada por el ID
          $listaCategoria = CategoriaController::Obtener($datos);
        }
        else
        {
            //Retorna todas las categorias que se encuentren registradas
          $listaCategoria = CategoriaController::ObtenerTodo($datos);
        }

        if (isset($listaCategoria["result"]["error_id"])) 
        {
            // code...
            $responseCode = $listaCategoria["result"]["error_id"];
            http_response_code($responseCode);
        }
        else
        {
          http_response_code(200);
        }
        
        //Mostrar el contenido
        echo json_encode($listaCategoria);

        break;
    
    case 'POST':
             
            //Recibiendo los datos del JSON
            $postBody = json_decode(file_get_contents("php://input"),true);
            
            //Llamando al metodo guardar que se encuentra en la clase Categoria        
            $datosArray = CategoriaController::Guardar($postBody);

            // Si existe algun error al guardar la categoria
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


    case 'PUT':
         
        //Recibiendo los datos del JSON 
        $postBody = json_decode(file_get_contents("php://input"),true);
                    
        //Llamando al metodo actualizar que se encuentra en la clase Categoria 
        $datosArray = CategoriaController::Actualizar($postBody);

         // Si existe algun error al actualizar la categoria
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
         
         
    case 'DELETE':
        
        //Recibiendo los datos del JSON 
        $postBody = json_decode(file_get_contents("php://input"),true);
                  
         //Llamando al metodo eliminar que se encuentra en la clase Categoria 
        $datosArray = CategoriaController::Eliminar($postBody);

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
        http_response_code(405);
        echo json_encode($resultado["mensaje"]);
        break;

}






?>