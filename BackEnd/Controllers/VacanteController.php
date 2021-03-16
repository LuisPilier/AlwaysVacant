<?php

//INCLUDES
include('../Models/Vacante.php');
include('TokenController.php');

class VacanteController
{

    public static function guardar($datos)
    {
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
                    $vacante = new Vacante(); 

                     //Query para insertar la vacante
                     $resp = $vacante->Guardar($datos);

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

    public static function ObtenerTodo($datos)
    {
        $token = TokenController::validarToken($datos);
       
        if(is_bool($token))
        {
            return Vacante::ObtenerTodo();
        }
        else
        {
            return $token;
        }

    }
    
    public static function Obtener($datos)
    {
        $token = TokenController::validarToken($datos);
       
        if(is_bool($token))
        {
            if(isset($datos['ID_Vacante']))
            {
                return Vacante::Obtener($datos);
            }    
            else
            {
                 //Datos enviados incompletos o con formato incorrecto
                 return respuestas::error_400();
            }
        }
        else
        {
            return $token;
        }    
   }   

   public static function Vacantes_Categoria($datos)
   {
            $token = TokenController::validarToken($datos);
           
            if(is_bool($token))
            {
                if(isset($datos['ID_Categoria']))
                {
                    return Vacante::Vacantes_Categoria($datos);
                }
                else
                {
                    //Datos enviados incompletos o con formato incorrecto
                    return respuestas::error_400();
                }
            }
            else
            {
                return $token;
            }
    }

     //METOOD HEREDADO DE LA INTERFACE
     public static function Actualizar($datos)
     {
         $token = TokenController::validarToken($datos);
        
         if(is_bool($token))
         {
                 //Campos Obligatorios
                 if(!isset($datos['ID_Vacante']) || !isset($datos['Compania']) || !isset($datos['ID_Tipo_Vacante']) || !isset($datos['Posicion']) || !isset($datos['ID_Ciudad']) || !isset($datos['Ubicacion']) || !isset($datos['ID_Categoria']))
                 {
                     //Datos enviados incompletos o con formato incorrecto
                     return respuestas::error_400();
                 }
                 else{
                        //Query para actualizar la vacante
                        $_vacante = new Vacante();

                        $resp = $_vacante->Actualizar($datos);

                        if($resp)
                        {
                            $respuesta = respuestas::$response;
                            $respuesta['result'] = array(
                                "ID_Vacante" => $datos['ID_Vacante']
                            );
                            return $respuesta;
                        }
                        else{
                            //Error Interno del Servidor
                            return respuestas::error_500();
                        }
                 }

             }
             else
             {
                 return $token;
             }
         }

          //METODO HEREDADO DE LA INTERFACE
        public static function Eliminar($datos)
        {
            $token = TokenController::validarToken($datos);
           
           if(is_bool($token))
           {
                //Campo Obligatorio para eliminar una vacante
                if(!isset($datos['ID_Vacante']))
                {
                    //Datos enviados incompletos o con formato incorrecto
                    return respuestas::error_400();
                }
                else
                {
                    $_vacante = new Vacante();

                    //Query para eliminar una vacante
                    $resp = $_vacante->Eliminar($datos);

                    //Si se eliminaron registros
                    if($resp)
                    {
                        $respuesta = respuestas::$response;
                        $respuesta['result'] = array(
                            "ID_Vacante" => $datos['ID_Vacante']
                        );
                        return $respuesta;
                    }
                    else{
                        //Error Interno del Servidor
                        return respuestas::error_500();
                    }  
                }
                
           }
           else
           {
               return $token;
           }
         
        }  
        




}

?>