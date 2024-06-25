
<head>
    <link rel="stylesheet" href="../css/style-chek.css">
</head>
<?php 
    // Incluir la conexión a la base de datos
    include_once "base_de_datos.php";
    // Preparar consulta para obtener los tipos de elementos
    $s_tipo_elemento = $base_de_datos->prepare('SELECT a.id_tipo, a.nom_tipo FROM tab_tipo_elemento AS a ORDER BY 2 ASC;');
    // Ejecutar la consulta
    $s_tipo_elemento->execute();
    // Obtener todos los resultados como objetos
    $enc_tipo_elemento = $s_tipo_elemento->fetchAll(PDO::FETCH_OBJ);
?>


    <!-- Espaciado para alinear el formulario -->
    <div class="container col-md-9">
        <div class="row justify-content-center">
            <div class="col-md-5 col-md-4">
                <div class="card card-form">
                    <div class="card-header text-center">
                        <h4>Registro de departamentos.</h4> <!-- Título del formulario -->
                    </div>
                    <div class="card-body">
                        <!-- Formulario para insertar un nuevo elemento -->
                        <form action="ins_depto.php" method="post">
                            <!-- Campo para el identificador del departamento -->
                            <input type="number" class="form-control" name="id_depto" id="id_depto" placeholder="Codigo postal del departamento" required>
                            <!-- campo para el nombre del departamento -->
                            <input type="text" class="form-control" name="nom_depto" id="nom_depto" placeholder="Nombre del departamento" required>
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
