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
    private $_numeroPedido;
    private $_mailUsuario;
    private $_fecha;
    private $_idVenta;

    public function __construct($sabor,$precio=0,$tipo,$cantidad=0,$mailUsuario = "Sin Mail")
    {
        parent::__construct($sabor,$precio,$tipo,$cantidad);
        $this->_fecha = date("Y-m-d");
        $this->_numeroPedido = rand(1,10000);
        $this->_idVenta = rand(1,10000);
        $this->_mailUsuario = $mailUsuario;
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

    public function SetMailUsuario($mail)
    {
        $this->_mailUsuario = $mail;
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
        $numeroPedido = $venta->GetNumeroPedido();
        $datosImagen = $numeroPedido."_".$venta->GetSabor()."_".$venta->GetTipo()."_".
                        substr($venta->GetMailUsuario(),0,$cortaString)."_".
                        $venta->GetFecha().".jpg";
        $ruta = "ImagenesDeLaVenta/".$datosImagen;
        $nombreCompleto = $ruta;
        move_uploaded_file($_FILES["archivo"]["tmp_name"],$nombreCompleto);
        return $datosImagen;
    }

    public static function CalculaCantidadVendida()
    {
        $arrayVentas = self::LeeJson();
        $cantidad = 0;
        foreach($arrayVentas as $venta)
        {
            $cantidad+=$venta->GetCantidad();
        }
        return $cantidad;
    }

    public static function OrdenaPorsabor($lista)
    {
        usort($lista,function($venta1,$venta2)
        {
            return strcmp($venta1->GetSabor(),$venta2->GetSabor());
        });
        return $lista;
    }

    public static function ListaVentasEntreFechas($fecha1,$fecha2)
    {
        $arrayVentas = self::LeeJson();
        $listaEntreFechas = array();
        foreach($arrayVentas as $venta)
        {
            if(strcmp($venta->GetFecha(),$fecha1) >=0 && strcmp($venta->GetFecha(),$fecha2) <= 0)
            {
                array_push($listaEntreFechas,$venta);
            }
        }
        $listaOrdenada = self::OrdenaPorsabor($listaEntreFechas);
        $listaOrdenada = self::ListaOrdenada($listaOrdenada);  
        return $listaOrdenada;
    }

    public static function ListaOrdenada($listaVentas)
    {
        $lista = "<ul>\n";
        foreach ($listaVentas as $venta) 
        {
            $lista .= "<li>Id: " . $venta->GetId() .
                " - Fecha: " . $venta->GetFecha() .
                " - Mail Usuario: " . $venta->GetMailUsuario() .
                " - Numero Pedido: " . $venta->GetNumeroPedido() .
                " - Sabor: " . $venta->GetSabor() .
                " - Cantidad: " . $venta->GetCantidad() . "</li>\n";
        } 
        $lista .= "</ul>\n";
        return $lista;       
    }
    
    public static function ListaPorUsuario($mail)
    {
        $arrayVentas = self::LeeJson();
        $lista = "<ul>\n";
        foreach($arrayVentas as $venta)
        {
            if($mail == $venta->GetMailUsuario())
            {
                $lista .= "<li>Id: " . $venta->GetId() .
                " - Fecha: " . $venta->GetFecha() .
                " - Mail Usuario: " . $venta->GetMailUsuario() .
                " - Numero Pedido: " . $venta->GetNumeroPedido() .
                " - Sabor: " . $venta->GetSabor() .
                " - Cantidad: " . $venta->GetCantidad() . "</li>\n";
            }
        }
        $lista .= "</ul>\n";
        return $lista;
    }

    public static function ListaUnaVenta($venta)
    {
        $lista = "<ul>\n";
        $lista .= "<li>Id: " . $venta->GetId() .
            " - Fecha: " . $venta->GetFecha() .
            " - Mail Usuario: " . $venta->GetMailUsuario() .
            " - Numero Pedido: " . $venta->GetNumeroPedido() .
            " - Sabor: " . $venta->GetSabor() .
            " - Cantidad: " . $venta->GetCantidad() . "</li>\n";

        $lista .= "</ul>\n";
        return $lista;
    }

    public static function ListaPorSabor($sabor)
    {
        $arrayVentas = self::LeeJson();
        $lista = "<ul>\n";
        foreach($arrayVentas as $venta)
        {
            if($sabor == $venta->GetSabor())
            {
                $lista .= self::ListaUnaVenta($venta);
            }
        }
        $lista .= "</ul>\n";
        return $lista;
    }
    
    public static function ModificarVenta($sabor,$tipo,$numeroPedido,$mailUsuario,$cantidad)
    {
        try
        {
            $flag = false;
            $arrayVentas = Venta::LeeJson();
            if(is_numeric($numeroPedido)&& $numeroPedido != NULL)
            {
                foreach($arrayVentas as $venta)
                {
                    if($numeroPedido == $venta->GetNumeroPedido())
                    {
                        if(is_string($sabor) && is_string($tipo) && $tipo == "molde" || 
                        $tipo == "piedra" && is_numeric($cantidad))
                        {
                            $venta->SetSabor($sabor);
                            $venta->SetTipo($tipo);
                            $venta->SetCantidad($cantidad);
                            $venta->SetMailUsuario($mailUsuario);
                            $flag = true;
                        }
                        break;
                    }
                }
                if($flag)
                {
                    Venta::GuardaJson($arrayVentas);
                    echo "Se modifico la venta";
                }
                else
                {
                    echo "No existe esa venta";
                }
            }
        }
        catch (Exception $e)
        {
            echo "Debe ser un numero valido el pedido".$e->getMessage();
        }
    }

    public static function BorraImagenPorNumero($venta)
    {
        $retorno = false;
        $rutaImagenes = "ImagenesDeLaVenta/";
        $rutaBackup = "BACKUPVENTAS/";
        $numeroPedido = $venta->GetNumeroPedido();
        $archivos = glob($rutaImagenes."*.jpg");//obtiene los archivos jpg
        foreach($archivos as $value)
        {
            $nombreImagen = basename($value);
            $numeroImagen = explode("_",$nombreImagen);//me saca el id antes del guion
            $numero = $numeroImagen[0];
            if($numeroPedido == $numero)
            {
                $rutaBackup = $rutaBackup.$nombreImagen;
                rename($value,$rutaBackup);//cambia la direccion vieja por la nueva
                unlink($value);
                $retorno = true;
            }
        }
        return $retorno;
    }
}   

?>