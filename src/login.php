<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Taller formulario">
    <meta name="author" content="Jack Antony Hernández González">
    <link rel="icon" type="image/x-icon" href="../img/icon.ico" />
    <link rel="stylesheet" href="../css/styles.css">
    <link rel="stylesheet" href="../css/style-form.css">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.2.3/js/bootstrap.bundle.min.js"></script>
    <title>Ingresar</title>
</head>
<body>
    <div class="login-box">
        <img class="avatar" src="../img/icon.png" alt="Imagen de el logo JA">
        <h3>Inicio de sesión</h3>
        <form class="" action="vali_usuario.php" method="POST">
            <label for="Nombre de usuario">E-mail</label>
            <input class="form-control" type="email" name="email" required>

            <label for="Contraseña">Contraseña</label>
            <input class="form-control" type="password"   name="password" required>

            <input type="submit" value="Ingresar">
            
            <div class="text-center">
                <a href="form_usuario.php">Crea tu cuenta.</a>
                    <br>
                <a href="email_pass.php">¿Olvidaste tu contraseña?</a>
            </div>
        </form>
        
    </div>
    
</body>
</html>