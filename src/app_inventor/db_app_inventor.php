<?php
session_start(); // Iniciar una nueva sesión o reanudar la existente
header('Content-Type: application/json');

// Configura la conexión a la base de datos PostgreSQL
$contraseña         = "Janher2103!";
$usuario            = "jhernandez";
$nombreBaseDeDatos  = "db_eureka";
#Puede ser 127.0.0.1 o el nombre de tu equipo; o la IP de un servidor remoto
$server = "10.200.138.62";
$puerto = "5432";
try
{
    $base_de_datos = new PDO("pgsql:host=$server;port=$puerto;dbname=$nombreBaseDeDatos", $usuario, $contraseña);
    $base_de_datos->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//  echo "Me Conecté";
}
catch (Exception $e)
{
    echo "Ocurrió un error con la base de datos: " . $e->getMessage();
}

// Obtener los datos del JSON enviado por la aplicación
$data = json_decode(file_get_contents('php://input'), true);
$id_usuario = $data['email'];
$pass_usuario = $data['password'];

// Preparar la consulta
$sentencia = $base_de_datos->prepare('SELECT id_usuario, pass_usuario FROM tab_usuarios WHERE id_usuario = :id_usuario');
$sentencia->bindParam(':id_usuario', $id_usuario);

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
?>

