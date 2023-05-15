<?php
class Pizza
{
    private $_sabor;
    private $_precio;
    private $_tipo;
    private $_cantidad;
    private $_id; 
    
    public function __construct($sabor,$precio=0,$tipo,$cantidad=0)
    {
        if($tipo == "molde" || $tipo == "piedra")
        {
            $this->_tipo = $tipo;
            $this->_sabor =$sabor;
            $this->_precio = $precio;
            $this->_cantidad = $cantidad;
            $this->_id = rand(1,10000);
        }
        else
        {
            $this->_tipo = "Sin tipo";
        }
         
    }

    public function GetSabor()
    {
        return $this->_sabor;
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

    public function SetSabor($sabor)
    {
        $this->_sabor=$sabor;
    }

    public function SetTipo($tipo)
    {
        $this->_tipo=$tipo;
    }

    public function SetId($id)
    {
        $this->_id = $id;
    }

    public function GetId()
    {
        return $this->_id;
    }

    public static function Equals($pizza1,$pizza2)
    {
        $retorno = false;
        if($pizza1->GetSabor() == $pizza2->GetSabor() && $pizza1->GetTipo() == $pizza2->GetTipo())
        {
            $retorno = true;
        }
        return $retorno;
    }

    public static function LeeJson()
    {
        $fileJson = __DIR__."/Pizza.json";
        $arrayPizza = array();
      
        if(file_exists($fileJson))
        {
            $arrayCodificado =  file_get_contents($fileJson);
            $arrayDecodificado = json_decode($arrayCodificado,true); 
            
            foreach($arrayDecodificado as $pizza)
            {
                $pizzaAgregar = new Pizza(
                $pizza["_sabor"],
                $pizza["_precio"],
                $pizza["_tipo"],
                $pizza["_cantidad"]);
                $pizzaAgregar->SetId($pizza["_id"]);
                array_push($arrayPizza,$pizzaAgregar);
            }
        }
     
        return $arrayPizza;
    }

    public static function GuardarJson($productos)
    {
        $retorno = false;
        $fileJson = __DIR__."/Pizza.json";
        $pizzaArray = array();
        foreach($productos as $producto)
        {
            $pizzaAsociativo = get_object_vars($producto);//lo pasa a array asociativo con los nombres de las variables
            array_push($pizzaArray,$pizzaAsociativo);
        }
        $json = json_encode($pizzaArray,JSON_PRETTY_PRINT);
        $archivo = file_put_contents($fileJson,$json);
        if($archivo) 
        {
            $retorno = true;
        }

        return $retorno;
    }
    
    public static function SumaCantidadPizza($listaPizza,$pizza)
    {
        $retorno = false;
        if($listaPizza != NULL)
        {
            foreach($listaPizza as $pizza1)
            {
                if(Pizza::equals($pizza1,$pizza))
                {
                    $nuevoStock = $pizza1->GetCantidad() + $pizza->GetCantidad();
                    $pizza1->SetCantidad($nuevoStock);
                    $retorno = true; 
                    break;  
                }
            }
        }
        return $retorno;
    }

    public static function RestaCantidadPizza($listaPizza,$pizza)
    {
        $retorno = false;
        if($listaPizza != NULL)
        {
            foreach($listaPizza as $pizza1)
            {
                if(Pizza::equals($pizza1,$pizza))
                {
                    $nuevoStock = $pizza1->GetCantidad() - $pizza->GetCantidad();
                    $pizza1->SetCantidad($nuevoStock);
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
        
        if(!Pizza::SumaCantidadPizza($array,$pizza))
        {
            array_push($array,$pizza);

            if(Pizza::GuardarJson($array))
            {
                echo "Ingresado";
            }
            else
            {
                echo "No se pudo hacer";
            }    
        }
        else
        {
            if(Pizza::GuardarJson($array))
            {
                echo "Actualizado";
            }
            else
            {
                echo "No se pudo ingresar";
            }
        }
    
    }

    public static function GuardaImagen($pizza)
    {
        $imagenSabor = Venta::ElijeImagenPizza($pizza->GetSabor());
        $datosImagen = $pizza->GetSabor()."_".$pizza->GetTipo().".jpg";
        $rutaImagen = $imagenSabor;
        $rutaDestino ="ImagenesDePizzas/".$datosImagen;
        copy($rutaImagen,$rutaDestino);
        return $datosImagen;
    }

    /*
    public static function GuardaImagenPizza($venta)
    {
        $cortaString = strpos($venta->GetMailUsuario(),"@");
        $datosImagen = $venta->GetSabor()."_".$venta->GetTipo()."_".
                        substr($venta->GetMailUsuario(),0,$cortaString)."_".
                        $venta->GetFecha().".jpg";
        $ruta ="ImagenesDeLaVenta/".$_FILES["archivo"]["name"];
        $nombreCompleto = $ruta.$datosImagen;
        move_uploaded_file($_FILES["archivo"]["tmp_name"],$nombreCompleto);
        return $datosImagen;
    }*/

}
?>