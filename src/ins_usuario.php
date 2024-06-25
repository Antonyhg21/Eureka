<?php
// Verificar si todos los campos necesarios fueron enviados desde el formulario
if (!isset($_POST["email_usuario"]) ||
    !isset($_POST["doc_usuario"])   ||
    !isset($_POST["nom_usuario"])   ||
    !isset($_POST["ape_usuario"])   ||
    !isset($_POST["pass_usuario"])  ||
    !isset($_POST["cel_usuario"])   ||
    !isset($_POST["dir_usuario"])   ||
    !isset($_POST["id_depto"])      ||
    !isset($_POST["id_munic"]))
    {
    // Si falta algún campo, terminar la ejecución del script
    exit();
    }
// Si todos los campos requeridos están presentes, se continúa con la ejecución

// Incluir el archivo de conexión a la base de datos
include_once "base_de_datos.php";

// Recuperar los valores enviados desde el formulario y almacenarlos en variables
$email_usuario = $_POST["email_usuario"];
$doc_usuario   = $_POST["doc_usuario"];    
$nom_usuario   = $_POST["nom_usuario"];
$ape_usuario   = $_POST["ape_usuario"];
$pass_usuario  = $_POST["pass_usuario"];

// Encriptar la contraseña para enviarla a la base de datos ya encriptada
$pass_usuario_encriptada = password_hash($pass_usuario, PASSWORD_DEFAULT);

$cel_usuario   = $_POST["cel_usuario"];
$dir_usuario   = $_POST["dir_usuario"];
$id_depto      = $_POST["id_depto"];
$id_munic      = $_POST["id_munic"];

// Preparar la sentencia SQL para insertar los datos en la base de datos
$sentencia = $base_de_datos->prepare("SELECT fun_insert_usuarios(?, ?, ?, ?, ?, ?, ?, ?, ?);");

// Ejecutar la sentencia SQL pasando los valores de las variables en el mismo orden de los ?
$resultado = $sentencia->execute([$email_usuario, $doc_usuario, $nom_usuario, $ape_usuario, $pass_usuario_encriptada, $cel_usuario, $dir_usuario, $id_depto, $id_munic]);

// Verificar si la ejecución de la sentencia SQL fue exitosa
if ($resultado === true) {
    // Si el registro se insertó correctamente, mostrar un mensaje y redireccionar al login
    echo "Registro Insertado";
    header("Location: login.php");
} else {
    // Si la inserción falló, mostrar mensajes de error
    echo "Registro NO Insertado";
    echo "Algo salió mal. Por favor verifica que la tabla exista";
}