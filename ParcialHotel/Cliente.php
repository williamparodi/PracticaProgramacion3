<?php

use Cliente as GlobalCliente;

require_once "ManejadorArchivos.php";
class Cliente
{
    public $_id;
    public $_nombre;
    public $_apellido;
    public $_tipoDocumento;
    public $_nroDocumento;
    public $_email;
    public $_tipoCliente;
    public $_pais;
    public $_ciudad;
    public $_telefono;

    public function __construct($nombre,$apellido,$tipoDoc,$nroDocumento,$email,$tipoCliente,$pais,$ciudad,$telefono)
    {
        $this->_id = rand(100000,999999);
        $this->_nombre = $nombre;
        $this->_apellido = $apellido;
        $this->_tipoDocumento =$tipoDoc;
        $this->_nroDocumento = $nroDocumento;
        $this->_email = $email;
        $this->_tipoCliente = $tipoCliente;
        $this->_pais = $pais;
        $this->_ciudad = $ciudad;
        $this->_telefono = $telefono;
    }

    // ----Setters y Getters 
    public function GetNombre()
    {
        return $this->_nombre;
    }

    public function GetTipoCliente()
    {
        return $this->_tipoCliente;
    }

    public function SetId($id)
    {
        $this->_id = $id;
    }

    public function GetId()
    {
        return $this->_id;
    }

    //-------- Alta Cliente-------------
    public static function InsertaUnCliente($nuevoCliente)
    {
        if(Cliente::ValidaCliente($nuevoCliente))
        {
            $ruta = "json/hoteles.json";
            $destinoImagen = "ImagenesDeClientes/2023/";
            $manejadorDeArchivos = new ManejadorArchivos($ruta);
            $arrayClientes = $manejadorDeArchivos->leer();
            $clientes = Cliente::ConvertirArrayEnObjetos($arrayClientes);
            if (!Cliente::ClienteExiste($clientes, $nuevoCliente)) 
            {
                $manejadorDeArchivos->guardar($nuevoCliente);
                $manejadorDeArchivos->guardarImagen($destinoImagen, $nuevoCliente);
                echo json_encode(['exito' => 'El cliente se ingreso al sistema']);
            }
            else
            {
                echo json_encode(['error' => 'El cliente ya esta en el hotel, elija modificar los datos']);
            }
        }
    }

    public function Equals($cliente)
    {
        $retorno = false;
        if($cliente != NULL)
        {
            if($this->GetNombre() == $cliente->GetNombre() && $this->GetTipoCliente() == $cliente->GetTipoCliente())
            {
                $retorno = true;
            }
        }
        return $retorno;
    }

    public static function ClienteExiste($clientes, $nuevoCliente)
    {
        $retorno = false;
        foreach ($clientes as $cliente) 
        {
            if ($cliente instanceof Cliente && $cliente->Equals($nuevoCliente)) 
            {
                $retorno = true;
                break;
            }
        }
        return $retorno;
    }
    
    public static function ConvertirArrayEnObjetos($arrayClientes)
    {
        $clientes = [];
        foreach ($arrayClientes as $clienteData) 
        {
            $cliente = new Cliente(
                $clienteData["_nombre"],
                $clienteData["_apellido"],
                $clienteData["_tipoDocumento"],
                $clienteData["_nroDocumento"],
                $clienteData["_email"],
                $clienteData["_tipoCliente"],
                $clienteData["_pais"],
                $clienteData["_ciudad"],
                $clienteData["_telefono"]
            );
            $cliente->SetId($clienteData["_id"]);
            $clientes[] = $cliente;
        }
        return $clientes;
    }
    /*
    ConsultarCliente.php: (por POST) Se ingresa Tipo y Nro. de Cliente, si coincide con
    algún registro del archivo hoteles.json, retornar el país, ciudad y teléfono del cliente/s.
    De lo contrario informar si no existe la combinación de nro y tipo de cliente o, si existe
    el número y no el tipo para dicho número, el mensaje: “tipo de cliente incorrecto”.*/

    public function Consulta($tipo,$nroCliente)
    {
        $retorno = false;
        if($tipo != NULL && $nroCliente != NULL)
        {
            if($this->_id == $nroCliente  && $this->_tipoCliente == $tipo)
            {
                $retorno = true;
            }
        }
        return $retorno;
    }

    public static function ConsultaExisteCliente($clientes,$tipo,$nroCliente)
    {
        $flag = 0;
        $pais = "";
        $ciudad = "";
        $telefono = "";
        foreach ($clientes as $cliente) 
        {
            if ($cliente instanceof Cliente && $cliente->Consulta($tipo,$nroCliente)) 
            {
                $pais = $cliente->_pais;
                $ciudad = $cliente->_ciudad;
                $telefono = $cliente->_telefono;
                $flag = 1;
                break;
            }
            else if($cliente->_id == $nroCliente && $cliente->_tipoCliente != $tipo)
            {
                $flag = 2;
                break;
            }
        }
        if($flag == 1)
        {
            echo json_encode(['Consulta cliente:'=> 'Pais: '.$pais. ' Ciudad: '.$ciudad .' Telefono: '. $telefono]);
        }
        else if($flag == 2)
        {   
            echo json_encode(['Consulta cliente'=> 'Tipo de cliente erroneo']);
        }
        else 
        {
            echo json_encode(['Error'=>'No existe ese cliente']);
        }
    }

    public static function RealizaConsulta($tipo,$nroCliente)
    {
        if(is_string($tipo) && !is_nan($nroCliente))
        {
            $ruta = "json/hoteles.json";
            $manejadorDeArchivos = new ManejadorArchivos($ruta);
            $arrayClientes = $manejadorDeArchivos->leer();
            $clientes = Cliente::ConvertirArrayEnObjetos($arrayClientes);
            Cliente::ConsultaExisteCliente($clientes,$tipo,$nroCliente);
        }
        else
        {
            echo json_encode(["Error al consultar"=>'tipo o nro incorrecto']);
        }

    }
    ///---------- Modficación -----------------//
    public static function ModificaCliente($cliente,$idConsulta)
    {
        if(Cliente::ValidaCliente($cliente))
        {
            $ruta = "json/hoteles.json";
            $manejadorDeArchivos = new ManejadorArchivos($ruta);
            $arrayClientes = $manejadorDeArchivos->leer();
            $clientes = Cliente::ConvertirArrayEnObjetos($arrayClientes);
            $flag = false;
            foreach($clientes as $cl)
            {
                if($cl->Consulta($cliente->GetTipoCliente(),$idConsulta))
                {
                    $cl->SetId($idConsulta);
                    $cl->_nombre = $cliente->_nombre;
                    $cl->_apellido = $cliente->_apellido;
                    $cl->_tipoDocumento = $cliente->_tipoDocumento;
                    $cl->_nroDocumento = $cliente->_nroDocumento;
                    $cl->_email = $cliente->_email;
                    $cl->_tipoCliente = $cliente->_tipoCliente;
                    $cl->_pais = $cliente->_pais;
                    $cl->_cuidad = $cliente->_ciudad;
                    $cl->_telefono = $cliente->_telefono;
                    $manejadorDeArchivos->modifica($cl);
                    $flag = true;
                    break;
                }
            }

            if($flag)
            {
                echo json_encode(['exito'=> 'Modificacion exitosa']);
            }
            else
            {
                echo json_encode(['error'=> 'No se encuentra el cliente']);
            }
        
        }
    } 
     ///--------borrar ----------------
        /*9- BorrarCliente.php (por DELETE), debe recibir un número el tipo y número de cliente
        y debe realizar la baja de la cuenta (soft-delete, no físicamente) y la foto relacionada a
        ese cliente debe moverse a la carpeta /ImagenesBackupClientes/2023.
        */
    public static function BorrarCliente($nroCliente,$tipoCliente,$nroDni)
    {
        $ruta = "json/hoteles.json";
        $manejadorDeArchivos = new ManejadorArchivos($ruta);
        $arrayClientes = $manejadorDeArchivos->leer();
        $clientes = Cliente::ConvertirArrayEnObjetos($arrayClientes);
        foreach($clientes as $cl)
        {
            if($cl->Consulta($tipoCliente,$nroCliente) && $nroDni == $cl->_nroDocumento)
            {
                $cl->_email = "---------";
                $cl->_nombre = "--------";
                $cl->_apellido = "-------";
                $manejadorDeArchivos->modifica($clientes);
            }
        }
        
    }

    //------------Validaciones-----------------//
    public static function ValidaTipoCliente($tipo)
    {
        $retorno = false;
        if($tipo != NULL && $tipo === 'INDI' || $tipo === 'CORPO')
        {
            $retorno = true;
        }
        else
        {
            echo json_encode(["error" => 'tipos de cliente: individual o corrativo']);
        }
        return $retorno;
    }

    public static function ValidaDni($tipoDoc)
    {
        $retorno = false; 
        if($tipoDoc != NULL && $tipoDoc === 'DNI'|| $tipoDoc ==='LE' || $tipoDoc === 'PASAPORTE')
        {
            $retorno = true;
        }
        else
        {
            echo json_encode(["error" => 'tipos de documento: dni - lc - ci']);
        }
        return $retorno;
    }

    public static function validaNumeroDni($nroDocumento)
    {
        $retorno = false;

        $ruta = "json/hoteles.json";
        $manejadorDeArchivos = new ManejadorArchivos($ruta);
        $arrayClientes = $manejadorDeArchivos->leer();
        $clientes = Cliente::ConvertirArrayEnObjetos($arrayClientes);
        foreach ($clientes as $cl) 
        {
            if ($cl->_nroDocumento === $nroDocumento) 
            {
                $retorno = true;
                break;
            }
        }
        if($retorno)
        {
            echo json_encode(['dni'=>'dni repetido']);
        }

        return $retorno;
    }

    public static function ValidaCliente($cliente)
    {
        $retorno = false; 
        if($cliente != NULL)
        {
            if(is_string($cliente->_nombre) && is_string($cliente->_apellido))
            {
                if(!is_nan($cliente->_telefono))
                {
                    if(Cliente::ValidaDni($cliente->_tipoDocumento) //&& 
                    //Cliente::ValidaTipoCliente($cliente->_tipoCliente) 
                    && !Cliente::validaNumeroDni($cliente->_nroDocumento))
                    {
                        $retorno = true;
                    }
                }
                else
                {
                    echo json_encode(["error" => 'ingrese un telefono valido']);
                }
            }
            else
            {
                echo json_encode(["error" => 'nombre o apellido invalido']);
            }  
        }
        return $retorno;
    }

    
    /*Agregados 
    8- ClienteAlta.php:
    a- La validación del Cliente existente deberá hacerse considerando los atributos:
    número de cliente y DNI que deben ser únicos en el sistema.
    b- Se debe adecuar la lógica desarrollada para permitir el ingreso por parámetro
    opcional de Modalidad de Pago, que permita definir un modalidad de pago
    inicial como Efectivo.
    c- Se identificó una mejora funcional por la que el atributo “tipo de cliente”
    contendrá el Tipo Cliente siendo INDI para Individual, CORPO para Corporativo
    y el tipo Documento DNI, LE, LC, PASAPORTE.
    Ejemplo: INDI-DNI ó CORPO-PASAPORTE*/



}
?>