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
        $datos["Ubicacion"]       = "Av. Kennedy";
        $datos["Email"]           = "davidinojosa5@gmail.com";

        $num  = $vacante->guardar($datos);

        /*$testResult = [
            'status' => "ok",
            "result" => array(
                "ID_Vacante" => 1
            )
        ];*/

        $testResult = 1;

        $this->assertEquals($testResult,$num);
    }

    public function test_procesar_imagen()
    {
        $vacante = new Vacante();

        $logo = 'data:image/png;base64,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';

        $ruta_imagen = $vacante->procesarImagen($logo);
        $ruta_imagen_test = 'localhost/AlwaysVacant/BackEnd/Images/603c498371484.png';


        $this->assertEquals($ruta_imagen_test,$ruta_imagen);

    }

    public function test_obtener()
    {
        $vacante = new Vacante();

        $datos['ID_Vacante'] = 1;
        $vacante_result = $vacante->Obtener($datos);

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
        $vacante = new Vacante();

        $datos['ID_Categoria'] = 1;
        $vacante_result = $vacante->Vacantes_Categoria($datos);

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
        $vacante = new Vacante();

        $datos["ID_Vacante"]      = "1";
        $datos["Compania"]        = "Google Inc";
        $datos["URL"]             = "Google.com";
        $datos["Posicion"]        = "Mobile Developer";
        $datos["Descripcion"]     = "Desarrollador Android";
        $datos["ID_Categoria"]    = "2";
        $datos["ID_Tipo_Vacante"] = "1";
        $datos["ID_Ciudad"]       = "2"; 
        $datos["Ubicacion"]       = "2";
        $datos["Email"]           = "davidinojosa5@gmail.com";
        $datos["Token"]           = "25ff646b0befa1ae23a20f91127598d0";

        $num_result = $vacante->Actualizar($datos);
        $num_test = 1;
        $this->assertEquals($num_test,$num_result);

    }

    public function test_Eliminar()
    {
        $vacante = new Vacante();

        $datos["ID_Vacante"]      = "1";

        $num_result = $vacante->Eliminar($datos);
        $num_test = 1;
        $this->assertEquals($num_test,$num_result);
    }

}


?>