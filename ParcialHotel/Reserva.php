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
    
    /*estoy aca
    public function VereficaCliente($reserva)
    {
        if()
    }
    */


    public static function InsertaUnaReserva($reserva)
    {
        $rutaHoteles = "json/hoteles.json";
        $ruta = "json/reservas.json";
        $destinoImagen = "ImagenesDeReservas/2023/";
        $manejadorDeArchivosHoteles = new ManejadorArchivos($rutaHoteles);
        $arrayClientes = $manejadorDeArchivosHoteles->leer();
        $clientes = Cliente::ConvertirArrayEnObjetos($arrayClientes);
        if (Cliente::ClienteExiste($clientes, $reserva)) 
        {
            $manejadorDeArchivos =new ManejadorArchivos($ruta);
            $arrayReservas = $manejadorDeArchivos->leer();
            $manejadorDeArchivos->guardar($reserva);
            $manejadorDeArchivos->guardarImagenReserva($destinoImagen, $reserva);
            echo json_encode(['exito' => 'La reserva se ingresó al sistema']);
        }
        else
        {
            echo json_encode(['error' => 'No existe ese cliente,no se pudo ingresar la reserva']);
        }
    }

}

?>