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
$response = $client->request('Get','AlwaysVacant/BackEnd/API/vacante.php?ID_Categoria=3'



);

#echo
$body = $response->getBody();
$arr_boy = json_decode($body);
echo json_encode($arr_boy);

?>