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
Se deben cargar los datos en un array de autos.
En testAuto.php:
● Crear dos objetos “Auto” de la misma marca y distinto color.
● Crear dos objetos “Auto” de la misma marca, mismo color y distinto precio. 
● Crearun objeto “Auto” utilizando la sobrecarga restante.
● Utilizar el método “AgregarImpuesto” en los últimos tres objetos, agregando $ 1500 al
atributo precio.
● Obtener el importe sumado del primer objeto “Auto” más el segundo y mostrar el
resultado obtenido.
● Comparar el primer “Auto” con el segundo y quinto objeto e informar si son iguales o no.
● Utilizar el método de clase “MostrarAuto” para mostrar cada los objetos impares (1, 3, 5)*/


class auto
{
    private $_color;
    private $_precio;
    private $_marca;
    private $_fecha;

    public function __construct($marca,$color,$precio = 0.00,$fecha = "Sin fecha")
    {
        if($marca != NULL && is_string($marca) && $color != NULL && is_string($color))
        {
            $this->_marca = $marca;
            $this->_color = $color;
            if($precio !=NULL)
            {
                $this->_precio = $precio;
                if($fecha != NULL)
                {
                    $this->_fecha = new DateTime();
                    $this->_fecha = $fecha;
                }
            }
        }
    }

    public function AgregarImpuesto($impuesto)
    {
        if($impuesto != NULL && is_double($impuesto))
        {
            $this->_precio+=$impuesto;
        }    
    }

    public static function MostrarAuto($auto)
    {
        if($auto != NULL)
        {
            echo "Marca:".$auto->_marca . "<br/>";
            echo "Color:".$auto->_color . "<br/>";
            echo "Precio:".$auto->_precio . "<br/>";
            echo "Fecha:".$auto->_fecha. "<br/>";
        }
    }

    public function Equals($auto1,$auto2)
    {
        $retorno = false;
        if($auto1 != NULL && $auto2 != NULL)
        {
            if($auto1->_marca == $auto2->_marca)
            {
                $retorno = true;
            }
        }
        return $retorno;
    }

    public static function Add(Auto $auto1,Auto $auto2)
    {
        $precioTotal = 0;
        if($auto1 != NULL && $auto2 != NULL)
        {
            if($auto1 == $auto2 && $auto1->_color == $auto2->_color)
            {
                $precioTotal = $auto1->_precio + $auto2->_precio;
                echo "Precio Sumado <br/>";
            }
            else
            {
                echo "Los autos no son iguales, no se pudo sacar el importe total <br/>";
            }
        }
        return $precioTotal;
    }

    public static function AltaAuto($auto)
    {
        if($auto != NULL)
        {
            $archivo = fopen("autos.csv","a");
            $unAuto = $auto->_marca. "," . $auto->_color. "," .
             $auto->_precio. "," .$auto->_fecha."\n";
            fwrite($archivo,$unAuto);
            fclose($archivo);
        }
    }

    public static function LeerAutos()
    {
        $autos = array();
        $archivo = fopen("autos.csv","r");
        while(!feof($archivo))
        {
            $unAuto = fgets($archivo);
            if($unAuto)
            {
                //Marca la separacion y lo guarda en datos(un array)
                $datos = explode(",",$unAuto);//divide por comas
                $marca = trim($datos[0]);
                $color = trim($datos[1]);
                $precio = trim($datos[2]);
                $fecha = trim($datos[3]);
                $auto = new Auto($marca,$color,$precio,$fecha);
                array_push($autos,$auto);
            }
        }
        fclose($archivo);
        return $autos;
    }

    

}
?>