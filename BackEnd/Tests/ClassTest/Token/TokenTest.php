<?php

include($_SERVER['DOCUMENT_ROOT'].'Models/Token.php');


class TokenTest extends \PHPUnit\Framework\TestCase
{
    /** @test **/
    public function test_guardar_token()
    {
        $token = new Token();
        $datos['ID_Usuario'] = '1001';
        $result  = $token->guardar($datos);

        $testResult = bin2hex(openssl_random_pseudo_bytes(16,$val),true);

        $this->assertEquals($testResult,$result);
    }

    public function test_obtener()
    {
        $token = new Token();

        $datos = 'a79d3d56f6b0a676819ce2f424f3cdcb';
        $result = Token::Obtener($datos);

        $testResult['ID_Token']   = '80';
        $testResult['ID_Usuario'] = '1001';
        $testResult['Estado']     = 'Activo';
        $testResult['Fecha']      = '2021-03-01';
        $testResult['Token']      = 'a79d3d56f6b0a676819ce2f424f3cdcb';
        $testResult['ID_Rol']     = '2';
        $testResult['Usuario']    = 'CDIM18';
        $testResult['Nombre']     = 'Postman';


        $this->assertEquals($testResult,$result);
    }

    public function test_Actualizar()
    {
        $token = new Token();

        $fecha = 'Y-m-d';
        $result = $token->Actualizar($fecha);
        $testResult = 10;
        
        $this->assertEquals($testResult,$result);
    }

    public function test_Eliminar()
    {
        $token = new Token();

        $fecha = 'Y-m-d';
        $result = $token->Eliminar($fecha);
        $testResult = 10;
        
        $this->assertEquals($testResult,$result);
    }

}


?>