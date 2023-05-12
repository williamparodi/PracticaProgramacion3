<?php

use Venta as GlobalVenta;

include_once "pizza.php";
/*
a- (1 pts.) AltaVenta.php: (por POST)se recibe el email del usuario y el sabor,tipo y cantidad ,si el ítem existe en
Pizza.json, y hay stock guardar en la base de datos( con la fecha, número de pedido y id autoincremental ) y se
debe descontar la cantidad vendida del stock .
b- (1 pt) completar el alta con imagen de la venta , guardando la imagen con el tipo+sabor+mail(solo usuario hasta
el @) y fecha de la venta en la carpeta /ImagenesDeLaVenta.*/

class Venta extends Pizza
{
    private static $_idAutoIncremental = 0;
    private $_numeroPedido;
    private $_mailUsuario;
    private $_fecha;
    private $_idVenta;

    public function __construct($sabor,$precio=0,$tipo,$cantidad=0,$mailUsuario = "Sin Mail")
    {
        parent::__construct($sabor,$precio,$tipo,$cantidad);
        $this->_fecha = new DateTime();
        $this->_numeroPedido = rand(1,10000);
        $this->_id = Venta::$_idAutoIncremental++;
        $this->_mailUsuario = $mailUsuario; //vaildar hasta el arroba.
    }

    public function GetFecha()
    {
        return $this->_fecha;
    }

    public function GetNumeroPedido()
    {
        return $this->_numeroPedido;
    }

    public function GetIdVenta()
    {
        return $this->_idVenta;
    }

    public function GetMailUsuario()
    {
        return $this->_mailUsuario;
    }

    public function SetFecha($fecha)
    {
        $this->_fecha = $fecha;
    }

    public function SetId($id)
    {
        $this->_idVenta = $id;
    }

    public function SetNumero($numeroPedido)
    {
        $this->_numeroPedido = $numeroPedido;
    }

    public static function LeeJson()
    {
        $fileJson = __DIR__ . "/ventas.json";
        $arrayVentas = array();
        if (file_exists($fileJson)) 
        {
            $arrayCodificado = file_get_contents($fileJson);
            $arrayDecodificado = json_decode($arrayCodificado, true);

            foreach ($arrayDecodificado as $venta) 
            {
                $ventaNueva = new Venta
                (
                    $venta["_sabor"],
                    $venta["_tipo"],
                    $venta["_cantidad"],
                    $venta["_mailUsuario"]
                );
                $ventaNueva->SetFecha($venta["_fecha"]);
                $ventaNueva->SetId($venta["_idVenta"]);
                $ventaNueva->SetNumero($venta["_numeroPedido"]);
                array_push($arrayVentas, $ventaNueva);
            }
        }

        return $arrayVentas;
    }

    public static function GuardaJson($ventas)
    {
        $fileJson = __DIR__ . "/ventas.json";
        $arrayVentas = array();
        $retorno = false;

        foreach($ventas as $venta)
        {
            $arrayVenta = get_object_vars($venta);
            array_push($arrayVentas,$arrayVenta);
        }

        $json = json_encode($arrayVentas,JSON_PRETTY_PRINT);
        $archivo = file_put_contents($fileJson,$json);

        if($archivo)
        {
            $retorno = true;
        }
        return $retorno;
    }

}

?>