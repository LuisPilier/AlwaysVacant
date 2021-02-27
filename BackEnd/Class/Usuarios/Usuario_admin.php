<?php


//Includes
include ('Usuario.php');


//Clase Usario admin herededa de Usuario
class Usuario_admin extends Usuario{

       
    //Atributos 
    private $Tabla = "Configuracion";
    private $Numero_vacantes = "";
    protected $token = "";


      //Metodos

     //Guardadr
    public function Guardar($conn,$json)
    {

    }

    //Obtenertodas las config.
     public  static function ObtenerTodasConf($conn,$json)
     {
                        //Validar token
                        $token = Token::validarToken($conn,$json);

                        if(is_bool($token))
                        {
                            

                        //Llamando la funcion privada Select_Categoria con la condicion del usuario solicitada
                        $query = self::Select_Config();
                        $datos = $conn->Query($query);

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
     public static function ObtenerConfigadmin($conn,$json)
     {
                //Validar token
                $token = Token::validarToken($conn,$json);

                if(is_bool($token))
                {
                 
                 //ID de configuracion especifica   
                $conf_especifica = $json['Cod_conf'];

                //Llamando la funcion privada Select_Config con la condicion de  solicitada
                $query = self::Select_Config(). ' where Cod_conf = ' . $conf_especifica;
                $datos = $conn->Query($query);

                    //Retornar datos
                    return $datos;
                }
                else
                {
                    //Error en caso de que el token sea invalido o no sea enviado
                    return  $token;

                }        
     }
     
     //Select Basico Conf
      private static function Select_Config()
      {
              $query = " SELECT Cod_conf,Nombre,Numero_vacantes FROM Configuracion";  

              return $query;
      }

       //Funcion actualizar configuracion 
    public function ActualizarConfigVacantes($conn,$json)
    {
                    //Array con los datos
                    $data = json_decode($json,true);

                    //Validar token
                    $this->token = Token::validarToken($conn,$data);

                    if(is_bool($this->token))
                    {


                            //Comprobar campos requerido
                            if( !isset($data['Numero_vacantes']))
                            {      
                                //Campos requidos no enviados     
                                return Respuestas::error_400();
                            }
                            else
                            {
                                //Campos requidos enviados  
                                $this->Numero_vacantes        = $data['Numero_vacantes'];
                                
                                
                                // Llamar funcion Actualizar_Admon
                                $Actualizar_conf = $this->Actualizar_ConfAdmin($conn);
                
                                if( $Actualizar_conf >= 1)
                                {
                                  

                                    //Respuesta
                                    
                                    $respuesta = Respuestas::$response;
                                    $respuesta['result'] = array(
                                        "Cantidad_de_vacantes" => $this->Numero_vacantes
                                        
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
                            return $this->token;
                    }

    }




        //Funcion privada (Update Confif) 
        private function Actualizar_ConfAdmin($conn)
        {
            //Query
            $query = " update $this->Tabla
                        set Numero_vacantes = $this->Numero_vacantes 
                        where Cod_conf =1  ";
                        
            //Lamando la funcion que esta en la clase conexion y trae la interface
            $resp =  $conn->nonQuery($query);

            //Si se afectan las filas de la tabla categoria
            if($resp >= 1)
            {
                return $resp;
            }
            else
            {
                //Error
                return 0;
            }


        }


    public function Eliminar($conn,$json)
    {

    }

}



?>