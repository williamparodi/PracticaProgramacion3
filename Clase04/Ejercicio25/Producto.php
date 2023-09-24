<?php

/*Aplicación Nº 25 ( AltaProducto)
Archivo: altaProducto.php
método:POST
Recibe los datos del producto(código de barra (6 sifras ),nombre ,tipo, stock, precio )por POST ,
crea un ID autoincremental(emulado, puede ser un random de 1 a 10.000). crear un objeto y
utilizar sus métodos para poder verificar si es un producto existente, si ya existe el producto se le
suma el stock , de lo contrario se agrega al documento en un nuevo renglón
Retorna un :
“Ingresado” si es un producto nuevo
“Actualizado” si ya existía y se actualiza el stock.
“no se pudo hacer“si no se pudo hacer
Hacer los métodos necesarios en la clase*/

class Producto
{
    private $_id;
    private $_codigoBarras;
    private $_nombre;
    private $_tipo;
    private $_stock;
    private $_precio;

    public function __construct($codigoBarras,$nombre,$tipo="Sin tipo",$stock=0,$precio=0)
    {
        if(!is_nan($codigoBarras) && is_string($nombre))
        {
            $this->_codigoBarras = $codigoBarras;
            $this->_nombre = $nombre;
        }
        else
        {
            echo "Datos erroneos<br/>";
        }
        $this->_tipo = $tipo;
        $this->_id = rand(1, 10000);
        $this->_stock = (int)$stock;
        $this->_precio = $precio;
        
    }

    public function Equals($producto)
    {
        $retorno = false;
        if($producto != NULL)
        {
            if($this->_codigoBarras == $producto->_codigoBarras)
            {
                $retorno = true;
            }
        }
        return $retorno;
    }

    public static function GuardaDatosProducto($productos)
    {
        $retorno = false;
        if ($productos != NULL) 
        {
            $carpeta_destino =  "Productos/";
            $nombre_archivo = "productos.json";
            $destino = $carpeta_destino . $nombre_archivo;
            $arrayProductos = array();
            foreach($productos as $p)
            {
                $productoAsc = get_object_vars($p);
                array_push($arrayProductos, $productoAsc);
            }

            $json = json_encode($arrayProductos, JSON_PRETTY_PRINT);
            $archivo = file_put_contents($destino, $json);

            if ($archivo) 
            {
                $retorno = true;
            }
        }

        return $retorno;
    }

    public static function LeeDatosProductos()
    {
        $carpeta_destino =  "Productos/";
        $nombre_archivo = "productos.json";
        $destino = $carpeta_destino . $nombre_archivo;
        $arrayProductos = array();

        if(file_exists($destino))
        {
            $arrayProductos = array();
            $json = file_get_contents($destino);
            $arrayProductosJson = json_decode($json,true);
            foreach($arrayProductosJson as $producto)
            {
                $productoAgregar = new Producto($producto['_codigoBarras'],$producto['_nombre'],
                $producto['_tipo'],$producto['_stock'],$producto['_precio']);
                $productoAgregar->_id = $producto["_id"];
                array_push($arrayProductos,$productoAgregar);
            }
        }

        return $arrayProductos;
    }
    
    public static function VerificaStockProducto($listaProducto,$producto)
    {
        $retorno = false;
        if($listaProducto != NULL)
        {
            foreach($listaProducto as $p)
            {
                if($p->Equals($producto))
                {
                    $nuevoStock = $p->_stock + $producto->_stock;
                    $p->_stock = $nuevoStock;
                    $retorno = true; 
                    break;  
                }
            }
        }
        return $retorno;
    }

    public static function AltaProducto($producto)
    {
        $array = Producto::LeeDatosProductos();

        if (!Producto::VerificaStockProducto($array, $producto)) 
        {
            array_push($array, $producto);

            if (Producto::GuardaDatosProducto($array))
            {
                echo "Ingresado";
            }
            else 
            {
                echo "No se pudo hacer";
            }
        }
        else 
        {
            if (Producto::GuardaDatosProducto($array)) 
            {
                echo "Actualizado";
            }
            else 
            {
                echo "No se pudo ingresar";
            }
        }
    }
}


?>