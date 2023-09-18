<?php
/*Aplicación Nº 9 (Arrays asociativos) Segunda Version!
Realizar las líneas de código necesarias para generar un Array asociativo $lapicera, que
contenga como elementos: ‘color’, ‘marca’, ‘trazo’ y ‘precio’. Crear, cargar y mostrar tres
lapiceras*/

//Creo unos array con valores para cargar los elementos 
$colores = array("amarillo", "verde", "azul");
$marca = array("BBB", "Filgo", "Faber");
$trazo = array("Grueso", "Fino", "Medio");

$lapicera1 = CargarArray($colores,$marca,$trazo);
$lapicera2 = CargarArray($colores,$marca,$trazo);
$lapicera3 = CargarArray($colores,$marca,$trazo);

foreach ($lapicera1 as $k => $valor)
{
    echo "Caracteristicas de la Lapicera 1: $k = $valor <br/>";
}

echo "<br/>";

foreach ($lapicera2 as $k => $valor)
{
    echo "Caracteristicas de la Lapicera 2: $k = $valor <br/> ";
}

echo "<br/>";

foreach ($lapicera3 as $k => $valor)
{
    echo "Caracteristicas de la Lapicera 3: $k = $valor <br/>";
}

//Funcion para cargar los array
function CargarArray($arrayColores,$arrayMarca,$arrayTrazo)
{
    //Tiro un random para cada uno y me devuelve un indice
    $indiceColores = array_rand($arrayColores);
    $indiceMarca = array_rand($arrayMarca);
    $indiceTrazo = array_rand($arrayTrazo);

    //Cargo los elementos en el array con el indice
    $lapiceraAux['color'] = $arrayColores[$indiceColores];
    $lapiceraAux['marca'] = $arrayMarca[$indiceMarca];
    $lapiceraAux['trazo'] = $arrayTrazo[$indiceTrazo];
    $lapiceraAux['precio'] = rand(100, 1000);
    
    return $lapiceraAux;
}
?>