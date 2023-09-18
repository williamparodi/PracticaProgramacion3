<?php
/*
Aplicación No 13 (Invertir palabra)
Crear una función que reciba como parámetro un string ($palabra) y un entero ($max). La
función validará que la cantidad de caracteres que tiene $palabra no supere a $max y además
deberá determinar si ese valor se encuentra dentro del siguiente listado de palabras válidas:
“Recuperatorio”, “Parcial” y “Programacion”. Los valores de retorno serán: 1 si la palabra
pertenece a algún elemento del listado.
0 en caso contrario.*/

$palabraDePreueba = "Recuperatorio";

if(validaMaximo($palabraDePreueba,15) == 1)
{
    echo "palabra correcta";
}
else
{
    echo "palabra incorrecta";
}

function validaMaximo($palabra,$max)
{
    $retorno = 0;
    $cantidadLetras = strlen($palabra);
    if($cantidadLetras <= $max)
    {
        if($palabra == "Recuperatorio" ||$palabra == "Parcial" || $palabra == "Programacion")
        {
            $retorno = 1;
        }
    }

    return $retorno;
}

?>