<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"> <!-- Define la codificación de caracteres como UTF-8. -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- Configura la vista en dispositivos móviles. -->
    <title>CRUD_REGISTRO</title> <!-- Establece el título de la página en la barra de título del navegador. -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css"> <!-- Enlaza la hoja de estilos CSS de Materialize. -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet"> <!-- Enlaza las fuentes de iconos de Google Material Icons. -->
</head>
<body>
    <div class="col-8 p-4"> <!-- Crea un contenedor div con clases de estilo. -->
        <table class="table"> <!-- Inicia una tabla con una clase de estilo. -->
            <thead class="card-panel teal accent-3"> <!-- Crea el encabezado de la tabla con estilos de Materialize. -->
                <tr> <!-- Inicia una fila en el encabezado de la tabla. -->
                    <!-- Define las celdas del encabezado de la tabla. -->
                    <th>ID</th>
                    <th>Nombres</th>
                    <th>Apellidos</th>
                    <th>Fecha De Nacimiento</th>
                    <th>Nacionalidad</th>
                    <th>Sexo</th>
                    <th>Correo</th>
                    <th>Movil</th>
                    <th>Username</th>
                    <th>Contraseña</th>
                    <th></th> <!-- Una celda vacía en el encabezado. -->
                </tr>
            </thead>
            <tbody> <!-- Inicia el cuerpo de la tabla donde se mostrarán los datos de los usuarios. -->
                <?php 
                include('conexion.php'); // Incluye un archivo de conexión a la base de datos.
                $ins = $conexion->query("SELECT * FROM usuarios"); // Ejecuta una consulta SQL para obtener registros de usuarios.
                while ($datos = $ins->fetch_assoc()) { ?> <!-- Inicia un bucle para mostrar los datos de los usuarios. -->
                    <tr> <!-- Inicia una fila de datos de usuario. -->
                        <!-- Muestra los datos de cada campo de usuario en celdas de la tabla. -->
                        <td><?= $datos["id_registro"] ?></td>
                        <td><?= $datos["nombres"] ?></td>
                        <td><?= $datos["apellidos"] ?></td>
                        <td><?= $datos["fecha_nacimiento"] ?></td>
                        <td><?= $datos["nacionalidad"] ?></td>
                        <td><?= $datos["sexo"] ?></td>
                        <td><?= $datos["correo"] ?></td>
                        <td><?= $datos["movil"] ?></td>
                        <td><?= $datos["username"] ?></td>
                        <td><?= $datos["contrasena"] ?></td>
                        <td> <!-- Celda con botones de edición y eliminación. -->
                            <a href="editar_registro.php?id=<?= $datos['id_registro'] ?>" class="btn-floating btn-small waves-effect waves-light blue">
                                <i class="material-icons">edit</i> <!-- Icono de edición. -->
                            </a>
                            <a href="eliminar_registro.php?id=<?= $datos['id_registro'] ?>" class="btn-floating btn-small waves-effect waves-light red" onclick="return confirm('¿Estás seguro de que deseas eliminar este registro?');">
                                <i class="material-icons">delete</i> <!-- Icono de eliminación. -->
                            </a>
                        </td>
                    </tr>
                <?php }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
