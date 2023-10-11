<?php
/*
B- (1 pt.) PizzaCarga.php: (por GET)se ingresa Sabor, precio, Tipo (“molde” o “piedra”), cantidad( de unidades). Se
guardan los datos en en el archivo de texto Pizza.json, tomando un id autoincremental como
identificador(emulado) .Sí el sabor y tipo ya existen , se actualiza el precio y se suma al stock existente.*/
require_once "Pizza.php";
class PizzaCarga
{
    public static function CargaPizza()
    {
        if(isset($_POST["_sabor"]) && isset($_POST["_precio"])
        && isset($_POST["_tipo"])
        && isset($_POST["_cantidad"]))
        {
            $sabror = $_POST["_sabor"];
            $precio = $_POST["_precio"];
            $tipo = $_POST["_tipo"];
            $cantidad = $_POST["_cantidad"];
            $idIncremental = Pizza::$idIncremental;
            $pizzaPost = new Pizza($sabror, $precio, $tipo, $cantidad);
            Pizza::$idIncremental = $idIncremental;
            if($pizzaPost->ValidaTipo($tipo))
            {
                $array = Pizza::LeeJson();

                if(!Pizza::SumaCantidadPizza($array,$pizzaPost))
                {
                    array_push($array,$pizzaPost);
                    if(Pizza::GuardaJson($array))
                    {
                        echo json_encode(['carga'=> 'Ingresada']);
                    }
                    else
                    {
                        echo json_encode(['carga'=> 'No se pudo ingresar']);
                    }

                }
                else
                {
                    if(Pizza::GuardaJson($array))
                    {
                        echo json_encode(['carga'=> 'Se actualizo la cantidad']);
                    }   
                    else
                    {
                        echo json_encode(['carga'=> 'No se pudo actualizar']);
                    }
                }
            }
            else
            {
                echo json_encode(['tipo'=> 'tipo erroneo']);
            }
            
        }
        else
        {
            echo json_encode(['error' => 'parametros erroneos']);
        }
    
    }
}
    
?>