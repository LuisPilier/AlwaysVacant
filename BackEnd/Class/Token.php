<?php 


class Token
{

    //Este metodo se utiliza al momento de hacer cualquier request a la API
    public static function validarToken($conn,$datos)
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
            $arrayToken  = self::buscarToken($conn,$datos['Token']);
            
            if($arrayToken)
            {
                return true;
            }
            else{
                return Respuestas::error_401("El Token que envio es invalido o ha caducado");
            }
        }   

    }

    //Este metodo se utiliza cuando un usuario hace LOGIN 
    public static function insertarToken($conn,$usuarioid)
    {
      $val    = true;
      $token  = bin2hex(openssl_random_pseudo_bytes(16,$val));
      $date   = date("Y-m-d");
      $estado = "Activo";

      $query = "INSERT INTO Usuarios_token(ID_Usuario,Token,Estado,Fecha) VALUES
      ('$usuarioid','$token','$estado','$date')";

      $verifica = $conn->nonQuery($query);

      if ($verifica) {
        // code...
        return $token;
      } else {
        // code...
        return 0;
      }


    }

    //Este metodo busca los token que estan activos
    public static function buscarToken($conn,$token)
    {
        $query = "
        
        SELECT ut.ID_Token,ut.ID_Usuario,ut.Estado,ut.Fecha,ut.Token, usuarios.ID_Rol, r.Nombre
        FROM Usuarios_token ut
        join Usuario usuarios on (ut.ID_Usuario = usuarios.ID_Usuario)
        join Rol r on (r.ID_Rol = usuarios.ID_Rol)
        WHERE ut.Token = '$token' and ut.ESTADO = 'Activo' "
        ;
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
    public static function InactivarToken($conn,$fecha)
    {
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
    public static function EliminarToken($conn,$fecha)
    {

        $query = "DELETE FROM usuarios_token WHERE Fecha < '$fecha' AND Estado = 'Activo'";
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