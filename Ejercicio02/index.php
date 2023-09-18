<?php
/*Jon William Parodi
Aplicación No 2 (Mostrar fecha y estación)
Obtenga la fecha actual del servidor (función date) y luego imprímala dentro de la página con
distintos formatos (seleccione los formatos que más le guste). Además indicar que estación del
año es. Utilizar una estructura selectiva múltiple.*/

$mes = date("n");
$dia = date("d");
$estacion;

echo date("m.d.y"),"<br/>";
echo date("F j, Y, g:i a"),"<br/>";

switch($mes)
{
    case 1:
    case 2:
        $estacion = "Verano";
        break;
    case 3:
        if($dia > 20)
        {
            $estacion = "Otoño";
        }
        else
        {
            $estacion = "Verano";
        }
        break;
    case 4:
    case 5:
        $estacion = "Otoño";
        break;
    case 6:
        if($dia > 20)
        {
            $estacion = "Invierno";
        }
        else
        {
            $estacion = "Otoño";
        }
        break;
    case 7:
    case 8:
        $estacion = "Invierno";
        break;
    case 9:
        if($dia > 20)
        {
            $estacion = "Primavera";
        }
        else
        {
            $estacion = "Invierno";
        }
        break;
    case 10:
    case 11:
        $estacion = "Primavera";
    case 12:
        if($dia > 20)
        {
            $estacion = "Verano";
        }
        else
        {
            $estacion = "Primavera";
        }
        break;
    default:
        $estacion = "Error";
        break;
}

echo "Estamos en $estacion <br/>";
?>