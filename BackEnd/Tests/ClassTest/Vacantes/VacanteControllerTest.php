<?php

include($_SERVER['DOCUMENT_ROOT'].'Controllers/VacanteController.php');


class VacanteControllerTest extends \PHPUnit\Framework\TestCase
{
    /** @test **/
    public function test_guardar_vacante()
    {
        $datos = array();
        
        $datos["Compania"]        = "Google Inc";
        $datos["URL"]             = "Google.com";
        $datos["Posicion"]        = "Mobile Developer";
        $datos["Descripcion"]     = "Desarrollador Android";
        $datos["ID_Categoria"]    = "1";
        $datos["ID_Tipo_Vacante"] = "1";
        $datos["ID_Ciudad"]       = "2"; 
        $datos["Ubicacion"]       = "Av. Kennedy";
        $datos["Email"]           = "davidinojosa5@gmail.com";
        $datos["Token"]           = "0a5108cb44cd8819452bfbf78296cf4f";

        $datos_result  = VacanteController::guardar($datos);

        $testResult = [
            'status' => "ok",
            "result" => array(
                "ID_Vacante" => 1
            )
        ];

        $this->assertEquals($testResult,$datos_result);
    }

    public function test_obtener()
    {
        $datos['ID_Vacante'] = 1;
        $vacante_result = VacanteController::Obtener($datos);

        $vacante_test["ID_Vacante"]= "1";
        $vacante_test["Compania"]= "Amazon";
        $vacante_test["Logo"]= "en-linea.app/AlwaysVacant/BackEnd/Images/603c498371484.png";
        $vacante_test["URL"]= "https=//www.amazon.com/";
        $vacante_test["Posicion"]= "QA";
        $vacante_test["Descripcion"]= "Se necesita persona con experiencia en QA";
        $vacante_test["Codigo_Pais"]= "RD";
        $vacante_test["Nombre"]= "REPUBLICA DOMINICANA ";
        $vacante_test["ID_Ciudad"]= "1";
        $vacante_test["Ciudad"]= "Azua";
        $vacante_test["ID_Categoria"]= "4";
        $vacante_test["Categoria"]= "Engeniering";
        $vacante_test["ID_Tipo_Vacante"]= "2";
        $vacante_test["TipoVacante"]= "Full Time";
        $vacante_test["Email"]= "";
        $vacante_test["Ubicacion"]= "San Isidro";
     
        $this->assertEquals($vacante_test,$vacante_result);

    }

    public function test_Vacantes_Categoria()
    {
        $datos['ID_Categoria'] = 1;
        $datos["Token"]        = "0a5108cb44cd8819452bfbf78296cf4f";
        $vacante_result = VacanteController::Vacantes_Categoria($datos);

        $vacante_test["ID_Vacante"]= "1";
        $vacante_test["Compania"]= "Amazon";
        $vacante_test["Logo"]= "en-linea.app/AlwaysVacant/BackEnd/Images/603c498371484.png";
        $vacante_test["URL"]= "https=//www.amazon.com/";
        $vacante_test["Posicion"]= "QA";
        $vacante_test["Descripcion"]= "Se necesita persona con experiencia en QA";
        $vacante_test["Codigo_Pais"]= "RD";
        $vacante_test["Nombre"]= "REPUBLICA DOMINICANA ";
        $vacante_test["ID_Ciudad"]= "1";
        $vacante_test["Ciudad"]= "Azua";
        $vacante_test["ID_Categoria"]= "4";
        $vacante_test["Categoria"]= "Engeniering";
        $vacante_test["ID_Tipo_Vacante"]= "2";
        $vacante_test["TipoVacante"]= "Full Time";
        $vacante_test["Email"]= "";
        $vacante_test["Ubicacion"]= "San Isidro";

        
        $this->assertEquals($vacante_test,$vacante_result);

    }

    public function test_Actualizar()
    {
        $datos["ID_Vacante"]      = "7";
        $datos["Compania"]        = "Google Inc";
        $datos["URL"]             = "Google.com";
        $datos["Posicion"]        = "Mobile Developer";
        $datos["Descripcion"]     = "Desarrollador Android";
        $datos["ID_Categoria"]    = "2";
        $datos["ID_Tipo_Vacante"] = "1";
        $datos["ID_Ciudad"]       = "2"; 
        $datos["Ubicacion"]       = "2";
        $datos["Email"]           = "davidinojosa5@gmail.com";
        $datos["Token"]           = "0a5108cb44cd8819452bfbf78296cf4f";

        $result = VacanteController::Actualizar($datos);

        $testResult = [
            'status' => "ok",
            "result" => array(
                "ID_Vacante" => 7
            )
        ];
        $this->assertEquals($testResult,$result);

    }

    public function test_Eliminar()
    {
        $datos["ID_Vacante"]      = "1";
        $datos["Token"]           = "0a5108cb44cd8819452bfbf78296cf4f";


        $result = VacanteController::Eliminar($datos);

        $testResult = [
            'status' => "ok",
            "result" => array(
                "ID_Vacante" => 7
            )
        ];
        $this->assertEquals($testResult,$result);

    }

}


?>