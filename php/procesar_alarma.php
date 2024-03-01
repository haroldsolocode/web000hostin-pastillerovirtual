<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
require 'twilio-php-main/src/Twilio/autoload.php';

include('conexion.php');

// Obtener el nombre de usuario del usuario que ha iniciado sesión
session_start();
if (!isset($_SESSION['username'])) {
    // Si el usuario no ha iniciado sesión, redirige a la página de inicio de sesión
    header('Location: 1-index.php');
    exit();   
}
$username = $_SESSION['username'];

// Consultar la base de datos para obtener el correo electrónico y el número de móvil del usuario
$query_datos_usuario = "SELECT correo, movil FROM usuarios WHERE username = ?";
$stmt_datos_usuario = $conexion->prepare($query_datos_usuario);

if ($stmt_datos_usuario) {
    // Asociar parámetros
    $stmt_datos_usuario->bind_param("s", $username);

    // Ejecutar la consulta
    $stmt_datos_usuario->execute();

    // Vincular variables de resultados
    $stmt_datos_usuario->bind_result($correo, $movil);

    // Obtener los resultados
    $stmt_datos_usuario->fetch();

    // Cerrar el statement
    $stmt_datos_usuario->close();
} else {
    echo "<h1>Error en la preparación de la consulta: " . $conexion->error . "</h1>";
}

// Función para obtener el nombre del medicamento
function obtenerNombreMedicamento($id_medicamento, $conexion) {
    $query_nombre_medicamento = "SELECT nombre FROM medicamentos WHERE id_medicamento = ?";
    $stmt_nombre_medicamento = $conexion->prepare($query_nombre_medicamento);

    if ($stmt_nombre_medicamento) {
        // Asociar parámetros
        $stmt_nombre_medicamento->bind_param("s", $id_medicamento);

        // Ejecutar la consulta
        $stmt_nombre_medicamento->execute();

        // Vincular variables de resultados
        $stmt_nombre_medicamento->bind_result($nombre_medicamento);

        // Obtener los resultados
        $stmt_nombre_medicamento->fetch();

        // Cerrar el statement
        $stmt_nombre_medicamento->close();

        return $nombre_medicamento;
    } else {
        echo "<h1>Error en la preparación de la consulta: " . $conexion->error . "</h1>";
        return null;
    }
}

// Función para enviar correo electrónico
function enviarCorreo($destinatario, $asunto, $mensaje) {
    $mail = new PHPMailer(true);
    try {
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'pastillerovirtual000@gmail.com'; // Coloca tu dirección de correo de Gmail
        $mail->Password = 'txdd asxd uxoi dxxg'; // Coloca la contraseña de tu correo de Gmail
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        // Configurar el remitente y el destinatario
        $mail->setFrom('pastillerovirtual000@gmail.com', 'APP-PastilleroVirtual');
        $mail->addAddress($destinatario);

        // Configurar el asunto y el cuerpo del correo
        $mail->Subject = $asunto;
        $mail->CharSet = 'UTF-8'; // Configurar el juego de caracteres como UTF-8
        $mail->Body = $mensaje;

        // Enviar el correo
        return $mail->send();
    } catch (Exception $e) {
        // Si hay un error al enviar el correo electrónico, muestra un mensaje de error
        echo "<h1>Error al enviar el correo electrónico: " . $e->getMessage() . "</h1>";
        return false;
    }
}

// Función para enviar mensaje de WhatsApp
function enviarWhatsApp($numero, $mensaje) {
    // Credenciales de Twilio (obtenidas desde tu cuenta de Twilio)
    $sid    = "AC104e8683c1518f090ef5a93ad51a74cf";
    $token = 'dd85346497d40052a82777433e3c7195';

    // Crear instancia del cliente de Twilio
    $cliente = new Twilio\Rest\Client($sid, $token);

    try {
        // Enviar el mensaje de WhatsApp
        $message = $cliente->messages
            ->create("whatsapp:$numero",
                array(
                    'from' => 'whatsapp:+14155238886',
                    'body' => $mensaje
                )
            );
        return true; // Éxito al enviar el mensaje
    } catch (Exception $e) {
        // Si hay un error al enviar el mensaje de WhatsApp, muestra un mensaje de error
        echo "<h1>Error al enviar el mensaje de WhatsApp: " . $e->getMessage() . "</h1>";
        return false;
    }
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recibir datos del formulario
    $mensaje = $_POST['cantidad_dosis'];
    $fechaini = $_POST['inicio_activacion'];
    $fechafin = $_POST['fin_activacion'];
    $hora = $_POST['hora_recordatorio'];
    $dias = isset($_POST['dias']) ? implode(',', $_POST['dias']) : '';
    $sonido = $_POST['tipo_sonido'];
    $id_medicamento = $_POST['id_medicamento'];

    // Obtener el nombre del medicamento
    $nombre_medicamento = obtenerNombreMedicamento($id_medicamento, $conexion);

    if ($nombre_medicamento === null) {
        // Si no se pudo obtener el nombre del medicamento, mostrar un mensaje de error
        echo "<h1>Error: No se pudo obtener el nombre del medicamento.</h1>";
        exit();
    }

    // Por ejemplo, podrías almacenar la configuración de la alarma en la base de datos
    $query_insertar_alarma = "INSERT INTO alarmas (cantidad_dosis, correo, movil, inicio_activacion,fin_activacion, hora_recordatorio, dias, tipo_sonido, id_medicamento) 
                              VALUES (?, ?, ?, ?, ?, ?, ?, ?,?)";

    $stmt_insertar_alarma = $conexion->prepare($query_insertar_alarma);

    if ($stmt_insertar_alarma) {
        // Asociar parámetros
        $stmt_insertar_alarma->bind_param("sssssssss", $mensaje, $correo, $movil, $fechaini,$fechafin, $hora, $dias, $sonido, $id_medicamento);

        // Ejecutar la consulta
        if ($stmt_insertar_alarma->execute()) {
            // Si la alarma se configuró correctamente, intenta enviar el correo electrónico
            $asunto = 'Alarma Registrada';
            $mensajeCorreo = "Su Pastillero Virtual le recuerda que debe suministrar $mensaje dosis de su medicamento. Por favor, tome las precauciones necesarias y siga las indicaciones de su médico. Si tiene alguna pregunta o necesita ayuda, no dude en ponerse en contacto con nosotros.\n\n";
            $mensajeCorreo .= "Detalles de la alarma:\n\n";
            $mensajeCorreo .= "Medicamento: $nombre_medicamento\n";
            $mensajeCorreo .= "Cantidad de dosis: $mensaje\n";
            $mensajeCorreo .= "Hora del recordatorio: $hora\n";
            $mensajeCorreo .= "Días de suministro: $dias\n";
            $mensajeCorreo .= "Fecha de inicio de la alarma: $fechaini\n";
            $mensajeCorreo .= "Fecha de fin de la alarma: $fechafin\n";
            $mensajeCorreo .= "Sonido de la alarma: $sonido";
           
            $envioCorreo = enviarCorreo($correo, $asunto, $mensajeCorreo);

            // Construir el mensaje de WhatsApp
            $mensajeWhatsApp = "¡Hola! Es hora de tomar tu medicamento. Recuerda que debes tomar $mensaje dosis de $nombre_medicamento a las $hora. ¡No lo olvides!";

            // Enviar mensaje de WhatsApp
            $envioWhatsApp = enviarWhatsApp($movil, $mensajeWhatsApp);

            if ($envioCorreo && $envioWhatsApp) {
                // Si el envío del correo electrónico y del mensaje de WhatsApp es exitoso, muestra el mensaje de éxito
                echo "<h1>Alarma configurada con éxito y correos electrónicos enviados.</h1>";
                echo "<meta http-equiv='refresh' content='2; url=/PASTI/php/14-registroMedicamentoCRUD.php'>";
            } else {
                // Si hay un error al enviar el correo electrónico o al mensaje de WhatsApp, muestra un mensaje de error
                echo "<h1>Alarma configurada con éxito, pero hubo un error al enviar el correo electrónico o al mensaje de WhatsApp.</h1>";
                echo "<h1><a href='20-generar_alarma.php'>Volver a intentar</a></h1>";
            }
        } else {
            // Si hay un error al configurar la alarma, mostrar un mensaje de error
            echo "<h1>Error al configurar la alarma: " . $stmt_insertar_alarma->error . "</h1>";
            echo "<h1><a href='20-generar_alarma.php'>Volver a intentar</a></h1>";
        }

        // Cerrar el statement
        $stmt_insertar_alarma->close();
    } else {
        echo "<h1>Error en la preparación de la consulta: " . $conexion->error . "</h1>";
    }
}

$conexion->close();
?>
