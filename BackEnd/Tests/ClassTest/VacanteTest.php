<?php

include($_SERVER['DOCUMENT_ROOT'].'/AlwaysVacant/BackEnd/Class/Vacante.php');

class VacanteTest extends \PHPUnit\Framework\TestCase
{
    /** @test **/
    public function  test_probar_numero()
    {
        $vacante = new Vacante();

        $num  = $vacante->retornar_numero();

        $this->assertEquals(4,$num);
    }
}


?>