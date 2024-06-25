<?php
/*
CRUD con PostgreSQL y PHP
@Jack Antony Hernández González
@Junio 2024
==================================================================
Este archivo inserta los datos enviados a través de formulario.php
en la base de datos utilizando una función almacenada de PostgreSQL.
==================================================================
*/

// Verificar si los datos requeridos fueron enviados
if (!isset($_POST["id_depto"]) || 
    !isset($_POST["nom_depto"])) {
    // Si no se enviaron los datos necesarios, terminar la ejecución
    exit();
}

/*
Incluir el archivo de conexión a la base de datos
Al incluir el archivo "base_de_datos.php", todas sus variables están
a nuestra disposición. Por lo que podemos acceder a ellas tal como si hubiéramos
copiado y pegado el código.
*/
include_once "base_de_datos.php";

// Recuperar los datos enviados desde el formulario
$id_depto       = $_POST["id_depto"];
$nom_depto      = $_POST["nom_depto"];

// Preparar la sentencia SQL para insertar el departamento
$sentencia = $base_de_datos->prepare("SELECT fun_insert_deptos(?,?);");

// Ejecutar la sentencia SQL pasando los valores correspondientes
$resultado = $sentencia->execute([$id_depto, $nom_depto]);

/*
Execute regresa un booleano. True en caso de que todo vaya bien, falso en caso contrario.
Con eso podemos evaluar
*/

// Verificar si el resultado de la ejecución fue exitoso
if ($resultado === true) {
    // Si el elemento se insertó correctamente, redireccionar al administrador
    echo "Registro Insertado";
    header("Location: seccion_admin.php");
} else {
    // Si hubo un error al insertar, mostrar un mensaje de error
    echo "Registro NO Insertado";
    echo "Algo salió mal. Por favor verifica que la tabla exista";
}