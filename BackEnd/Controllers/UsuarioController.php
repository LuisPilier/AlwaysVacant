<?php

//INCLUDES
include($_SERVER['DOCUMENT_ROOT'].'/AlwaysVacant/BackEnd/Models/Usuario.php');
include('TokenController.php');


//Clase Usuario que implementa la interface
class UsuarioController {
    //Metodos

    //Funcion implementada de la Interface        
    public static function Guardar($datos)
    { 
        //Metodo de la clase token, valida si fue enviado o si es valido
         $token = TokenController::validarToken($datos);

          //Comprobar si el token existe 
         if(is_bool($token))
         {
              //Comprobar si los cambios requeridos fueron enviados
            if( !isset($datos['Nombre']) || !isset($datos['Apellido']) || !isset($datos['Usuario']) || !isset($datos['Contrasena']) || !isset($datos['ID_Rol']) || !isset($datos['Correo']) ) 
            {      
                //Campo requido no enviado     
                return Respuestas::error_400();
            }
            else
            {
                  //Llamar a la function privada para comprobar si el usuario introducido existe
                  $comprobaruser = self::Comprobar_Usuario($datos['Usuario']);

                  //Resultado de llamar la funcion
                  if($comprobaruser >= 1)
                  {
                      //No existe un user con ese nombre
                            
                    //Llamar a la function privada para comprobar si el correo introducido existe
                    $comprobarcorreo = self::Comprobar_Correo($datos['Correo']);

                      //Resultado de llamar la funcion
                      if($comprobarcorreo >= 1)
                      {
                          //Llamar a la funcion privada para comprobar si el rol introducido existe
                          $comprobarrol = self::Comprobar_Rol($datos['ID_Rol']);

                          if($comprobarrol >= 1)
                          {
                                $_usuario = new Usuario();
                                        
                                //Encriptar contrasena
                                $Contrasena = $_usuario->EncriptarContrasena($datos['Contrasena']);                      
                            
                                //Llamar la funcion para insertar el usario
                                $resp = $_usuario->guardar($datos);

                                if($resp)
                                {
                                    //Respuesta de insercion exitosa y ID insertado
                                    $respuesta['result'] = array(
                                        "ID_Usuario" => $resp
                                    );
                                    return $respuesta;
                                }
                                else
                                {
                                    //Error al momento de insertar
                                    Respuestas::error_500();
                                }
                          }
                          else
                          {
                            //Error el rol introducido no existe
                            return Respuestas::error_500("El rol introducido no es valido");     
                          }
                      }
                      else
                      {
                                //El correo introducido ya esta registrado
                            return Respuestas::error_500("El correo introducido ya existe");
                      }

                  }
                  else
                  {
                        //El usuario introducido ya esta registrado
                        return  Respuestas::error_500("El Usuario introducido ya existe");
                  }       
            }

         }
        else
        {
                //Error en caso de que el token sea invalido o no sea enviado
                return $token;
        }
    }
 

    //Funcion Implementada de la Interface (Obtener todos los usarios)
    public static function ObtenerTodo($datos)
    {
         //Validar token
         $token = TokenController::validarToken($datos);
          
          if(is_bool($token))
          {         
                 //Ejecutar function privada Select_Usuario   
                    $datos = Usuario::ObtenerTodo();

                    //Retornar datos
                    return $datos;
          }
          else
          {
               //Error en caso de que el token sea invalido o no sea enviado
               return  $token;
          }          
    }

    //Funcion Implementada de la Interface (Obtener un usuario especificado por el ID_Usuario)
    public static function Obtener($datos)
    {
          //Validar token
          $token = TokenController::validarToken($datos);

          if(is_bool($token))
          {
              $datos = Usuario::Obtener($datos['ID_Usuario']);
         
            //Retornar datos
            return $datos;
          }
          else
          {
                //Error en caso de que el token sea invalido o no sea enviado
                return  $token;

          } 
    }


    //Funcion actualizar 
    public function Actualizar($json)
    {
      //inhabilitada POR AHORA

    }

   //Funcion Implementada de la Interface (Eliminar una Usuario)
    public static function Eliminar($datos)
    {
         //Validar token
        $token = TokenController::validarToken($datos);

        if(is_bool($token))
        {
            //Comprobar campos requeridos enviados
            if( !isset($datos['ID_Usuario']))
            {      
                    //Campo requido no enviado     
                    return Respuestas::error_400();
            }
            else
            {
                //Campo requido enviado  
                $id  = $datos['ID_Usuario'];
                
                // Llamar funcion obtener para ver si el user especificado existe
                $ID = Usuario::Obtener($datos['ID_Usuario']);


                if($ID)
                {
                        $_usuario = new Usuario();
                        //El ID del usario existe

                        //Llamando a la funcion privada Delete Usuario (Eliminar un usario) 
                        $resp = $_usuario->Eliminar($datos);
                    
                        $respuesta = Respuestas::$response;
                        $respuesta['result'] = array(
                            "ID_Usuario" => $datos['ID_Usuario'] 
                        );
                        return $respuesta;
                        
                }
                else
                {
                    //Error al momento de insertar
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

     //Comprobacion
    private static function Comprobar_Rol($rol)
    {
        $buscarrol = Usuario::Comprobar_Rol($rol);

        if($buscarrol != [])
        {
            return $buscarrol;
        }
        else
        {
            return 0;
        }

    }

    private static function Comprobar_Usuario($usuario)
    {
        $buscaruser = Usuario::Comprobar_Usuario($usuario);

        if($buscaruser != [])
        {
            return 0;
        }
        else
        {
            return $buscaruser;
        }
    }

    private static function Comprobar_Correo($correo)
    {
        $buscarcorreo = Usuario::Comprobar_Correo($correo);

        if($buscarcorreo != [])
        {
            return 0;
        }
        else
        {
            return $buscarcorreo;
        }
    }

    
}






?>