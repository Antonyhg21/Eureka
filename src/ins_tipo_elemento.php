<?php
// Verificar si el campo "nom_tipo" fue enviado desde el formulario
if (!isset($_POST["nom_tipo"])) {
    // Si no se envió "nom_tipo", terminar la ejecución del script
    exit();
}
// Si "nom_tipo" está presente, se continúa con la ejecución del script

// Incluir el archivo de conexión a la base de datos
include_once "base_de_datos.php";
// Recuperar el valor de "nom_tipo" enviado desde el formulario
$nom_tipo = $_POST["nom_tipo"];

// Preparar la sentencia SQL para insertar el nuevo tipo de elemento
$sentencia = $base_de_datos->prepare("SELECT fun_insert_tipo_elemento(?);");
// Ejecutar la sentencia SQL pasando el valor de "nom_tipo"
$resultado = $sentencia->execute([$nom_tipo]); // Pasar en el mismo orden de los ?

/*
execute() devuelve un booleano: true si la ejecución fue exitosa, false en caso contrario.
Esto nos permite evaluar el resultado de la operación.
*/
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