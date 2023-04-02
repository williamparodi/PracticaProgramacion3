<?php
/*
Aplicación No 4 (Calculadora)
Escribir un programa que use la variable $operador que pueda almacenar los símbolos
matemáticos: ‘+’, ‘-’, ‘/’ y ‘*’; y definir dos variables enteras $op1 y $op2. De acuerdo al
símbolo que tenga la variable $operador, deberá realizarse la operación indicada y mostrarse el
resultado por pantalla.*/


$op1 = rand(1,10);
$op2 = rand(1,10);
$resultado;
$operador = '+';

switch($operador)
{
    case '+':
       $resultado = $op1 + $op2;
       echo "La suma de $op1 + $op2 da : $resultado";
    break;
    case '-';
        $resultado = $op1 - $op2;
        echo "La resta de $op1 - $op2 da : $resultado";
    break;
    case '*':
        $resultado = $op1 * $op2;
        echo "La multiplicacion de $op1 * $op2 de: $resultado";
    break;
    case '/':
        $resultado = $op1 / $op2;
        echo "La division de $op1 / $op2 da: $resultado";
    break;
    default:
    break;
}

?>