
<?php
require_once 'class/autoload.php';
//echo "informacion: ".file_get_contents('php://input');
header("Content-Type: JSON");
switch ($_SERVER['REQUEST_METHOD']) {
    case 'POST':
        $_POST = json_decode(file_get_contents('php://input'), true);
        error_reporting(0);
        if (!empty($_POST['nombre']) && !empty($_POST['apellido'])) {
            //intval($_POST['idEmpleado']);
            $insert = new insert($_POST['nombre'], $_POST['apellido'], $_POST['telefono'], $_POST['idEmpleado']);
            $insert->insertar();
        } else {
            echo "Datos requeridos faltantes";
            http_response_code(406);
        }
        break;
    case 'PUT':
        $convertido = json_decode(file_get_contents('php://input'), true);
        var_dump($convertido);
        if (isset($_GET['id'])) {
            $N = 0;
            $A = 0;
            $T = 0;
            while (isset($convertido['nombre']) && $N == 0) {
                $update = new update($_GET['id'], $convertido['nombre']);
                $update->updateNombre();
                $N++;
            }
            while (isset($convertido['apellido']) && $A == 0) {
                $update = new update($_GET['id'], $convertido['apellido']);
                $update->updateApellido();
                $A++;
            }
            while (isset($convertido['telefono']) && $T == 0) {
                $update = new update($_GET['id'], $convertido['telefono']);
                $update->updateTelefono();
                $T++;
            }
        }
        break;
    case 'DELETE':
        $_DELETE = json_decode(file_get_contents('php://input'), true);
        $delete = new delete($_GET['id']);
        $delete->Eliminar();
        break;
    case 'GET':
        header("Content-Type: JSON");
        $IMAGEN = json_decode(file_get_contents('php://input'), true);

        //convirtiendo y guardando imagen traida por el json
        $rutaImagenSalida = __DIR__ . "/ficheros/{$IMAGEN['name']}";
        $convertido = base64_decode($IMAGEN['base']);
        $imagenfinal = file_put_contents($rutaImagenSalida, $convertido);

        //devolviendo imagen en json
        // Nombre de la imagen
        $path = 'ficheros/tax.jpg';
        $type = pathinfo($path, PATHINFO_EXTENSION);
        $data = file_get_contents($path);
        $base64['base'] = 'data:image/' . $type . ';base64,' . base64_encode($data);
        echo json_encode($base64);




        //$archivo = fopen("ficheros/imagen.jpg", "a+");
        //$convertido = base64_encode($IMAGEN['base']);
        //
        //fwrite($archivo, $convertido);
        //
        //fclose($archivo);
        //$archivo = fopen("ficheros/imagen.jpg", "a+");
        //$convertido = base64_decode($archivo);
        //while (!feof($convertido)) {
        //    $contenido = fread($convertido);
        //    echo $contenido;
        //    
        //}
        //fclose($archivo);



        //if (isset($_GET['id'])) {
        //    $respuesta = new select($_GET['id']);
        //    $conexion = new conexion();
        //    $resultado = mysqli_query($conexion->EstablecerConexion(), $respuesta->query());
        //    while ($rows = mysqli_fetch_assoc($resultado)) {
        //        $userData = $rows;
        //    }
        //    if (empty($userData)) {
        //        echo 'no existe';
        //        http_response_code(404);
        //    } else {
        //        echo json_encode($userData);
        //    }
        //} else {
        //    $respuesta = new select($_GET['id'] = null);
        //    $conexion = new conexion();
        //    $resultado = mysqli_query($conexion->EstablecerConexion(), $respuesta->sinid());
        //    $i = 0;
        //    while ($rows = mysqli_fetch_assoc($resultado)) {
        //        $userData[$i]['id'] = $rows['id'];
        //        $userData[$i]['nombre'] = $rows['nombre'];
        //        $userData[$i]['apellido'] = $rows['apellido'];
        //        $userData[$i]['telefono'] = $rows['telefono'];
        //        $i++;
        //    }
        //    if (empty($userData)) {
        //        echo "No Existen datos";
        //        http_response_code(404);
        //    }else {
        //        echo json_encode($userData, JSON_PRETTY_PRINT);
        //    }
        //}
        break;
    default:
        echo "Metodo no permitido";
        http_response_code(405);
}
