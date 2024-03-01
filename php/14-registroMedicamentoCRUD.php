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
    <title>CRUD Medicamentos</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://code.jquery.com/mobile/1.5.0-alpha.1/jquery.mobile-1.5.0-alpha.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <style>
        body {
            background-color: #f5f5f6;
            margin: 0;
            padding: 0;
            font-family: 'Arial', sans-serif;
        }

        .container {
            margin-top: 20px;
            padding: 20px;
        }

        .accordion {
            display: flex;
            flex-direction: column;
            gap: 20px; /* Aumenta el espacio vertical entre las opciones del acordeón */
        }

        .accordion-item {
            background-color: #fff;
            border-radius: 5px;
            overflow: hidden;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .accordion-header {
            padding: 15px; /* Aumenta el espacio interno del encabezado */
            cursor: pointer;
            background-color: #f5f5f6;
        }

        .accordion-content {
            padding: 15px; /* Aumenta el espacio interno del contenido */
            display: none;
        }

        .btn-row {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 10px;
            margin-top: 10px;
        }

        .btn-row .btn-action {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
        }

        .btn-row .btn-action .btn-icon {
            margin-bottom: 5px;
        }

        .button-text {
            font-size: 12px;
            margin-top: 5px;
            cursor: pointer;
            color: black;
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2 class="black-text text-accent-3 center-align">Medicamentos Registrados</h2>
        <div class="accordion">
            <p style="color: #3CB371;" >Usuario: <?php echo $_SESSION['username']; ?></p>
            <?php
            
            $consulta = $conexion->query("SELECT * FROM medicamentos");

            while ($medicamento = $consulta->fetch_assoc()) {
                $id_medicamento = $medicamento['id_medicamento'];
            ?>
                <div class="accordion-item">
                    <div class="accordion-header"><?= $medicamento["nombre"] ?></div>
                    <div class="accordion-content">
                        <p><strong>Dosificación:</strong> <?= $medicamento["dosificacion"] ?></p>
                        <p><strong>Descripción:</strong> <?= $medicamento["descripcion"] ?></p>
                        <p><strong>Vía de Administración:</strong> <?= $medicamento["via_administracion"] ?></p>
                        <p><strong>Presentación:</strong> <?= $medicamento["presentacion"] ?></p>
                        <p><strong>Cantidad:</strong> <?= $medicamento["cantidad"] ?></p>
                        <p><strong>Vencimiento:</strong> <?= $medicamento["fecha_vencimiento"] ?></p>
                        <p><strong>Contraindicaciones:</strong> <?= $medicamento["contraindicaciones"] ?></p>
                        <div class="btn-row">
                            <div class="btn-action">
                                <a href="#" class="btn-floating btn-small waves-effect waves-light orange btn-20-generar-alarma" data-medicamento-id="<?= $id_medicamento ?>">
                                    <i class="material-icons btn-icon">alarm</i>
                                </a>
                                <span class="button-text">Generar Alarma</span>
                            </div>
                            <div class="btn-action">
                                <a href="#" class="btn-floating btn-small waves-effect waves-light blue btn-19-editarMedicamento" data-medicamento-id="<?= $id_medicamento ?>">
                                    <i class="material-icons btn-icon">edit</i>
                                </a>
                                <span class="button-text">Editar Medicamento</span>
                            </div>
                            <div class="btn-action">
                                <a href="#" class="btn-floating btn-small waves-effect waves-light red btn-eliminar-medicamento" data-medicamento-id="<?= $id_medicamento ?>">
                                    <i class="material-icons btn-icon">delete</i>
                                </a>
                                <span class="button-text">Eliminar Medicamento</span>
                            </div>
                        </div>
                    </div>
                </div>
            <?php
            }
            ?>
        </div>
        <br><br><br><br><br><br>
        <a href="13-medicamento.php" class="btn btn-small waves-effect waves-light" id="btn-regresar">Regresar</a>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const accordionHeaders = document.querySelectorAll('.accordion-header');

            accordionHeaders.forEach(header => {
                header.addEventListener('click', function () {
                    const content = this.nextElementSibling;
                    content.style.display = content.style.display === 'none' ? 'block' : 'none';
                });
            });

            // Agregar evento click a los botones de acción
            const alarmButtons = document.querySelectorAll('.btn-20-generar-alarma');
            const editButtons = document.querySelectorAll('.btn-19-editarMedicamento');
            const deleteButtons = document.querySelectorAll('.btn-eliminar-medicamento');

            alarmButtons.forEach(button => {
                button.addEventListener('click', function (event) {
                    event.stopPropagation(); // Evitar que se propague el evento al contenedor
                    const id = this.dataset.medicamentoId;
                    window.location.href = `20-generar_alarma.php?id=${id}`;
                });
            });

            editButtons.forEach(button => {
                button.addEventListener('click', function (event) {
                    event.stopPropagation();
                    const id = this.dataset.medicamentoId;
                    window.location.href = `19-editarMedicamento.php?id=${id}`;
                });
            });

            deleteButtons.forEach(button => {
                button.addEventListener('click', function (event) {
                    event.stopPropagation();
                    const id = this.dataset.medicamentoId;
                    const confirmar = confirm('¿Estás seguro de que deseas eliminar este medicamento?');
                    if (confirmar) {
                        window.location.href = `eliminar_medicamento.php?id=${id}`;
                    }
                });
            });
        });
        document.getElementById('btn-regresar').addEventListener('click', function(event) {
        event.preventDefault(); // Evitar que el enlace funcione antes del desplazamiento
        window.location.href = this.getAttribute('href'); // Redireccionar a la URL del enlace
        window.scrollTo(0, 0); // Desplazar la página al principio
    });
    </script>
</body>

</html>
            