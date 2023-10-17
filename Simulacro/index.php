<?php
/*1-
A- (1 pt.) index.php:Recibe todas las peticiones que realiza el postman, y administra a que archivo se debe incluir.
B- (1 pt.) PizzaCarga.php: (por GET)se ingresa Sabor, precio, Tipo (“molde” o “piedra”), cantidad( de unidades). Se
guardan los datos en en el archivo de texto Pizza.json, tomando un id autoincremental como
identificador(emulado) .Sí el sabor y tipo ya existen , se actualiza el precio y se suma al stock existente.
2-
(1pt.) PizzaConsultar.php: (por POST)Se ingresa Sabor,Tipo, si coincide con algún registro del archivo Pizza.json,
retornar “Si Hay”. De lo contrario informar si no existe el tipo o el sabor.*/

if ($_SERVER['REQUEST_METHOD'] === 'GET') 
{
    if (isset($_GET['action'])) 
    {
        switch ($_GET['action']) 
        {
            case 'PizzaConsultar':
                require_once "PizzaConsultar.php";
                PizzaConsultar::VerificaSihay();
                break;
            default:
                echo json_encode(['error' => 'consulta erronea']);
                break;
        }
    }  
} 
else if ($_SERVER['REQUEST_METHOD'] === 'POST') 
{
    $postData = json_decode(file_get_contents("php://input"), true);
    if (isset($_GET['action'])) 
    {
        switch ($_GET['action']) 
        {
            case 'PizzaCarga':
                require_once "PizzaCarga.php";
                PizzaCarga::CargaPizza();
                break;
            case 'AltaVenta':
                require_once "AltaVenta.php";
                AltaVenta::AltaVenta();
            default:
                echo json_encode(['error' => 'carga erronea']);
                break;
        }
    } 
    else 
    {
        echo json_encode(['error' => 'carga no valida']);
    }
}
else
{
    echo json_encode(['error' => 'Metodo erroneo']);
}
?>