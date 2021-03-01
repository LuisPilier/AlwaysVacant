<?php

include($_SERVER['DOCUMENT_ROOT'].'Models/Vacante.php');


class VacanteTest extends \PHPUnit\Framework\TestCase
{
    /** @test **/
    public function test_guardar_vacante()
    {
        $vacante = new Vacante();

        $datos = array();
        
        $datos["Compania"]        = "Google Inc";
        $datos["URL"]             = "Google.com";
        $datos["Posicion"]        = "Mobile Developer";
        $datos["Descripcion"]     = "Desarrollador Android";
        $datos["ID_Categoria"]    = "1";
        $datos["ID_Tipo_Vacante"] = "1";
        $datos["ID_Ciudad"]       = "2"; 
        $datos["Ubicacion"]       = "2";
        $datos["Email"]           = "davidinojosa5@gmail.com";
        $datos["Token"]           = "25ff646b0befa1ae23a20f91127598d0";

        $num  = $vacante->guardar($datos);

        $testResult = [
            'status' => "ok",
            "result" => array(
                "ID_Vacante" => 1
            )
        ];

        $this->assertEquals($testResult,$datos);
    }

    public function test_procesar_imagen()
    {

    }
}


?>