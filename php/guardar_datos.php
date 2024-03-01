<?php
include('conexion.php');

// Recibir datos del formulario
$nombres = $_POST['nombres'];
$apellidos = $_POST['apellidos'];
$fecha_nacimiento = $_POST['fecha_nacimiento'];
$nacionalidad = $_POST['nacionalidad'];
$sexo = $_POST['sexo'];
$correo = $_POST['correo'];
$movil = $_POST['movil'];
$username = $_POST['username'];
$contrasena = $_POST['contrasena'];

// Validar que el correo y el usuario no existan en la base de datos
$query_validacion = "SELECT id_registro FROM usuarios WHERE correo = '$correo' OR username = '$username'";
$result_validacion = $conexion->query($query_validacion);

if ($result_validacion->num_rows > 0) {
    // Si ya existe un usuario o correo, mostrar un mensaje de error
    echo "<h1>Error: El correo electrónico o el nombre de usuario ya están registrados.</h1>";
    echo "<h1>Error: Intenta Nuevamente el Registro.</h1>";
    echo "<meta http-equiv='refresh' content='5;url=/PASTI/html/8-Registro.html'>"; // Redirige después de 5 segundos;
} else {
    // Insertar datos en la tabla 'usuarios'
    $query_insertar = "INSERT INTO usuarios (nombres, apellidos, fecha_nacimiento, nacionalidad, sexo, correo, movil, username, contrasena) 
                       VALUES ( '$nombres', '$apellidos', '$fecha_nacimiento', '$nacionalidad', '$sexo', '$correo', '$movil', '$username', '$contrasena')";

    $ins = $conexion->query($query_insertar);

    if ($ins) {
        // Si la inserción es exitosa, mostrar un mensaje de éxito y el enlace para iniciar sesión
        echo "<h1>Registro guardado con éxito.</h1>";
        echo "<h1> Ya Puedes Ingresar.</h1>";
        echo "<meta http-equiv='refresh' content='5;url=/PASTI/php/1-index.php'>"; // Redirige después de 5 segundos
    } else {
        // Si hay un error al registrar el usuario, mostrar un mensaje de error y un enlace para volver a intentar el registro
        echo "<h1>Error al registrar el usuario: " . $conexion->error . "</h1>";
        echo "<meta http-equiv='refresh' content='5;url=/PASTI/html/8-Registro.html'>";
    }
}
?>

