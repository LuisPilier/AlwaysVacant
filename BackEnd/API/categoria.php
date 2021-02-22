<?php


//Header que retorna el JSON
header("Content-Type: application/json");

//Header de Acces Control
header("Access-Control-Allow-Origin: *");


//Include de la clase Categoria para utilizar los metodos
include('../Class/Categoria.php');

//Instancia
$_categoria= new categoria();

//Switch(Desicion)
switch($_SERVER['REQUEST_METHOD']){


    case 'GET':
        //Recibiendo los datos del JSON
        $array = json_decode(file_get_contents("php://input"),true);
       
        //Si recibimos el ID de la categoria
        if(isset($array['ID_Categoria']))
        {
            //Retorna la categoria especificada por el ID
          $listaCategoria = $_categoria->Obtener($conn,$array);
        }
        else
        {
            //Retorna todas las categorias que se encuentren registradas
          $listaCategoria = $_categoria->ObtenerTodo($conn,$array);
        }
        
        //Mostrar el contenido
        echo json_encode($listaCategoria);

        break;
    
    case 'POST':
             
            //Recibiendo los datos del JSON
            $postBody = file_get_contents("php://input");
            
            //Llamando al metodo guardar que se encuentra en la clase Categoria        
            $datosArray = $_categoria->Guardar($conn,$postBody);

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
        $postBody = file_get_contents("php://input");
                    
        //Llamando al metodo actualizar que se encuentra en la clase Categoria 
        $datosArray = $_categoria->Actualizar($conn,$postBody);

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
        $postBody = file_get_contents("php://input");
                  
         //Llamando al metodo eliminar que se encuentra en la clase Categoria 
        $datosArray = $_categoria->Eliminar($conn,$postBody);

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