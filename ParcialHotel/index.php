<?php
if(isset($_GET['accion']))
{
    switch($_SERVER['REQUEST_METHOD'])
    {
        case 'GET':
            switch ($_GET['accion'])
            {
                case 'consultaReserva':
                    require_once 'ConsultaReservas.php';
                    ConsultaReservas::ConsultaReservas();
                    break;
                default:
                    echo json_encode(['error'=>'Parametro "accion" no permitido']);
                    break;
            }
            break;
        case 'POST':
            $postData = json_decode(file_get_contents("php://input"), true);
            switch ($_GET['accion']){
                case 'altaCliente':
                    require_once 'ClienteAlta.php';
                    ClienteAlta::AltaCliente();
                    break;
                case 'consultaCliente':
                    require_once 'ConsultarCliente.php';
                    ConsultarCliente::ConsultarCliente();
                    break;
                case 'reservaHabitacion':
                    require_once 'ReservaHabitacion.php';
                    ReservaHabitacion::AltaReserva();
                    break;
                case 'cancelaReserva':
                    require_once 'CancelarReserva.php';
                    CancelarReserva::CancelarReserva();
                    break;
                case 'ajuste':
                    require_once 'AjusteReserva.php';
                    AjusteReserva::AjusteReserva();
                    break;
                default:
                    echo json_encode(['error'=>'Parametro "accion" no permitido']);
                    break;
            }
            break;
        case 'PUT':
            switch($_GET['accion']){
                case 'modificacionCliente':
                    require_once 'ModificarCliente.php';
                    ModificarCliente::ModificarCliente($postData);
                    break;
                default:
                    echo json_encode(['error'=>'Parametro "accion" no permitido']);
                    break;
            }
            break;
        case 'DELETE':
            switch($_GET['accion']){
                case 'borrarCliente':
                require_once 'BorrarCliente.php';
                BorrarCliente::BorrarCliente();
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
    echo 'Parametro "accion" no enviado';
}
?>