<?php

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