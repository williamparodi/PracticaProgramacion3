<?php
/*
Aplicación Nº 10 (Arrays de Arrays)
Realizar las líneas de código necesarias para generar un Array asociativo y otro indexado que
contengan como elementos tres Arrays del punto anterior cada uno. Crear, cargar y mostrar los
Arrays de Arrays.*/

$colores = array("amarillo", "verde", "azul");
$marca = array("BBB", "Filgo", "Faber");
$trazo = array("Grueso", "Fino", "Medio");

$lapicera1 = CargarArray($colores,$marca,$trazo);
$lapicera2 = CargarArray($colores,$marca,$trazo);
$lapicera3 = CargarArray($colores,$marca,$trazo);

echo "Caracteristicas de la Lapicera 1: <br/>";
foreach ($lapicera1 as $k => $valor)
{
    echo "$k = $valor <br/>";
}

echo "<br/>";
echo "Caracteristicas de la Lapicera 2: <br/>";

foreach ($lapicera2 as $k => $valor)
{
    echo "$k = $valor <br/>";
}

echo "<br/>";
echo "Caracteristicas de la Lapicera 3:<br/>";

foreach ($lapicera3 as $k => $valor)
{
    echo " $k = $valor <br/>";
}

$arrayIndexado = array(
                        array("Azul","El mejor","Grueso",656),
                        array("Celeste","Friesm","Fino",750),
                        array("Rojo","Faber Castel","Medio",900));               


/* preguntar como imprimir esto
$arrayAsociativo["Lapicera 1:"] = array($lapicera1);
$arrayAsociativo["Lapicera 2:"] = array($lapicera2);
$arrayAsociativo["Lapicera 3:"] = array($lapicera3);
*/

//echo json_encode($array1);
//print_r($arrayIndexado);

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

