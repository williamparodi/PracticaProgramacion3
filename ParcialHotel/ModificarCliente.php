<?php
/*5- ModificarCliente.php (por PUT)
Debe recibir todos los datos propios de un cliente; si dicho cliente existe (comparar por
Tipo y Nro. de Cliente) se modifica, de lo contrario informar que no existe ese cliente.
*/
require_once "Cliente.php";

class ModificarCliente
{
    public static function ModificarCliente()
    {
        $inputData = file_get_contents("php://input");

        // Decodificar los datos JSON en un arreglo asociativo
        $postData = json_decode($inputData, true);
        if(isset($postData["_nombre"]) && isset($postData["_apellido"]) && isset($postData["_tipoDocumento"]) 
            && isset($postData["_nroDocumento"]) && isset($postData["_email"]) 
            && isset($postData["_tipoCliente"]) && isset($postData["_pais"]) && isset($postData["_ciudad"]) && isset($postData["_telefono"]))
            {
                $nombre = $postData["_nombre"];
                $apellido = $postData["_apellido"];
                $tipoDocumento = $postData["_tipoDocumento"];
                $nroDocumento = $postData["_nroDocumento"];
                $email = $postData["_email"];
                $tipoCliente = $postData["_tipoCliente"];
                $pais = $postData["_pais"];
                $ciudad = $postData["_ciudad"];
                $telefono = $postData["_telefono"];
                $idConsulta = $postData["idConsulta"];
                $cliente = new Cliente($nombre,$apellido,$tipoDocumento,$nroDocumento,
                $email,$tipoCliente,$pais,$ciudad,$telefono);
                $cliente->SetId($idConsulta);
                Cliente::ModificaCliente($cliente,$idConsulta);
            }
        else
        {
            echo json_encode(["error modificacion" => "Datos invalidos"]);
        }
    }
    
}
?>
