<?php


//Includes
include('../../Class/Includes/IEntidad.php');

//Clase Usuario que implementa la interface
Class Usuario implements IEntidad{

    //Atributos 
    private $Tabla = "Usuario";
    private $datos ;
    protected $ID_Usuario ="";
    protected $Nombre ="";
    protected $Apellido = "";
    protected $Usuario = "";
    protected $Contrasena =" ";
    protected $ID_Rol;
    protected $Correo = "";
    protected $token = "";

    //Metodos

    //Funcion implementada de la Interface        
    public function Guardar($conn,$json)
    { 
         // Array con datos
        $data = json_decode($json,true);

            //Comprobar si los cambios requeridos fueron enviados
        if( !isset($data['Nombre']) || !isset($data['Apellido']) || !isset($data['Usuario']) || !isset($data['Contrasena']) || !isset($data['ID_Rol']) || !isset($data['Correo']) ) 
        {      
            //Campo requido no enviado     
            return Respuestas::error_400();
        }
        else
        {
            //Campo requido enviados  
            $this->Nombre      = $data["Nombre"];
            $this->Apellido    = $data["Apellido"];
            $this->Usuario     = $data["Usuario"];
            $this->Contrasena  = $data["Contrasena"];
            $this->ID_Rol      = $data["ID_Rol"];
            $this->Correo      = $data["Correo"];        

            //Llamar a la function privada para comprobar si el usuario introducido existe
            $comprobaruser = $this->Comprobar_Usuario($conn);

            //Resultado de llamar la funcion
            if($comprobaruser >= 1)
            {
                //No existe un user con ese nombre
                    
                    //Llamar a la function privada para comprobar si el correo introducido existe
                    $comprobarcorreo = $this->Comprobar_Correo($conn);
                        
                        //Resultado de llamar la funcion
                    if($comprobarcorreo >= 1)
                    {
                            //No existe el correo introducido    

                            //Llamar a la funcion privada para comprobar si el rol introducido existe
                            $comprobarrol = $this-> Comprobar_Rol($conn);

                            //Resultado de llamar la funcion
                            if ($comprobarrol >= 1)
                            {
                                    //Encriptar contrasena
                                    $this->Contrasena = $this->EncriptarContrasena($this->Contrasena);                      
                                    
                                    //Llamar la funcion para insertar el usario
                                    $resp = $this-> Insert_Usuario($conn);

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
                                return Respuestas::error_500("El rol introducido no ex valido");
                                
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
    


 
    //Funcion privada (query de inserion usario)
    private function Insert_Usuario($conn)
    {
        //Query
        $query = "INSERT into $this->Tabla(Nombre, Apellido, Usuario,Contrasena,ID_Rol,Correo) values ('$this->Nombre','$this->Apellido','$this->Usuario','$this->Contrasena',$this->ID_Rol,'$this->Correo')";

         //Lamando la funcion que se encuentra en la clase conexion y que es utilizada por la interface
        $id = $conn->nonQueryId($query);

        if($id)
        {
            //Se inserto correctamente
           return $id;

        } 
        else
        {
            //Error al momento de insertar
            return 0;

        }
    }


    

    //Funcion Implementada de la Interface (Obtener todos los usarios)
    public static function ObtenerTodo($conn,$json)
    {
         //Validar token
         $token = Token::validarToken($conn,$json);
          
          if(is_bool($token))
          {         
                 //Ejecutar function privada Select_Usuario   
                    $query = self::Select_Usuario();
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

    //Funcion Implementada de la Interface (Obtener un usuario especificado por el ID_Usuario)
    public static function Obtener($conn,$json)
    {
          //Validar token
          $token = Token::validarToken($conn,$json);

          if(is_bool($token))
          {
               //Extrayendo el ID_Usuario solicitado
            $id = $json["ID_Usuario"];

            //Llamando la funcion privada Select_Categoria con la condicion del usuario solicitada
            $query = self::Select_Usuario(). ' WHERE u.ID_Usuario = '. $id;
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

    //Funcion privada (Query general para el select de Usuario)
    private static function Select_Usuario()
    {
        //Query
         $query = "select u.ID_Usuario,u.Nombre, u.Apellido, u.Usuario, r.Nombre Rol, u.Correo, u.Contrasena
                  from Usuario u
                  JOIN Rol r on (u.ID_Rol=r.ID_Rol)";

         return $query;
    }


    //Funcion actualizar 
    public function Actualizar($conn,$json)
    {
      //inhabilitada POR AHORA

    }

   //Funcion Implementada de la Interface (Eliminar una Usuario)
    public function Eliminar($conn,$json)
    {
        // Array con datos
        $data = json_decode($json,true);
      

         //Validar token
        $this->token = Token::validarToken($conn,$data);


        if(is_bool($this->token))
        {
            //Comprobar campos requeridos enviados
            if( !isset($data['ID_Usuario']))
            {      
                    //Campo requido no enviado     
                    return Respuestas::error_400();
            }
            else
            {
                //Campo requido enviado  
                    $this->ID_Usuario        = $data['ID_Usuario'];
                
                // Llamar funcion obtener para ver si el user especificado existe
                $ID = self::Obtener($conn,$data);


                if($ID)
                {
                        //El ID del usario existe

                        //Llamando a la funcion privada Delete Usuario (Eliminar un usario) 
                        $resp = $this->Delete_Usuario($conn);
                    
                        $respuesta = Respuestas::$response;
                        $respuesta['result'] = array(
                            "ID_Usuario" => $this->ID_Usuario  
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
            return $this->token;
        }    
    }

    //Funcion privada (Delete_Usuario)
    private function Delete_Usuario($conn)
    {
           $query = "DELETE FROM $this->Tabla where ID_Usuario = $this->ID_Usuario";

           $id = $conn->nonQuery($query);

           if($id >= 1)
           {
              return $id;
           }
           else
           {
              return 0;
           }
    }




     //Comprobacion
    private function Comprobar_Rol($conn)
    {
        $query = "Select * from Rol where ID_Rol = $this->ID_Rol";
         
        $buscarrol = $conn->Query($query);
        
        if($buscarrol != [])
        {
            return $buscarrol;
        }
        else
        {
            return 0;
        }

    }

    public function Comprobar_Usuario($conn)
    {
      
        $query = "Select * from $this->Tabla where Usuario = '$this->Usuario'";
         
        $buscaruser = $conn->Query($query);
        
        if($buscaruser != [])
        {
             $this->datos = $buscaruser;
            return 0;
        }
        else
        {
            return $buscaruser;
        }
    }
    private function Comprobar_Correo($conn)
    {
        $query = "Select * from $this->Tabla where Correo = '$this->Correo'";
         
        $buscarcorreo = $conn->Query($query);
        
        if($buscarcorreo != [])
        {
            return 0;
        }
        else
        {
            return $buscarcorreo;
        }
    }

    Private function EncriptarContrasena($Contrasena)
    {
        return md5($Contrasena);
    }
}






?>