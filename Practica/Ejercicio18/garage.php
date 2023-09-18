<?php
/*
Aplicación Nº 18 (Auto - Garage)
Crear la clase Garage que posea como atributos privados:
_razonSocial (String)
_precioPorHora (Double)
_autos (Autos[], reutilizar la clase Auto del ejercicio anterior)
Realizar un constructor capaz de poder instanciar objetos pasándole como
parámetros: 
i. La razón social.
ii. La razón social, y el precio por hora.

Realizar un método de instancia llamado “MostrarGarage”, que no recibirá parámetros y
que mostrará todos los atributos del objeto.
Crear el método de instancia “Equals” que permita comparar al objeto de tipo Garaje con un
objeto de tipo Auto. Sólo devolverá TRUE si el auto está en el garaje.
Crear el método de instancia “Add” para que permita sumar un objeto “Auto” al “Garage”
(sólo si el auto no está en el garaje, de lo contrario informarlo).
Ejemplo: $miGarage->Add($autoUno);
Crear el método de instancia “Remove” para que permita quitar un objeto “Auto” del
“Garage” (sólo si el auto está en el garaje, de lo contrario informarlo). Ejemplo:
$miGarage->Remove($autoUno);
En testGarage.php, crear autos y un garage. Probar el buen funcionamiento de todos
los métodos*/ 
include_once "auto.php";
class Garage
{
    private $_razonSocial;
    private $_precioPorHora;
    private $_autos = array();

    public function __construct($razonSocial,$precioPorHora=0.00)
    {
        if(is_string($razonSocial))
        {
            $this->_razonSocial = $razonSocial; 
        }
        if(!is_nan($precioPorHora))
        {
            $this->_precioPorHora = (double)$precioPorHora;
        }
              
    }

    public function MostrarGarage()
    {
        echo "Garage: <br/>";
        echo "Razon social: $this->_razonSocial<br/>";
        echo "Precio por hora: $ ".$this->_precioPorHora ."<br/>";
        if(count($this->_autos)>0)
        {
            echo "Autos en el Garage :<br/>";
            foreach($this->_autos as $auto)
            {
                Auto::MostrarAuto($auto);
            }
        }
    }
    //preguntar
    public function Equals($auto)
    {
        $retorno = false;

        if($auto != NULL)
        {
            foreach($this->_autos as $autoGarage)
            {
                if($auto->Equals($autoGarage,$auto))
                {
                    $retorno = true;
                    break;
                }
            }
        }

        return $retorno;
    }

    public function Add($auto)
    {
        if($auto != NULL)
        {
            if(!$this->Equals($auto))
            {   
                array_push($this->_autos,$auto);
                echo "Se agrego el auto al garage <br/>";
            }
            else
            {
                echo "El auto ya esta en el garage <br/>";
            }
        }
    }

    public function Remove($auto)
    {
        $flag = false;
        if($auto != NULL)
        {
            foreach($this->_autos as $k => $autoGarage)
            {
                if($autoGarage->Equals($autoGarage,$auto))
                {
                    unset($this->_autos[$k]);
                    echo "Se saco el auto del garage<br/>";
                    $flag = true;
                    break;
                }
            }
            if(!$flag)
            {
                echo "El auto no esta en el garage<br/>";
            }
        }
    }


}

?>