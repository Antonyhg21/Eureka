<?php 
include_once "encabezado.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/styles.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Contacto</title>
</head>
<body class="body">
    <br><br><br><br><br><br>
    <div class="container p-3 rounded w-50" style="background-color: rgba(255, 255, 255, 0.5);">
        <h1 class="text-center">Formulario de contacto</h1>
        <form action="submit_contacto.php" method="POST">
            <div class="form-group">
                <label for="nombre">Nombre:</label>
                <input type="text" class="form-control" id="nombre" name="nombre" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="mensaje">Mensaje:</label>
                <textarea class="form-control" id="mensaje" name="mensaje" rows="5" required></textarea>
            </div>
            <div class="button-group">
                <button type="submit" class="btn btn-primary">Enviar</button>
                <a href="seekfind.php" onclick="window.open(this.href, '_self'); return false;">
                    <input class="btn btn-primary" type="submit" value="Volver">
                </a>
            </div>
        </form>
    </div>

    <br><br><br><br><br><br>
    <?php 
    include_once "footer.php";
    ?>
    </body>
    </html>
