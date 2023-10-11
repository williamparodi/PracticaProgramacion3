<?php
/*B- (1 pt.) PizzaCarga.php: (por GET)se ingresa Sabor, precio, Tipo (“molde” o “piedra”), cantidad( de unidades). Se
guardan los datos en en el archivo de texto Pizza.json, tomando un id autoincremental como
identificador(emulado) .Sí el sabor y tipo ya existen , se actualiza el precio y se suma al stock existente*/
class Pizza
{
    public $_id;
    public $_sabor;
    public $_precio;
    public $_tipo;
    public $_cantidad;
    public static $idIncremental = 1;

    public function __construct($sabor,$precio=0,$tipo,$cantidad=0)
    {
        $this->_sabor = $sabor;
        $this->_precio = $precio;
        $this->_tipo = $tipo;
        $this->_cantidad = $cantidad;
        $this->_id = ++Pizza::$idIncremental;
    }

    public function ValidaTipo($tipo)
    {
        $retrono = false;
        if($tipo === "molde" || $tipo === "piedra")
        {
            $retrono = true;
        }
        return $retrono;
    }

    public function Equals($pizza)
    {
        $retrono = false;
        if($pizza != NULL)
        {
            if($this->_sabor == $pizza->_sabor && $this->_tipo == $pizza->_tipo)
            {   
                $retrono = true;
            }   
        }
        return $retrono;
    }
    
    public static function GuardaJson($pizzas)
    {
        $retorno = false;
        if ($pizzas != NULL) 
        {
            $carpeta_destino =  "Pizzas/";
            $nombre_archivo = "Pizza.json";
            $destino = $carpeta_destino . $nombre_archivo;
            $arrayPizzas = array();
            foreach($pizzas as $p)
            {
                $productoAsc = get_object_vars($p);
                array_push($arrayPizzas, $productoAsc);
            }

            $json = json_encode($arrayPizzas, JSON_PRETTY_PRINT);
            $archivo = file_put_contents($destino, $json);

            if ($archivo) 
            {
                $retorno = true;
            }
        }

        return $retorno;
    }

    public static function LeeJson()
    {
        $carpeta_destino = "Pizzas/";
        $nombre_archivo = "Pizza.json";
        $destino = $carpeta_destino . $nombre_archivo;
      
        if(file_exists($destino))
        {
            $arrayPizza = array();
            $json = file_get_contents($destino);
            $arrayPizzasJson = json_decode($json,true); 
            
            foreach($arrayPizzasJson as $pizza)
            {
                $pizzaAgregar = new Pizza(
                $pizza["_sabor"],
                $pizza["_precio"],
                $pizza["_tipo"],
                $pizza["_cantidad"]);
                $pizzaAgregar->_id = $pizza["_id"];
                array_push($arrayPizza,$pizzaAgregar);
            }
        }
     
        return $arrayPizza;
    }

    public static function SumaCantidadPizza($listaPizza,$pizza)
    {
        $retorno = false;
        if($listaPizza != NULL)
        {
            foreach($listaPizza as $pizza1)
            {
                if($pizza1->Equals($pizza))
                {
                    $nuevoStock = $pizza1->_cantidad + $pizza->_cantidad;
                    $pizza1->_cantidad =$nuevoStock;
                    $retorno = true; 
                    break;  
                }
            }
        }
        return $retorno;
    }

    public static function AltaPizza($pizza)
    {
        $array = Pizza::LeeJson();

        if (!Pizza::SumaCantidadPizza($array, $pizza)) 
        {
            array_push($array, $pizza);

            if (Pizza::GuardaJson($array))
            {
                echo "Ingresada";
            }
            else 
            {
                echo "No se pudo hacer";
            }
        }
        else 
        {
            if (Pizza::GuardaJson($array)) 
            {
                echo "Actualizada";
            }
            else 
            {
                echo "No se pudo ingresar";
            }
        }
    }
}
?>