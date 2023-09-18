<?php

class Auto
{
    private $_color;
    private $_precio;
    private $_marca;
    private $_fecha;
    static $path = "autos.csv";

    public function __construct($marca,$color,$precio=0.00,$fecha="0/00/0000")
    {
        if(is_string($marca) && is_string($color))
        {
            $this->_marca = $marca;
            $this->_color = $color;
        }
        $this->_precio = (double)$precio;
        $this->_fecha = new DateTime();
        $this->_fecha = $fecha;
    }

    public function AgregarImpuestos($impuesto)
    {
        if(!is_nan($impuesto) && $impuesto > 0)
        {
            $this->_precio += $impuesto;
        }  
    }

    public static function MostrarAuto($auto)
    {
        if($auto != NULL)
        {
            echo "Auto: <br/>";
            echo "Marca: $auto->_marca <br/>";
            echo "Color: $auto->_color <br/>";
            echo "Precio: $auto->_precio <br/>";
            echo "Fecha: $auto->_fecha<br/>";
        }
    }
    
    public function Equals($autoUno,$autoDos)
    {
        $retorno = false;
        if($autoUno != NULL && $autoDos != NULL)
        {
            if($autoUno->_marca == $autoDos->_marca)
            {
                $retorno = true;
            }
        }
        return $retorno;
    }

    public static function Add($autoUno,$autoDos)
    {
        $precioTotal = 0;
        if($autoUno->Equals($autoUno,$autoDos))
        {
            $precioTotal = (double)$autoUno->_precio + $autoDos->_precio;
        }
        else
        {
            echo "Los autos no son iguales, no se suman los precios <br/>";
        }
        return $precioTotal;
    }

    public static function AltaAuto($auto)
    {
        if($auto != NULL)
        {
            Auto::GuardarArchivo("autos.csv",$auto);
        }
    }

    public static function GuardarArchivo($path,$auto)
    {
        if($auto != NULL)
        {
            $file = fopen($path,"a");
            $unAuto = $auto->_marca.",".$auto->_color.",".$auto->_precio.",".$auto->_fecha."\n";
            fwrite($file,$unAuto);
            fclose($file);
        }
    }

    public static function LeerArchivo($path)
    {
        $arrayAutos = array();
        if(file_exists($path))
        {
            $file = fopen($path,"r");
            while(!feof($file))
            {
                $unAuto = fgets($file);
                if($unAuto)
                {
                    $data = explode(",",$unAuto);
                    $marca = trim($data[0]);
                    $color = trim($data[1]);
                    $precio = trim($data[2]);
                    $fecha = trim($data[3]);
                    $auto = new Auto($marca,$color,$precio,$fecha);
                    array_push($arrayAutos,$auto);
                }

            }
            fclose($file);
        }
        return $arrayAutos;
    }
}
?>