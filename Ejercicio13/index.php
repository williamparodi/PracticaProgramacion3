<?php
/*Aplicación No 13 (Invertir palabra)
Crear una función que reciba como parámetro un string ($palabra) y un entero ($max). La
función validará que la cantidad de caracteres que tiene $palabra no supere a $max y además
deberá determinar si ese valor se encuentra dentro del siguiente listado de palabras válidas:
“Recuperatorio”, “Parcial” y “Programacion”. Los valores de retorno serán: 1 si la palabra
pertenece a algún elemento del listado.
0 en caso contrario.*/
$palabrarAValidar = "Recuperatoriosadasdasdasdasdasdasdsd";
$maximo = 15;
$respuesta = ValidaPalabra($palabrarAValidar,$maximo);
echo $respuesta;

function ValidaPalabra($palabra,$max)
{
    $retorno = 0; 

    if(strlen($palabra) < $max && $palabra == "Recuperatorio" || 
            $palabra == "Parcial" || $palabra == "Programacion")
    {
       $retorno = 1;
    }
    return $retorno;
}