<?php

class Auto
{
    private $_color;
    private $_precio;
    private $_marca;
    private $_fecha;

    public function __construct($marca,$color,$precio=0.00,$fecha="0/00/0000")
    {
        if(is_string($marca)&& is_string($color))
        {
            $this->_marca = $marca;
            $this->_color = $color;
        }
        if(!is_nan($precio))
        {
            $this->_precio = (double)$precio;
        }
        if(is_string($fecha))
        {
            $this->_fecha = new DateTime();
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

    public static function GuardarAuto($path,$auto)
    {
        if($auto != NULL)
        {
            $file = fopen($path,"a");
            $data = array($auto->_marca,$auto->_color,$auto->_precio,$auto->_fecha);
            $linea = fputcsv($file,$data);
            fclose($file);
            if($linea >0)
            {
                echo "Auto Agregado al archivo<br/>";
            }
            else
            {
                echo "Error al agregar el auto al archivo<br/>";
            }
            
        }
    }

    public static function LeerAutos($path)
    {
        $file = fopen($path,"r");
        $arrayAuto = array();

        while(!feof($file))
        {
            $data = fgetcsv($file,filesize($path));
            if($data != false)//me sirve para no poner datos vacios
            {
                $marca = $data[0];
                $color = $data[1];
                $precio = $data[2];
                $fecha = $data[3];
                $auto = new Auto($marca,$color,$precio,$fecha);
                array_push($arrayAuto,$auto);
            }
        }
        fclose($file);
   
        return $arrayAuto;
    }

}

?>