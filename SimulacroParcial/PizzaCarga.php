<?php
/*
B- (1 pt.) PizzaCarga.php: (por Post)se ingresa Sabor, precio, Tipo (“molde” o “piedra”), cantidad( de unidades). Se
guardan los datos en en el archivo de texto Pizza.json, tomando un id autoincremental como
identificador(emulado) .Sí el sabor y tipo ya existen , se actualiza el precio y se suma al stock existente.
*/

include_once "pizza.php";

class PizzaCarga
{
    public static function AltaPizza($pizzaPost)
    { 
        $array = Pizza::LeeJson();
        
        if(!Pizza::SumaCantidadPizza($array,$pizzaPost))
        {
            array_push($array,$pizzaPost);

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
}

?>