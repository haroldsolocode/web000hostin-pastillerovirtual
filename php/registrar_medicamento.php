<?php
// Conexión a la base de datos
include('conexion.php');

$conn = new mysqli($servidor, $usuario, $contrasena, $base_de_datos);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener los datos del formulario de manera segura
$medicamento = mysqli_real_escape_string($conn, $_POST['medicamento']);
$dosificacion = mysqli_real_escape_string($conn, $_POST['dosificacion']);
$indicaciones = mysqli_real_escape_string($conn, $_POST['descripcion']);
$via_administracion = mysqli_real_escape_string($conn, $_POST['via-administracion']);
$presentacion = mysqli_real_escape_string($conn, $_POST['presentacion']);
$cantidad = mysqli_real_escape_string($conn, $_POST['cantidad']);
$vencimiento = mysqli_real_escape_string($conn, $_POST['vencimiento']);
$contraindicacion = mysqli_real_escape_string($conn, $_POST['contraindicacion']);

// Consulta preparada para insertar los datos en la base de datos
$sql = "INSERT INTO medicamentos (nombre, dosificacion, descripcion, via_administracion, presentacion, cantidad, fecha_vencimiento, contraindicaciones)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);

if ($stmt) {
    // Asociar parámetros
    $stmt->bind_param("ssssssss", $medicamento, $dosificacion, $indicaciones, $via_administracion, $presentacion, $cantidad, $vencimiento, $contraindicacion);

    // Ejecutar la consulta
    if ($stmt->execute()) {
       
        echo "<p style='font-size: 50px; color: green; text-align: center; padding: 100px '>Medicamento registrado con éxito</p>";
        // Redireccionar a la página 13-medicamento.html después de un breve retraso (1 segundo)

        header("refresh:2; url= 13-medicamento.php");
    } else {
        echo "Error al registrar el medicamento: " . $stmt->error;
    }
    

    // Cerrar el statement
    $stmt->close();
} else {
    echo "Error en la preparación de la consulta: " . $conn->error;
}

// Cerrar la conexión a la base de datos
$conn->close();

?>
