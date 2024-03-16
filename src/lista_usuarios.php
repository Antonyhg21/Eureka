<?php
include_once "encabezado.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de usuario</title>
</head>
<body class="body">
    <br><br>
    <div class="container mt-5">
        <h1>Usuarios:</h1>
        <form class="mb-3">
            <div class="input-group">
                
                <label for="buscar" class="form-label">Buscar</label>
            </div>
            <div class="input-group">
                <input type="text" id="buscar" class="form-control-sm" name="buscar" placeholder="Search">
            </div>
        </form>

        <div class="table-responsive">
            <table class="table table-striped">
                <thead class="bg-dark text-white" >
                    <tr>
                        <th>Correo electrónico</th>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Documento</th>
                        <th>Celular</th>
                        <th>Direccion</th>
                        <th>Departamento</th>
                        <th>Municipio</th>
                        <th>Editar</th>
                        <th>Eliminar</th>
                    </tr>
                </thead>
                <tbody class="bg-light" id="cont_table"> <!-- Aquí se mostrarán los datos -->

                    <!-- Los datos se completarán dinámicamente desde la base de datos. -->
                </tbody>
            </table>
        </div>
        <br>
        <div class="center-button">
            <button class="btn btn-primary" onclick="window.location.href='home.php'">Volver</button>
        </div>
    </div>
    <script src="../js/ajax_buscar_usuarios.js"></script>
</body>
</html>