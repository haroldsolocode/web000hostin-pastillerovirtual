<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Registro de Nuevo Medicamento</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
  <style>
    /* Estilos para centrar el contenido en la página */
    h2 {
      font-size: 24px; /* Tamaño de fuente ajustado para dispositivos móviles */
      margin: 10px 0; /* Ajusta el margen para dispositivos móviles */
      font-family: "Poppins", sans-serif;
    }
    body { 
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: 100vh; /* Altura mínima para ocupar la pantalla completa */
      margin: 0;
      background-color: #f0f0f0; /* Color de fondo de la página */
    }
    
    /* Ajusta el contenedor principal */
    .registration-container {
      display: flex;
      flex-direction: column; /* Cambia la dirección del diseño a columna para dispositivos móviles */
      align-items: center;
      width: 80%;
      max-width: 1200px;
      padding: 20px;
    }
    
    /* Ajusta el ancho del formulario */
    .registration-form {
      width: 100%; /* Ocupa el ancho completo en dispositivos móviles */
    }
    
    /* Ajusta los márgenes internos del formulario */
    .registration-form .input-field {
      margin-bottom: 20px;
    }

    /* Ajusta el margen inferior del campo de medicamento */
    .registration-form #medicamento {
      margin-bottom: 20px;
    }

    .registration-image {
      width: 50%; /* Ocupa el ancho completo en dispositivos móviles */
      max-height: 250px; /* Limita la altura de la imagen */
      object-fit: cover;
      border-radius: 10px;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
      margin-top: 20px; /* Ajusta el espacio superior para dispositivos móviles */
    }
    
    /* Ajusta el espacio entre el botón y el formulario */
    .button-space {
      margin-top: 20px;
    }

    /* Media queries para dispositivos móviles */
    @media only screen and (max-width: 600px) {
      h2 {
        font-size: 20px;
        margin: 5px 0;
      }

      .registration-image {
        margin-top: 10px;
      }
    }
  </style>
</head>
<body>

  <div class="registration-container">
    <h2>Registrar Nuevo Medicamento</h2>
    <div class="registration-form">
      <form id="medicationForm" action="registrar_medicamento.php" method="POST" onsubmit="return validarFechaVencimiento()">
        <div class="input-field">
          <label for="medicamento">Nombre del Medicamento</label>
          <input type="text" id="medicamento" name="medicamento" pattern="[A-Za-zñÑáéíóúÁÉÍÓÚ\s]+" required>
        </div>
        <div class="input-field">
          <label for="dosificacion">Dosificación</label>
          <input type="text" id="dosificacion" name="dosificacion" required>
        </div>
        <div class="input-field">
          <label for="indicaciones">&nbsp;&nbsp;Descripción</label>
          <textarea id="indicaciones" name="descripcion" rows="4" required ></textarea>
        </div>
        <div class="input-field">
          <label for="via-administracion">Vía de Administración</label>
          <input type="text" id="via-administracion" name="via-administracion" pattern="[A-Za-zñÑáéíóúÁÉÍÓÚ\s]+" required>
        </div>
        <div class="input-field">
          <label for="presentacion">Presentación</label>
          <input type="text" id="presentacion" name="presentacion" pattern="[A-Za-zñÑáéíóúÁÉÍÓÚ\s]+" required>
        </div>
        <div class="input-field">
          <label for="cantidad">Cantidad/Stock</label>
          <input type="number" id="cantidad" name="cantidad" required>
        </div>
        <div class="input-field">
          <label for="vencimiento">Fecha de Vencimiento</label><br>
          <input type="date" id="vencimiento" name="vencimiento" required>
        </div>
        <div class="input-field">
          <label for="contraindicacion">&nbsp;&nbsp;Contraindicaciones</label>
          <textarea id="contraindicacion" name="contraindicacion" rows="4" required></textarea>
        </div>
        
        <div class="row center-align button-space">
          <button class="waves-effect waves-light btn green">Registrar</button>
        </div>
      </form>
    </div>
    <img src="/PASTI/imagenes/pastillero3.jpg" alt="Imagen de Medicamento" class="registration-image">
    <!-- Botón de Regresar -->
    <div class="row center-align button-space">
      <a href="#" class="waves-effect waves-light btn green darken-4" onclick="history.go(-1);">Atras</a>
    </div>
  </div>

  <script>
    function validarFechaVencimiento() {
      var fechaVencimiento = document.getElementById('vencimiento').value;
      var fechaActual = new Date().toISOString().split('T')[0];

      if (fechaVencimiento < fechaActual) {
        alert('OJO: Medicamento Vencido.');
        return false;
      }

      return true;
    }
  </script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>

</body>
</html>


