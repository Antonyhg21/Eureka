<?php
session_start(); // Iniciar la sesión para poder acceder a las variables de sesión

// Verificar si el usuario está conectado, si no, terminar la ejecución con un mensaje
if (!isset($_SESSION['usuario'])) {
    exit("La sesión no está definida, intente de nuevo con una sesión activa");
}

// Obtener el id del usuario de la sesión actual para usarlo en la inserción
$variable_sesion = $_SESSION['usuario'];

// Mensaje de depuración para verificar hasta dónde se ejecuta el script correctamente
echo "hasta aquí funciona esta vaina 1";

// Verificar si todos los campos necesarios fueron enviados desde el formulario
if (!isset($_POST["id_tipo"]) ||
    !isset($_POST["id_elemento"]) ||
    !isset($_POST["desc_elemento"]) ||
    !isset($_POST["id_depto"]) ||
    !isset($_POST["id_munic"]) ||
    !isset($_POST["id_sitio"]) ||
    !isset($_POST["desc_sitio"]) ||
    !isset($_POST["fecha"]) ||
    !isset($_POST["hora"])) {
    exit(); // Si falta algún campo, terminar la ejecución
}

// Mensaje de depuración para verificar hasta dónde se ejecuta el script correctamente
echo "hasta aquí funciona esta vaina 1";

// Incluir el archivo de conexión a la base de datos
include_once "base_de_datos.php";

// Recuperar los valores enviados desde el formulario y almacenarlos en variables
$id_tipo        = $_POST["id_tipo"];
$id_elemento    = $_POST["id_elemento"];
$desc_elemento  = $_POST["desc_elemento"];
$id_depto       = $_POST["id_depto"];
$id_munic       = $_POST["id_munic"];
$id_sitio       = $_POST["id_sitio"];
$desc_sitio     = $_POST["desc_sitio"];
$fecha          = $_POST["fecha"];
$hora           = $_POST["hora"];

// Preparar la sentencia SQL para insertar los datos en la base de datos
$sentencia = $base_de_datos->prepare("SELECT fun_insert_seekfind(?,?,?,?,?,?,?,?,?,?);");

// Ejecutar la sentencia SQL pasando los valores de las variables en el mismo orden de los ?
$resultado = $sentencia->execute([$variable_sesion, $id_tipo, $id_elemento, $desc_elemento, $id_depto, $id_munic, $id_sitio, $desc_sitio, $fecha, $hora]);

// Verificar si la ejecución de la sentencia SQL fue exitosa
if ($resultado === true) {
    echo "Registro Insertado"; // Mensaje de éxito
    header("Location: home.php"); // Redireccionar al usuario a la página principal
} else {
    // Si la inserción falló, mostrar mensajes de error
    echo "Registro NO Insertado";
    echo "Algo salió mal. Por favor verifica que la tabla exista";
}