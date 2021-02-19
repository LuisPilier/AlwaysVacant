<?php

include($_SERVER['DOCUMENT_ROOT'].'/AlwaysVacant/BackEnd/Class/Vacante.php');

class VacanteTest extends \PHPUnit\Framework\TestCase
{

    protected function setUp(): void {
        $_SERVER['DOCUMENT_ROOT'] = "../../";
        $this->vacante = new Vacante();
    }


    /** @test **/
    public function  test_probar_numero()
    {
        $vacante = new Vacante();

        $num  = $vacante->retornar_numero();


        $this->assertEquals(5,$num);
    }
}


?>