<?php

/*
Aplicación Nº 19 (Auto)
Realizar una clase llamada “Auto” que posea los siguientes atributos
privados: _color (String)
_precio (Double)
_marca (String).
_fecha (DateTime)
Realizar un constructor capaz de poder instanciar objetos pasándole como
parámetros: i. La marca y el color.
ii. La marca, color y el precio.
iii. La marca, color, precio y fecha.
Realizar un método de instancia llamado “AgregarImpuestos”, que recibirá un doble por
parámetro y que se sumará al precio del objeto.
Realizar un método de clase llamado “MostrarAuto”, que recibirá un objeto de tipo “Auto” por
parámetro y que mostrará todos los atributos de dicho objeto.
Crear el método de instancia “Equals” que permita comparar dos objetos de tipo “Auto”. Sólo devolverá
TRUE si ambos “Autos” son de la misma marca.
Crear un método de clase, llamado “Add” que permita sumar dos objetos “Auto” (sólo si son de la
misma marca, y del mismo color, de lo contrario informarlo) y que retorne un Double con la suma de los
precios o cero si no se pudo realizar la operación.
Ejemplo: $importeDouble = Auto::Add($autoUno, $autoDos);

Crear un método de clase para poder hacer el alta de un Auto, guardando los datos en un archivo
autos.csv.
Hacer los métodos necesarios en la clase Auto para poder leer el listado desde el archivo
autos.csv
Se deben cargar los datos en un array de autos*/

class Auto
{
    private $_color;
    private $_precio;
    private $_marca;
    private $_fecha;
    static $path = "autos.csv";

    public function __construct($marca,$color,$precio=0,$fecha="0/00/0000")
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