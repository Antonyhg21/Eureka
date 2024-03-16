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
    !isset($_POST["email_usuario"]) ||
    !isset($_POST["doc_usuario"]) ||
    !isset($_POST["nom_usuario"]) ||
    !isset($_POST["ape_usuario"]) ||
    !isset($_POST["cel_usuario"]) ||
    !isset($_POST["dir_usuario"]) ||
    !isset($_POST["id_depto"]) ||
    !isset($_POST["id_munic"])
) {
    exit();
}

#Si todo va bien, se ejecuta esta parte del código...

include_once "base_de_datos.php";
$id_usuario     = $_POST["id_usuario"];
$doc_usuario    = $_POST["doc_usuario"];
$nom_usuario    = $_POST["nom_usuario"];
$ape_usuario    = $_POST["ape_usuario"];
$cel_usuario    = $_POST["cel_usuario"];
$dir_usuario    = $_POST["dir_usuario"];
$id_depto       = $_POST["id_depto"];
$id_munic       = $_POST["id_munic"];

echo $nom_usuario;
$sentencia = $base_de_datos->prepare("SELECT fun_update_usuarios(?,?,?,?,?,?,?,?);");
echo 'error 1';

$resultado = $sentencia->execute([$id_usuario, $doc_usuario, $nom_usuario, $ape_usuario, $cel_usuario, $dir_usuario, $id_depto, $id_munic]); # Pasar en el mismo orden de los ?
if ($resultado === true) 
{
    header("Location: lista_usuarios.php");
} else {
    echo "Algo salió mal. Por favor verifica que la tabla exista, así como el ID del usuario";
}
echo 'error 2';
