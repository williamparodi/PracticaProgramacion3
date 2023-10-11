<?php
/*Aplicación Nº 28 ( Listado BD)
Archivo: listado.php
método:GET
Recibe qué listado va a retornar(ej:usuarios,productos,ventas)
cada objeto o clase tendrán los métodos para responder a la petición
devolviendo un listado en <JSON></JSON>*/

require_once 'UsuarioController.php';
require_once 'ProductoController.php';
require_once 'VentaController.php';

$usuarioController = new UsuarioController();
$productoController = new ProductoController();
$ventaController = new VentaController();
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET['action'])) {
        switch ($_GET['action']) {
            case 'listarUsuarios':
                $usuarios = $usuarioController->listarUsuarios();
                echo json_encode($usuarios);
                break;
            case 'listarVentas':
                $ventas = $ventaController->listarVentas();
                echo json_encode($ventas);
                break;
            case 'listarProductos':
                $productos = $productoController->listarProductos();
                echo json_encode($productos);
                break;
            default:
                echo json_encode(['error' => 'lista erronea']);
                break;
        }
    } else {
        echo json_encode(['error' => 'Falta el parametro action']);
    }
}
else
{
    echo json_encode(['error'=> 'metodo erroneos']);
}







?>