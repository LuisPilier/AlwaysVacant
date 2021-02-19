<?php

include($_SERVER['DOCUMENT_ROOT'].'/AlwaysVacant/BackEnd/Models/Vacante.php');
include('TokenController.php');


class VacanteController
{

    public static function guardar($json)
    {
        $vacante = new vacante(); 
        $datos = json_decode($json,true);
        $token = TokenController::validarToken($datos);

        if(is_bool($token))
           {
                //Campos Obligatorios
                if(!isset($datos['Compania']) || !isset($datos['ID_Tipo_Vacante']) || !isset($datos['Posicion']) || !isset($datos['ID_Ciudad']) || !isset($datos['Ubicacion']) || !isset($datos['ID_Categoria']))
                {
                    //Datos enviados incompletos o con formato incorrecto
                    return respuestas::error_400();
                }
                else
                {
                     //Query para insertar la vacante
                     $resp = $vacante->guardar($datos);

                     //Si se insertaron registros exitosamente
                     if($resp)
                     {
                         $respuesta = respuestas::$response;
                         $respuesta['result'] = array(
                             "ID_Vacante" => $resp
                         );
                         return $respuesta;
                     }
                     else
                     {
                         //return respuestas::error_500();
                         return $resp;
                     }
                }
                
           }    
           else
           {
               //Retornar Error en caso de que el Token no fue enviado o No es Valido
               return $token;
           }

    }
}


?>