<?php
// Conexión a la base de datos
include('conexion.php');

// Obtener el nombre del medicamento de la solicitud POST
$medicationName = $_POST['medicationName'];

// Insertar el nombre del medicamento en la base de datos (esto es solo un ejemplo)
$sql = "INSERT INTO medicamentos (nombre) VALUES ('$medicationName')";

if ($conn->query($sql) === TRUE) {
    echo "Medicamento registrado en el servidor";
} else {
    echo "Error al registrar el medicamento en el servidor: " . $conn->error;
}

// Cerrar la conexión a la base de datos
$conn->close();
?>
