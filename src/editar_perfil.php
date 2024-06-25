<?php
/*
CRUD con PostgreSQL y PHP
@JAck Antony Hernandez Gonzalez
@Abril 2024
=================================================================
Este archivo guarda los datos del formulario en donde se editan
=================================================================
*/
?>

<?php
echo 'aqui vamos'; // Indica el inicio del proceso de guardado
#Salir si alguno de los datos no está presente
if (
    !isset($_POST["id_usuario"]) ||     // Verifica si se ha enviado el ID del usuario
    !isset($_POST["email"]) ||          // Verifica si se ha enviado el email
    !isset($_POST["documento"]) ||      // Verifica si se ha enviado el documento
    !isset($_POST["nombres"]) ||        // Verifica si se han enviado los nombres
    !isset($_POST["apellidos"]) ||      // Verifica si se han enviado los apellidos
    !isset($_POST["celular"]) ||        // Verifica si se ha enviado el número de celular
    !isset($_POST["direccion"]) ||      // Verifica si se ha enviado la dirección
    !isset($_POST["id_depto"]) ||       // Verifica si se ha enviado el ID del departamento
    !isset($_POST["id_munic"])          // Verifica si se ha enviado el ID del municipio
) {
    exit(); // Termina la ejecución si falta alguno de los datos
}
echo 'aqui vamos 2'; // Indica que todos los datos requeridos están presentes

#Si todo va bien, se ejecuta esta parte del código...

include_once "base_de_datos.php";       // Incluye el archivo de conexión a la base de datos
$id_usuario     = $_POST["id_usuario"]; // Obtiene el ID del usuario desde el formulario
$email_usuario  = $_POST["email"];      // Obtiene el email desde el formulario
$doc_usuario    = $_POST["documento"];  // Obtiene el documento desde el formulario
$nom_usuario    = $_POST["nombres"];    // Obtiene los nombres desde el formulario
$ape_usuario    = $_POST["apellidos"];  // Obtiene los apellidos desde el formulario
$cel_usuario    = $_POST["celular"];    // Obtiene el número de celular desde el formulario
$dir_usuario    = $_POST["direccion"];  // Obtiene la dirección desde el formulario
$id_depto       = $_POST["id_depto"];   // Obtiene el ID del departamento desde el formulario
$id_munic       = $_POST["id_munic"];   // Obtiene el ID del municipio desde el formulario

$sentencia = $base_de_datos->prepare("SELECT fun_update_usuarios(?,?,?,?,?,?,?,?,?);"); // Prepara la sentencia SQL para actualizar el usuario
echo 'error 1'; // Indica un punto de control para depuración

$resultado = $sentencia->execute([$id_usuario, $email_usuario, $doc_usuario, $nom_usuario, $ape_usuario, $cel_usuario, $dir_usuario, $id_depto, $id_munic]); // Ejecuta la sentencia con los datos obtenidos
if ($resultado === true) 
{   // Redirecciona al usuario a la página de configuración si la actualización fue exitosa
    header("Location: config_usuario.php");
} else {
    // Muestra un mensaje de error si algo falla
    echo "Algo salió mal. Por favor verifica que la tabla exista, así como el ID del usuario";
}
echo 'error 2'; // Indica otro punto de control para depuración