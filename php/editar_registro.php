<?php
// Verifica si se ha enviado un ID válido en la URL
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id_registro = $_GET['id'];
    
    // Conecta a la base de datos (asegúrate de configurar la conexión)
    include('conexion.php');
    
    // Realiza una consulta para obtener los datos del registro a editar
    $query = "SELECT * FROM usuarios WHERE id_registro = $id_registro";
    $resultado = $conexion->query($query);
    
    // Verifica si se encontró el registro
    if ($resultado->num_rows == 1) {
        $registro = $resultado->fetch_assoc();
    } else {
        // Si no se encontró el registro, puedes manejar el error o redirigir a otra página
        echo "El registro no existe.";
        exit;
    }
} else {
    // Si no se proporcionó un ID válido en la URL, puedes manejar el error o redirigir a otra página
    echo "ID no válido.";
    exit;
}

// Procesa el formulario de edición si se ha enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recupera los datos enviados desde el formulario
    $nuevos_nombres = $_POST['nombres'];
    $nuevos_apellidos = $_POST['apellidos'];
    $nueva_fecha_nacimiento = $_POST['fecha_nacimiento'];
    $nueva_nacionalidad = $_POST['nacionalidad'];
    $nuevo_sexo = $_POST['sexo'];
    $nuevo_correo = $_POST['correo'];
    $nuevo_movil = $_POST['movil'];
    $nuevo_username = $_POST['username'];
    $nueva_contrasena = $_POST['contrasena'];

    // Realiza la actualización en la base de datos
    $query = "UPDATE usuarios SET nombres = '$nuevos_nombres', apellidos = '$nuevos_apellidos', fecha_nacimiento = '$nueva_fecha_nacimiento', nacionalidad = '$nueva_nacionalidad', sexo = '$nuevo_sexo', correo = '$nuevo_correo', movil = '$nuevo_movil', username = '$nuevo_username', contrasena = '$nueva_contrasena' WHERE id_registro = $id_registro";
    
    if ($conexion->query($query) === TRUE) {
        echo "Registro actualizado con éxito.";
        // Redirige a la página principal u otra página de tu elección
        header('Location: registroCRUD.php');
        exit;
    } else {
        echo "Error al actualizar el registro: " . $conexion->error;
    }
}

// Cierra la conexión a la base de datos
$conexion->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Registro</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>
<body>
    <div class="col-8 p-4">
        <h4>Editar Registro</h4>
        <form action="editar_registro.php? id=<?= $id_registro ?>" method="POST">
            <input type="text" name="nombres" placeholder="Nombres" value="<?= $registro['nombres'] ?>">
            <input type="text" name="apellidos" placeholder="Apellidos" value="<?= $registro['apellidos'] ?>">
            <input type="text" name="fecha_nacimiento" placeholder="Fecha de Nacimiento" value="<?= $registro['fecha_nacimiento'] ?>">
            <input type="text" name="nacionalidad" placeholder="Nacionalidad" value="<?= $registro['nacionalidad'] ?>">
            <input type="text" name="sexo" placeholder="Sexo" value="<?= $registro['sexo'] ?>">
            <input type="text" name="correo" placeholder="Correo" value="<?= $registro['correo'] ?>">
            <input type="text" name="movil" placeholder="Movil" value="<?= $registro['movil'] ?>">
            <input type="text" name="username" placeholder="Ingrese Nombre de Usuario" value="<?= $registro['username'] ?>">
            <input type="text" name="contrasena" placeholder="Contraseña" value="<?= $registro['contrasena'] ?>">
            <button type="submit" class="btn waves-effect waves-light blue">
                Actualizar
                <i class="material-icons right">edit</i>
            </button>
        </form>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
</body>
</html>