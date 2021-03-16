<?php

#include
include('../ApiTest.php');

#Require de la del composer 
require "../../../vendor/autoload.php";

use GuzzleHttp\Client;

#instancia
$apitest = new ApiTest();

//lamando al metodo
$server = $apitest->obtenerconexion();


//Creando un nuevo cliente
$client = new Client(['base_uri' => $server['conexion']['url']]);


//Request + api deseada
$response = $client->request('PUT','AlwaysVacant/BackEnd/API/vacante.php',

[
      'json' =>  
       [
            
            "Token" =>"e34748f5f7cb104a37704a535397a95a",
            "ID_Vacante" => "240",
            "Compania" => "samuel",
            "URL" => "Google.com",
            "Posicion"=> "Mobile Developer",
            "Descripcion" => "Desarrollador Android",
            "ID_Categoria" => "2",
            "ID_Tipo_Vacante" => "1",
            "ID_Ciudad" => "2", 
            "Ubicacion" => "2",
            "Email"=>"davidinojosa5@gmail.com"
            
    
      ]
     
]



);

#echo
$body = $response->getBody();
$arr_boy = json_decode($body);
echo json_encode($arr_boy);

?>