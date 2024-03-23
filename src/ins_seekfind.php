<?php
/*
CRUD con PostgreSQL y PHP
@Jack Antony Hernández González
@Enero 2024
==================================================================
Este archivo inserta los datos enviados a través de formulario.php
==================================================================
*/
?>

<?php
session_start(); // Iniciar la sesión

if (!isset($_SESSION['usuario'])) {
    // Si el usuario no está conectado, redirigir a la página de inicio de sesión
    exit("La sesion no esta definida, intente denuevo con una sesion activa");
}
// Obtener el id de la sesión actual y guardarlo en una variable para usarlo en la consulta
$variable_sesion = $_SESSION['usuario'];



echo "hasta aqui funciona esta vaina 1";
if (!isset($_POST["id_tipo"])  ||
    !isset($_POST["id_elemento"])  ||
    !isset($_POST["desc_elemento"])  ||
    !isset($_POST["id_depto"])  ||
    !isset($_POST["id_munic"])  ||
    !isset($_POST["id_sitio"])  ||
    !isset($_POST["desc_sitio"])  ||
    !isset($_POST["fecha"])  ||
    !isset($_POST["hora"]))
    {
    exit();
    }
#Si todo va bien, se ejecuta esta parte del código..., si no, nos jodimos
echo "hasta aqui funciona esta vaina 1";
include_once "base_de_datos.php";
$id_tipo            = $_POST["id_tipo"];
$id_elemento        = $_POST["id_elemento"];
$desc_elemento      = $_POST["desc_elemento"];
$id_depto           = $_POST["id_depto"];
$id_munic           = $_POST["id_munic"];
$id_sitio           = $_POST["id_sitio"];
$desc_sitio         = $_POST["desc_sitio"];
$fecha              = $_POST["fecha"];
$hora               = $_POST["hora"];
/*
Al incluir el archivo "base_de_datos.php", todas sus variables están
a nuestra disposición. Por lo que podemos acceder a ellas tal como si hubiéramos
copiado y pegado el código
 */

$sentencia = $base_de_datos->prepare("SELECT fun_insert_seekfind(?,?,?,?,?,?,?,?,?,?);");
$resultado = $sentencia->execute([$variable_sesion, $id_tipo, $id_elemento, $desc_elemento, $id_depto, $id_munic, $id_sitio, $desc_sitio, $fecha, $hora] ); # Pasar en el mismo orden de los ?
#execute regresa un booleano. True en caso de que todo vaya bien, falso en caso contrario.
#Con eso podemos evaluar*/
echo $resultado;
if ($resultado === true) {
    # Redireccionar a la lista
    echo "Registro Insertado";
	header("Location: home.php");
} else
    {
    echo "Registro NO Insertado";
    echo "Algo salió mal. Por favor verifica que la tabla exista";
    }