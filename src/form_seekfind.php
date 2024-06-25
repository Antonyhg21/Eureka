<?php 
// Incluir el archivo de encabezado
include_once "encabezado.php";
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Incluir hoja de estilos CSS -->
    <link rel="stylesheet" href="../css/style-chek.css">    
    <title>Registra Elementos</title>
</head>

<?php 
// Incluir la conexión a la base de datos
include_once "base_de_datos.php";
?>

<body class="body">
    <br><br><br>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-5 col-md-4">
                <div class="card card-form">
                    <div class="card-header text-center">
                        <h4>Registra tu elemento extraviado</h4> <!-- Título del formulario -->
                    </div>
                    <div class="card-body">
                        <!-- Formulario para insertar un nuevo elemento extraviado -->
                        <form action="ins_seekfind.php" method="post" onsubmit="return validarFormulario()">
                            <label class="form-label" for="">Informacion sobre el elemento:</label>
                            <!-- Campo deshabilitado para subir foto (no implementado) -->
                            <input disabled type="file" class="form-control elemento" name="foto" id="foto" accept="image/*" title="Sube una foto de tu elemento">
                            <!-- Selector de tipo de elemento -->
                            <select class="form-select form-control bg-transparent" name="id_tipo" id="id_tipo" >
                                <option value="">SELECCIONE UN TIPO DE ELEMENTO</option>      
                                <?php 
                                // Preparar y ejecutar consulta para obtener tipos de elementos
                                $s_tipo_elemento = $base_de_datos->prepare('SELECT a.id_tipo, a.nom_tipo FROM tab_tipo_elemento AS a ORDER BY 2');
                                $s_tipo_elemento->execute();
                                $enc_tipo_elemento = $s_tipo_elemento->fetchAll(PDO::FETCH_ASSOC);
                                
                                // Iterar sobre los resultados y crear opciones para el selector
                                foreach($enc_tipo_elemento as $tipo_elemento)
                                {
                                ?>
                                    <option value="<?php echo $tipo_elemento['id_tipo']?>"><?php echo $tipo_elemento['nom_tipo']?></option>
                                <?php
                                } ?>
                            </select>

                            <!-- Selector de elemento específico (se llena dinámicamente) -->
                            <select class="form-select form-control bg-transparent" name="id_elemento" id="id_elemento" >
                                <option value="">SELECCIONE ELEMENTO</option> 
                            </select>

                            <!-- Campo para descripción del elemento -->
                            <input type="text" class="form-control" name="desc_elemento" id="desc_elemento" placeholder="Descripción del elemento" maxlength="300" required>

                            <label class="form-label" for="">Lugar:</label>
                            <!-- Selector de departamento -->
                            <select class="form-select form-control bg-transparent" name="id_depto" id="id_depto">
                                <option value="">Departamento</option>      
                                <?php 
                                // Preparar y ejecutar consulta para obtener departamentos
                                $s_depto = $base_de_datos->prepare('SELECT a.id_depto, a.nom_depto FROM tab_deptos AS a ORDER BY 2');
                                $s_depto->execute();
                                $enc_depto = $s_depto->fetchAll(PDO::FETCH_ASSOC);
                                
                                // Iterar sobre los resultados y crear opciones para el selector
                                foreach($enc_depto as $depto)
                                {
                                ?>
                                    <option value="<?php echo $depto['id_depto']?>"><?php echo $depto['nom_depto']?></option>
                                <?php
                                } ?>
                            </select>
                                 
                            <!-- Selector de municipio (se llena dinámicamente) -->
                            <select class="form-select form-control bg-transparent" name="id_munic" id="id_munic">
                                <option value="">Municipio</option>  
                            </select>
                                 
                            <!-- Selector de sitio (se llena dinámicamente) -->
                            <select class="form-select form-control bg-transparent" name="id_sitio" id="id_sitio" >
                                <option value="">Sitio</option>
                            </select>
                            <!-- Campo para descripción del sitio -->
                            <input type="text" class="form-control" name="desc_sitio" id="desc_sitio" placeholder="Descripción del sitio" maxlength="500" required>

                            <label class="form-label" for="">Fecha y hora:</label>
                            <!-- Campo para seleccionar fecha de extravío -->
                            <input type="date" class="form-control" name="fecha" id="fecha" placeholder="Dia de extravío" required>
                            <!-- Campo para seleccionar hora de extravío -->
                            <input type="time" class="form-control" name="hora" id="hora" placeholder="Hora de extravío" required>
                            <div class="form-group text-center btn-container">
                                <!-- Botón para enviar el formulario -->
                                <button type="submit" class="btn btn-primary btn-block">Enviar registro</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br><br><br><br>
    <?php
    // Incluir el pie de página
    include_once "footer.php";
    ?>
    <!-- Incluir scripts para funcionalidad AJAX -->
    <script src="../js/ajax_buscar_elementos.js"></script> 
    <script src="../js/ajax_buscar_municipios.js"></script>
    <script src="../js/ajax_buscar_sitios.js"></script> 

    <script>
        // Scripts para redireccionar basado en la selección de ciertos campos
        // Agrega un escuchador de eventos al elemento con ID 'id_sitio'. Este escuchador reacciona a cambios en el elemento.
        document.getElementById('id_sitio').addEventListener('change', function() {
            // Si el valor seleccionado es igual a 'form_sitios.php', redirecciona a esa página.
            if (this.value === 'form_sitios.php') {
                window.location.href = this.value;
            }
        });

        // Agrega un escuchador de eventos al elemento con ID 'id_elemento'. Este escuchador reacciona a cambios en el elemento.
        document.getElementById('id_elemento').addEventListener('change', function() {
            // Si el valor seleccionado es igual a 'form_elemento.php', redirecciona a esa página.
            if (this.value === 'form_elemento.php') {
                window.location.href = this.value;
            }
        });

        // Agrega un escuchador de eventos al elemento con ID 'id_tipo'. Este escuchador reacciona a cambios en el elemento.
        document.getElementById('id_tipo').addEventListener('change', function() {
            // Si el valor seleccionado es igual a 'form_tipo_elemento.php', redirecciona a esa página.
            if (this.value === 'form_tipo_elemento.php') {
                window.location.href = this.value;
            }
        });
    </script>
</body>
</html>

