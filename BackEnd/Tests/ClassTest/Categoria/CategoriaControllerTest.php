<?php

include($_SERVER['DOCUMENT_ROOT'].'Models/Categoria.php');


class CategoriaControllerTest extends \PHPUnit\Framework\TestCase
{
    /** @test **/
    public function test_guardar_categoria()
    {
        $datos = array();
        $datos["Nombre"] = "Categoria I";
        $datos['Token'] = 'a79d3d56f6b0a676819ce2f424f3cdcb';

        $result = CategoriaController::guardar($datos);

        $testResult['Result'] = [
            'ID_Categoria' => 1
        ];

        $testResult = 1;

        $this->assertEquals($testResult,$result);
    }

    public function test_obtener()
    {
        $datos['ID_Categoria'] = 1;
        $datos['Token'] = 'a79d3d56f6b0a676819ce2f424f3cdcb';
        $categoria_result = CategoriaController::Obtener($datos);

        $testResult['ID_Categoria'] = 1;
        $testResult['Nombre'] = 'Categoria I';

     
        $this->assertEquals($testResult,$categoria_result);
    }

    public function test_Actualizar()
    {
        $datos["ID_Categoria"] = "1";
        $datos["Nombre"]       = "Categoria II";

        $result = CategoriaController::Actualizar($datos);

        $testResult = [
            'status' => "ok",
            "result" => array(
                "ID_Vacante" => "1",
                "Nombre" => "Categoria II"
            )
        ];

        $this->assertEquals($result,$testResult);

    }

    public function test_Eliminar()
    {
        $datos["ID_Categoria"]      = "1";

        $result = CategoriaController::Eliminar($datos);
        
        $testResult = [
            'status' => "ok",
            "result" => array(
                "ID_Vacante" => "1"
            )
        ];

        $this->assertEquals($testResult,$result);
    }

}


?>