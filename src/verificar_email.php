<?php
include_once "base_de_datos.php";

$email_usuario = $_POST['email_usuario'];

$query = $base_de_datos->prepare("SELECT email_usuario FROM tab_usuarios WHERE email_usuario = :email");
$query->execute(['email' => $email_usuario]);
$resultado = $query->fetch(PDO::FETCH_ASSOC);

if ($resultado) {
    echo json_encode(['existe' => true]);
} else {
    echo json_encode(['existe' => false]);
}