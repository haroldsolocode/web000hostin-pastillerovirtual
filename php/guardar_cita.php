<?php
include('conexion.php');
session_start();

if (!isset($_SESSION['username'])) {
    header('Location: 1-index.php');
    exit();
}

// Obtener el ID del usuario a partir del nombre de usuario
$username = $_SESSION['username'];
$query_id_usuario = "SELECT id_registro FROM usuarios WHERE username = '$username'";
$result_id_usuario = $conexion->query($query_id_usuario);

if ($result_id_usuario->num_rows > 0) {
    $row = $result_id_usuario->fetch_assoc();
    $id_usuario = $row['id_registro'];}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener los datos del formulario
    $nombre_paciente = $_POST['nombre-paciente'];
    $fecha_cita = $_POST['fecha-cita'];
    $hora_cita = $_POST['hora-cita'];
    $tipo_cita = $_POST['tipo-cita'];
    $nombre_alarma = $_POST['nombre-alarma'];
    $hora_alarma = $_POST['hora'];
    $dia_semana = $_POST['dia-semana'];
    $sonido_alarma = $_POST['sonido-alarma'];
 

    // Insertar datos en la tabla 'citas'
    $query_cita = "INSERT INTO citas ( id_usuario, nombre_paciente, fecha_cita, hora_cita, tipo_cita) 
                   VALUES ('$id_usuario', '$nombre_paciente', '$fecha_cita', '$hora_cita', '$tipo_cita')";
    
    if ($conexion->query($query_cita)) {
        // Obtener el ID de la última cita insertada
        $id_cita = $conexion->insert_id;

        // Insertar datos en la tabla 'recordatorios'
        $query_recordatorio = "INSERT INTO recordatorios ( id_cita, nombre_alarma, hora_alarma, dia_semana, sonido_alarma) 
                               VALUES ('$id_cita', '$nombre_alarma', '$hora_alarma', '$dia_semana', '$sonido_alarma')";

        if ($conexion->query($query_recordatorio)) {
            echo "Cita y recordatorio registrados correctamente.";
        } else {
            echo "Error al registrar el recordatorio: " . $conexion->error;
        }
    } else {
        echo "Error al registrar la cita: " . $conexion->error;
    }
}
?>
