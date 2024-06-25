<?php
// Incluye el archivo de encabezado común a todas las páginas
include_once "encabezado.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Define la codificación de caracteres para esta página -->
    <meta charset="UTF-8">
    <!-- Asegura una correcta visualización y zoom táctil en dispositivos móviles -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Enlace al archivo CSS para estilos específicos de los checkboxes -->
    <link rel="stylesheet" href="../css/style-chek.css">
    <!-- Script de validación de formularios -->
    <script src="js/vali.js"></script>
    <title>Document</title>
</head>

<?php
// Variables para identificar el rol del usuario en el formulario
$seeker = 1; // Usuario que busca un objeto perdido
$finder = 0; // Usuario que ha encontrado un objeto
?>
<body class="bg-image">
    <!-- Espaciado para alinear el contenido principal -->
    <br><br><br><br>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-2 col-md-5">
                <div class="card card-form">
                    <div class="card-header text-center">
                        <!-- Título de la sección para elegir el rol del usuario -->
                        <h4>Selecciona la opción según tu necesidad.</h4>
                    </div>
                    <div class="card-body">
                            <div class="form-group text-center btn-container btn-group-lg">
                                <!-- Botón para usuarios que han perdido un objeto (seekers) -->
                                <a class="text-decoration-none" href="<?php echo "form_seekfind.php?seekfind=" . $seeker?>" onclick="window.open(this.href, '_self'); return false;">
                                    <button type="button" class="btn btn-light mb-3">Soy seeker, he perdido un elemento</button>
                                </a>
                                <!-- Botón para usuarios que han encontrado un objeto (finders) -->
                                <a class="text-decoration-none" href="<?php echo "form_seekfind.php?seekfind=" . $finder?>" onclick="window.open(this.href, '_self'); return false;">
                                    <button type="submit" class="btn btn-primary btn-block">Soy finder, he encontrado un elemento</button>
                                </a>
                            </div>  
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Espaciado al final de la página -->
    <br><br><br><br><br><br><br>
    <?php
    // Incluye el archivo de pie de página común a todas las páginas
    include_once "footer.php"; 
    ?>
</body>
</html>