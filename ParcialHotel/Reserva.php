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
    public $_estado;

    public function __construct($tipoCliente,$nroCliente,$fechaEntrada,$fechaSalida,$tipoHabitacion,$importeTotal,$estado="Sin Estado")
    {
        $this->_id = rand(1,1000);
        $this->_tipoCliente = $tipoCliente;
        $this->_nroCliente = $nroCliente;
        $this->_fechaEntrada = $fechaEntrada;
        $this->_fechaSalida = $fechaSalida;
        $this->_tipoHabitacion = $tipoHabitacion;
        $this->_importeTotal = $importeTotal;
        if($estado != "Sin Estado")
        {
            $this->_estado = $estado;
        }
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
                    $fechaEntradaFormat = $fechaEntradaValida->format('d/m/Y');
                    $fechaSalidaFormat = $fechaSalidaValida->format('d/m/Y');

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
                $reservaData["_tipoCliente"],
                $reservaData["_nroCliente"],
                $reservaData["_fechaEntrada"],
                $reservaData["_fechaSalida"],
                $reservaData["_tipoHabitacion"],
                $reservaData["_importeTotal"]
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
    
    //------Cancela------------------//
    public static function CancelaUnaReserva($tipoCliente,$nroCliente,$idReserva)
    {
        $rutaHoteles = "json/hoteles.json";
        $ruta = "json/reservas.json";
        $manejadorDeArchivosHoteles = new ManejadorArchivos($rutaHoteles);
        $arrayClientes = $manejadorDeArchivosHoteles->leer();
        $manejadorDeArchivos =new ManejadorArchivos($ruta);
        $arrayReservas = $manejadorDeArchivos->leer();
        $clientes = Cliente::ConvertirArrayEnObjetos($arrayClientes);
        $reservas = Reserva::ConvertirArrayReservaEnObjetos($arrayReservas);
        $flag = false;
        foreach($clientes as $cl)
        {
            if ($cl->Consulta($tipoCliente,$nroCliente)) 
            {
                $flag = true;
                break;
            }
            
        }
        if($flag)
        {
            foreach($reservas as $reserva)
            {
                if($idReserva == $reserva->_id)
                {
                    $reserva->_estado = "Cancelada";
                    $manejadorDeArchivos->modifica($reservas);
                    echo json_encode(["cancelacion reserva" => 'se cancelo la reserva']);
                }
            }
        }
        else
        {
            echo json_encode(["error cliente" => 'no existe cliente']);
        }
        
    }

    //-----------------Ajusta----------------------------

    public static function AjustaReserva($idReserva,$motivo,$importeNuevo)
    {
        $ruta = "json/ajustes.json";
        $rutaReserva = "json/reservas.json";
        $manejadorDeArchivos = new ManejadorArchivos($ruta);
        $manejadorDeArchivosReserva = new ManejadorArchivos($rutaReserva);
        $arrayReservas = $manejadorDeArchivosReserva->leer();
        $arrayAjuste = $manejadorDeArchivos->leer();
        $reservas = Reserva::ConvertirArrayReservaEnObjetos($arrayReservas);
        foreach($reservas as $reserva)
        {
            if($reserva->_id == $idReserva)
            {
                $reserva->_importeTotal = $importeNuevo;
                $arrayAjuste = "Motivo: ".$motivo ."-"."IdReserva: ".$reserva->_id ."-"."importe nuevo: ".$importeNuevo;
                $manejadorDeArchivosReserva->modifica($reservas);
                $manejadorDeArchivos->guardar($arrayAjuste); 
            }
        }
    }


    /*-----------------Consultas------------------------------------------
    a- El total de reservas (importe) por tipo de habitación y fecha en un día en particular
    (se envía por parámetro), si no se pasa fecha, se muestran las del día anterior.*/ 

    public static function ConsultaTotalReservas($tipoHabitacion,$fecha)
    {
        $ruta = "json/reservas.json";
        $manejadorDeArchivos = new ManejadorArchivos($ruta);
        $arrayReservas = $manejadorDeArchivos->leer();
        $reservas = Reserva::ConvertirArrayReservaEnObjetos($arrayReservas);
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
                $fecha = $fecha->format('d/m/Y');
                echo "Fecha ingresada: $fecha";
            }
        }

        foreach($reservas as $reserva)
        {
            if($reserva->_tipoHabitacion == $tipoHabitacion)
            {
                if($fecha == null) 
                {
                    $reservasTotal += $reserva->_importeTotal;
                }
                else
                {
                    if($fecha == $reserva->_fechaEntrada)
                    {
                        $reservasTotal += $reserva->_importeTotal; 
                    }
                }
            }
        }

        return $reservasTotal;
    }

    //-----------------------------------------------------------------------
    //b- El listado de reservas para un cliente en particular.
    public static function ConsultaReservasCliente($nroCliente)
    {
        $reservasCliente = [];
        if($nroCliente != null && !is_nan($nroCliente))
        {
            $ruta = "json/reservas.json";
            $manejadorDeArchivos = new ManejadorArchivos($ruta);
            $arrayReservas = $manejadorDeArchivos->leer();
            $reservas = Reserva::ConvertirArrayReservaEnObjetos($arrayReservas);
            foreach($reservas as $reserva)
            {
                if($reserva->_nroCliente == $nroCliente)
                {
                    $reservasCliente[] = $reserva;
                }
            }
        }

        return $reservasCliente;
    }

    //c- El listado de reservas entre dos fechas ordenado por fecha.
    public static function ConsultaReservasPorFechas($fecha1,$fecha2)
    {
        $ruta = "json/reservas.json";
        $manejadorDeArchivos = new ManejadorArchivos($ruta);
        $arrayReservas = $manejadorDeArchivos->leer();
        $reservas = Reserva::ConvertirArrayReservaEnObjetos($arrayReservas);
        if($fecha1 != NULL && $fecha2 != NULL)
        {
            $fechaEntradaValida = DateTime::createFromFormat('d/m/Y', $fecha1);
            $fechaSalidaValida = DateTime::createFromFormat('d/m/Y', $fecha2);
            if($fechaEntradaValida && $fechaSalidaValida)
            {
                if($fechaEntradaValida < $fechaSalidaValida)
                {
                    $fechaEntradaFormat = $fechaEntradaValida->format('d/m/Y');
                    $fechaSalidaFormat = $fechaSalidaValida->format('d/m/Y');
                    $fecha1 = $fechaEntradaFormat;
                    $fecha2 = $fechaSalidaFormat;
                    var_dump($fecha1);
                    var_dump($fecha2);
                }
                else
                {
                    echo json_encode(['error' => 'La fecha1 nunca puede ser anterior a la fecha2 ']);
                }
                // Filtrar las reservas por fecha en el rango especificado
                $reservasFiltradas = array_filter($reservas, function($reserva) use ($fecha1, $fecha2) 
                {
                    $fechaReserva = DateTime::createFromFormat('d/m/Y', $reserva->_fechaEntrada);
                    return $fechaReserva >= $fecha1 && $fechaReserva <= $fecha2;
                });
            
                // Ordenar las reservas por fecha
                usort($reservasFiltradas, function($a, $b) 
                {
                    $fechaA = $a->_fechaEntrada;
                    $fechaB = $b->_fechaEntrada;
                    return $fechaA <=> $fechaB;
                });
            }
        }
    
        return $reservasFiltradas; 
    }

    //d- El listado de reservas por tipo de habitación.
    public static function ConsultaReservasPorTipo($tipoHabitacion)
    {
        $ruta = "json/reservas.json";
        $manejadorDeArchivos = new ManejadorArchivos($ruta);
        $arrayReservas = $manejadorDeArchivos->leer();
        $reservas = Reserva::ConvertirArrayReservaEnObjetos($arrayReservas);
        if ($tipoHabitacion != NULL) 
        {
            // Filtrar las reservas por tipo de habitación
            $reservasFiltradas = array_filter($reservas, function($reserva) use ($tipoHabitacion) {
                return $reserva->_tipoHabitacion == $tipoHabitacion;
            });
    
            // Ordenar las reservas por fecha (puedes omitir esto si no necesitas ordenarlas)
            usort($reservasFiltradas, function($a, $b) {
                return strcmp($a->_fechaEntrada, $b->_fechaEntrada);
            });
    
            return $reservasFiltradas;
        }
    }

    public static function MostrarReservas($reservas)
    {
        if (count($reservas)>0)
        {
            foreach ($reservas as $reserva) 
            {
                echo "ID de Reserva: " . $reserva->_id . "<br>";
                echo "Tipo de Habitación: " . $reserva->_tipoHabitacion . "<br>";
                echo "Fecha de Entrada: " . $reserva->_fechaEntrada . "<br>";
                echo "Fecha de Salida: " . $reserva->_fechaSalida . "<br>";
                echo "Importe Total: $" . $reserva->_importeTotal . "<br>";
            }
        } 
        else
        {
            echo "No se encontraron reservas.";
        }
    }

    //---------- Selector ------------------------
    public static function SeleccionaConsulta($consulta)
    {
        $consulta = strtolower($consulta);
        switch($consulta)
        {
            case 'a':
                echo json_encode(['Consulta a'=> 'Total de reserva segun fecha : ']);
                echo "<br/>";
                if(isset($_GET['tipoHabitacion']))
                {
                    $tipoHabitacion = $_GET['tipoHabitacion'];
                    
                    if(!isset($_GET['fecha']))
                    {
                        $importeTotal = Reserva::ConsultaTotalReservas($tipoHabitacion,null);
                        echo json_encode(['Total : '=> $importeTotal]);
                    }
                    else
                    {
                        $fecha = $_GET['fecha'];
                        $importeTotal = Reserva::ConsultaTotalReservas($tipoHabitacion,$fecha);
                        echo json_encode(['Importe Total de la fecha '=>$fecha.' Importe: '. $importeTotal]);
                    }
                }
                else
                {
                    echo json_encode(["error" => "Datos invalidos"]);
                }
                break;
            case 'b':
                if(isset($_GET['idCliente']))
                {
                    $idCliente = $_GET['idCliente'];
                    $arrayReservas = Reserva::ConsultaReservasCliente($idCliente);
                    echo json_encode(['Consulta b'=> 'El listado de reservas para un cliente en particular : ']);
                    Reserva::MostrarReservas($arrayReservas);
                }
                else
                {
                    echo json_encode(["error" => "Datos invalidos"]);
                }
                break;
            case 'c':
                if(isset($_GET['fecha1']) && isset($_GET['fecha2']))
                {
                    $fecha1 = $_GET['fecha1'];
                    $fecha2 = $_GET['fecha2'];
                    $arrayFechasFiltradas = Reserva::ConsultaReservasPorFechas($fecha1,$fecha2);
                    echo json_encode(['Consulta c'=> 'El listado de reservas entre dos fechas ordenado por fecha: ']);
                    Reserva::MostrarReservas($arrayFechasFiltradas);
                }
                else
                {
                    echo json_encode(["error" => "Datos invalidos"]);
                }
                break;
            case 'd':
                if(isset($_GET['tipoHabitacion']))
                {
                    $tipoHabitacion = $_GET['tipoHabitacion'];
                    $arrayReservasPorTipo = Reserva::ConsultaReservasPorTipo($tipoHabitacion);
                    Reserva::MostrarReservas($arrayReservasPorTipo);
                }
                else
                {
                    echo json_encode(["error" => "Datos invalidos"]);
                }
                break;
            default:
                echo json_encode(["error consulta" => "Consulta invalida"]);
                break;
        }
    }
}

?>