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
    <title>Administrador</title> <!-- Título de la página, visible en la pestaña del navegador -->
</head>

<body class="body">
    <br><br>
    <div class="container-fluid bg-light mt-5 mb-5 p-3 rounded shadow">
        <!-- Contenedor principal que centra el contenido en la página con un fondo claro, márgenes y sombreado -->
        <div class="row">
            <!-- Fila para organizar el contenido en columnas -->
            <div class="col-md-3">
                <!-- Columna para la navegación, ocupa 3 de 12 posibles columnas en un diseño de cuadrícula para pantallas medianas y grandes -->
                <div class="list-group">
                    <!-- Grupo de elementos de lista para la navegación -->
                    <a href="?modulo=usuarios" class="list-group-item list-group-item-action">Usuarios</a> <!-- Enlace a la sección 'Usuarios' -->
                    <a href="?modulo=departamento" class="list-group-item list-group-item-action">Agregar departamentos</a> <!-- Enlace a la sección 'Agregar departamentos' -->
                    <a href="?modulo=municipio" class="list-group-item list-group-item-action">Agregar municipios</a> <!-- Enlace a la sección 'Agregar municipios' -->
                    <a href="?modulo=sitio" class="list-group-item list-group-item-action">Agregar sitios</a> <!-- Enlace a la sección 'Agregar sitios' -->
                    <a href="?modulo=tipo_elemento" class="list-group-item list-group-item-action">Agregar tipos de elementos</a> <!-- Enlace a la sección 'Agregar tipos de elementos' -->
                    <a href="?modulo=elemento" class="list-group-item list-group-item-action">Agregar elementos</a> <!-- Enlace a la sección 'Agregar elementos' -->
                </div>
            </div>
            <!-- En los archivos incluidos por la función se traerá el contenido de la sección seleccionada -->
            <?php
                // Verifica si se ha establecido el parámetro 'modulo' en la URL
                if (isset($_GET['modulo']) && $_GET['modulo'] == 'usuarios') {
                    include 'modulo_admin_usuarios.php'; // Incluye el contenido de la sección 'Usuarios'
                } else if (isset($_GET['modulo']) && $_GET['modulo'] == 'departamento') {
                    include 'modulo_admin_ins_depto.php'; // Incluye el contenido de la sección 'Agregar departamentos'
                } else if (isset($_GET['modulo']) && $_GET['modulo'] == 'municipio') {
                    include 'modulo_admin_ins_munics.php'; // Incluye el contenido de la sección 'Agregar municipios'
                } else if (isset($_GET['modulo']) && $_GET['modulo'] == 'sitio') {
                    include 'modulo_admin_ins_sitio.php'; // Incluye el contenido de la sección 'Agregar sitios'
                } else if (isset($_GET['modulo']) && $_GET['modulo'] == 'tipo_elemento') {
                    include 'modulo_admin_ins_tipo_elemento.php'; // Incluye el contenido de la sección 'Agregar tipos de elementos'
                } else if (isset($_GET['modulo']) && $_GET['modulo'] == 'elemento') {
                    include 'modulo_admin_ins_elemento.php'; // Incluye el contenido de la sección 'Agregar elementos'
                } else {
                    include 'modulo_admin_usuarios.php'; // Por defecto, incluye la sección 'Usuarios'
                }
            ?>
        </div>
    </div>
</body>
</html>