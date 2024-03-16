<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Registro</title>
    <link rel="icon" type="image/x-icon" href="img/icon.ico" />
    <link rel="stylesheet" href="../css/styles.css">
    <link rel="stylesheet" href="../css/style-chek.css">
    <script src="js/vali.js"></script>
</head>

    
<body class="bg-image">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-2 col-md-5">
                <div class="card card-form">
                    <div class="card-header text-center">
                        <h4>Recupera tu cuenta.</h4>
                    </div>
                    <div class="card-body">
                        <form onsubmit=" return validarFormulario()">
                            <div class="form-group ">
                                <label for="nom_usuario" class="featured-text">
                                    Ingresa tu correo electrónico o número de celular para buscar tu cuenta. 
                                </label>

                                <input type="email" class="form-control mt-2" id="nom_usuario" placeholder="Correo electrónico" >
                            </div>

                            <div class="form-group text-center btn-container btn-group-lg">
                                <a class="text-decoration-none" href="login.php" onclick="window.open(this.href, '_self'); return false;">
                                    <button type="button" class="btn btn-light">Cancelar</button>
                                </a>
                                <a class="text-decoration-none" href="rec_pass.php" onclick="window.open(this.href, '_self'); return false;">
                                    <button type="submit" class="btn btn-primary btn-block">buscar</button>
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br>
    
</body>
</html>