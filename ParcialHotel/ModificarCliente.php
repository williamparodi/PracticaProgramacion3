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
                $telefono = $_POST["telefono"];
                $idConsulta = $_POST["idConsulta"];
                $cliente = new Cliente($nombre,$apellido,$tipoDocumento,$nroDocumento,
                $email,$tipoCliente,$pais,$ciudad,$telefono);
                Cliente::ModificaCliente($cliente,$idConsulta);
            }
        else
        {
            echo json_encode(["error modificacion" => "Datos invalidos"]);
        }
    }
    
}
?>
