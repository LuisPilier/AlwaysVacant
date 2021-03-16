<?php 

include('Respuestas.php');
include($_SERVER['DOCUMENT_ROOT'].'/AlwaysVacant/BackEnd/Models/Token.php');


class TokenController
{

    //Este metodo se utiliza al momento de hacer cualquier request a la API
    public static function validarToken($datos)
    {
        //Retornar respuesta si no recibe un token
        if(!isset($datos['Token']))
        {   
        //No Autorizado
        return respuestas::error_401();
        }

        else
        {
            //Metodo para Verificar 
            $arrayToken  = Token::Obtener($datos);
            
            if($arrayToken)
            {
                return true;
            }
            else{
                return Respuestas::error_401("El Token que envio es invalido o ha caducado");
            }
        }   

    }

    
}



?>