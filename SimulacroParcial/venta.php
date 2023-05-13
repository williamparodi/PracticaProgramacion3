<?php

include_once "pizza.php";
/*
a- (1 pts.) AltaVenta.php: (por POST)se recibe el email del usuario y el sabor,tipo y cantidad ,si el ítem existe en
Pizza.json, y hay stock guardar en la base de datos( con la fecha, número de pedido y id autoincremental ) y se
debe descontar la cantidad vendida del stock .
b- (1 pt) completar el alta con imagen de la venta , guardando la imagen con el tipo+sabor+mail(solo usuario hasta
el @) y fecha de la venta en la carpeta /ImagenesDeLaVenta.*/

class Venta extends Pizza
{
    static $_idIncremental = 1;
    private $_numeroPedido;
    private $_mailUsuario;
    private $_fecha;
    private $_idVenta;

    public function __construct($sabor,$precio=0,$tipo,$cantidad=0,$mailUsuario = "Sin Mail")
    {
        parent::__construct($sabor,$precio,$tipo,$cantidad);
        $this->_fecha = date("m.d.y");
        $this->_numeroPedido = rand(1,10000);
        $this->_idVenta = self::$_idIncremental;
        $this->_mailUsuario = $mailUsuario;
        self::$_idIncremental++;
    }

    public function GetFecha()
    {
        return $this->_fecha;
    }

    public function GetId()
    {
        return $this->_idVenta;
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
                    0,
                    $venta["_tipo"],
                    $venta["_cantidad"],
                    $venta["_mailUsuario"]
                );
                $ventaNueva->SetFecha($venta["_fecha"]);
                $ventaNueva->SetId($venta["_id"]);
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
            $arrayVenta = array("_id"=>$venta->GetId(),"_numeroPedido"=>$venta->GetNumeroPedido(),
            "_sabor"=>$venta->GetSabor(),"_tipo"=>$venta->GetTipo(),"_cantidad"=>$venta->GetCantidad(),"_mailUsuario"=>$venta->GetMailUsuario(),
            "_fecha"=>$venta->GetFecha());
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

    public static function ElijeImagenPizza($sabor)
    {
        switch($sabor)
        {
            case "anchoas":
                $dirImagen  ="imagenesPizza/anchoas.png";
                break;
            case "cebolla":
                $dirImagen  ="imagenesPizza/cebolla.jpg";
                break;
            case "muzzarella":
                $dirImagen  ="imagenesPizza/muzzarella.jpg";
                break;
            default:
                break;
        }
        return $dirImagen;
    }

    public static function GuardaImagenPizza($venta)
    {
        $cortaString = strpos($venta->GetMailUsuario(),"@");
        $datosImagen = $venta->GetSabor()."_".$venta->GetTipo()."_".
                        substr($venta->GetMailUsuario(),0,$cortaString)."_".
                        $venta->GetFecha().".jpg";
        $ruta ="ImagenesDeLaVenta/".$_FILES["archivo"]["name"];
        $nombreCompleto = $ruta.$datosImagen;
        move_uploaded_file($_FILES["archivo"]["tmp_name"],$nombreCompleto);
        return $datosImagen;
    }
}

?>