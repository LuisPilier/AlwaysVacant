<?php 


class Token
{

    private function insertarToken($conn,$usuarioid)
    {
      $val    = true;
      $token  = bin2hex(openssl_random_pseudo_bytes(16,$val));
      $date   = date("Y-m-d");
      $estado = "Activo";

      $query = "INSERT INTO usuarios_token(UsuarioId,Token,Estado,Fecha) VALUES
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

    private function buscarToken($conn)
    {
        $query = "SELECT TokenId,UsuarioId,Estado FROM usuarios_token WHERE Token = '$this->token'
        and ESTADO = 'Activo'";
        $resp = $conn->obtenerDatos($query);

        if($resp)
        {
            return $resp;
        }
        else
        {
            return 0;
        }
    }


    private function actualizarToken($conn,$tokenid)
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
    }

    public function InactivarToken($conn,$fecha)
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

    public function EliminarToken($conn,$fecha)
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