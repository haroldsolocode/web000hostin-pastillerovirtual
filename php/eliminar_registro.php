<?php

// Verifica si se ha enviado un ID válido en la URL
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id_registro = $_GET['id'];
    
    // Conecta a la base de datos (asegúrate de configurar la conexión)
    include('conexion.php');
    
    // Realiza una consulta para eliminar el registro
    $query = "DELETE FROM usuarios WHERE id_registro = $id_registro";
    
    if ($conexion->query($query) === TRUE) {
        // Redirige a la página principal u otra página de tu elección después de la eliminación
        header('Location:/PASTI/php/registroCRUD.php');
        exit;
    } else {
        echo "Error al eliminar el registro: " . $conexion->error;
    }
} else {
    // Si no se proporcionó un ID válido en la URL, puedes manejar el error o redirigir a otra página
    echo "ID no válido.";
    exit;
}
// Cierra la conexión a la base de datos
$conexion->close();
?>