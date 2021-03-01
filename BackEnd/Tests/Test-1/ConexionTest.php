<?php


class ConexionTest extends \PHPUnit\Framework\TestCase
{
    /** @test **/
    public function  test_x()
    {
        include($_SERVER['DOCUMENT_ROOT'].'Models/Conexion.php');
        $conn = new Conexion();
        $password = md5('1234');
        $passwordTest = $conn->encriptar('1234');

    }
}


?>