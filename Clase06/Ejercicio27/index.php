<?php
/*Parte 9 - Ejercicios PDO
Aplicación No 27 (Registro BD)
Archivo: registro.php
método:POST
Recibe los datos del usuario( nombre,apellido, clave,mail,localidad )por POST , crear
un objeto con la fecha de registro y utilizar sus métodos para poder hacer el alta,
guardando los datos la base de datos
retorna si se pudo agregar o no.*/
require_once 'UsuarioController.php';

$usuarioController = new UsuarioController();

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET['action'])) {
        switch ($_GET['action']) {
            case 'listar':
                $usuarios = $usuarioController->listarUsuarios();
                echo json_encode($usuarios);
                break;
            default:
                break;
        }
    } else {
        echo json_encode(['error' => 'Falta el parametro action']);
    }
} else if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $postData = json_decode(file_get_contents("php://input"), true);
    if (isset($_GET['action'])) {
        switch ($_GET['action']) {
            case 'insertar':
                if (isset($_POST['nombre']) && isset($_POST['apellido']) && isset($_POST['clave']) && isset($_POST['mail'])
                        && isset($_POST['localidad']))
                {
                    $resultado = $usuarioController->insertarUsuario($_POST['nombre'],$_POST['apellido'],$_POST['clave'],
                    $_POST['mail'],$_POST['localidad']);
                    echo json_encode(['Se pudo ingresar el usuario a la base de datos con el id: ' => $resultado]);
                } else {
                    echo json_encode(['error' => 'Faltan parámetros']);
                }
                break;
            default:
                echo json_encode(['error' => 'Accion no valida']);
                break;
        }
    } else {
        echo json_encode(['error' => 'Falta el parametro action']);
    }
}
?>