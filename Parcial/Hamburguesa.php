<?php

class Hamburguesa
{
    private $_id;
    private $_nombre;
    private $_precio;
    private $_tipo;
    private $_aderezo;
    private $_cantidad;

    public function __construct($nombre,$precio,$tipo="Sin tipo",$aderezo="sin aderezo",$cantidad=0)
    {
      
        $this->_nombre = $nombre;
        $this->_precio = $precio;
        $this->_id = rand(1,10000);
        if($tipo == "simple" || $tipo == "doble")
        {
            $this->_tipo = $tipo;
        }
        else
        {
            throw new Exception("El tipo debe ser simple o doble");
        }
        $this->_aderezo = $aderezo;
        $this->_cantidad = $cantidad;
    }

    public function GetNombre()
    {
        return $this->_nombre;
    }

    public function SetNombre($nombre)
    {
        $this->_nombre= $nombre;
    }

    public function GetTipo()
    {
        return $this->_tipo;
    }

    public function GetCantidad()
    {
        return $this->_cantidad;
    }

    public function SetCantidad($cantidad)
    {
        $this->_cantidad = $cantidad;
    }

    public function SetTipo($tipo)
    {
        $this->_tipo=$tipo;
    }

    public function SetId($id)
    {
        $this->_id = $id;
    }

    public function SetPrecio($precio)
    {
        $this->_precio = $precio;
    }

    public function GetId()
    {
        return $this->_id;
    }

    public function GetPrecio()
    {
        return $this->_precio;
    }
    public static function LeeJson()
    {
        $fileJson = __DIR__."/Hamburguesas.json";
        $arrayHamburguesa = array();
      
        if(file_exists($fileJson))
        {
            $arrayCodificado =  file_get_contents($fileJson);
            $arrayDecodificado = json_decode($arrayCodificado,true); 
            
            foreach($arrayDecodificado as $hamburguesa)
            {
                $hamburguesaAgregar = new Hamburguesa(
                $hamburguesa["_nombre"],
                $hamburguesa["_precio"],
                $hamburguesa["_tipo"],
                $hamburguesa["_aderezo"],
                $hamburguesa["_cantidad"]);
                $hamburguesaAgregar->SetId($hamburguesa["_id"]);
                array_push($arrayHamburguesa,$hamburguesaAgregar);
            }
        }
     
        return $arrayHamburguesa;
    }

    public static function GuardarJson($lista)
    {
        $retorno = false;
        $fileJson = __DIR__."/Hamburguesas.json";
        $arrayHamburguesa = array();
        foreach($lista as $producto)
        {
            $arrayAsociativo = get_object_vars($producto);//lo pasa a array asociativo con los nombres de las variables
            array_push($arrayHamburguesa,$arrayAsociativo);
        }
        $json = json_encode($arrayHamburguesa,JSON_PRETTY_PRINT);
        $archivo = file_put_contents($fileJson,$json);
        if($archivo) 
        {
            $retorno = true;
        }

        return $retorno;
    }

    public static function Equals($hamburguesa1,$hamburguesa2)
    {
        $retorno = false;
        if($hamburguesa1->GetNombre() == $hamburguesa2->GetNombre() && $hamburguesa1->GetTipo() == $hamburguesa2->GetTipo())
        {
            $retorno = true;
        }
        return $retorno;
    }

    public static function SumaCantidadHamburguesa($listaHamburguesa,$hamburguesa)
    {
        $retorno = false;
        if($listaHamburguesa != NULL)
        {
            foreach($listaHamburguesa as $hamburguesa1)
            {
                if(self::equals($hamburguesa1,$hamburguesa))
                {
                    $cantidad1 = $hamburguesa1->GetCantidad();
                    $cantidad2 = $hamburguesa->GetCantidad();
                    $nuevoStock = $cantidad1 + $cantidad2;
                    $hamburguesa1->SetCantidad($nuevoStock);
                    $hamburguesa1->SetPrecio($hamburguesa->GetPrecio());
                    $retorno = true; 
                    break;  
                }
            }
        }
        return $retorno;
    }

    public static function AltaHamburguesa()
    { 
        $array = self::LeeJson();
        $nombre = $_POST["_nombre"];
        $precio = $_POST["_precio"];
        $tipo = $_POST["_tipo"];
        $aderezo =$_POST["_aderezo"];
        $cantidad = $_POST["_cantidad"];
        $hamburguesa = new Hamburguesa($nombre, $precio, $tipo,$aderezo, $cantidad);
        $array = self::LeeJson();
        if(!self::SumaCantidadHamburguesa($array,$hamburguesa))
        {
            array_push($array,$hamburguesa);

            if(self::GuardarJson($array))
            {
                self::GuardaImagen($hamburguesa);
                echo "Ingresada";
            }
            else
            {
                echo "No se pudo hacer";
            }    
        }
        else
        {
            if(self::GuardarJson($array))
            {
                echo "Actualizada";
            }
            else
            {
                echo "No se pudo ingresar";
            }
        }
    
    }

    public static function ElijeImagenHamburguesa($nombre)
    {
        
        switch($nombre)
        {
            case "grande":
                $dirImagen  ="ImagenesDeHamburguesas/grande.jpg";
                break;
            case "chica":
                $dirImagen  ="ImagenesDeHamburguesas/chica.jpg";
                break;
            case "monster":
                $dirImagen  ="ImagenesDeHamburguesas/monster.jpg";
                break;
            default:
                break;
        }
        return $dirImagen;
    }

    public static function GuardaImagen($hamburguesa)
    {
        $imagenNombre = self::ElijeImagenHamburguesa($hamburguesa->GetNombre());
        $datosImagen = $hamburguesa->GetNombre()."_".$hamburguesa->GetTipo().".jpg";
        $rutaImagen = $imagenNombre;
        $rutaDestino ="ImagenesDeHambur/2023".$datosImagen;
        copy($rutaImagen,$rutaDestino);
        return $datosImagen;
    }

    public static function MuestraSiHay()
    {
        $flag = false;
        $nombre= $_GET["_nombre"];
        $tipo = $_GET["_tipo"];
        $hamburguesa = new Hamburguesa($nombre,NULL,$tipo,NULL,0);
        $array = self::LeeJson();
        foreach ($array as $hamburguesa1) 
        {
            if (self::Equals($hamburguesa1, $hamburguesa)) 
            {
                $flag = true;
                break;
            } 
        }
        if($flag)
        {
            echo "Si hay";
        }
        else
        {
            echo "No hay";
        }
    }
}

?>