<?php
// Incluir el archivo de encabezado común a todas las páginas
include_once "encabezado.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Definir la codificación de caracteres para la página -->
    <meta charset="UTF-8">
    <!-- Asegurar la correcta visualización y el diseño responsive en dispositivos móviles -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Título de la página, visible en la pestaña del navegador -->
    <title>Lista de usuario</title>
</head>
<body class="body">
    <!-- Espaciado para separar el contenido del inicio de la página -->
    <br><br>
    <div class="container mt-5">
        <!-- Título de la sección -->
        <h1>Usuarios:</h1>
        <!-- Formulario para buscar usuarios -->
        <form class="mb-3">
            <div class="input-group">
                <!-- Etiqueta para el campo de búsqueda -->
                <label for="buscar" class="form-label">Buscar</label>
            </div>
            <div class="input-group">
                <!-- Campo de entrada para realizar búsquedas -->
                <input type="text" id="buscar" class="form-control-sm" name="buscar" placeholder="Search">
            </div>
        </form>

        <!-- Contenedor para la tabla de usuarios -->
        <div class="table-responsive">
            <!-- Definición de la tabla -->
            <table class="table table-striped">
                <!-- Encabezado de la tabla -->
                <thead class="bg-dark text-white" >
                    <tr>
                        <!-- Columnas del encabezado -->
                        <th>Id</th>
                        <th>Correo electrónico</th>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Documento</th>
                        <th>Celular</th>
                        <th>Direccion</th>
                        <th>Departamento</th>
                        <th>Municipio</th>
                        <th>Editar</th>
                        <th>Inhabilitar</th>
                    </tr>
                </thead>
                <!-- Cuerpo de la tabla donde se mostrarán los datos de los usuarios -->
                <tbody class="bg-light" id="cont_table">
                    <!-- Los datos se completarán dinámicamente desde la base de datos mediante AJAX. -->
                </tbody>
            </table>
        </div>
        <!-- Espaciado después de la tabla -->
        <br>
        <!-- Botón para volver a la página principal -->
        <div class="center-button">
            <button class="btn btn-primary" onclick="window.location.href='home.php'">Volver</button>
        </div>
    </div>
    <!-- Incluir el script de JavaScript para la búsqueda dinámica de usuarios -->
    <script src="../js/ajax_buscar_usuarios.js"></script>
</body>
</html>