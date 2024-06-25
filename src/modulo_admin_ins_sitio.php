
<head>
    <link rel="stylesheet" href="../css/style-chek.css">
    <title>Formulario de sitios</title>
</head>
<?php 
// Incluir la conexión a la base de datos
include_once "base_de_datos.php";
// Preparar consulta SQL para obtener información de departamentos y municipios
$s_depmun = $base_de_datos->prepare('SELECT a.id_depto, a.nom_munic, a.id_munic, b.nom_depto  FROM tab_munics as a, tab_deptos as b WHERE a.id_depto = b.id_depto  ORDER BY 2 asc');
// Ejecutar la consulta
$s_depmun->execute();
// Obtener todos los resultados como objetos
$enc_depmun = $s_depmun->fetchAll(PDO::FETCH_OBJ);
?>

    <div class="container col-md-9">
        <div class="row justify-content-center">
            <div class="col-md-5 col-md-4">
                <div class="card card-form">
                    <div class="card-header text-center">
                        <h4>Registro de sitios.</h4> <!-- Título del formulario -->
                    </div>
                    <div class="card-body">
                        <!-- Formulario para insertar un nuevo sitio -->
                        <form action="ins_sitio.php" method="post">
                            <!-- Selector de departamento -->
                            <select class="form-select form-control bg-transparent" name="id_depto" id="id_depto">
                                <option value="">Departamento</option>      
                                <?php foreach($enc_depmun as $depmun)
                                {
                                ?>
                                    <!-- Opciones de departamento obtenidas de la base de datos -->
                                    <option value="<?php echo $depmun->id_depto?>"><?php echo $depmun->nom_depto?></option>
                                <?php
                                 } ?>
                            </select>
                                 
                            <!-- Selector de municipio -->
                            <select class="form-select form-control bg-transparent" name="id_munic" id="id_munic">
                                <option value="">Municipio</option>      
                                <?php  
                                foreach($enc_depmun as $munic)
                                {
                                ?>
                                    <!-- Opciones de municipio obtenidas de la base de datos -->
                                    <option value="<?php echo $munic->id_munic?>"><?php echo $munic->nom_munic?></option>
                                <?php
                                } ?>
                            </select>

                            <br>
                            <!-- Campo para el nombre del sitio -->
                            <input type="text" class="form-control" name="nom_sitio" id="nom_sitio" placeholder="Nombre del sitio" required>
                            <!-- Campo para la dirección del sitio -->
                            <input type="text" class="form-control" name="dir_sitio" id="dir_sitio" placeholder="Dirección" required>
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