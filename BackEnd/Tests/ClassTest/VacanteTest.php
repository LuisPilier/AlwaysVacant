<?php


class VacanteTest extends \PHPUnit\Framework\TestCase
{

    protected function setUp(): void {
        $_SERVER['DOCUMENT_ROOT'] = "../../";
        $this->vacante = new Vacante();
    }

    
    /** @test **/
    public function  test_probar_numero()
    {
        $num  = $this->vacante->retornar_numero();

        $this->assertEquals(5,$num);

       // echo 'Todo bien 2 ';
    }


    public function test_eliminar_vacante()
    {
        
    }
}


?>