<?php
ob_start();
// Configuración de la base de datos
$servidor = "localhost";
$usuario = "id21805195_userpasti";
$contrasena = "Abc123456_789";
$base_de_datos = "id21805195_pastiprueba";
// Crear una conexión a la base de datos
$conexion = new mysqli($servidor, $usuario, $contrasena, $base_de_datos);
// Verificar la conexión
if ($conexion->connect_error) {
    die("Error de conexión a la base de datos: " . $conexion->connect_error);
}
?>

