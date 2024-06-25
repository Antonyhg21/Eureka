<?php
// Verificar si todos los campos necesarios fueron enviados desde el formulario
if (!isset($_POST["id_depto"])  ||
    !isset($_POST["id_munic"])  ||
    !isset($_POST["nom_sitio"]) ||
    !isset($_POST["dir_sitio"]))
    {
    // Si falta algún campo, terminar la ejecución del script
    exit();
    }
// Si todos los campos requeridos están presentes, se continúa con la ejecución

// Incluir el archivo de conexión a la base de datos
include_once "base_de_datos.php";

// Recuperar los valores enviados desde el formulario y almacenarlos en variables
$id_depto   = $_POST["id_depto"];
$id_munic   = $_POST["id_munic"];
$nom_sitio  = $_POST["nom_sitio"];
$dir_sitio  = $_POST["dir_sitio"];

// Preparar la sentencia SQL para insertar los datos en la base de datos
$sentencia = $base_de_datos->prepare("SELECT fun_insert_sitios(?,?,?,?);");

// Ejecutar la sentencia SQL pasando los valores de las variables en el mismo orden de los ?
$resultado = $sentencia->execute([$id_depto, $id_munic, $nom_sitio, $dir_sitio]);

// execute() regresa un booleano: true si todo va bien, false en caso contrario
// Con eso podemos evaluar el resultado de la operación
echo $resultado;

// Verificar si la ejecución de la sentencia SQL fue exitosa
if ($resultado === true) {
    // Si el registro se insertó correctamente, mostrar un mensaje y redireccionar al administrador
    echo "Registro Insertado";
    header("Location: admin.php");
} else {
    // Si la inserción falló, mostrar mensajes de error
    echo "Registro NO Insertado";
    echo "Algo salió mal. Por favor verifica que la tabla exista";
}