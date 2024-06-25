<?php
/*
CRUD con PostgreSQL y PHP
@JAck Antony Hernandez Gonzalez
@Octubre 2023
=================================================================
Este archivo guarda los datos del formulario en donde se editan
=================================================================
*/
?>

<?php

#Salir si alguno de los datos no está presente
if (
    !isset($_POST["id_seekfind"]) ||
    !isset($_POST["estado_usuario"])
) {
    exit();
}

#Si todo va bien, se ejecuta esta parte del código...

include_once "base_de_datos.php";
$id_seekfind        = $_POST["id_seekfind"];
$estado_usuario     = $_POST["estado_usuario"];


$sentencia = $base_de_datos->prepare("SELECT fun_update_estado_publicacion(?,?);");
echo 'error 1';

$resultado = $sentencia->execute([$id_seekfind, $estado_usuario]); # Pasar en el mismo orden de los ?
if ($resultado === true) 
{
    // header("Location: perfil.php ");
} else {
    echo "Algo salió mal. Por favor verifica que la tabla exista, así como el id_seekfind";
}
echo 'error 2';
?>
