<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualizar Datos</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>
<body>
    <div class="col-8 p-4">
        <table class="table">
            <thead class="card-panel teal accent-3">
                <tr>
                    <th>Nombres</th>
                    <th>Apellidos</th>
                    <th>Fecha De Nacimiento</th>
                    <th>Nacionalidad</th>
                    <th>Sexo</th>
                    <th>Correo</th>
                    <th>Movil</th>
                    <th>Username</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include('conexion.php');
                session_start();
                // Asume que ya tienes el ID del usuario conectado
                $id_usuario = $_SESSION['username'];
                $ins = $conexion->prepare("SELECT * FROM usuarios WHERE id_registro = ?");
                $ins->bind_param("i", $id_registro);
                $ins->execute();
                $result = $ins->get_result();

                if ($result->num_rows > 0) {
                    $datos = $result->fetch_assoc();
                ?>
                    <tr>
                        <td><?= $datos["nombres"] ?></td>
                        <td><?= $datos["apellidos"] ?></td>
                        <td><?= $datos["fecha_nacimiento"] ?></td>
                        <td><?= $datos["nacionalidad"] ?></td>
                        <td><?= $datos["sexo"] ?></td>
                        <td><?= $datos["correo"] ?></td>
                        <td><?= $datos["movil"] ?></td>
                        <td><?= $datos["username"] ?></td>
                    </tr>
                <?php } else {
                    echo "esta pagina esta en construcción";
                }
                ?>
                <h2>esta en construcción</h2>
            </tbody>
        </table>
    </div>
</body>
</html>
