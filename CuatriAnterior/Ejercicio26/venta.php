<?php
/*
Aplicación Nº 26 (RealizarVenta)
Archivo: RealizarVenta.php
método:POST
Recibe los datos del producto(código de barra), del usuario (el id )y la cantidad de ítems ,por
POST .
Verificar que el usuario y el producto exista y tenga stock.
crea un ID autoincremental(emulado, puede ser un random de 1 a 10.000). carga
los datos necesarios para guardar la venta en un nuevo renglón.
Retorna un :
“venta realizada”Se hizo una venta
“no se pudo hacer“si no se pudo hacer
Hacer los métodos necesaris en las clases*/
include_once "usuario.php";
include_once "producto.php";
class Venta
{
    private $_codigoBarrasProducto;
    private $_id;
    private $_cantidadItems;
    private $_idUsuario;

    public function __construct($codigoBarrasProducto,$idUsuario,$cantidadItems)
    {
        if(strlen($codigoBarrasProducto) == 6 && is_numeric($codigoBarrasProducto))
        {
            $this->_codigoBarrasProducto = $codigoBarrasProducto;
            $this->_idUsuario = $idUsuario;
            $this->_cantidadItems = $cantidadItems;
            $this->_id = rand(1,10000);
        }
        else
        {
            throw new Exception("El codigo de barras debe ser de 6 digitos y numerico");
        }
    }

    //Setters
    public function SetId($idVenta)
    {
        $this->_id = $idVenta;
    }

    public function SetCodigo($codigoBarrasProducto)
    {
        $this->_codigoBarrasProducto = $codigoBarrasProducto;
    }

    public function SetCantidad($cantidadItems)
    {
        $this->_cantidadItems = $cantidadItems;
    }

    //Getters

    public function GetCodigo()
    {
        return $this->_codigoBarrasProducto;
    }

    public function GetIdUsuario()
    {
        return $this->_idUsuario;
    }

    public function GetCantidad()
    {
        return $this->_cantidadItems;
    }

    public static function VerificaUsuario($listaUsuarios,$idUsuario)
    {
        $retorno = false;
        if($listaUsuarios != NULL)
        {
            foreach($listaUsuarios as $usuario)
            {
                if($usuario->GetId() == $idUsuario)
                {
                    $retorno = true;
                    break;
                }
            }
        }
        return $retorno;
    }

    public static function VerificaProducto($listaProductos,$codigoBarrasProducto,$cantidadItems)
    {
        $retorno = false;
        if($listaProductos != NULL)
        {
            foreach($listaProductos as $producto)
            {
                if($producto->GetCodigo() == $codigoBarrasProducto && $producto->GetStock()> 0 
                    && $cantidadItems <= $producto->GetStock())
                {
                    $producto->SetStock($producto->GetStock() - $cantidadItems);
                    $retorno = true;
                    break;
                }
            }
        }
        return $retorno;
    }

    public static function LeeJson()
    {
        $fileJson = __DIR__ . "/ventas.json";
        $arrayVentas = array();
        if (file_exists($fileJson)) {

            $arrayCodificado = file_get_contents($fileJson);
            $arrayDecodificado = json_decode($arrayCodificado, true);

            foreach ($arrayDecodificado as $venta) {
                $ventaNueva = new Venta(
                    $venta["_codigoBarrasProducto"],
                    $venta["_idUsuario"],
                    $venta["_cantidadItems"]
                );
                $ventaNueva->SetId($venta["_id"]);
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

    public static function AltaVenta($venta)
    {
        $arrayProductos = Producto::LeeJson();
        $arrayUsuarios = Usuario::LeeJson();
        $arrayVentas = Venta::LeeJson(); 

        if(Venta::VerificaProducto($arrayProductos,$venta->GetCodigo(),$venta->GetCantidad()) && 
           Venta::VerificaUsuario($arrayUsuarios,$venta->GetIdUsuario()))
        {
            array_push($arrayVentas,$venta);
            if(Venta::GuardaJson($arrayVentas)&& Producto::GuardarJson($arrayProductos))
            {
                echo "Venta realizada";
            }
            else
            {
                echo "Error al guardar archivo";
            }
        }
        else
        {
            echo "No se pudo hacer";
        }
    }
}

?>