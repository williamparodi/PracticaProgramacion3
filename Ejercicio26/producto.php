<?php


class Producto
{
    private $_id;
    private $_codigoBarras;
    private $_nombre;
    private $_tipo;
    private $_stock;
    private $_precio;

    public function __construct($codigoBarras,$nombre="Sin nombre",$tipo="Sin tipo",$stock = 0,$precio = 0.00)
    {
        if(strlen($codigoBarras) == 6 && is_numeric($codigoBarras))
        {
            $this->_codigoBarras = $codigoBarras;
            $this->_nombre = $nombre;
            $this->_tipo = $tipo;
            $this->_stock = $stock;
            $this->_precio = $precio;
            $this->_id = rand(1, 10000);
        }
        else
        {
            throw new Exception("El codigo debe se numerico y de 6 sifras");
        }
    }

    //Getters
    public function GetId()
    {
        return $this->_id;
    }

    public function GetCodigo()
    {
        return $this->_codigoBarras;
    }

    public function GetNombre()
    {
        return $this->_nombre;
    }

    public function GetTipo()
    {
        return $this->_tipo;
    }

    public function GetStock()
    {
        return $this->_stock;
    }

    public function GetPrecio()
    {
        return $this->_precio;
    }
    //Setters

    public function SetCodigo($codigoBarras)
    {
        $this->_codigoBarras = $codigoBarras;    
    }

    public function SetNombre($nombre)
    {
        $this->_nombre = $nombre;    
    }

    public function SetStock($stock)
    {
        $this->_stock = $stock;    
    }

    public function SetPrecio($precio)
    {
        $this->_precio = $precio;    
    }

    public function SetTipo($tipo)
    {
        $this->_tipo = $tipo;
    }

    public function SetId($id)
    {
        $this->_id = $id;
    }

    //Metodos
    
    public static function equals($producto1,$producto2)
    {
        $retorno = false;

        if($producto1->GetCodigo() == $producto2->GetCodigo())
        {
            $retorno = true;
        }
        
        return $retorno;   
    }

    public static function LeeJson()
    {
        $fileJson = __DIR__."/productos.json";
        $arrayProductos = array();
      
        if(file_exists($fileJson))
        {
            $arrayCodificado =  file_get_contents($fileJson);
            $arrayDecodificado = json_decode($arrayCodificado,true); 
            
            foreach($arrayDecodificado as $producto)
            {
                $productoAgregar = new Producto(
                $producto["_codigoBarras"],
                $producto["_nombre"],
                $producto["_tipo"],
                $producto["_stock"],
                $producto["_precio"]);
                $productoAgregar->SetId($producto["_id"]);
                array_push($arrayProductos,$productoAgregar);
            }   
        }
     
        return $arrayProductos;
    }

    public static function GuardarJson($productos)
    {
        $retorno = false;
        $fileJson = __DIR__."/productos.json";
        $productosArray = array();
        foreach($productos as $producto)
        {
            $productoArray = get_object_vars($producto);//lo pasa a array asociativo con los nombres de las variables
            array_push($productosArray,$productoArray);
        }
        $json = json_encode($productosArray,JSON_PRETTY_PRINT);
        $archivo = file_put_contents($fileJson,$json);
        if($archivo) 
        {
            $retorno = true;
        }

        return $retorno;
    }

    public static function VerificaStockProducto($listaProducto,$producto)
    {
        $retorno = false;
        if($listaProducto != NULL)
        {
            foreach($listaProducto as $producto1)
            {
                if(Producto::equals($producto1,$producto))
                {
                    $nuevoStock = $producto1->GetStock() + $producto->GetStock();
                    $producto1->SetStock($nuevoStock);
                    $retorno = true; 
                    break;  
                }
            }
        }
        return $retorno;
    }

    public static function AltaProducto($producto)
    { 
        $array = Producto::LeeJson();
        
        if(!Producto::VerificaStockProducto($array,$producto))
        {
            array_push($array,$producto);

            if(Producto::GuardarJson($array))
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
            if(Producto::GuardarJson($array))
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