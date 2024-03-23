<?php
session_start(); // Iniciar la sesión

if (!isset($_SESSION['usuario'])) {
    // Si el usuario no está conectado, redirigir a la página de inicio de sesión
    header('Location: login.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="EUREKA - Plataforma para la recuperación de elementos perdidos y encontrados." />
        <meta name="author" content="Jack Antony Hernandez Gonzalez" />
        <!-- <title>EUREKA</title> -->
        <link rel="icon" type="../image/x-icon" href="../img/icon.ico" />
        <!-- Font Awesome icons (free version)-->
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
        <!-- Google fonts-->
        <link href="https://fonts.googleapis.com/css?family=Varela+Round" rel="stylesheet" />
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link rel="stylesheet" href="../css/styles.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tooltipster/3.3.0/css/tooltipster.min.css" />

    </head>
    <body id="page-top">
        <nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
            <div class="container-fluid px-lg-3">
                <a class="navbar-brand" href="home.php">
                <img src="../img/icon.png" alt="Logo de la empresa" class="mr-2" style="height: 30px; width: 30px;">
                    EUREKA!
                </a>
                <button class="navbar-toggler navbar-toggler-right" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                    Menu
                    <i class="fas fa-bars"></i>
                </button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item"><a class="nav-link" href="seekfind.php">Publicar un elemento</a></li>
                        <li class="nav-item"><a class="nav-link" href="#footer">Acerca de</a></li>
                        <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-bell"></i> <!-- Este es el icono de la campana -->
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <!-- Aquí puedes poner tus notificaciones. Por ahora, solo es un texto de prueba. -->
                            <li><a class="dropdown-item text-truncate" href="#">Notificación 1</a></li>
                            <li><a class="dropdown-item text-truncate" href="#">Notificación 2</a></li>
                        </ul>
                    </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-user"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                                <li><a class="dropdown-item" href="<?php echo "edit_usuarios.php?id_usuario=antackgondez@gmail.com"?>">Actualizar mis datos</a></li>
                                <li><a class="dropdown-item" href="<?php echo "perfil.php?"?>">Mi perfil</a></li>
                                <li><a class="dropdown-item" href="<?php echo "lista_usuarios.php?"?>">Administrar usuarios</a></li>
                                <li><a class="dropdown-item" href="<?php echo "admin.php?"?>">Administrativo</a></li>
                                <li><a class="dropdown-item" href="cerrar_sesion.php">Cerrar sesión</a></li>                       </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="../js/scripts.js"></script>
        <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
        <!-- * *                               SB Forms JS                               * *-->
        <!-- * * Activate your form at https://startbootstrap.com/solution/contact-forms * *-->
        <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
        <!-- <script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script> -->
    </body>
</html>
                
