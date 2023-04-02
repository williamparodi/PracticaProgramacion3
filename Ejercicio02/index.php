<?php
/*Aplicación Nº 2 (Mostrar fecha y estación)
Obtenga la fecha actual del servidor (función date) y luego imprímala dentro de la página con
distintos formatos (seleccione los formatos que más le guste). Además indicar que estación del
año es. Utilizar una estructura selectiva múltiple.*/

echo date("d/n/y"),"<br/>";
echo date("l jS \of M Y"),"<br/>"; // el \of hace que escriba el literal y no en formato date.
echo date(DATE_RFC2822),"<br/>";

$dia = date("j");
$mes = date("n");
$estacion = " ";

switch($mes)
{
  case 1: 
  case 2:
    $estacion = "Verano";
    break;
  case 3: 
    if($dia <21)
    {
        $estacion = "Verano";
    }
    else
    {
        $estacion = "Otoño";
    }
  break;
  case 4:
  case 5:
    $estacion = "Otoño";
    break;
  case 6:
    if($dia <21)
    {
        $estacion = "Otoño";
    }
    else
    {
        $estacion = "Invierno";
    }
  break;
  case 7:
  case 8:
    $estacion = "Invierno";
    break;
  case 9:
        if($dia <21)
        {
            $estacion = "Invierno";
        }
        else
        {
            $estacion = "Primavera";
        }
    break;
  case 10:
  case 11:
    $estacion = "Primavera";
    break;
  case 12:
    if($dia <21)
    {
        $estacion = "Primavera";
    }
    else
    {
        $estacion = "Verano";
    }
    break;
    default:
    break;
}

echo "Estamos en $estacion";

?>