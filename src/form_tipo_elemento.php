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
    <title>Formulario tipo de elemento</title>
</head>

<body class="bg-image">
    <br><br><br><br><br><br><br>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-5 col-md-4">
                <div class="card card-form">
                    <div class="card-header text-center">
                        <h4>Registro de tipo de elemento.</h4>
                    </div>
                    <div class="card-body">
                        <form action="ins_tipo_elemento.php" method="post">
                            <input type="text" class="form-control" name="nom_tipo" id="nom_tipo" placeholder="Nombre del tipo de elemento" required>
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