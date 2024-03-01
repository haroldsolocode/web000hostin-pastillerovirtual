<?php
include('conexion.php');
session_start(); // Inicia la sesión (debe estar al principio del archivo)
if (!isset($_SESSION['username'])) {
    // Si el usuario no ha iniciado sesión, redirige a la página de inicio de sesión
    header('Location: 1-index.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <title>Pastillero Virtual - Bienvenida</title>
    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css"
    />
    <style>
        h1, h4 {
            font-size: 40px;
            margin: 0;
            font-family: "Poppins", sans-serif;
        }

        body {
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            min-height: 100vh;
        }

        .logo {
            max-width: 350px;
            margin-top: 20px;
        }

        .profile-buttons {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            margin-top: 20px;
            padding: 10px 0;
        }

        .profile-button {
            color: white;
            margin: 5px;
        }

        .profile-images {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            align-items: center;
            margin-top: 20px;
        }

        .profile-image {
            max-width: 40%;
            text-align: center;
            position: relative;
            margin: 10px;
        }

        .profile-image img {
            display: block;
            margin: 0 auto;
            max-width: 60%;
            height: auto;
        }

        .back-button {
            margin-top: 20px;
            text-align: center;
        }

        .green-divider {
            width: 100%;
            height: 100px;
            background-color: #00BF63;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .divider-message {
            font-size: 18px;
            color: white;
        }

        .profile-content {
            width: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding-bottom: 20px;
        }

        .button-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-top: 10px;
        }

        .logout-button {
            background-color: #00ff00;
            color: white;
            margin: 10px;
        }

        .welcome-message {
            font-size: 24px;
            color: #00BF63;
            margin-top: 10px;
            text-align: center;
        }

        .welcome-message {
            animation: moveMessage 3s linear infinite;
        }

        @keyframes moveMessage {
            0% { transform: translateX(0); }
            50% { transform: translateX(20px); }
            100% { transform: translateX(0); }
        }
    </style>
</head>

<body>
    <div class="container">
        <?php
        if (isset($_SESSION['username'])) {
            $username = $_SESSION['username'];
            echo '<p class="welcome-message">¡Bienvenido, ' . $username . '!</p>';
        }
        ?>

        <div class="logo-container">
            <img src="/PASTI/imagenes/pastilleroVirtualrecortado.jpeg" alt="Logo" />
            <a href="/PASTI/php/logout.php" class="btn waves-effect waves-light green logout-button" style="float: right;">Cerrar Sesión</a>
        </div>

        <div class="profile-buttons">
            <a href="/PASTI/html/2-mision.html" class="btn profile-button">Misión</a>
            <a href="/PASTI/html/3-vision.html" class="btn profile-button">Visión</a>
            <a href="/PASTI/html/4-contacto.html" class="btn profile-button">Contacto</a>
            <a href="/PASTI/html/5-ayuda.html" class="btn profile-button">Ayuda</a>
            <a href="/PASTI/html/6-blog.html" class="btn profile-button">Blog</a>
        </div>

        <div class="green-divider">
            <div class="divider-message" style="font-size: 20px;">"¿Cómo usarás la app? Perfil: Paciente o Cuidador"</div>
        </div>
        <br><br>

        <h4>Perfil</h4>

        <div class="profile-images">
            <div class="profile-image">
                <img src="/PASTI/imagenes/paciente2IA.jpeg" alt="Paciente" />
                <a href='10-perfilpaciente.php' class="btn waves-effect waves-light green">Paciente</a>
            </div>
            <div class="profile-image">
                <img src="/PASTI/imagenes/cuidadorIA.jpeg" alt="Cuidador" />
                <a href="/PASTI/html/12-perfilcuidador.html" class="btn waves-effect waves-light green">Cuidador</a>
            </div>
        </div>

        <div class="button-container">
           <a href="actualizar_datos.php" class="btn waves-effect waves-light"  onclick="M.toast({html: 'Esta en construcción'})">Actualizar Datos</a><br>

            <a href="#" class="btn waves-effect waves-lightblue-grey"style="background-color: #00BF63;" onclick="M.toast({html: 'Esta en construcción'})">Configuraciones</a>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
</body>

</html>


