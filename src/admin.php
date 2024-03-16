<?php 
include_once "encabezado.php";
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/styles.css">
    <title>Administración de Tablas</title>
</head>
<body class="body">
    <br><br><br><br>
    <div class="d-flex flex-wrap gap-2 justify-content-center align-items-center">
        <button class="btn btn-primary" onclick="showCrud('seekfind')">seekfind</button>
        <button class="btn btn-primary" onclick="showCrud('usuarios')">usuarios</button>
        <button class="btn btn-primary" onclick="showCrud('elemento')">elemento</button>
        <button class="btn btn-primary" onclick="showCrud('tipo_elemento')">tipo_elemento</button>
        <button class="btn btn-primary" onclick="showCrud('sitios')">sitios</button>
        <button class="btn btn-primary" onclick="showCrud('munics')">munics</button>
        <button class="btn btn-primary" onclick="showCrud('deptos')">deptos</button>
    </div>

    <div id="crud-section-seekfind" class="crud-section">
        <!-- Sección CRUD para la tabla seekfind -->
        <div class="crud-buttons">
            <button class="btn btn-secondary" onclick="createData('seekfind')">Crear Nuevo</button>
            <button class="btn btn-secondary" onclick="showData('seekfind')">Mostrar Datos</button>
        </div>
        seekfind
    </div>
    <div id="crud-section-usuarios" class="crud-section">
        <!-- CRUD section for usuarios table -->
        <div class="crud-buttons">
            <button class="btn btn-secondary" onclick="showData('usuarios')">Mostrar Datos</button>
        </div>
        usuarios
        <script src="../js/ajax_buscar_usuarios.js"></script>

    </div>
    <div id="crud-section-elemento" class="crud-section">
        <!-- CRUD section for elemento table -->
        <div class="crud-buttons">
            <button class="btn btn-secondary" onclick="createData('elemento')">Crear Nuevo</button>
            <button class="btn btn-secondary" onclick="showData('elemento')">Mostrar Datos</button>
        </div>
        elemento
    </div>
    <div id="crud-section-tipo_elemento" class="crud-section">
        <!-- CRUD section for tipo_elemento table -->
        <div class="crud-buttons">
            <button class="btn btn-secondary" onclick="createData('tipo_elemento')">Crear Nuevo</button>
            <button class="btn btn-secondary" onclick="showData('tipo_elemento')">Mostrar Datos</button>
        </div>
        tipo_elemento
    </div>
    <div id="crud-section-sitios" class="crud-section">
        <!-- CRUD section for sitios table -->
        <div class="crud-buttons">
            <button class="btn btn-secondary" onclick="createData('sitios')">Crear Nuevo</button>
            <button class="btn btn-secondary" onclick="showData('sitios')">Mostrar Datos</button>
        </div>
        sitios
    </div>
    <div id="crud-section-munics" class="crud-section">
        <!-- CRUD section for munics table -->
        <div class="crud-buttons">
            <button class="btn btn-secondary" onclick="createData('munics')">Crear Nuevo</button>
            <button class="btn btn-secondary" onclick="showData('munics')">Mostrar Datos</button>
        </div>
        munics
    </div>
    <div id="crud-section-deptos" class="crud-section">
        <!-- CRUD section for deptos table -->
        <div class="crud-buttons">
            <button class="btn btn-secondary" onclick="createData('deptos')">Crear Nuevo</button>
            <button class="btn btn-secondary" onclick="showData('deptos')">Mostrar Datos</button>
        </div>
        deptos
    </div>

    <script>
        // Oculta todos los botones de CRUD al cargar la página
        window.onload = function() {
            var buttons = document.querySelectorAll('.crud-section');
            buttons.forEach(function(button) {
                button.style.display = 'none';
            });
        };


        function showCrud(tableName) {
            // Hide all CRUD sections
            var crudSections = document.getElementsByClassName("crud-section");
            for (var i = 0; i < crudSections.length; i++) {
                crudSections[i].style.display = "none";
            }

            // Show the selected CRUD section
            var selectedCrudSection = document.getElementById("crud-section-" + tableName);
            selectedCrudSection.style.display = "block";
        }

        function createData(tableName) {
            console.log("Creating new data for table: " + tableName);
            // Add your create data logic here
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    // Inserta el formulario en el elemento HTML que desees
                    document.getElementById("crud-section-" + tableName).innerHTML = this.responseText;
                }
            };
            xhttp.open("GET", "form_" + tableName + ".php", true);
            xhttp.send();
        }

        function showData(tableName) {
            console.log("Showing data for table: " + tableName);
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    console.log(this.responseText); // Aquí está el console.log agregado
                    document.getElementById("crud-section-" + tableName).innerHTML = this.responseText;
                }
            };
            xhttp.open("GET", "lista_" + tableName + ".php", true);
            xhttp.send();
        }
    </script>
</body>
</html>

