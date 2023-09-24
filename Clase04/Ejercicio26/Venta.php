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
require_once "Usuario.php";
require_once "Producto.php";

class Venta
{
    private $_id;
    private $_codigoBarras;
    private $_cantidadItems;
    private $_idUsuario;

    public function __construct($codigoBarras,$idUsuario,$cantidadItems)
    {
        $this->_id = rand(1,10000);
        $this->_codigoBarras = $codigoBarras;
        $this->_cantidadItems = $cantidadItems;
        $this->_idUsuario = $idUsuario;      
    }

    public static function VerificaUsuario($arrayUsuarios,$idUsuario)
    {
        $retorno = false;
        if($arrayUsuarios != NULL && $idUsuario != NULL)
        {
            foreach($arrayUsuarios as $u)
            {
                if($u->getId() == $idUsuario)
                {
                    $retorno = true;
                    break;
                }
            }
            if(!$retorno)
            {
                echo "Usuario Erroneo<br/>";
            }
        }
        
        return $retorno;
    }

    public static function VerificaProducto($arrayProducto,$codigoBarras)
    {
        $retorno = false;
        if($arrayProducto != NULL && $codigoBarras != NULL)
        {
            foreach($arrayProducto as $p)
            {
                if($p->getCodigo() == $codigoBarras)
                {
                    if($p->getStock() > 0)
                    {
                        $retorno = true;
                        break;
                    }   
                }
            }
            if(!$retorno)
            {
                echo "No hay stock<br/>";
            }
        }
        return $retorno;
    }

    public static function GuardaVentaJson($ventas)
    {
        $retorno = false;
        if($ventas != NULL)
        {
            $capeta_destino = "Ventas/";
            $nombre_archivo = "ventas.json";
            $destino = $capeta_destino . $nombre_archivo;
            $arrayVentas = array();

            foreach($ventas as $v)
            {
                $ventasAsc = get_object_vars($v);
                array_push($arrayVentas, $ventasAsc);
            }
            $json = json_encode($arrayVentas, JSON_PRETTY_PRINT);
            $archivo = file_put_contents($destino, $json);

            if ($archivo) 
            {
                $retorno = true;
            }
        }
        return $retorno;
    }

    public static function LeeVentaJson()
    {
        $carpeta_destino =  "Ventas/";
        $nombre_archivo = "ventas.json";
        $destino = $carpeta_destino . $nombre_archivo;
        $arrayVentas = array();

        if(file_exists($destino))
        {
            $arrayVentas = array();
            $json = file_get_contents($destino);
            $arrayVentasJson = json_decode($json,true);
            foreach($arrayVentasJson as $venta)
            {
                $ventaAgregar = new Venta($venta['_codigoBarras'],$venta['_idUsuario'],$venta['_cantidadItems']);
                $ventaAgregar->_id = $venta["_id"];
                array_push($arrayVentas,$ventaAgregar);
            }
        }
        return $arrayVentas;
    }

    public static function DescuentaStock($cantidadItems,$codigoBarras)
    {
        $retorno = false;
        if($cantidadItems != NULL)
        {
            $arrayProductos = Producto::LeeDatosProductos();
            if(Venta::VerificaProducto($arrayProductos,$codigoBarras))
            {
                foreach($arrayProductos as $p)
                {
                    if($p->getStock() >= $cantidadItems)
                    {
                        $nuevoStock = $p->getStock() - $cantidadItems;
                        $p->setStock($nuevoStock);
                        $retorno = true;
                        break;
                    }
                }
                if($retorno)
                {
                    Producto::GuardaDatosProducto($arrayProductos);
                }
                else
                {
                    echo "No hay stock suficiente<br/>";
                }
            }
            else
            {
                echo "No esta el producto para la venta<br/>";
            }
        }
        return $retorno;
    }   

    public static function VerificaVenta($venta)
    {
        $retorno = false;
        if($venta != NULL)
        {
            $arrayUsuarios = Usuario::LeeDatosUsuarios();
            if(Venta::VerificaUsuario($arrayUsuarios,$venta->_idUsuario) 
                && Venta::DescuentaStock($venta->_cantidadItems,$venta->_codigoBarras))
            {
                $retorno = true;
            }
            
        }
        return $retorno;
    }

    public static function AltaVenta($venta)
    {
        if($venta != NULL)
        {
            $array = Venta::LeeVentaJson();
            if (Venta::VerificaVenta($venta))
            {
                array_push($array, $venta);

                if (Venta::GuardaVentaJson($array)) 
                {
                    echo "Se realizo y guardo la venta<br/>";
                }
                else 
                {
                    echo "No se pudo hacer guardar<br/>";
                }
            } 
            else 
            {
                echo "Venta no realizada<br/>";
            }
        }
    }

}

?>