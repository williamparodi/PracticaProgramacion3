<?php
/*
(1pt.) PizzaConsultar.php: (por GET)Se ingresa Sabor,Tipo, si coincide con algún registro del archivo Pizza.json,
retornar “Si Hay”. De lo contrario informar si no existe el tipo o el sabor.*/
include_once "pizza.php";

class PizzaConsultar
{
    static function MuestraSiHay()
    {
        $flag = false;
        $sabor = $_GET["_sabor"];
        $tipo = $_GET["_tipo"];
        $pizzaGet = new Pizza($sabor,NULL,$tipo,NULL);
        $array = Pizza::LeeJson();
        foreach ($array as $pizza1) 
        {
            if (Pizza::Equals($pizza1, $pizzaGet)) 
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