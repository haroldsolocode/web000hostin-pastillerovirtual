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
<html>
<head>
  <meta charset="UTF-8">
  <title>Registro de Nueva Cita</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
  <style>
    /* Estilos para centrar el contenido en la página */
    h2 {
        font-size: 70px;
        margin: 0;
        font-family: "Poppins", sans-serif;
        padding-top: 500px; /* Espacio arriba del título */
      }
    body { 
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      margin: 0;
      background-color: #f0f0f0; /* Color de fondo de la página */
    }
    
    /* Ajusta el contenedor principal */
    .registration-container {
      display: flex;
      justify-content: space-between;
      align-items: center;
      width: 80%;
      max-width: 1200px;
      padding: 20px;
    }
    
    /* Ajusta el ancho del formulario */
    .registration-form {
      width: 60%;
    }
    
    /* Ajusta los márgenes internos del formulario */
    .registration-form .input-field {
      margin-bottom: 20px;
    }
    .registration-image {
      width: 30%;
      max-height: 400px;
      object-fit: cover;
      border-radius: 30px;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
    }

    .welcome-message {
      position: absolute;
      top: 60px;
      right:300px;
      font-size: 20px;
      color: #228B22 /* Color del texto de bienvenida */
    }
  </style>
</head>
<body>

<?php
    if (isset($_SESSION['username'])) {
      $username = $_SESSION['username'];
      echo '<p class="welcome-message"> Usuario: ' . $username . '</p>' ;
  }
    ?>
  <div class="registration-container">
  
    <div class="registration-form">
      <h2>Registro de Nueva Cita</h2>
      
      <form id="appointment-form" method="post" action="guardar_cita.php">
        <div class="input-field">
          <label for="nombre-paciente">Nombre del Paciente</label>
          <input type="text" id="nombre-paciente" name="nombre-paciente" required>
        </div>
        <div class="input-field">
          <label for="fecha-cita">Fecha de la Cita</label><br>
          <input type="date" id="fecha-cita" name="fecha-cita" required>
        </div>
        <div class="input-field">
          <label for="hora-cita">Hora de la Cita</label><br>
          <input type="time" id="hora-cita" name="hora-cita" required>
        </div>
        <div class="input-field">
          <label for="tipo-cita">Tipo de Cita</label>
          <input type="text" id="tipo-cita" name="tipo-cita" required>
        </div>
        
        <!-- Formulario para agregar recordatorio -->
        <h3>Agregar Recordatorio</h3>
        <div class="input-field">
          <label for="nombre-alarma">Nombre del Recordatorio</label>
          <input type="text" id="nombre-alarma" name="nombre-alarma" required>
        </div>
        <div class="input-field">
          <label for="hora">Hora</label>
          <input type="text" id="hora" name="hora" class="timepicker" required>
        </div>
        <div class="input-field">
          <label for="dia-semana">Día de la Semana</label><br>
          <select id="dia-semana" name="dia-semana"  class="validate" required>
            <option value="" disabled selected>Selecciona un día</option>
            <option value="lunes">Lunes</option>
            <option value="martes">Martes</option>
            <option value="miercoles">Miércoles</option>
            <option value="jueves">Jueves</option>
            <option value="viernes">Viernes</option>
            <option value="sabado">Sábado</option>
            <option value="domingo">Domingo</option>
          </select>
        </div>
      
        <div class="input-field">
          <label for="sonido-alarma">Sonido de Alarma</label><br>
          <select id="sonido-alarma" name="sonido-alarma"  class="validate" required>
            <option value="sonido1">Sonido 1</option>
            <option value="sonido2">Sonido 2</option>
            <option value="sonido3">Sonido 3</option>
          </select>
        </div>
        
       
       
        
        <button type="submit" class="btn waves-effect waves-light green">Registrar Cita</button>
        <div class="back-button right-align">
            <a href="10-perfilpaciente.php" class="waves-effect waves-light btn green">Atrás</a>
          </div>
      </form>
    </div>
   
    <img src="/PASTI/imagenes/calendar_2278049.png" alt="Imagen de Medicamento" class="registration-image">
  </div>
    
  <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const timePicker = document.querySelector('.timepicker');
      const selectSonido = document.getElementById('sonido-alarma');
      const selectDiaSemana = document.getElementById('dia-semana');
      
      M.Timepicker.init(timePicker, {
        twelveHour: false // Formato de 24 horas
      });
      M.FormSelect.init(selectSonido);
      M.FormSelect.init(selectDiaSemana);
    });
  </script>
</body>

</html>




  