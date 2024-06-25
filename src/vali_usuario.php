<?php
session_start(); // Iniciar una nueva sesión o reanudar la existente

require 'base_de_datos.php'; // Incluir el archivo que realiza la conexión a la base de datos

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email_usuario      = $_POST['email'];      //cambio de nombre de la variable para que coincida con el nombre del campo en la tabla
    $pass_usuario       = $_POST['password'];   //cambio de nombre de la variable para que coincida con el nombre del campo en la tabla

    // Preparar la consulta
    $sentencia = $base_de_datos->prepare('SELECT id_usuario, email_usuario, pass_usuario FROM tab_usuarios WHERE email_usuario = :email_usuario');
    $sentencia->bindParam(':email_usuario', $email_usuario);

    // Ejecutar la consulta
    $sentencia->execute();

    // Obtener el resultado
    $usuario = $sentencia->fetch(PDO::FETCH_OBJ);

    if ($usuario) {
        if (password_verify($pass_usuario, $usuario->pass_usuario)) {
            $_SESSION['usuario'] = $usuario->id_usuario;
            echo json_encode(['status' => 'success']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'El correo electrónico o la contraseña son incorrectos']);
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'El correo electrónico o la contraseña son incorrectos']);
    }
    exit;
}

// Aquí deberías manejar el cierre de la sesión si se recibe una petición para ello
if (isset($_GET['cerrar_sesion'])) {
    session_unset(); // Eliminar todas las variables de sesión
    session_destroy(); // Destruir la sesión
    header('Location: login.php'); // Redirigir al usuario a la página de inicio de sesión
}
?>