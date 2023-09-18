<?php
/*Realizar un método de instancia llamado “AgregarImpuestos”, que recibirá un doble
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

    public function __construct($marca,$color,$precio=0.00,$fecha="0/00/0000")
    {
        $this->_marca = $marca;
        $this->_color = $color;
        if(!is_nan($precio))
        {
            $this->_precio = (double)$precio;
        }
        if(is_string($fecha))
        {
            $this->_fecha = $fecha;
        }
    }

    public function AgregarImpuestos($impuesto)
    {
        if(!is_nan($impuesto) && $impuesto >0)
        {
            $this->_precio += $impuesto;        
        }
    }

    public static function MostrarAuto($auto)
    {
        if($auto != NULL)
        {
           echo "Auto:<br/>";
           echo "Marca: $auto->_marca <br/>";
           echo "Color: $auto->_color <br/>";
           echo "Precio: $auto->_precio <br/>";
           echo "Fecha: $auto->_fecha <br/>";
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
        $precioSumado = 0;
        if($autoUno != NULL && $autoDos != NULL)
        {
            if($autoUno->Equals($autoUno,$autoDos) && $autoUno->_color == $autoDos->_color)
            {
                $precioSumado+= (double)$autoUno->_precio + $autoDos->_precio;
            }
            else
            {
                echo "Los autos son distintos no se pudo sumar<br/>";
            }
        }
        return $precioSumado;
    }

}
?>