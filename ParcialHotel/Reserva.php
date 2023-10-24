<?php
require_once "Cliente.php";
/*a- ReservaHabitacion.php: (por POST) se recibe el Tipo de Cliente, Nro de Cliente,
Fecha de Entrada, Fecha de Salida, Tipo de Habitación (Simple, Doble, Suite), y el
importe total de la reserva. Si el cliente existe en hoteles.json, se registra la reserva en
el archivo reservas.json con un id autoincremental). Si el cliente no existe, informar el
error.
b- Completar la reserva con imagen de confirmación de reserva con el nombre: Tipo de
Cliente, Nro. de Cliente e Id de Reserva, guardando la imagen en la carpeta
/ImagenesDeReservas2023.*/
class Reserva 
{
    public $_id;
    public $_tipoCliente;
    public $_nroCliente;
    public $_fechaEntrada;
    public $_fechaSalida;
    public $_tipoHabitacion;
    public $_importeTotal;
    public static $idAutoincremental = 1;

    public function __construct($tipoCliente,$nroCliente,$fechaEntrada,$fechaSalida,$tipoHabitacion,$importeTotal)
    {
        $this->_id = ++Reserva::$idAutoincremental;
        $this->_tipoCliente = $tipoCliente;
        $this->_nroCliente = $nroCliente;
        $this->_fechaEntrada = $fechaEntrada;
        $this->_fechaSalida = $fechaSalida;
        $this->_tipoHabitacion = $tipoHabitacion;
        $this->_importeTotal = $importeTotal;
    }
    
    //---getter y setters----
    public function GetNroCliente()
    {
        return $this->_nroCliente;
    }

    public function GetTipoCliente()
    {
        return $this->_tipoCliente;
    }

    public function SetId($id)
    {
        $this->_id = $id;
    }
    
    public function Equals($cliente)
    {
        $retorno = false;
        if($cliente != NULL)
        {
            if($this->_nroCliente == $cliente->GetId() && $this->GetTipoCliente() == $cliente->GetTipoCliente())
            {
                $retorno = true;
            }
        }
        return $retorno;
    }

    public static function InsertaUnaReserva($reserva)
    {
        $rutaHoteles = "json/hoteles.json";
        $ruta = "json/reservas.json";
        $destinoImagen = "ImagenesDeReservas2023/";
        $manejadorDeArchivosHoteles = new ManejadorArchivos($rutaHoteles);
        $arrayClientes = $manejadorDeArchivosHoteles->leer();
        $clientes = Cliente::ConvertirArrayEnObjetos($arrayClientes);
        if (Reserva::BuscarCliente($clientes, $reserva)) 
        {
            $manejadorDeArchivos =new ManejadorArchivos($ruta);
            //$arrayReservas = $manejadorDeArchivos->leer();
            //$reservas = Reserva::ConvertirArrayReservaEnObjetos($arrayReservas);
            $manejadorDeArchivos->guardar($reserva);
            $manejadorDeArchivos->guardarImagenReserva($destinoImagen, $reserva);
            echo json_encode(['exito' => 'La reserva se ingreso al sistema']);
        }
        else
        {
            echo json_encode(['error' => 'No existe ese cliente,no se pudo ingresar la reserva']);
        }
    }

    public static function ConvertirArrayReservaEnObjetos($arrayReservas)
    {
        $reservas = [];
        foreach ($arrayReservas as $reservaData) 
        {
            $reserva = new Reserva(
                $reservaData["tipoCliente"],
                $reservaData["nroCliente"],
                $reservaData["fechaEntrada"],
                $reservaData["fechaSalida"],
                $reservaData["tipoHabitacion"],
                $reservaData["importe"]
            );
            $reserva->SetId($reservaData["_id"]);
            $reservas[] = $reserva;
        }
        return $reservas;
    }

    public static function BuscarCliente($clientes, $nuevaReserva)
    {
        $retorno = false;
        foreach ($clientes as $cl) 
        {
            if ($nuevaReserva->Equals($cl)) 
            {
                $retorno = true;
                break;
            }
        }
        return $retorno;
    }

}

?>