<?php


class PruebaTest extends \PHPUnit\Framework\TestCase
{
    /** @test **/
    public function  test_probar_suma_dos_numero()
    {
        $res = 2 + 2;

        $this->assertEquals(4,$res);
    }
}


?>