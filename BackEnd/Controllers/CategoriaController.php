<?php

//INCLUDES
include('../Models/Categoria.php');
include('TokenController.php');

class CategoriaController
{

    public static function guardar($datos)
    {
        $token = TokenController::validarToken($datos);

        if(is_bool($token))
           {
                //Campos Obligatorios
                if( !isset($datos['Nombre']))
                {      
                    //Campo requido no enviado     
                    return Respuestas::error_400();
                }
                else
                {
                
                    $_categoria = new Categoria();

                    // Llamar funcion privada Insert_Categoria(Query de insertar categoria)
                    $resp = $_categoria->Guardar($datos);

                    if($resp)
                    {
                        //Respuesta de insercion exitosa y ID insertado
                        $respuesta['result'] = array(
                            "ID_Categoria" => $resp
                        );
                        return $respuesta;
                    }
                    else
                    {
                        //Error al momento de insertar
                        Respuestas::error_500();
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
            return Categoria::ObtenerTodo();
        }
        else
        {
            return $token;
        }

    }
    
    public static function Obtener($datos)
    {
        //Validar token
         $token = TokenController::validarToken($datos);

         if(is_bool($token))
         {
             return Categoria::Obtener($datos);
         }
         else
         {
                 //Error en caso de que el token sea invalido o no sea enviado
                return  $token;
         }

    }

     //METOOD HEREDADO DE LA INTERFACE
     public static function Actualizar($datos)
     {
         $token = TokenController::validarToken($datos);
        
         if(is_bool($token))
         {
                  //Comprobar campos requerido
                  if( !isset($datos['ID_Categoria']) ||  !isset($datos['Nombre']))
                  {      
                      //Campos requidos no enviados     
                      return Respuestas::error_400();
                  }
                  else
                  {
                      $_categoria = new Categoria();

                      // Llamar funcion obtener(para verificar si el ID introducido existe)
                      $ID = Categoria::Obtener($datos);
      
                      if($ID)
                      {
                          //El ID introducido existe

                          //Llamando a la funcion privada Actualizar_Categoria(Update Categoria)
                          $resp = $_categoria->Actualizar($datos);
                          
                          $respuesta = Respuestas::$response;
                          $respuesta['result'] = array(
                              "ID_Categoria" => $datos['ID_Categoria'],
                              "Nombre"       => $datos['Nombre']
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

    public static function Eliminar($datos)
    {
        //Validar token
        $token = TokenController::validarToken($datos);

        if(is_bool($token))
        {
            //Comprobar campos requeridos
            if( !isset($data['ID_Categoria']))
            {      
                    //Campo requido no enviado     
                    return Respuestas::error_400();
            }
            else
            {
                $_categoria = new categoria();
                
                // Llamar funcion obtener para ver si existe el ID solicitado
                $ID = Categoria::Obtener($datos);

                if($ID)
                {       //Existe
                    
                        //Llamando a la funcion privada Delete Categoria (Eliminar una categoria)
                        $resp = $_categoria->Eliminar($datos);
                    
                        //Respuesta
                        $respuesta = Respuestas::$response;
                        $respuesta['result'] = array(
                            "ID_Categoria" => $datos['ID_Categoria']
                        );
                        return $respuesta;
                        
                }
                else
                {
                    //Error al momento de eliminar
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