<?php
/*a- ReservaHabitacion.php: (por POST) se recibe el Tipo de Cliente, Nro de Cliente,
Fecha de Entrada, Fecha de Salida, Tipo de Habitación (Simple, Doble, Suite), y el
importe total de la reserva. Si el cliente existe en hoteles.json, se registra la reserva en
el archivo reservas.json con un id autoincremental). Si el cliente no existe, informar el
error*/
require_once "Reserva.php";
class ReservaHabitacion
{
    public static function AltaReserva()
    {
        if(isset($_POST['tipoCliente']) && isset($_POST['nroCliente'])&& isset($_POST['fechaEntrada']) 
        && isset($_POST['fechaSalida']) && isset($_POST['tipoHabitacion'])&& isset($_POST['importe']))
        {
            $tipoCliente = $_POST['tipoCliente'];
            $nroCliente = $_POST['nroCliente'];
            $fechaEntrada = $_POST['fechaEntrada'];
            $fechaSalida = $_POST['fechaSalida'];
            $tipoHabitacion = $_POST['tipoHabitacion'];
            $importe = $_POST['importe'];
            $reserva = new Reserva($tipoCliente,$nroCliente,$fechaEntrada,$fechaSalida,$tipoHabitacion,$importe);
            Reserva::InsertaUnaReserva($reserva);
        }
        else
        {
            echo json_encode(["error alta" => "Datos invalidos"]);
        }
    }
}
 
?>