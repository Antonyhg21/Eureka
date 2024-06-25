
<head>
    <link rel="stylesheet" href="../css/style-chek.css">
</head>
<?php 
    // Incluir la conexión a la base de datos
    include_once "base_de_datos.php";
    // Preparar consulta para obtener los departamentos
    $s_deptos = $base_de_datos->prepare('SELECT a.id_depto, a.nom_depto FROM tab_deptos AS a ORDER BY 2 ASC;');
    // Ejecutar la consulta
    $s_deptos->execute();
    // Obtener todos los resultados como objetos
    $enc_deptos = $s_deptos->fetchAll(PDO::FETCH_OBJ);
?>


    <!-- Espaciado para alinear el formulario -->
    <div class="container col-md-9">
        <div class="row justify-content-center">
            <div class="col-md-5 col-md-4">
                <div class="card card-form">
                    <div class="card-header text-center">
                        <h4>Registro de municipios.</h4> <!-- Título del formulario -->
                    </div>
                    <div class="card-body">
                        <!-- Formulario para insertar un municipio-->
                        <form action="ins_munics.php" method="post">
                            <!-- Selector de tipo de departamentos -->
                            <select class="form-select form-control bg-transparent" name="id_depto" id="id_depto">
                                <option value="">SELECCIONE DEPARTAMENTO</option>      
                                <?php foreach($enc_deptos as $deptos)
                                {
                                ?>
                                    <!-- Opciones del selector, obtenidas de la base de datos -->
                                    <option value="<?php echo $deptos->id_depto?>"><?php echo $deptos->nom_depto?></option>
                                <?php
                                 } ?>
                            </select>
                            <br>
                            <!-- Campo para el identificador del municipio -->
                            <input type="number" class="form-control" name="id_munic" id="id_munic" placeholder="Codigo del municipio" required>
                            <!-- Campo para el nombre del municipio -->
                            <input type="text" class="form-control" name="nom_munic" id="nom_munic" placeholder="Nombre del municipio" required>
                            <div class="form-group text-center btn-container">
                                <!-- Botón para enviar el formulario -->
                                <button type="submit" class="btn btn-primary btn-block">Guardar registro</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
