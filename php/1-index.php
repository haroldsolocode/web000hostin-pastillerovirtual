<?php
session_start(); // Inicia la sesión (debe estar al principio del archivo)
include('conexion.php');
ob_start();
?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Pastillero Virtual</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@800&display=swap');

    h1,
    h2 {
      font-size: 40px; /* Ajusta el tamaño del título para dispositivos móviles */
      margin: 0;
      font-family: 'Poppins', sans-serif;
    }

    h1 + h2 {
      margin-top: -10px;
    }

    .button-space {
      margin-top: 20px;
    }

    .link-space {
      margin-top: 20px; /* Reduce el espacio entre los enlaces para dispositivos móviles */
    }

    .tarro-pastillas img {
      width: 100%; /* Ajusta el ancho de la imagen para que sea responsiva */
      max-width: 500px; /* Establece un ancho máximo para la imagen */
      height: auto; /* Permite que la altura se ajuste automáticamente */
    }

    h2 {
      margin-left: 0; /* Elimina el margen izquierdo para dispositivos móviles */
      text-align: center; /* Centra el título en dispositivos móviles */
    }

    /* Botonera */
    .button-wrapper {
      display: flex;
      flex-wrap: wrap; /* Permite que los botones se envuelvan en dispositivos móviles */
      justify-content: center;
      margin-top: 20px;
      color: rgb(6, 133, 90);
    }

    .button-wrapper button {
      margin: 5px; /* Ajusta el margen entre los botones */
    }

    .input-field.col.s12 {
      display: flex;
      justify-content: center;
    }

    /* Estilo para el mensaje de inicio de sesión fallido */
    .error-message {
      color: red;
      font-weight: bold;
      text-align: center;
      position: absolute;
      top: 70%; /* Centra el mensaje verticalmente */
      left: 50%; /* Centra el mensaje horizontalmente */
      transform: translate(-50%, -50%); /* Centra el mensaje completamente */
      animation: blinkMessage 1s ease-in-out infinite;
    }

    @keyframes blinkMessage {
      0%, 100% {
        opacity: 1;
      }
      50% {
        opacity: 0;
      }
    }
  </style>
</head>

<body style="background-color: white;">
  <div class="container">
    <h1 class="center-align" style="color: rgb(0, 0, 0);">Pastillero </h1>
    <h2>Virtual</h2>

    <div class="row center-align button-wrapper">
      <div class="col s12 m6 l2">
        <button class="waves-effect waves-light btn"><a href="/PASTI/html/2-mision.html" style="color: inherit; text-decoration: none;">Misión</a></button>
      </div>
      <div class="col s12 m6 l2">
        <button class="waves-effect waves-light btn"><a href="/PASTI/html/3-vision.html" style="color: inherit; text-decoration: none;">Visión</a></button>
      </div>
      <div class="col s12 m6 l2">
        <button class="waves-effect waves-light btn"><a href="/PASTI/html/4-contacto.html" style="color: inherit; text-decoration: none;">Contacto</a></button>
      </div>
      <div class="col s12 m6 l2">
        <button class="waves-effect waves-light btn"><a href="/PASTI/html/5-ayuda.html" style="color: inherit; text-decoration: none;">Ayuda</a></button>
      </div>
      <div class="col s12 m6 l2">
        <button class="waves-effect waves-light btn"><a href="/PASTI/html/6-blog.html" style="color: inherit; text-decoration: none;">Blog</a></button>
      </div>
    </div>

    <div class="row center-align">
      <img src="/PASTI/imagenes/WhatsApp Image 2023-06-21 at 11.33.17 PM.jpeg" alt="Pastillas" width="200px">
    </div>

    <form method="post" action="">
      <div class="row">
        <div class="input-field col s12">
          <input id="username" type="text" class="validate" name="username">
          <label for="username">Nombre de usuario</label>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s12">
          <input id="contrasena" type="password" class="validate" name="contrasena">
          <label for="password">Contraseña</label>
        </div>
      </div>
      <div class="row center-align button-space">
        <button class="waves-effect waves-light btn green" type="submit" name="login">Ingresar</button>
      </div>
      <div class="row center-align link-space">
        <a class="link-underline"style="font-size: 19px;" href="/PASTI/html/7-recuperarContrase%C3%B1a.html">¿Olvidó su contraseña?</a>
      </div>
      <div class="row center-align link-space">
        <a class="link-underline"style="font-size: 19px;" href="/PASTI/html/8-Registro.html">Registrarse</a>
      </div>
      <div class="row center-align image-space tarro-pastillas">
        <img src="/PASTI/imagenes/tarro pastillas.jpg" alt="Pastillas" width="500px">
      </div>
    </form>

    <?php
    if (isset($_POST['login'])) {
      // Procesa la consulta en la misma página

      // Obtén los datos del formulario
      $username = $_POST['username'];
      $contrasena = $_POST['contrasena'];

      // Verifica si los campos están vacíos
      if (empty($username) || empty($contrasena)) {
        echo '<div class="error-message">Ingresa el nombre de usuario y contraseña.</div>';
      } else {
        // Realiza la consulta en la base de datos
        $consulta = "SELECT * FROM usuarios WHERE username = '$username' AND contrasena = '$contrasena'";
        $resultado = $conexion->query($consulta);

        // Verifica si la consulta fue exitosa
        if ($resultado->num_rows > 0) {
          $_SESSION['username'] = $username; // Almacenar el nombre de usuario en una variable de sesión
          header("Location: 9-bienvenida.php");
          exit(); // Asegúrate de salir para evitar redirecciones adicionales
        } else {
          echo '<div class="error-message">Inicio de sesión fallido. Verifica tus credenciales.</div>';
        }
      }
    }
    ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
  </div>
</body>

</html>
