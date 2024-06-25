<?php
// Incluye el archivo 'encabezado.php' que puede contener la barra de navegación, estilos comunes, etc.
include_once 'encabezado.php';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8"> <!-- Define el conjunto de caracteres para la página -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- Asegura una correcta visualización y zoom adecuado en dispositivos móviles -->
    <link rel="stylesheet" href="../css/styles.css"> <!-- Vincula el archivo de estilos CSS para la página -->
    <title>Mi perfil</title> <!-- Título de la página, visible en la pestaña del navegador -->
</head>

<body class="body">
    <br><br>
    <div class="container bg-light mt-5 mb-5 p-3 rounded shadow">
        <!-- Contenedor principal que centra el contenido en la página con un fondo claro, márgenes y sombreado -->
        <div class="row">
            <!-- Fila para organizar el contenido en columnas -->
            <div class="col-md-3">
                <!-- Columna para la navegación, ocupa 3 de 12 posibles columnas en un diseño de cuadrícula para pantallas medianas y grandes -->
                <div class="list-group">
                    <!-- Grupo de elementos de lista para la navegación -->
                    <a href="?modulo=perfil" class="list-group-item list-group-item-action">Mis datos</a> <!-- Enlace a la sección 'Mi perfil' -->
                    <a href="?modulo=elementos_buscados" class="list-group-item list-group-item-action">Elementos en búsqueda</a> <!-- Enlace a la sección 'Elementos en búsqueda' -->
                    <a href="?modulo=busquedas_finalizadas" class="list-group-item list-group-item-action">Búsquedas finalizadas</a> <!-- Enlace a la sección 'Búsquedas finalizadas' -->
                </div>
            </div>
            <!-- En los archivos incluidos por la función se traerá el contenido de la sección seleccionada -->
            <?php
                // Verifica si se ha establecido el parámetro 'modulo' en la URL
                if (isset($_GET['modulo']) && $_GET['modulo'] == 'perfil') {
                    include 'modulo_usuario.php'; // Incluye el contenido de 'Mi perfil'
                } else if (isset($_GET['modulo']) && $_GET['modulo'] == 'elementos_buscados') {
                    include 'modulo_publicaciones.php'; // Incluye el contenido de 'Elementos en búsqueda'
                } else if (isset($_GET['modulo']) && $_GET['modulo'] == 'busquedas_finalizadas') {
                    include 'modulo_publicaciones_finalizadas.php'; // Incluye el contenido de 'Búsquedas finalizadas'
                } else {
                    include 'modulo_usuario.php'; // Por defecto, incluye 'Mi perfil'
                }
            ?>
        </div>
    </div>
</body>
</html>