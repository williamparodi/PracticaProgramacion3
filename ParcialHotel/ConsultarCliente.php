<?php

?>
<?php
/*
ConsultarCliente.php: (por POST) Se ingresa Tipo y Nro. de Cliente, si coincide con
algún registro del archivo hoteles.json, retornar el país, ciudad y teléfono del cliente/s.
De lo contrario informar si no existe la combinación de nro y tipo de cliente o, si existe
el número y no el tipo para dicho número, el mensaje: “tipo de cliente incorrecto”.*/
require_once "Cliente.php";
class ConsultarCliente
{
    public static function ConsultarCliente()
    {
        if(isset($_POST['tipo']) && isset($_POST['nroCliente']))
        {
            $tipo = $_POST['tipo'];
            $nroCliente = $_POST['nroCliente'];
            Cliente::RealizaConsulta($tipo,$nroCliente);
        }
        else
        {
            echo json_encode(["error alta" => "Datos invalidos"]);
        }
    }
}

?>

