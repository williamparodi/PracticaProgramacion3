<?php
        /*9- BorrarCliente.php (por DELETE), debe recibir un número el tipo y número de cliente
        y debe realizar la baja de la cuenta (soft-delete, no físicamente) y la foto relacionada a
        ese cliente debe moverse a la carpeta /ImagenesBackupClientes/2023.
        */
require_once "Cliente.php";
class BorrarCliente
{
    public static function BorrarCliente()
    {
        $deleteData = $_GET;
        if(isset($deleteData['tipoCliente']) && isset($deleteData['nroCliente']) && isset($deleteData['nroDni']))
        {
            $tipoCliente = $deleteData['tipoCliente'];
            $nroCliente = $deleteData['nroCliente'];
            $nroDni = $deleteData['nroDni'];
            Cliente::BorrarCliente($nroCliente,$tipoCliente,$nroDni);
            echo json_encode(["borrado"=>'Se borro cliente']);
        }
        else
        {
            echo json_encode(["error borrar" => "Datos invalidos"]);
        }
    }
}
?>