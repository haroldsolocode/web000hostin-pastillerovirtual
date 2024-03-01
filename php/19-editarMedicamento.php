<?php
// Verifica si se ha enviado un ID válido en la URL
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id_medicamento = $_GET['id'];

    // Conecta a la base de datos (asegúrate de configurar la conexión)
    include('conexion.php');

    // Realiza una consulta para obtener los datos del medicamento a editar
    $query = "SELECT * FROM medicamentos WHERE id_medicamento = $id_medicamento";
    $resultado = $conexion->query($query);

    // Verifica si se encontró el medicamento
    if ($resultado->num_rows == 1) {
        $medicamento = $resultado->fetch_assoc();
    } else {
        // Si no se encontró el medicamento, puedes manejar el error o redirigir a otra página
        echo "El medicamento no existe.";
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
    $nuevo_nombre = $_POST['nombre'];
    $nueva_dosificacion = $_POST['dosificacion'];
    $nueva_descripcion = $_POST['descripcion'];
    $nueva_via_administracion = $_POST['via_administracion'];
    $nueva_presentacion = $_POST['presentacion'];
    $nueva_cantidad = $_POST['cantidad'];
    $nuevo_vencimiento = $_POST['vencimiento'];
    $nueva_contraindicacion = $_POST['contraindicacion'];

    // Realiza la actualización en la base de datos
    $query = "UPDATE medicamentos SET nombre = '$nuevo_nombre', dosificacion = '$nueva_dosificacion', descripcion = '$nueva_descripcion', via_administracion = '$nueva_via_administracion', presentacion = '$nueva_presentacion', cantidad = '$nueva_cantidad', fecha_vencimiento = '$nuevo_vencimiento', contraindicaciones = '$nueva_contraindicacion' WHERE id_medicamento = $id_medicamento";

    if ($conexion->query($query) === TRUE) {
        echo "Medicamento actualizado con éxito.";
        // Redirige a la página principal u otra página de tu elección
        header('location: 14-registroMedicamentoCRUD.php');
        exit;
    } else {
        echo "Error al actualizar el medicamento: " . $conexion->error;
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
    <title>Editar Medicamento</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background-color: #f0f0f0; /* Color de fondo de la página */
        }

        .container {
            width: 95%;
            max-width: 700px; /* Ajusta el ancho máximo según tus necesidades */
            margin: 20px; /* Agrega márgenes para separar del borde de la pantalla */
            background-color: white; /* Color de fondo del contenedor */
            padding: 20px; /* Agrega espacio interno */
            border-radius: 10px; /* Bordes redondeados */
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); /* Sombra para resaltar el contenedor */
        }
    </style>
</head>
<body>
    <div class="container">
        <h4>Editar Medicamento</h4>
        <form action="19-editarMedicamento.php?id=<?= $id_medicamento ?>" method="POST">
            <div class="input-field">
                <label for="nombre">Nombre</label>
                <input type="text" name="nombre" id="nombre" value="<?= $medicamento['nombre'] ?>">
            </div>
            <div class="input-field">
                <label for="dosificacion">Dosificación</label>
                <input type="text" name="dosificacion" id="dosificacion" value="<?= $medicamento['dosificacion'] ?>">
            </div>
            <div class="input-field">
                <label for="descripcion">Descripción</label>
                <input type="text" name="descripcion" id="descripcion" value="<?= $medicamento['descripcion'] ?>">
            </div>
            <div class="input-field">
                <label for="via_administracion">Vía de Administración</label>
                <input type="text" name="via_administracion" id="via_administracion" value="<?= $medicamento['via_administracion'] ?>">
            </div>
            <div class="input-field">
                <label for="presentacion">Presentación</label>
                <input type="text" name="presentacion" id="presentacion" value="<?= $medicamento['presentacion'] ?>">
            </div>
            <div class="input-field">
                <label for="cantidad">Cantidad</label>
                <input type="text" name="cantidad" id="cantidad" value="<?= $medicamento['cantidad'] ?>">
            </div>
            <div class="input-field">
                <label for="vencimiento">Fecha de Vencimiento</label>
                <input type="text" name="vencimiento" id="vencimiento" value="<?= $medicamento['fecha_vencimiento'] ?>">
            </div>
            <div class="input-field">
                <label for="contraindicacion">Contraindicaciones</label>
                <input type="text" name="contraindicacion" id="contraindicacion" value="<?= $medicamento['contraindicaciones'] ?>">
            </div>
            <button type="submit" class="btn waves-effect waves-light blue">
                Actualizar
                <i class="material-icons right">edit</i>
            </button>
            <a href="14-registroMedicamentoCRUD.php" class="btn waves-effect waves-light green darken-3">
            Volver
            <i class="material-icons right">arrow_back</i>
        </a>
        </form>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
</body>
</html>


