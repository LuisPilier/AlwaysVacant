<?php

#include
include('../ApiTest.php');

#Require de la del composer 
require "../../../vendor/autoload.php";

//Use de libreria 
use GuzzleHttp\Client;

#instancia
$apitest = new ApiTest();

//lamando al metodo
$server = $apitest->obtenerconexion();


//Creando un nuevo cliente
$client = new Client(['base_uri' => $server['conexion']['url']]);


//Request + api deseada
$response = $client->request('POST','AlwaysVacant/BackEnd/API/Usuarios/usuario.php',
[
    #Parametros
    
    'json' =>[
           
        "Token"=>"e4af7a1c83c4a6788476cced2b8a61fe",
        "Nombre" => "Rafael",
        "Apellido"=> "Polanco",
        "Usuario"=> "Rafael2002",
        "Contrasena"=> "Rpolacano1989",
        "ID_Rol"=> "1",
        "Correo"=> "polanco@gmail.com"
    ]

]

);

#echo
$body = $response->getBody();
$arr_boy = json_decode($body);
echo json_encode($arr_boy);

?>