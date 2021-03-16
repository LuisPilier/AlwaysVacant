<?php

include($_SERVER['DOCUMENT_ROOT'].'Models/Categoria.php');


class CategoriaTest extends \PHPUnit\Framework\TestCase
{
    /** @test **/
    public function test_guardar_categoria()
    {
        $categoria = new Categoria();

        $datos = array();
        $datos["Nombre"] = "Categoria I";

        $num  = $categoria->guardar($datos);

        $testResult = 1;

        $this->assertEquals($testResult,$num);
    }

    public function test_obtener()
    {
        $categoria = new Categoria();

        $datos['ID_Categoria'] = 1;
        $categoria_result = $categoria->Obtener($datos);

        $categoria_test["ID_Vacante"]= "1";
     
        $this->assertEquals($categoria_test,$categoria_result);

    }

    public function test_Actualizar()
    {
        $categoria = new Categoria();

        $datos["ID_Categoria"]      = "1";
        $datos["Nombre"]        = "Google Inc";

        $num_result = $categoria->Actualizar($datos);
        $num_test = 1;
        $this->assertEquals($num_test,$num_result);

    }

    public function test_Eliminar()
    {
        $categoria = new Categoria();

        $datos["ID_Categoria"]      = "1";

        $num_result = $categoria->Eliminar($datos);
        $num_test = 1;
        $this->assertEquals($num_test,$num_result);
    }

}


?>