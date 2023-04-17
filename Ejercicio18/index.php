<?php
/*
Aplicación Nº 18 (Auto - Garage)
Crear la clase Garage que posea como atributos privados:
_razonSocial (String)
_precioPorHora (Double)
_autos (Autos[], reutilizar la clase Auto del ejercicio anterior)
Realizar un constructor capaz de poder instanciar objetos pasándole como
parámetros: i. La razón social.
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
los métodos.*/

include_once "auto.php";

class Garage
{
    private $_razonSocial;
    private $_precioPorHora;
    private $_autos = array();

    public function __construct($razonSocial,$precioPorHora = 0.00)
    {
        if($razonSocial != NULL && is_string($razonSocial))
        {
            $this->_razonSocial = $razonSocial;

            if($precioPorHora != NULL && is_double($precioPorHora))
            {
                $this->_precioPorHora = $precioPorHora;
            }
        }
    }

    public function MostrarGarage()
    {
        echo "Garage: <br/>";
        echo "Razon Social: ". $this->_razonSocial."<br/>";
        echo "Precio por hora: ".$this->_precioPorHora."<br/>";
        foreach($this->_autos as $auto)
        {
           echo Auto::MostrarAuto($auto);
           echo "<br/>";
        }
    }

    public function Equals($auto)
    {
        $retorno = false;

        if($auto != NULL)
        {
            foreach($this->_autos as $valor)
            {
                if($valor->Equals($valor,$auto))
                {
                    $retorno = true;
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

    //No anda bien revisar 
    public function Remove($auto)
    {
        if($auto != NULL)
        {
            foreach($this->_autos as $key => $valor)
            {
                if($this->Equals($auto))
                {
                    //Esto borra pero no reacomoda el array
                    unset($this->_autos[$key]);
                    //Este lo borra y reacomoda el array se le pasa el array, el indice y la cantidad.
                    //array_splice($this->_autos,$key,1);
                    echo "Se quito el auto del garage <br/>";
                    break;
                }
                else
                {
                    echo "Ese auto no esta en el garage por lo tanto no se puede quitar <br/>";
                }
            }
            
        }
    }

}
?>