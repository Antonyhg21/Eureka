<?php
include_once "encabezado.php";
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/styles.css">
    <link rel="stylesheet" href="../css/style-chek.css">
    <title>Formulario de sitios</title>
</head>
<?php 
    include_once "base_de_datos.php";
    /*echo "Entro a Listar para saber si está entrando o no....";*/
    $s_depmun = $base_de_datos->prepare('SELECT a.id_depto, a.nom_munic, a.id_munic, b.nom_depto  FROM tab_munics as a, tab_deptos as b WHERE a.id_depto = b.id_depto  ORDER BY 2 asc');
    $s_depmun->execute();
    $enc_depmun = $s_depmun->fetchAll(PDO::FETCH_OBJ);
?>

<body class="bg-image">
    <br><br><br><br><br><br><br>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-5 col-md-4">
                <div class="card card-form">
                    <div class="card-header text-center">
                        <h4>Registro de sitios.</h4>
                    </div>
                    <div class="card-body">
                        <form action="ins_sitio.php" method="post">

                            <select class="form-select form-control bg-transparent" name="id_depto" id="id_depto">
                                <option value="">Departamento</option>      
                                <?php foreach($enc_depmun as $depmun)
					            {
						        ?>
                                    <option value="<?php echo $depmun->id_depto?>"><?php echo $depmun->nom_depto?></option>
					            <?php
					             } ?>
                            </select>
                                 
                            <select class="form-select form-control bg-transparent" name="id_munic" id="id_munic">
                                <option value="">Municipio</option>      
                                <?php  
                                foreach($enc_depmun as $munic)
					            {
						        ?>
                                    <option value="<?php echo $munic->id_munic?>"><?php echo $munic->nom_munic?></option>
					            <?php
					            } ?>
                            </select>

                            <br>
                            <input type="text" class="form-control" name="nom_sitio" id="nom_sitio" placeholder="Nombre del sitio" required>
                            <input type="text" class="form-control" name="dir_sitio" id="dir_sitio" placeholder="Dirección" required>
                            <div class="form-group text-center btn-container">
                                <button type="submit" class="btn btn-primary btn-block">Guardar registro</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br>
    <br><br><br><br><br><br><br>
    
    <?php 
        include_once "footer.php";
    ?>
</body>
</html>