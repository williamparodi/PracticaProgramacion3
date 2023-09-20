<?php
/*
Aplicación Nº 20 (Auto - Garage)
Crear la clase Garage que posea como atributos privados:
_razonSocial (String)
_precioPorHora (Double)
_autos (Autos[], reutilizar la clase Auto del ejercicio anterior)
Realizar un constructor capaz de poder instanciar objetos pasándole como
parámetros: i. La razón social.
ii. La razón social, y el precio por hora.
Realizar un método de instancia llamado “MostrarGarage”, que no recibirá parámetros y que
mostrará todos los atributos del objeto.
Crear el método de instancia “Equals” que permita comparar al objeto de tipo Garaje con un objeto de
tipo Auto. Sólo devolverá TRUE si el auto está en el garaje.
Crear el método de instancia “Add” para que permita sumar un objeto “Auto” al “Garage” (sólo si el
auto no está en el garaje, de lo contrario informarlo).
Ejemplo: $miGarage->Add($autoUno);
Crear el método de instancia “Remove” para que permita quitar un objeto “Auto” del
“Garage” (sólo si el auto está en el garaje, de lo contrario informarlo). Ejemplo:
$miGarage->Remove($autoUno);
Crear un método de clase para poder hacer el alta de un Garage y, guardando los datos en un archivo
garages.csv.
Hacer los métodos necesarios en la clase Garage para poder leer el listado desde el archivo
garage.csv
Se deben cargar los datos en un array de garage.
En testGarage.php, crear autos y un garage. Probar el buen funcionamiento de todos los
métodos.*/

use Garage as GlobalGarage;

require_once "Auto.php";
class Garage
{
    private $_razonSocial;
    private $_precioPorHora;
    private $_autos;

    public function __construct($razonSocial,$precioPorHora=0.00)
    {
        $this->_razonSocial = $razonSocial;
        if(!is_nan($precioPorHora))
        {
            $this->_precioPorHora = (double)$precioPorHora;
        }
        $this->_autos = array();
    }

    public function MostarGarage()
    {
        echo "Garage:  <br/>";
        echo "Razon Social: $this->_razonSocial <br/>";
        echo "Precio por hora: $this->_precioPorHora <br/>";
        echo "Autos en el garage<br/>";
        if(count($this->_autos)>0)
        {
            foreach($this->_autos as $auto)
            {
                Auto::MostrarAuto($auto);
            }
        }
        else
        {
            echo "El garage esta vacio<br/>";
        }
    }

    public function Equals($auto)
    {
        $retorno = false;

        if($auto != NULL && count($this->_autos))
        {
            foreach($this->_autos as $autoEnGarage)
            {
                if($autoEnGarage->Equals($autoEnGarage,$auto))
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
                echo "El auto se agrego al garage <br/>";
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
            foreach($this->_autos as $k=> $autoEnGarage)
            {
                if($autoEnGarage->Equals($autoEnGarage,$auto))
                {
                    unset($this->_autos[$k]);
                    echo "El auto se retiro del garage <br/>";
                    $flag=true;
                    break;
                }
            }
            if(!$flag)
            {
                echo "El auto no se puede sacar, no esta en el garage <br/>";
            }
        }
    }

    public static function GuardarArchivo($path,$garage)
    {
        $data = array($garage->_razonSocial,$garage->_precioPorHora);
        $file = fopen($path,"a");
        $linea = fputcsv($file,$data);
        fclose($file);
        foreach($garage->_autos as $auto)
        {
            Auto::GuardarAuto($path,$auto);
        }
    }

    public static function LeerArchivo($path)
    {
        $file = fopen($path, "r");
        while(!feof($file))
        {
            $data = fgetcsv($file, filesize($path));
            foreach($data as $d)
            {
                echo $d."<br/>";
            }
        }
        fclose($file);
    }

    public static function AltaGarage($garage)
    {
        if($garage != NULL)
        {
            Garage::GuardarArchivo("garage.csv",$garage);
        }
    }
}



?>