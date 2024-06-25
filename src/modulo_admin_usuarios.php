<div class="container col-md-9">
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

    </div>
    <!-- Incluir el script de JavaScript para la búsqueda dinámica de usuarios -->
    <script src="../js/ajax_buscar_usuarios.js"></script>