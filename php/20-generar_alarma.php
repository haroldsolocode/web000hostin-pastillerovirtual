<?php
include('conexion.php');
session_start();
if (!isset($_SESSION['username'])) {
    // Si el usuario no ha iniciado sesión, redirige a la página de inicio de sesión
    header('Location: 1-index.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Generar Alarma</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <style>
        body {
        background-color: #3F3F3F; /* Color blanco */
    }
    </style>
</head>

<body class="container">

    <h2 class="teal-text text-accent-3 center-align">Configurar Alarma</h2>
    <p style="color: #3CB371;">Usuario: <?php echo $_SESSION['username']; ?></p>

    <?php

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

    // Obtener el id_medicamento de la URL
    $id_medicamento = isset($_GET['id']) ? $_GET['id'] : null;

    // Verificar si el id_medicamento es válido
    if ($id_medicamento !== null) {
        // Puedes realizar acciones con el id_medicamento, por ejemplo, guardarlo en una variable
        $id_medicamento_para_usar = $id_medicamento;

        // Obtener el nombre del medicamento desde la base de datos
        $query_nombre = "SELECT nombre FROM medicamentos WHERE id_medicamento = ?";

        $stmt_nombre = $conexion->prepare($query_nombre);
        $stmt_nombre->bind_param("i", $id_medicamento);
        $stmt_nombre->execute();
        $stmt_nombre->bind_result($nombre);
        $stmt_nombre->fetch();
        $stmt_nombre->close();

        // Obtener el correo y el whatsapp del usuario desde la base de datos
        $query_datos_usuario = "SELECT correo, movil FROM usuarios WHERE username = ?";
        $stmt_datos_usuario = $conexion->prepare($query_datos_usuario);
        $stmt_datos_usuario->bind_param("s", $_SESSION['username']);
        $stmt_datos_usuario->execute();
        $stmt_datos_usuario->bind_result($correo, $whatsapp);
        $stmt_datos_usuario->fetch();
        $stmt_datos_usuario->close();
    } else {
        // Manejar el caso en el que no se proporcionó el id_medicamento
        echo "No se proporcionó un id_medicamento válido.";
    }

    ?>

    <form action="procesar_alarma.php" method="post" class="col s12" onsubmit="return validarFormulario()">
          
        
         <div class="input-field">
            <label for="correo">Correo Electrónico:</label>
            <input type="email" id="correo" name="correo" class="validate" value="<?php echo $correo; ?>" readonly>
        </div>

        <div class="input-field">
            <label for="whatsapp">Número de WhatsApp:</label>
            <input type="text" id="whatsapp" name="whatsapp" class="validate" value="<?php echo $whatsapp; ?>" readonly>
        </div>
        
        <div class="input-field">
            <label for="nombre">Nombre del Medicamento:</label>
            <input type="text" style="color: #3CB371; text-transform: uppercase; font-weight: bold;" id="nombre" name="nombre" class="validate" value="<?php echo $nombre; ?>" readonly>
        </div>
        
        <div class="input-field">
            <label for="cantidad_dosis">Cantidad de Dosis:</label>
            <input type="number" style="color: #3CB371; text-transform: uppercase; font-weight: bold;" id="cantidad_dosis" name="cantidad_dosis" class="validate" required min="1" value="1">
        </div>
        
       <div class="input-field">
            <label for="inicio_activacion">Recordatorio inicia:</label><br>
            <input type="date" id="inicio_activacion" name="inicio_activacion" class="validate" required>
            <span class="helper-text" data-error="Selecciona una fecha válida"></span>
        </div>

        <div class="input-field">
            <label for="fin_activacion">Recordatorio termina:</label><br>
            <input type="date" id="fin_activacion" name="fin_activacion" class="validate" required>
            <span class="helper-text" data-error="Selecciona una fecha válida"></span>
        </div>
         <div class="input-field">
            <label for="hora">Hora del Recordatorio:</label><br>
            <input type="time" id="hora" name="hora_recordatorio" class="validate" required>
        </div>

        <div class="input-field">
            <label>Frecuencia de Repetición:</label><br>
            <p>
                <label>
                    <input type="checkbox" id="diario" name="diario" onclick="seleccionarTodosLosDias(this)" />
                    <span>Diario</span>
                </label>
            </p>
            <p>
                <label>
                    <input type="checkbox" id="lunes" name="dias[]" value="lunes" />
                    <span>Lunes</span>
                </label>
            </p>
            <p>
                <label>
                    <input type="checkbox" id="martes" name="dias[]" value="martes" />
                    <span>Martes</span>
                </label>
            </p>
            <p>
                <label>
                    <input type="checkbox" id="miercoles" name="dias[]" value="miercoles" />
                    <span>Miércoles</span>
                </label>
            </p>
            <p>
                <label>
                    <input type="checkbox" id="jueves" name="dias[]" value="jueves" />
                    <span>Jueves</span>
                </label>
            </p>
            <p>
                <label>
                    <input type="checkbox" id="viernes" name="dias[]" value="viernes" />
                    <span>Viernes</span>
                </label>
            </p>
            <p>
                <label>
                    <input type="checkbox" id="sabado" name="dias[]" value="sabado" />
                    <span>Sábado</span>
                </label>
            </p>
            <p>
                <label>
                    <input type="checkbox" id="domingo" name="dias[]" value="domingo" />
                    <span>Domingo</span>
                </label>
            </p>
        </div>

        <div class="input-field">
            <label for="tipo_sonido">Tipo de Sonido:</label><br><br>
            <select id="tipo_sonido" name="tipo_sonido" class="validate" required>
                <option value="sonido1">Sonido 1</option>
                <option value="sonido2">Sonido 2</option>
                <option value="sonido3">Sonido 3</option>
                <!-- Agrega más opciones según sea necesario -->
            </select>
        </div>

        <input type="hidden" name="id_medicamento" value="<?= $id_medicamento ?>">

        <button class="btn waves-effect waves-light" type="submit">Guardar Alarma</button>
        <br><br><br>
        <a href="#" class="btn waves-effect waves-light teal darken-3" onclick="history.go(-1);">Volver Atrás</a>
    </form>

    <?php
    $conexion->close();
    ?>

    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <script>
        $(document).ready(function () {
            M.updateTextFields(); // Actualiza los campos de Materialize al cargar la página
            $('select').formSelect(); // Inicializa los select
        });

        function validarFormulario() {
            var inicio_activacion = document.getElementById("inicio_activacion").value;
            var fin_activacion = document.getElementById("fin_activacion").value;
            var checkboxes = document.getElementsByName('dias[]');
            var selected = false;

            // Resto de las validaciones aquí

            return true;
        }
        function seleccionarTodosLosDias(checkbox) {
            var checkboxes = document.getElementsByName('dias[]');
            for (var i = 0; i < checkboxes.length; i++) {
                checkboxes[i].checked = checkbox.checked;
            }
        }

        document.getElementById('inicio_activacion').addEventListener('change', function() {
            var inicio_activacion = new Date(this.value);
            var fin_activacion = new Date(document.getElementById('fin_activacion').value);
            if (inicio_activacion > fin_activacion) {
                document.getElementById('fin_activacion').value = this.value;
            }
            document.getElementById('fin_activacion').min = this.value;
        });

        document.getElementById('fin_activacion').addEventListener('change', function() {
            var inicio_activacion = new Date(document.getElementById('inicio_activacion').value);
            var fin_activacion = new Date(this.value);
            if (fin_activacion < inicio_activacion) {
                document.getElementById('inicio_activacion').value = this.value;
            }
        });

        // Establecer el valor mínimo del campo inicio_activacion como la fecha actual menos un día
        var today = new Date();
        var yesterday = new Date(today);
        yesterday.setDate(yesterday.getDate() - 1);
        document.getElementById('inicio_activacion').min = yesterday.toISOString().split('T')[0];
    </script>
</body>

</html>
