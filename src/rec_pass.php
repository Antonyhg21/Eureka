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
            <div class="col-md-4 col-md-4">
                <div class="card card-form">
                    <div class="card-header text-center">
                        <h5>Reestablece tu contraseña.</h5>
                    </div>
                    <div class="mt-4">
                        A continuación, escribe tu nueva contraseña:
                    </div>
                    <div class="card-body">
                        <form action="login.php"  onsubmit="return validarFormulario()">
                                    <input type="password" class="form-control" id="nom_usuario" placeholder="Escribe tu nueva contraseña" required>
                                    <input type="password" class="form-control mt-1" id="nom_usuario" placeholder="Confirma tu contraseña" required>
                            <div class="form-group text-center btn-container">
                                <button type="submit" class="btn btn-primary btn-block">Confirmar cambios</button>
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