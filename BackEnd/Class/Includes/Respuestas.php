<?php


class respuestas{

    
    public  static $response = [
        'status' => "ok",
        "result" => array()
    ];


    public static function error_405(){
        self::$response['status'] = "error";
        self::$response['result'] = array(
            "error_id" => "405",
            "error_msg" => "Metodo no permitido"
        );
        return self::$response;
    }

    public static function error_200($valor = "Datos incorrectos"){
        self::$response['status'] = "error";
        self::$response['result'] = array(
            "error_id" => "200",
            "error_msg" => $valor
        );
        return self::$response;
    }


    public static function error_400(){
        self::$response['status'] = "error";
        self::$response['result'] = array(
            "error_id" => "400",
            "error_msg" => "Datos enviados incompletos o con formato incorrecto"
        );
        return self::$response;
    }


    public static function error_500($valor = "Error interno del servidor"){
        self::$response['status'] = "error";
        self::$response['result'] = array(
            "error_id" => "500",
            "error_msg" => $valor
        );
        return self::$response;
    }


    public static function error_401($valor = "No autorizado"){
        self::$response['status'] = "error";
        self::$response['result'] = array(
            "error_id" => "401",
            "error_msg" => $valor
        );
        return self::$response;
    }

}

?>