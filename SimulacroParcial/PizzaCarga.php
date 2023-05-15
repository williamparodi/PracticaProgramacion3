<?php
/*
B- (1 pt.) PizzaCarga.php: (por Post)se ingresa Sabor, precio, Tipo (“molde” o “piedra”), cantidad( de unidades). Se
guardan los datos en en el archivo de texto Pizza.json, tomando un id autoincremental como
identificador(emulado) .Sí el sabor y tipo ya existen , se actualiza el precio y se suma al stock existente.

5- (2 pts.)PizzaCarga.php:.(continuación) Cambio de get a post.
completar el alta con imagen de la pizza, guardando la imagen con el tipo y el sabor como nombre en la carpeta
/ImagenesDePizzas.
*/

include_once "pizza.php";

class PizzaCarga
{
    public static function AltaPizza()
    { 
        $sabror = $_POST["_sabor"];
        $precio = $_POST["_precio"];
        $tipo = $_POST["_tipo"];
        $cantidad = $_POST["_cantidad"];
        $pizzaPost = new Pizza($sabror, $precio, $tipo, $cantidad);
        $array = Pizza::LeeJson();

        if(!Pizza::SumaCantidadPizza($array,$pizzaPost))
        {
            array_push($array,$pizzaPost);
            if(Pizza::GuardarJson($array))
            {
                echo "Ingresado";
                Pizza::GuardaImagen($pizzaPost);
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