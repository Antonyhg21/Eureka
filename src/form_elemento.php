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
    <title>Formulario elemento</title>
</head>
<?php 
    include_once "base_de_datos.php";
    /*echo "Entro a Listar para saber si está entrando o no....";*/
    $s_tipo_elemento = $base_de_datos->prepare('SELECT a.id_tipo, a.nom_tipo FROM tab_tipo_elemento AS a ORDER BY 2 ASC;');
    $s_tipo_elemento->execute();
    $enc_tipo_elemento = $s_tipo_elemento->fetchAll(PDO::FETCH_OBJ);
?>

<body class="bg-image">
    <br><br><br><br><br><br><br>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-5 col-md-4">
                <div class="card card-form">
                    <div class="card-header text-center">
                        <h4>Registro de elemento.</h4>
                    </div>
                    <div class="card-body">
                        <form action="ins_elemento.php" method="post">
                            <select class="form-select form-control bg-transparent" name="id_tipo" id="id_tipo">
                                <option value="">SELECCIONE UN TIPO DE ELEMENTO</option>      
                                <?php foreach($enc_tipo_elemento as $tipo_elemento)
					            {
						        ?>
                                    <option value="<?php echo $tipo_elemento->id_tipo?>"><?php echo $tipo_elemento->nom_tipo?></option>
					            <?php
					             } ?>
                            </select>
                            <br>
                            <input type="text" class="form-control" name="nom_elemento" id="nom_elemento" placeholder="Nombre del elemento" required>
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