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
  <title>Pastillero Virtual - Cuidador</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
  <style>
    /* ... (otros estilos css) ... */
    
    h3 {
      font-size: 30px;
      margin: 0;
      font-family: "Poppins", sans-serif;
    }

    h4 {
      font-size: 20px;
      margin: 0;
      font-family: "Poppins", sans-serif;
    }

    .logo-container {
      display: flex;
      flex-direction: column;
      align-items: center;
    }

    .logo {
      max-width: 100%;
      margin-top: 20px;
    }

    .logout-button {
      background-color: green;
      color: white;
      margin-top: 10px;
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

    .green-divider {
      width: 100%;
      height: auto;
      background-color: #00bf63;
      display: flex;
      flex-direction: column;
      align-items: center;
      text-align: center;
    }

    .divider-image {
      max-width: 20%;
      height: auto;
      margin: 20px 0;
    }

    .divider-message {
      font-size: 18px;
      color: white;
      margin: 20px 0;
    }

    .profile-category-buttons {
      display: flex;
      flex-wrap: wrap;
      justify-content: center;
      align-items: center;
      margin-top: 20px;
      padding: 20px 0;
    }

    .profile-category-button {
      color: white;
      background-color: #00bf63;
      text-align: center;
      padding: 20px;
      display: flex;
      flex-direction: column;
      align-items: center;
      font-size: 16px;
      margin: 10px;
      border-radius: 8px;
      max-width: 150px;
      overflow: hidden;
    }

    .ingresar-medicamento, .medicamentos-registrados {
      width: 100%; /* Ajusta el ancho de los botones al 100% en dispositivos móviles */
    }

    .profile-button-image {
      max-width: 60%;
      height: auto;
      margin-bottom: 10px;
    }

    .back-button {
      text-align: center;
      margin-top: 20px;
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="logo-container">
      <img src="/PASTI/imagenes/pastilleroVirtualrecortado.jpeg" alt="Logo" class="logo">
      <a href="logout.php" class="btn waves-effect waves-light green logout-button">Cerrar Sesión</a>
       <p style="color: #3CB371;" >Usuario: <?php echo $_SESSION['username']; ?></p>
    </div>

    <div class="profile-buttons">
      <a href="/PASTI/html/2-mision.html" class="btn profile-button">Misión</a>
      <a href="/PASTI/html/3-vision.html" class="btn profile-button">Visión</a>
      <a href="/PASTI/html/4-contacto.html" class="btn profile-button">Contacto</a>
      <a href="/PASTI/html/5-ayuda.html" class="btn profile-button">Ayuda</a>
      <a href="/PASTI/html/6-blog.html" class="btn profile-button">Blog</a>
    </div>

    <div class="green-divider">
      <img src="/PASTI/imagenes/paciente2IA.jpeg" alt="Imagen en franja verde" class="divider-image">
      <div class="divider-message">¡Llevar un registro de los medicamentos que debes tomar es más fácil que nunca!.</div>
    </div>
    <br /><br />
    <h3>Registra tus Medicamentos y Genera los Recordatorios</h3>
    <br /><br />

    <div class="profile-category-buttons">
      <a href="/PASTI/php/15-registrarmedicamento.php" class="modal-trigger profile-category-button ingresar-medicamento">
        <img src="/PASTI/imagenes/agregar.png" alt="Imagen 4" class="profile-button-image">
        <span>Ingresar Medicamento</span>
      </a>
      <a href="/PASTI/php/14-registroMedicamentoCRUD.php" class="modal-trigger profile-category-button medicamentos-registrados">
        <img src="/PASTI/imagenes/listconalarma.png" alt="Imagen 4" class="profile-button-image">
        <span> Medicamentos Registrados y Crear Alarma</span>
      </a>
    </div>

    <br /><br /><br />

    <div class="back-button">
      <a href="/PASTI/php/10-perfilpaciente.php" class="btn waves-effect waves-light green">Atrás</a>
    </div>
  </div>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
</body>
</html>

