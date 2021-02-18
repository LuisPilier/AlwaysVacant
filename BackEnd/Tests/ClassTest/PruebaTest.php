<?php


class PruebaTest extends \PHPUnit\Framework\TestCase
{

    protected function setUp(): void {
        $_SERVER['DOCUMENT_ROOT'] = "...";
        //parent::setUp();
    }

    /** @test **/
    public function  test_probar_suma_dos_numero()
    {
        $res = 2 + 2;

        $this->assertEquals(4,$res);

        //echo 'Todo bien 1';
    }
}


?>