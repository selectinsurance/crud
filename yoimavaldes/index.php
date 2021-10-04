
<?php
//Exportando libreria para envio de correos
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
require_once '../class/autoload.php';
//echo "informacion: ".file_get_contents('php://input');
header("Content-Type: JSON");
switch ($_SERVER['REQUEST_METHOD']) {
    case 'POST':
        $_POST = json_decode(file_get_contents('php://input'), true);
        //error_reporting(0); no mms guey
        echo $_POST;
        if (!empty($_POST['nombre']) && !empty($_POST['apellido'])) {

                //Usando Libreriear
                require_once '../class/PHPMailer/Exception.php';
                require_once '../class/PHPMailer/PHPMailer.php';
                require_once '../class/PHPMailer/SMTP.php';

                $mail = new PHPMailer(true);

                try {
                    //Server settings
                    $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output  smtpout.secureserver.net
                    $mail->isSMTP();                                            //Send using SMTP
                    $mail->Host       = 'smtpout.secureserver.net';                     //Set the SMTP server to send through 
                    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
                    $mail->Username   = 'leadss@selectinsurance.info';
                    $mail->Password   = 'Clau32290398';                               //SMTP password Miami2021!    Insurance2021*  leadselectinsurance@selectinsurance.info
                   // $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
                    $mail->Port       = 80;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS` 3535

                    //Recipients
                    $mail->setFrom('leadss@selectinsurance.info', 'selectinsurance.info/' . $Valor);
                    //$mail->addAddress($rows['Email'], 'Web Site');     //Add a recipient
                    $mail->addAddress('yvaldes.selectinsurance@gmail.com', 'Web Site');
                    //$mail->addAddress('ellen@example.com');               //Name is optional
                    //$mail->addReplyTo('info@example.com', 'Information');
                    //$mail->addCC('cc@example.com');
                    //$mail->addBCC('bcc@example.com');

                    //Attachments
                    //$mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
                    //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

                    //Content
                    $mail->isHTML(true);                                  //Set email format to HTML
                    $mail->Subject = 'Lead de la pagina selectinsurance.info/' . $Valor;
                    $mail->Body    =
                        'Nombre: ' . $_POST['nombre'] . '<br>' .
                        'Apellido: ' . $_POST['apellido'] . '<br>' .
                        'Correo: ' . $_POST['correo'] . '<br>' .
                        'Telefono: ' . $_POST['telefono'] . '<br>' .
                        'Estado: ' . $_POST['estado'] . '<br>' .
                        'Servicio: ' . $_POST['servicio'] . '<br>';
                    //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

                    $mail->send();
                    echo 'El mensaje se envio correctamente';
                } catch (Exception $e) {
                    echo "Hubo un error: {$mail->ErrorInfo}";
                }
            //intval($_POST['idEmpleado']);
            //$insert = new insert($_POST['nombre'], $_POST['apellido'], $_POST['telefono'], $_POST['idEmpleado']);
            //$insert->insertar();
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
        //$IMAGEN = json_decode(file_get_contents('php://input'), true);
//
        ////convirtiendo y guardando imagen traida por el json
        //$rutaImagenSalida = __DIR__ . "/ficheros/{$IMAGEN['name']}";
        //$convertido = base64_decode($IMAGEN['base']);
        //$imagenfinal = file_put_contents($rutaImagenSalida, $convertido);
//
        ////devolviendo imagen en json
        //// Nombre de la imagen
        //$path = 'ficheros/tax.jpg';
        //$type = pathinfo($path, PATHINFO_EXTENSION);
        //$data = file_get_contents($path);
        //$base64['base'] = 'data:image/' . $type . ';base64,' . base64_encode($data);
        //echo json_encode($base64);




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



        if (isset($_GET['id'])) {
            $respuesta = new select($_GET['id']);
            $conexion = new conexion();
            $resultado = mysqli_query($conexion->EstablecerConexion(), $respuesta->query());
            while ($rows = mysqli_fetch_assoc($resultado)) {
                $userData = $rows;
            }
            if (empty($userData)) {
                echo 'no existe';
                http_response_code(404);
            } else {
                echo json_encode($userData);
            }
        } else {
            $respuesta = new select($_GET['id'] = null);
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
            }else {
                echo json_encode($userData, JSON_PRETTY_PRINT);
            }
        }
        break;
    default:
        echo "Metodo no permitido";
        http_response_code(405);
}
?>