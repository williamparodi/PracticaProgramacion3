<?php
require_once "Cliente.php";

class ClienteAlta
{
    public static function AltaCliente()
    {
        if(isset($_POST["_nombre"]) && isset($_POST["_apellido"]) && isset($_POST["_tipoDocumento"]) 
            && isset($_POST["_nroDocumento"]) && isset($_POST["_email"]) 
            && isset($_POST["_tipoCliente"]) && isset($_POST["_pais"]) && isset($_POST["_ciudad"]) && isset($_POST["_telefono"]))
            {
                $nombre = $_POST["_nombre"];
                $apellido = $_POST["_apellido"];
                $tipoDocumento = $_POST["_tipoDocumento"];
                $nroDocumento = $_POST["_nroDocumento"];
                $email = $_POST["_email"];
                $tipoCliente = $_POST["_tipoCliente"];
                $pais = $_POST["_pais"];
                $ciudad = $_POST["_ciudad"];
                $telefono = $_POST["_telefono"];
                $cliente = new Cliente($nombre,$apellido,$tipoDocumento,$nroDocumento,
                $email,$tipoCliente,$pais,$ciudad,$telefono);
                Cliente::InsertaUnCliente($cliente);
            }
        else
        {
            echo json_encode(["error alta" => "Datos invalidos"]);
        }
    }

    
}

?>