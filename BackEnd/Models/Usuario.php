<?php


//Includes
include('IEntidad.php');

include('Conexion.php');

//Clase Usuario que implementa la interface
Class Usuario implements IEntidad{

    //Atributos 
    private static $Tabla = "Usuario";
    private $datos ;
    protected $ID_Usuario = "";
    protected $Nombre     = "";
    protected $Apellido   = "";
    protected $Usuario    = "";
    protected $Contrasena = "";
    protected $ID_Rol     = "";
    protected $Correo     = "";
    protected $token      = "";

    //Metodos

    //Funcion implementada de la Interface        
    public function Guardar($datos)
    { 
        //Campo requido enviados  
        $this->Nombre             = $datos["Nombre"];
        $this->Apellido           = $datos["Apellido"];
        $this->Usuario            = $datos["Usuario"];
        $this->Contrasena         = $datos["Contrasena"];
        $this->ID_Rol             = $datos["ID_Rol"];
        $this->Correo             = $datos["Correo"];

        $resp = $this->Insert_Usuario();

        return $resp;
            
    }
 
    //Funcion privada (query de inserion usario)
    private function Insert_Usuario()
    {
        $conn = Conexion::getInstance();

        //Query
        $query = "INSERT into ". self::$Tabla." (Nombre, Apellido, Usuario,Contrasena,ID_Rol,Correo) values ('$this->Nombre','$this->Apellido','$this->Usuario','$this->Contrasena',$this->ID_Rol,'$this->Correo')";

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
    public static function ObtenerTodo()
    {
        $conn = Conexion::getInstance();
    
        //Ejecutar function privada Select_Usuario   
        $query = self::Select_Usuario();
        $datos = $conn->Query($query);

        //Retornar datos
        return $datos;
    }

    //Funcion Implementada de la Interface (Obtener un usuario especificado por el ID_Usuario)
    public static function Obtener($id)
    {
        $conn = Conexion::getInstance();

        //Llamando la funcion privada Select_Categoria con la condicion del usuario solicitada
        $query = self::Select_Usuario(). ' WHERE u.ID_Usuario = '. $id;
        $datos = $conn->Query($query);
        
        //Retornar datos
        return $datos;
        
    }

    //METODO UTILIZADO PARA LA AUTENTIFICACION
    public function obtenerDatosUsuario($usuario){
        
        $conn = Conexion::getInstance();

        $query = "SELECT ID_Usuario,Nombre,Apellido,Usuario,Contrasena,ID_Rol,Correo FROM Usuario WHERE Usuario = '$usuario'";
        $datos = $conn->Query($query);
        if($datos){
            return $datos;
        }else{
            return 0;
        }
    }

    //Funcion privada (Query general para el select de Usuario)
    private static function Select_Usuario()
    {
        //Query
         $query = "Select u.ID_Usuario,u.Nombre, u.Apellido, u.Usuario, r.Nombre Rol, u.Correo, u.Contrasena from Usuario u JOIN Rol r on (u.ID_Rol=r.ID_Rol) ";

         return $query;
    }


    //Funcion actualizar 
    public function Actualizar($json)
    {
      //inhabilitada POR AHORA

    }

   //Funcion Implementada de la Interface (Eliminar una Usuario)
    public function Eliminar($datos)
    {
        //Llamando a la funcion privada Delete Usuario (Eliminar un usario) 
        $resp = $this->Delete_Usuario($datos);  

        return $resp;
    }

    //Funcion privada (Delete_Usuario)
    private function Delete_Usuario($datos)
    {
           $conn = Conexion::getInstance();           
           $query = "DELETE FROM ". self::$Tabla ." where ID_Usuario = ".$datos['ID_Usuario'];
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
    public static function Comprobar_Rol($rol)
    {
        $conn = Conexion::getInstance();

        $query = "Select * from Rol where ID_Rol = '$rol'";
         
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

    public static function Comprobar_Usuario($usuario)
    {
        $conn = Conexion::getInstance();
        $query = "Select * from ".self::$Tabla ." Where Usuario = '$usuario'";
        $buscaruser = $conn->Query($query);
        
        return $buscaruser;
    }

    public static function Comprobar_Correo($correo)
    {
        $conn = Conexion::getInstance();

        $query = "Select * from ".self::$Tabla ." Where Correo = '$correo'";
         
        $buscarcorreo = $conn->Query($query);
        
        return $buscarcorreo;
    }

    public function EncriptarContrasena($Contrasena)
    {
        return md5($Contrasena);
    }
}






?>