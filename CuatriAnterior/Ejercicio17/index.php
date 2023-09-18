<?php
/*Aplicación No 17 (Auto)
Realizar una clase llamada “Auto” que posea los siguientes atributos

privados: _color (String)
_precio (Double)
_marca (String).
_fecha (DateTime)

Realizar un constructor capaz de poder instanciar objetos pasándole como

parámetros: i. La marca y el color.
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

En testAuto.php:
● Crear dos objetos “Auto” de la misma marca y distinto color.
● Crear dos objetos “Auto” de la misma marca, mismo color y distinto precio.
● Crear un objeto “Auto” utilizando la sobrecarga restante.

● Utilizar el método “AgregarImpuesto” en los últimos tres objetos, agregando $ 1500
al atributo precio.
● Obtener el importe sumado del primer objeto “Auto” más el segundo y mostrar el
resultado obtenido.
● Comparar el primer “Auto” con el segundo y quinto objeto e informar si son iguales o
no.
● Utilizar el método de clase “MostrarAuto” para mostrar cada los objetos impares (1, 3,
5)*/

class Auto
{
    private $_color;
    private $_precio;
    private $_marca;
    private $_fecha;

    public function __construct($marca,$color,$precio = 0.00,$fecha = "sin fecha")
    {
        if(is_string($marca) && is_string($color) && $marca != NULL && $color != NULL)
        {
            $this->_marca = $marca;
            $this->_color = $color;
            if(is_double($precio) && $precio != NULL)
            {
                $this->_precio = (double)$precio;
            }
            if(is_string($fecha) && $fecha != NULL)
            {
                $this->_fecha = $fecha;
            }
            
        }    
    }

    public function AgregarImpuestos($impuestos)
    {
        if(is_double($impuestos) && $impuestos> 0)
        {
            $this->_precio += (double)$impuestos;    
        }
    }

    public static function MostrarAuto($auto)
    {
        if($auto != NULL)
        {
            $datosDelAuto="Caracteristicas del Auto:<br/>".
            "Marca :.$auto->_marca <br/>".
            "Color : $auto->_color <br/>".
            "Precio :$auto->_precio <br/>".
            "Fecha :$auto->_fecha <br/>";
            return $datosDelAuto;
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

    public static function Add($auto1,$auto2)
    {
        $importeTotal = (double)0;
        if($auto1 == $auto2 && $auto1->_color == $auto2->_color)
        {
            $importe = (double)$auto1->_precio + $auto2->_precio;
        }
        else
        {
            echo "Los autos son diferentes no se pueden sumar importes <br/>";
        }
        return $importeTotal;
    }

}

?>