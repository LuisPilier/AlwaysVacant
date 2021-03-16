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
$response = $client->request('DELETE','AlwaysVacant/BackEnd/API/Usuarios/usuario.php',
[
    'json' =>[
              #TOKEN
              "Token"=>"0e4d6ae1aa4fdc2fbfad146d2375c76d",
               #Usuario en especifico
               "ID_Usuario" => 1019
           ]
]
);

#echo
$body = $response->getBody();
$arr_boy = json_decode($body);
echo json_encode($arr_boy);

?>