<?php


//Includes
include('../../Class/Includes/IEntidad.php');


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

    public function Guardar($conn,$json)
    { 
        
        $data = json_decode($json,true);

        if( !isset($data['Nombre']) || !isset($data['Apellido']) || !isset($data['Usuario']) || !isset($data['Contrasena']) || !isset($data['ID_Rol']) || !isset($data['Correo']) ) 
        {      
               //Campo requido no enviado     
               return Respuestas::error_400();
        }
        else
        {
                //Campo requido enviado  
                $this->Nombre             = $data["Nombre"];
                $this->Apellido           = $data["Apellido"];
                $this->Usuario            = $data["Usuario"];
                $this->Contrasena         = $data["Contrasena"];
                $this->ID_Rol             = $data["ID_Rol"];
                $this->Correo             = $data["Correo"];

                  // Llamar funcion privada Insert_Categoria


                  $comprobaruser = $this->Comprobar_Usuario($conn);

                  
                  if($comprobaruser >= 1)
                  {
                        $comprobarcorreo = $this->Comprobar_Correo($conn);

                        if($comprobarcorreo >= 1)
                        {
                              
                                $comprobarrol = $this-> Comprobar_Rol($conn);

                                if ($comprobarrol >= 1)
                                {
                                        //Encriptar contrasena
                                        $this->Contrasena = $this->EncriptarContrasena($this->Contrasena);                      
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
                                    return Respuestas::error_500("El rol introducido no ex valido");
                                    
                                }

                        }
                        else
                        {
                            return Respuestas::error_500("El correo introducido ya existe");
                        }
                  }
                  else
                  {
                    return  Respuestas::error_500("El Usuario introducido ya existe");
                  }
  
        }
    }


 
    private function Insert_Usuario($conn)
    {
        $query = "INSERT into $this->Tabla(Nombre, Apellido, Usuario,Contrasena,ID_Rol,Correo) values ('$this->Nombre','$this->Apellido','$this->Usuario','$this->Contrasena',$this->ID_Rol,'$this->Correo')";

        $id = $conn->nonQueryId($query);

        if($id)
        {
           return $id;

        } 
        else
        {
            return 0;

        }
    }


    


    public static function ObtenerTodo($conn,$json)
    {
          $query = self::Select_Usuario();
          $datos = $conn->Query($query);
          return $datos;
    }

    public static function Obtener($conn,$json)
    {
        $id = $json["ID_Usuario"];
        $query = self::Select_Usuario(). ' WHERE u.ID_Usuario = '. $id;
        $datos = $conn->Query($query);
        return $datos;
    }

    private static function Select_Usuario()
    {
         $query = "select u.ID_Usuario,u.Nombre, u.Apellido, u.Usuario, r.Nombre Rol, u.Correo, u.Contrasena
                  from Usuario u
                  JOIN Rol r on (u.ID_Rol=r.ID_Rol)";

         return $query;
    }



    public function Actualizar($conn,$json)
    {
      

    }

 
    public function Eliminar($conn,$json)
    {
        $data = json_decode($json,true);

        //Comprobar campos requeridos
       if( !isset($data['ID_Usuario']))
       {      
              //Campo requido no enviado     
              return Respuestas::error_400();
       }
       else
       {
           //Campo requido enviado  
             $this->ID_Usuario        = $data['ID_Usuario'];
           
           // Llamar funcion privada Insert_Categoria
           $ID = self::Obtener($conn,$data);

           if($ID)
           {
                //EXISTE
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