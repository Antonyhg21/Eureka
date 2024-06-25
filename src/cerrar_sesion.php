<?php
// Éste archivo cierra la sesión del usuario y redirige a la página de inicio

session_start(); // Iniciar la sesión

// Eliminar todas las variables de sesión
session_unset();

// Destruir la sesión
session_destroy();

// Redirigir al usuario a la página de inicio
header('Location: ../index.php');
exit();
?>