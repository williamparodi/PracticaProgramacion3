<?php
/*
Aplicación No 17 (Auto)
Realizar una clase llamada “Auto” que posea los siguientes atributos

privados: _color (String)
_precio (Double)
_marca (String).
_fecha (DateTime)

Realizar un constructor capaz de poder instanciar objetos pasándole como

parámetros:
i. La marca y el color.
ii. La marca, color y el precio.
iii. La marca, color, precio y fecha.

Realizar un método de instancia llamado “AgregarImpuestos”, que recibirá un doble
por parámetro y que se sumará al precio del objeto.
Realizar un método de clase llamado “MostrarAuto”, que recibirá un objeto de tipo “Auto”
por parámetro y que mostrará todos los atributos de dicho objeto.
Crear el método de instancia “Equals” que permita comparar dos objetos de tipo “Auto”. Sólo
devolverá TRUE si ambos “Autos” son de la misma marca.
Crear un método de clase, llamado “Add” que permita sumar dos objetos “Auto” (sólo si son
de la misma marca, y del mismo color, de lo contrario informarlo) y que retorne un Double con
la suma de los precios o cero si no se pudo realizar la operación.
Ejemplo: $importeDouble = Auto::Add($autoUno, $autoDos);

*/
class Auto
{
    private $_color;
    private $_precio;
    private $_marca;
    private $_fecha;

    public function __construct($marca,$color,$precio=0.00,$fecha = "")
    {
        $this->_marca = $marca;
        $this->_color = $color;
        if(!is_nan($precio))
        {
            $this->_precio=$precio;
        }
        if(is_string($fecha))
        {
            $this->_fecha = $fecha;
        }
    }

    public function AgregaImpuesto($impuesto)
    {
        if(is_double($impuesto) && $impuesto > 0)
        {
            $this->_precio += $impuesto;
        }
    }

    static function MostrarAuto($auto)
    {
        if($auto != NULL)
        {
            echo "Auto: <br/>";
            echo "Marca: $auto->_marca<br/>";
            echo "Color: $auto->_color<br/>";
            echo "Precio: $auto->_precio<br/>";
            echo "Fecha: $auto->_fecha<br/>";
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

    static function Add($auto1,$auto2)
    {
        $precio = 0;
        if($auto1->Equals($auto1,$auto2) && 
            $auto1->_color == $auto2->_color)
        {
            $precio += (double)$auto1->_precio + $auto2->_precio;
        }
        else
        {
            echo "No son autos iguales, no se pueden sumar los precios <br/>";
        }

        return $precio;
    }

    

}



?>