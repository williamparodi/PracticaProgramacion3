<?php
if(isset($_GET['accion']))
{
    switch($_SERVER['REQUEST_METHOD'])
    {
        case 'GET':
            switch ($_GET['accion'])
            {
                case 'sesion':
                    include 'sesiones.php';
                    break;
                default:
                    echo json_encode(['error'=>'Parametro "accion" no permitido']);
                    break;
            }
            break;
        case 'POST':
            switch ($_GET['accion']){
                case 'altaCliente':
                    require_once 'ClienteAlta.php';
                    ClienteAlta::AltaCliente();
                    break;
                case 'consultaCliente':
                    require_once 'ConsultarCliente.php';
                    ConsultarCliente::ConsultarCliente();
                    break;
                default:
                    echo json_encode(['error'=>'Parametro "accion" no permitido']);
                    break;
            }
            break;
        default:
            echo json_encode(['error'=>'Verbo no permitido']);
            break;
    }
} 
else 
{
    echo 'Parámetro "accion" no enviado';
}
?>