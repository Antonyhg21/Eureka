<?php
session_start();    // Iniciar la sesión
session_unset();    // Eliminar todas las variables de sesión
session_destroy();  // Destruir la sesión

// Redirigir al usuario a la página de inicio
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
        <form id="loginForm" class="" action="vali_usuario.php" method="POST">
            <!-- Campo para ingresar el correo electrónico -->
            <label for="Nombre de usuario">E-mail</label>
            <input class="form-control" type="email" name="email" required>

            <!-- Campo para ingresar la contraseña -->
            <label for="Contraseña">Contraseña</label>
            <input class="form-control" type="password" name="password" required>

            <!-- Botón para enviar el formulario -->
            <input type="submit" value="Ingresar">
            
            <!-- Enlaces para crear una cuenta nueva o recuperar la contraseña -->
            <div class="text-center">
                <a href="form_usuario.php">Crea tu cuenta.</a>
                <br>
                <a href="email_pass.php">¿Olvidaste tu contraseña?</a>
            </div>
        </form>
    </div>

    <!-- Modal para mostrar mensajes de error -->
    <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Error</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="modalText">
                    <!-- Aquí se mostrará el mensaje de error -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
    
</body>
<script src="../js/script_jquery.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
$(document).ready(function(){
    $('#loginForm').on('submit', function(e){
        e.preventDefault(); // Evitar el envío del formulario de manera tradicional

        $.ajax({
            type: 'POST',
            url: 'vali_usuario.php',
            data: $(this).serialize(), // Serializar los datos del formulario
            dataType: 'json',
            success: function(response){
                if(response.status == 'success'){
                    // Si el inicio de sesión es exitoso, redirigir a home.php
                    window.location.href = 'home.php';
                } else {
                    // Si hay un error, mostrar el mensaje en el modal
                    $('#modalText').text(response.message);
                    var myModal = new bootstrap.Modal(document.getElementById('myModal'), {});
                    myModal.show();
                }
            }
        });
    });
});
</script>
</html>