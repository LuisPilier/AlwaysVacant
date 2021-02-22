<?php


class ApiTest{


    public static function obtenerconexion()
    { 
        $jsondata = file_get_contents($_SERVER['DOCUMENT_ROOT'].'/AlwaysVacant/BackEnd/Tests/ApiTest/Database/conexion.json');
        return json_decode($jsondata, true);
    
    }

    
}


?>