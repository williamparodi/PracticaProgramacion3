<?php
/*Se deben cargar los datos en un array de autos.
En testAuto.php:
*/

include_once "auto.php";

//● Crear dos objetos “Auto” de la misma marca y distinto color.

$auto1 = new Auto("Renault","Rojo");
$auto2 = new Auto("Renault","Azul");

//● Crear dos objetos “Auto” de la misma marca, mismo color y distinto precio. 
$auto3 = new Auto("Fiat","Rojo",45.00);
$auto4 = new Auto("Fiat","Rojo",56.00);

//● Crear un objeto “Auto” utilizando la sobrecarga restante.
$auto5 = new Auto("Lamborgini","Violeta",685.00,"04/09/23");

$autos = array();
$autosLeidos = array();
$archivo;

/*● Utilizar el método “AgregarImpuesto” en los últimos tres objetos, agregando $ 1500 al
atributo precio.*/
$auto3->AgregarImpuesto(1500.00);
$auto4->AgregarImpuesto(1500.00);
$auto5->AgregarImpuesto(1500.00);

/*● Obtener el importe sumado del primer objeto “Auto” más el segundo y mostrar el
resultado obtenido.*/
$resultado = Auto::Add($auto1,$auto2);
echo "Resultado de la suma de auto 1 y 2 : " . $resultado ."<br/>";

//● Comparar el primer “Auto” con el segundo y quinto objeto e informar si son iguales o no.
if($auto1->Equals($auto1,$auto2))
{
    echo "El auto 1 y el dos son iguales <br/>";
}
else
{
    echo "El auto 1 y el dos no son iguales <br/>";
}

if($auto1->Equals($auto1,$auto5))
{
    echo "El auto 1 y el 5 son iguales <br/>";
}
else
{
    echo "El auto 1 y el 5 no son iguales <br/>";
}
/*
Crear un método de clase para poder hacer el alta de un Auto, guardando los datos en un archivo
autos.csv.
Hacer los métodos necesarios en la clase Auto para poder leer el listado desde el archivo
autos.csv
Se deben cargar los datos en un array de autos.*/

array_push($autos,$auto1);
array_push($autos,$auto2);
array_push($autos,$auto3);
array_push($autos,$auto4);
array_push($autos,$auto5);

foreach($autos as $valor)
{
    Auto::AltaAuto($valor);
}
/*
$autosLeidos=Auto::LeerAutos();
echo "Autos leidos -------------------------------- <br/>";

foreach($autosLeidos as $valor)
{
    Auto::MostrarAuto($valor);
}
*/
//● Utilizar el método de clase “MostrarAuto” para mostrar cada los objetos impares (1, 3, 5)
Auto::MostrarAuto($auto1);
Auto::MostrarAuto($auto3);
Auto::MostrarAuto($auto5);

?>