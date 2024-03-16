<?php
session_start(); // Iniciar una nueva sesión o reanudar la existente

require 'base_de_datos.php'; // Incluir el archivo que realiza la conexión a la base de datos

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_usuario     = $_POST['email'];      //cambio de nombre de la variable para que coincida con el nombre del campo en la tabla
    $pass_usuario   = $_POST['password'];   //cambio de nombre de la variable para que coincida con el nombre del campo en la tabla

    // Preparar la consulta
    $sentencia = $base_de_datos->prepare('SELECT id_usuario, pass_usuario FROM tab_usuarios WHERE id_usuario = :id_usuario');
    $sentencia->bindParam(':id_usuario', $id_usuario);

    // Ejecutar la consulta
    $sentencia->execute();

    // Obtener el resultado
    $usuario = $sentencia->fetch(PDO::FETCH_OBJ);

    if ($usuario) {
        // Verificar si la contraseña proporcionada coincide con la almacenada en la base de datos
        if (password_verify($pass_usuario, $usuario->pass_usuario)) {
            $_SESSION['usuario'] = $usuario->id_usuario; // Almacenar información del usuario en la sesión
            header('Location: home.php'); // Redirigir al usuario a la página principal
        } else {
            $error = 'El correo electrónico o la contraseña son incorrectos';
            echo "<script> 
            alert('El correo electrónico o la contraseña son incorrectos'); 
            window.location.href = 'login.php';
            </script>";
        }

    }
}

// Aquí deberías manejar el cierre de la sesión si se recibe una petición para ello
if (isset($_GET['cerrar_sesion'])) {
    session_unset(); // Eliminar todas las variables de sesión
    session_destroy(); // Destruir la sesión
    header('Location: login.php'); // Redirigir al usuario a la página de inicio de sesión
}
?>