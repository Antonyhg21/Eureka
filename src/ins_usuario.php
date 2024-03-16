<?php
/*
CRUD con PostgreSQL y PHP
@Carlos Eduardo Perez Rueda
@Marzo de 2023
==================================================================
Este archivo inserta los datos enviados a través de formulario.php
==================================================================
*/
?>
<?php
if (!isset($_POST["email_usuario"])||
    !isset($_POST["doc_usuario"])  ||
    !isset($_POST["nom_usuario"])  ||
    !isset($_POST["ape_usuario"])  ||
    !isset($_POST["pass_usuario"])  ||
    !isset($_POST["cel_usuario"])  ||
    !isset($_POST["dir_usuario"])  ||
    !isset($_POST["id_depto"])  ||
    !isset($_POST["id_munic"]))
    {
    exit();
    }
#Si todo va bien, se ejecuta esta parte del código..., si no, nos jodimos

include_once "base_de_datos.php";
$id_usuario         = $_POST["email_usuario"];  // Se cambia el nombre de la variable para que coincida con el nombre del campo en la tabla
$doc_usuario        = $_POST["doc_usuario"];    
$nom_usuario        = $_POST["nom_usuario"];
$ape_usuario        = $_POST["ape_usuario"];
$pass_usuario       = $_POST["pass_usuario"];

// Encriptar la contraseña
$pass_usuario_encriptada = password_hash($pass_usuario, PASSWORD_DEFAULT);

$cel_usuario        = $_POST["cel_usuario"];
$dir_usuario        = $_POST["dir_usuario"];
$id_depto           = $_POST["id_depto"];
$id_munic           = $_POST["id_munic"];
/*
Al incluir el archivo "base_de_datos.php", todas sus variables están
a nuestra disposición. Por lo que podemos acceder a ellas tal como si hubiéramos
copiado y pegado el código
 */

$sentencia = $base_de_datos->prepare("SELECT fun_insert_usuarios(?, ?, ?, ?, ?, ?, ?, ?, ?);");
$resultado = $sentencia->execute([$id_usuario, $doc_usuario, $nom_usuario, $ape_usuario, $pass_usuario_encriptada, $cel_usuario, $dir_usuario, $id_depto, $id_munic] ); # Pasar en el mismo orden de los ?
#execute regresa un booleano. True en caso de que todo vaya bien, falso en caso contrario.
#Con eso podemos evaluar*/
echo $resultado;
if ($resultado === true) {
    # Redireccionar a la lista
    echo "Registro Insertado";
    header("Location: login.php");
} else
    {
    echo "Registro NO Insertado";
    echo "Algo salió mal. Por favor verifica que la tabla exista";
    }