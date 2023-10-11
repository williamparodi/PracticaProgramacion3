<?php
/*
(1pt.) PizzaConsultar.php: (por POST)Se ingresa Sabor,Tipo, si coincide con algún registro del archivo Pizza.json,
retornar “Si Hay”. De lo contrario informar si no existe el tipo o el sabor.*/
require_once "Pizza.php";
class PizzaConsultar
{
    public static function VerificaSihay()
    {
        $flag = false;
        if(isset($_GET['_sabor']) && isset($_GET['_tipo']))
        {
            $sabor = $_GET['_sabor'];
            $tipo = $_GET['_tipo'];
            $pizzaPost = new Pizza($sabor,0,$tipo,0);
            if($pizzaPost->ValidaTipo($tipo))
            {
                $arrayPizza = Pizza::LeeJson();
                foreach($arrayPizza as $pizza)
                {
                    if($pizza->Equals($pizzaPost))
                    {
                        $flag = true;
                        break;
                    }
                }
                if($flag)
                {
                    echo json_encode(['stock'=> 'Si Hay']);
                }
                else
                {
                    echo json_encode(['stock'=> 'No Hay']);
                }
            }
            else
            {
                echo json_encode(['tipo'=> 'tipo de pizza erroneo']);
            }
           
        }
        else
        {
            echo json_encode(['error'=> 'parametros erroneos']);
        }
    }
}

?>
