<?php

include($_SERVER['DOCUMENT_ROOT'].'Controllers/TokenController.php');


class TokenControllerTest extends \PHPUnit\Framework\TestCase
{
    /** @test **/
    public function test_validar_token()
    {
        $datos['Token'] = 'a79d3d56f6b0a676819ce2f424f3cdcb';
        $result = TokenController::validarToken($datos);

        $testResult = true;

        $this->assertEquals($testResult,$result);
    }
    
}


?>