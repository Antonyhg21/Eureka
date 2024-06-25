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
    !isset($_POST["email_usuario"]) ||  // Verifica si se ha enviado el email del usuario
    !isset($_POST["doc_usuario"]) ||    // Verifica si se ha enviado el documento del usuario
    !isset($_POST["nom_usuario"]) ||    // Verifica si se ha enviado el nombre del usuario
    !isset($_POST["ape_usuario"]) ||    // Verifica si se ha enviado el apellido del usuario
    !isset($_POST["cel_usuario"]) ||    // Verifica si se ha enviado el celular del usuario
    !isset($_POST["dir_usuario"]) ||    // Verifica si se ha enviado la dirección del usuario
    !isset($_POST["id_depto"]) ||       // Verifica si se ha enviado el ID del departamento
    !isset($_POST["id_munic"])          // Verifica si se ha enviado el ID del municipio
) {
    exit(); // Si falta alguno de los datos anteriores, termina la ejecución del script
}

#Si todo va bien, se ejecuta esta parte del código...

include_once "base_de_datos.php";           // Incluye la conexión a la base de datos
$id_usuario     = $_POST["id_usuario"];     // Recupera el ID del usuario desde el formulario
$doc_usuario    = $_POST["doc_usuario"];    // Recupera el documento del usuario desde el formulario
$nom_usuario    = $_POST["nom_usuario"];    // Recupera el nombre del usuario desde el formulario
$ape_usuario    = $_POST["ape_usuario"];    // Recupera el apellido del usuario desde el formulario
$cel_usuario    = $_POST["cel_usuario"];    // Recupera el celular del usuario desde el formulario
$dir_usuario    = $_POST["dir_usuario"];    // Recupera la dirección del usuario desde el formulario
$id_depto       = $_POST["id_depto"];       // Recupera el ID del departamento desde el formulario
$id_munic       = $_POST["id_munic"];       // Recupera el ID del municipio desde el formulario

echo $nom_usuario; // Muestra el nombre del usuario (para depuración)
$sentencia = $base_de_datos->prepare("SELECT fun_update_usuarios(?,?,?,?,?,?,?,?);"); // Prepara la sentencia SQL para actualizar el usuario
echo 'error 1'; // Mensaje de depuración

$resultado = $sentencia->execute([$id_usuario, $doc_usuario, $nom_usuario, $ape_usuario, $cel_usuario, $dir_usuario, $id_depto, $id_munic]); # Pasar en el mismo orden de los ?
// Ejecuta la sentencia SQL con los valores proporcionados
if ($resultado === true) 
{
    header("Location: lista_usuarios.php"); // Si la actualización es exitosa, redirige a la lista de usuarios
} else {
    echo "Algo salió mal. Por favor verifica que la tabla exista, así como el ID del usuario"; // Mensaje de error si algo falla
}
echo 'error 2'; // Mensaje de depuración
?>