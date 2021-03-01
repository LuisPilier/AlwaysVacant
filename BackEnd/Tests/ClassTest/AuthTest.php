<?php


include($_SERVER['DOCUMENT_ROOT'].'Controllers/Auth.php');


class VacanteTest extends \PHPUnit\Framework\TestCase
{

    public function test_login()
    {
        $datos['Usuario']    = 'CDIM18';
        $datos['Contrasena'] = 'cdavid8296803484'; 
        $result = Auth::login($datos);

        $testResult['result'] = array(
            "Token" => bin2hex(openssl_random_pseudo_bytes(16,$val),true),
            "Usuario" => 'CDIM18',
             "Tipo_Usuario" => 'admin',
             "ID_Rol" => 1
             
        );

        $this->assertEquals($testResult,$result);
    
    }

}    

?>