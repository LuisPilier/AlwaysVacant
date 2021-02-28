<?php

//INCLUDES
include($_SERVER['DOCUMENT_ROOT'].'/AlwaysVacant/BackEnd/Models/Usuario_admin.php');
include('TokenController.php');

//Clase Usario admin herededa de Usuario
class Usuario_adminController{

    //Obtenertodas las config.
     public  static function ObtenerTodasConf($datos)
     {

        //Validar token
        $token = TokenController::validarToken($datos);

        if(is_bool($token))
        {
            $user_admin = new Usuario_admin();

            $datos = $user_admin->ObtenerTodasConf();

            //Retornar datos
            return $datos;
        }
        else
        {
            //Error en caso de que el token sea invalido o no sea enviado
            return  $token;

        } 
     }


     //Obtener Config especifica
     public static function ObtenerConfigadmin($datos)
     {
        //Validar token
        $token = TokenController::validarToken($datos);

        if(is_bool($token))
        {
            
            $user_admin = new Usuario_admin();

            $datos = $user_admin->ObtenerConfigadmin($datos);

            //Retornar datos
            return $datos;
        }
        else
        {
            //Error en caso de que el token sea invalido o no sea enviado
            return  $token;

        }        
     }
     

       //Funcion actualizar configuracion 
    public static function ActualizarConfigVacantes($datos)
    {
            //Validar token
            $token = TokenController::validarToken($datos);

            if(is_bool($token))
            {
                    //Comprobar campos requerido
                    if( !isset($datos['Numero_vacantes']))
                    {      
                        //Campos requidos no enviados     
                        return Respuestas::error_400();
                    }
                    else
                    {
                        //Campos requidos enviados  
                        $Numero_vacantes        = $datos['Numero_vacantes'];
                        
                        $user_admin = new Usuario_admin();

                        // Llamar funcion Actualizar_Admon
                        $Actualizar_conf = $user_admin->Actualizar_ConfAdmin($Numero_vacantes);
        
                        if( $Actualizar_conf >= 1)
                        {
                            //Respuesta
                            
                            $respuesta = Respuestas::$response;
                            $respuesta['result'] = array(
                                "Cantidad_de_vacantes" => $Numero_vacantes
                                
                            );
                            return $respuesta;
            
                            
                        }
                        else
                        {
                                //Error al momento de buscar el ID introducido(no existe)
                                return  Respuestas::error_500();
                    }  
                }
            }
            else
            {
                    //Error en caso de que el token sea invalido o no sea enviado
                    return $token;
            }

    }

}



?>