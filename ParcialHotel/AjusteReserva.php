<?php
/*7- AjusteReserva.php (por POST),
Se ingresa el número de reserva afectada al ajuste y el motivo del mismo. El número de
reserva debe existir.
Guardar en el archivo ajustes.json
Actualiza en el estado de la reserva en el archivo reservas.json*/ 
require_once "Reserva.php";
class AjusteReserva
{
    public static function AjusteReserva()
    {
        if(isset($_POST['importe']) && isset($_POST['idReserva']) && isset($_POST['inflacion']))
        {
            $importe = $_POST['importe'];
            $idReserva = $_POST['idReserva'];
            $motivo = $_POST['motivo'];
            Reserva::AjustaReserva($idReserva,$motivo,$importe);
            echo json_encode(["ajuste"=>'Se ajuste el importe ']);
        }
        else
        {
            echo json_encode(["error"=>'Datos invalidos']);
        }
    }
}
?>