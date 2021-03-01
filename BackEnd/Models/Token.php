<?php 

 
/**/
class Token implements IEntidad
{
    private $ID_Usuario;
    private $Token;
    private $Estado;
    private $Fecha;

    private static $Table = "Usuarios_token";

    public static function buscarToken($token)
    {
        $conn = Conexion::getInstance();

        $query = "
        
         
        SELECT ut.ID_Token,ut.ID_Usuario,ut.Estado,ut.Fecha,ut.Token, usuarios.ID_Rol,usuarios.Usuario, r.Nombre
        FROM Usuarios_token ut
        join Usuario usuarios on (ut.ID_Usuario = usuarios.ID_Usuario)
        join Rol r on (r.ID_Rol = usuarios.ID_Rol)
        WHERE ut.Token = '$token' and ut.ESTADO = 'Activo' ";
        $resp = $conn->Query($query);

        if($resp)
        {
            return $resp;
        }
        else
        {
            return 0;
        }
    }


    //Este metodo se utiliza cuando un usuario hace LOGIN 
    public function Guardar($ID_Usuario)
    {
      $conn = Conexion::getInstance();

      $val              = true;
      $this->ID_Usuario = $ID_Usuario;
      $this->Token      = bin2hex(openssl_random_pseudo_bytes(16,$val));
      $this->Fecha      = date("Y-m-d H:m:s");
      $this->Estado     = "Activo";

      $insert_fields = array(
        'ID_Usuario'    => "'$this->ID_Usuario'",
        'Token' 	    => "'$this->Token'",
        'Fecha'         => "'$this->Fecha'",
        'Estado'        => "'$this->Estado'",
        );

       // Insert record
       $insert_sql = 'INSERT INTO ' . Token::$Table
           . ' ('   . implode(', ', array_keys($insert_fields))   . ')'
           . ' VALUES ('    . implode(', ', array_values($insert_fields)) . ')';

      $verifica = $conn->nonQuery($insert_sql);

      if ($verifica) {
        // code...
        return $this->Token;
      } else {
        // code...
        return 0;
      }

    }

    public static function ObtenerTodo()
    {
        echo '';
    }

    //Este metodo busca los token que estan activos
    public static function Obtener($datos)
    {
        $conn = Conexion::getInstance();

        $token = $datos['Token'];

        $query = "SELECT ID_Token,ID_Usuario,Estado,Fecha,Token FROM Usuarios_token WHERE Token = '$token'
        and ESTADO = 'Activo'";
        $resp = $conn->Query($query);

        if($resp)
        {
            return $resp;
        }
        else
        {
            return 0;
        }
    }


    /*public static function actualizarToken($conn,$tokenid)
    {
        $date = date("Y-m-d H:i");
        $query = "UPDATE usuarios_token SET fecha = '$date' WHERE TokenId = '$tokenid'";
        $resp = $conn->nonQuery($query);

        if($resp >= 1)
        {
            return $resp;
        }else{
            return 0;
        }
    }*/

    //Este metodo se utiliza para inactivar los Token luego de 24h
    public function Actualizar($fecha)
    {
        $conn = Conexion::getInstance();

        $query = "UPDATE usuarios_token SET Estado = 'Inactivo' WHERE Fecha < '$fecha' AND Estado = 'Activo'";
        $verificar = $conn->nonQuery($query);

        if($verificar > 0)
        {
            return 1;
        }
        else
        {
            return 0;
        }

    }

    //Este metodo se utiliza para eliminar los Token luego de 1 mes
    public function Eliminar($fecha)
    {
        $conn = Conexion::getInstance();

        $query = "DELETE FROM usuarios_token WHERE Fecha < '$fecha' AND Estado = 'Inactivo'";
        $verificar = $conn->nonQuery($query);

        if($verificar > 0)
        {
            return 1;
        }
        else
        {
            return 0;
        }


    }
}



?>