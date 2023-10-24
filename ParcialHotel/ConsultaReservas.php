<?php
/*4- ConsultaReservas.php: (por GET)
Datos a consultar:
a- El total de reservas (importe) por tipo de habitación y fecha en un día en particular
(se envía por parámetro), si no se pasa fecha, se muestran las del día anterior.
b- El listado de reservas para un cliente en particular.
c- El listado de reservas entre dos fechas ordenado por fecha.
d- El listado de reservas por tipo de habitación.*/
require_once "Reserva.php";
class ConsultaReservas
{
    public static function ConsultaReservas()
    {
        $consulta = $_GET["consulta"];
        var_dump($consulta);
        if(isset($_GET["consulta"]))
        {
            $consulta = $_GET["consulta"];
            Reserva::SeleccionaConsulta($consulta);
        }
        else
        {
            echo json_encode(['error'=> 'datos invalidos']);
        }
    }
}

?>