<?php
session_start(); // Inicia la sesión

// Comprueba si la sesión está iniciada
if (isset($_SESSION['username'])) {
    // Destruye la sesión
    session_unset(); // Elimina todas las variables de sesión
    session_destroy(); // Destruye la sesión
    header("Location: /PASTI/php/1-index.php"); // Redirige al usuario a la página de inicio de sesión
    exit();
} else {
    header("Location: /PASTI/php/1-index.php"); // Redirige al usuario a la página de inicio de sesión si no había una sesión iniciada
    exit();
}
?>
