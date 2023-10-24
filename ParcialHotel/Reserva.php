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

    public function ValidaFechas($fechaEntrada,$fechaSalida)
    {
        $retorno = false;
        if($fechaEntrada != NULL && $fechaSalida != NULL)
        {
            $fechaEntradaValida = DateTime::createFromFormat('d/m/Y', $fechaEntrada);
            $fechaSalidaValida = DateTime::createFromFormat('d/m/Y', $fechaSalida);
            if($fechaEntradaValida && $fechaSalidaValida)
            {
                if($fechaEntradaValida < $fechaSalidaValida)
                {
                    $fechaEntradaFormat = $fechaEntradaValida->format("Y-m-d");
                    $fechaSalidaFormat = $fechaSalidaValida->format("Y-m-d");

                    $this->_fechaEntrada = $fechaEntradaFormat;
                    $this->_fechaSalida = $fechaSalidaFormat;
                    $retorno = true;
                }
                else
                {
                    echo json_encode(['error' => 'La fecha de salida nunca puede ser anterior a la fecha de entrada']);
                }
                
            }
            else
            {
                echo json_encode(['error' => 'Error en formato fecha ingrese formato DD/MM/YYYY ']);
            }
        }
        return $retorno;
    }

    public static function InsertaUnaReserva($reserva)
    {
        if($reserva->ValidaFechas($reserva->_fechaEntrada,$reserva->_fechaSalida))
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
        else
        {
            echo json_encode(['error' => 'Error al ingresar los datos']);
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
    
    /*Consultas
    a- El total de reservas (importe) por tipo de habitación y fecha en un día en particular
    (se envía por parámetro), si no se pasa fecha, se muestran las del día anterior.*/ 

    public static function ConsultaTotalReservas($tipoHabitacion,$fecha)
    {
        $ruta = "json/reservas.json";
        $manejadorDeArchivos = new ManejadorArchivos($ruta);
        $arrayReservas = $manejadorDeArchivos->leer();
        $reservasTotal = 0;
        $fechaActual = new DateTime();

        if($fecha === null)
        {
            $fechaActual->modify('-1 day');
        }
        else
        {
            $fecha = DateTime::createFromFormat('d/m/Y', $fecha);
            if ($fecha) 
            {
                $fecha = $fecha->format('Y-m-d');
            }
        }

        foreach($arrayReservas as $reserva)
        {
            if($reserva->_tipoHabitacion == $tipoHabitacion)
            {
                if($fecha === null || $reserva->_fechaEntrada == $fecha)
                {
                    $reservasTotal += $reserva->_importe;
                }
            }
        }

        return $reservasTotal;
    }
     //-----------------------------------------------------------------------
    //b- El listado de reservas para un cliente en particular.
    public static function ConsultaReservasCliente($nroCliente)
    {
        $arrayReservasCliente = [];
        if($nroCliente != null && !is_nan($nroCliente))
        {
            $ruta = "json/reservas.json";
            $manejadorDeArchivos = new ManejadorArchivos($ruta);
            $arrayReservas = $manejadorDeArchivos->leer();
            foreach($arrayReservas as $reserva)
            {
                if($reserva->_nroCliente == $nroCliente)
                {
                    $arrayReservasCliente[] = $reserva;
                }
            }
        }

        return $arrayReservasCliente;
    }

    //c- El listado de reservas entre dos fechas ordenado por fecha.
    public static function ConsultaReservasPorFechas($fecha1,$fecha2)
    {
        $ruta = "json/reservas.json";
        $manejadorDeArchivos = new ManejadorArchivos($ruta);
        $arrayReservas = $manejadorDeArchivos->leer();
        
        // Filtrar las reservas por fecha en el rango especificado
        $reservasFiltradas = array_filter($arrayReservas, function($reserva) use ($fecha1, $fecha2) 
        {
            $fechaReserva = DateTime::createFromFormat('d/m/Y', $reserva->_fechaEntrada);
            return $fechaReserva >= $fecha1 && $fechaReserva <= $fecha2;
        });
    
        // Ordenar las reservas por fecha
        usort($reservasFiltradas, function($a, $b) 
        {
            $fechaA = DateTime::createFromFormat('d/m/Y', $a->_fechaEntrada);
            $fechaB = DateTime::createFromFormat('d/m/Y', $b->_fechaEntrada);
            return $fechaA <=> $fechaB;
        });
    
        return $reservasFiltradas; 
    }

    //d- El listado de reservas por tipo de habitación.
    public static function ConsultaReservasPorTipo($tipoHabitacion)
    {
        $ruta = "json/reservas.json";
        $manejadorDeArchivos = new ManejadorArchivos($ruta);
        $arrayReservas = $manejadorDeArchivos->leer();
        if ($tipoHabitacion != NULL) 
        {
            // Filtrar las reservas por tipo de habitación
            $reservasFiltradas = array_filter($arrayReservas, function($reserva) use ($tipoHabitacion) {
                return $reserva->_tipoHabitacion == $tipoHabitacion;
            });
    
            // Ordenar las reservas por fecha (puedes omitir esto si no necesitas ordenarlas)
            usort($reservasFiltradas, function($a, $b) {
                return strcmp($a->_fechaEntrada, $b->_fechaEntrada);
            });
    
            return $reservasFiltradas;
        }
    }
}

?>