<?php
/*Aplicación No 20 (Auto - Garage)
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

include_once "auto.php";
class Garage
{
    private $_razonSocial;
    private $_precioHora;
    private $_autos;

    public function __construct($razonSocial,$precioHora = 0.00)
    {
        if($razonSocial != NULL && is_string($razonSocial))
        {
            $this->_razonSocial = $razonSocial;
            $this->_autos = array();
            if($precioHora != NULL)
            {
                $this->_precioHora = $precioHora;
            }
        }
    }

    public function MostrarGarage()
    {
        echo "Garage: <br/>";
        echo "Razon Social: ".$this->_razonSocial."<br/>";
        echo "Precio por hora: ".$this->_precioHora."<br/>";
        if($this->_autos != NULL && count($this->_autos) > 0)
        {
            foreach($this->_autos as $valor)
            {
                Auto::MostrarAuto($valor);
            }
        }
        else
        {
            echo "El garage esta vacio <br/>";
        }
        
    }

    public function Equals($auto)
    {
        $retorno = false;

        if($auto != NULL && $this->_autos != NULL && count($this->_autos) >0)
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
                echo "El auto se agrego al garage <br/>";
            }
            else
            {
                echo "El auto ya esta en el garage, no se agrego <br/>";
            }
        }
    }

    public function Remove($auto)
    {
        $flag = false;
        if($auto != NULL)
        {
            foreach($this->_autos as $key => $valor)
            {
                if($valor->Equals($valor,$auto))
                {
                    unset($this->_autos[$key]);
                    echo "El auto se saco del garage <br/>";
                    $flag = true;
                }
            }
            if(!$flag)
            {
                echo "El auto no esta esta en el garage, no se puede sacar <br/>";
            }            
        }
    }

    public static function AltaGarge(Garage $garage)
    {
        if($garage != NULL)
        {
            $archivo = fopen("garage.csv","a");
            $unGarage = $garage->_razonSocial.",". $garage->_precioHora.",";
            fwrite($archivo,$unGarage);    
            fclose($archivo);
        }
    }

    public static function LeeUnGarage()
    {
        $garages = array();
        $autos = array();
        $archivo = fopen("garage.csv","r");
        $i = 0;
        while(!feof($archivo))
        {
            $unGarage = fgets($archivo);
            if($unGarage)
            {
                $datos = explode(",",$unGarage);
                $razonSocial = trim($datos[0]);
                $precioHora = trim($datos[1]);
                $garages = new Garage($razonSocial,$precioHora);
                $autos = Auto::LeerAutos();
                array_push($garages->_autos,$autos);
            }
            $i++;
        }
        fclose($archivo);
        return $garages;
    }
}

?>