<?php
/*Jon William Parodi 
Aplicación No 4 (Calculadora)
Escribir un programa que use la variable $operador que pueda almacenar los símbolos
matemáticos: ‘+’, ‘-’, ‘/’ y ‘*’; y definir dos variables enteras $op1 y $op2. De acuerdo al
símbolo que tenga la variable $operador, deberá realizarse la operación indicada y mostrarse el
resultado por pantalla.*/ 

$operador = array("+","-","/","*");
$op1 = rand(1,10);
$op2 = rand(1,10);
$resultado;
$operadorAzar = array_rand($operador);

echo "Operador1: $op1<br/>";
echo "Operador2: $op2<br/>";
switch($operador[$operadorAzar])
{
    case "+":
        $resultado = $op1 + $op2;
        break;
    case "-":
        $resultado = $op1 - $op2;
        break;
    case "*":
        $resultado = $op1 * $op2;
        break;
    case "/":
        if($op2 != 0)
        {
            $resultado = $op1 / $op2;
        }
        break;
    default:
    break;
}

echo "El resultado de $op1 $operador[$operadorAzar] $op2  es: $resultado<br/>";
?>