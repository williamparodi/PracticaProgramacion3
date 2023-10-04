<?php

try
{
    $conStr = "mysql:host=localhost; dbname=pruebaDB";
    $pdo = new PDO($conStr ,$user, $pass);    
}
catch(PDOException $e)
{
    echo "Error: " .$e->getMessage();
}
//consulatas 
// Sentencia preparada sin parámetros
$sentencia = $pdo->prepare('SELECT * FROM tabla');
$sentencia->execute();
// Sentencia preparada con parámetros estos son con ":" ejemplo: :id
$sentencia = $pdo->prepare('SELECT * FROM tabla WHERE ID = :id');
$sentencia->execute(array(':id' => 3));//le pasamos en forma de array los param que quermos q le lleguen 
//pdo Statement
//es una sentencia preparada posee metodos
//Metodos para vincular :
/* bindParam($param, &$variable,$tipo? , $lenght?)
* $param : Identificador del param
*$variable : nombre de la variable de PHP a vincular al param de la sentendia sql
*tipo:
*$lenght)

UN ejemplo para vincular : SE USA ESTO ! con bind param*/

$variableId = 2432; // ID a buscar
// Sentencia con parámetros nombrados
$sentencia = $pdo->prepare('SELECT * FROM tabla WHERE ID = :id');
$sentencia->bindParam(':id', $variableId, PDO::PARAM_INT);
$sentencia->execute();
// Sentencia con Parámetros posicionales el ? es para traer el que este en la posicion indicada en el 1 esta el ID.
$sentencia = $pdo->prepare('SELECT * FROM tabla WHERE ID = ?');
$sentencia->bindParam(1, $variableId, PDO::PARAM_INT);
$sentencia->execute();

/// binValue 
$variableId = 2432; // ID a buscar
// Sentencia con parámetros nombrados
$sentencia = $pdo->prepare('SELECT * FROM tabla WHERE ID = :id');
$sentencia->bindValue(':id'
, 2432, PDO::PARAM_INT);
$sentencia->execute();
// Sentencia con Parámetros posicionales
$sentencia = $pdo->prepare('SELECT * FROM tabla WHERE ID = ?');
$sentencia->bindValue(1, $variableId, PDO::PARAM_INT);
$sentencia->execute();

//bindColummn
//vinculamos una columna por nombre o numero de column 
$sentencia = $pdo->prepare('SELECT col1, col2, col3 FROM tabla ');
$sentencia->execute();
/* Vincular por número de columna */
$sentencia->bindColumn(1, $var1, PDO::PARAM_INT);
$sentencia->bindColumn(2, $var2, PDO::PARAM_STR);
/* Vincular por nombre de columna */
$sentencia->bindColumn('col3', $var3, PDO::PARAM_BOOL);

//obtenemos por fila con fetch
while ($fila = $sentencia->fetch(PDO::FETCH_BOUND)) 
{
    $datos = $var1 . "\t" . $var2 . "\t" . $var3 . "\n";
    print $datos;
}

//OBTENER VALORES : 

//fetch obtiene una fila de resultados 
//Estilos de fetch
//PDO::FETCH_ASSOC: devuelve array asociativo 
//PDO::FETCH_NUM; indexado;
//PDO::FETCH_BOTH: de las dos formas 

//otros
//PDO::FETCH_OBJ devuelve un objeto anonimo con los nombre de columnas 
//PDO::FETCH_CLASS: el que mas se usa
//POD::FETCH_BOUND: devuelve true 

//fetchAll()
/*Devuelve un array que contiene todas las filas de un conjunto
de resultados. El parámetro fetch_style determina cómo PDO devuelve la
fila. Sintaxis:
*/
//por default del xampp
//usuario y contraseña: ‘root’,’’,
?>