<?php
require_once '../class/autoload.php';
//require_once '../class/class/InsertEmpleado.php';
//echo "informacion: ".file_get_contents('php://input');
header("Content-Type: JSON");
switch ($_SERVER['REQUEST_METHOD']) {
    case 'POST':
        $ContenidoHeader = file_get_contents(('php://input'), true);
        $_POST = json_decode($ContenidoHeader);
        var_dump($_POST);
        $insertarEmpleado = new InsertEmpleado($_POST['nombre'], $_POST['apellido'], $_POST['telefono']);
        $insertarEmpleado->InsertarEmpleado();
        break;
    case 'PUT':
        # code...
        break;
    case 'DELETE':
        # code...
        break;
    case 'GET':
        if (isset($_GET['id'])) {
            $respuesta = new SelectEmpleado($_GET['id']);
            $conexion = new conexion();
            $resultado = mysqli_query($conexion->EstablecerConexion(), $respuesta->Query());
            while ($rows = mysqli_fetch_assoc($resultado)) {
                $userData = $rows;
            }
            if (empty($userData)) {
                echo 'no existe';
                http_response_code(404);
                var_dump($userData);
            } else {
                echo json_encode($userData);
            }
        } else {
            $respuesta = new SelectEmpleado($_GET['id'] = null);
            $conexion = new conexion();
            $resultado = mysqli_query($conexion->EstablecerConexion(), $respuesta->sinid());
            $i = 0;
            while ($rows = mysqli_fetch_assoc($resultado)) {
                $userData[$i]['id'] = $rows['id'];
                $userData[$i]['nombre'] = $rows['nombre'];
                $userData[$i]['apellido'] = $rows['apellido'];
                $userData[$i]['telefono'] = $rows['telefono'];
                $i++;
            }
            if (empty($userData)) {
                echo "No Existen datos";
                http_response_code(404);
            } else {
                echo json_encode($userData, JSON_PRETTY_PRINT);
            }
        }
        break;
        break;
    default:
        # code...
        break;
}
