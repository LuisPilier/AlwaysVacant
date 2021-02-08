<?php


//Header
header("Content-Type: application/json");

//Include
include('../Class/Categoria.php');


$_categoria= new categoria();

//Switch(Desicion)

switch($_SERVER['REQUEST_METHOD']){


    case 'GET':
      
        $array = json_decode(file_get_contents("php://input"),true);

        if(isset($array['ID_Categoria']))
        {
          $listaCategoria = $_categoria->Obtener($conn,$array);
        }
        else
        {
          $listaCategoria = $_categoria->ObtenerTodo($conn,$array);
        }
        
    
        echo json_encode($listaCategoria);

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
           
        $postBody = file_get_contents("php://input");
                    
        $datosArray = $_categoria->Actualizar($conn,$postBody);

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
         
         
    case 'DELETE':
        
        $postBody = file_get_contents("php://input");
                    
        $datosArray = $_categoria->Eliminar($conn,$postBody);

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
        echo json_encode($resultado["mensaje"]);
        break;
          


}






?>