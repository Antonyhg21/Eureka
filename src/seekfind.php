<?php
include_once "encabezado.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style-chek.css">
    <script src="js/vali.js"></script>
    <title>Document</title>
</head>

<?php
$seeker = 1;
$finder = 0;
?>
<body class="bg-image">
    <br><br><br><br>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-2 col-md-5">
                <div class="card card-form">
                    <div class="card-header text-center">
                        <h4>Selecciona la opción según tu necesidad.</h4>
                    </div>
                    <div class="card-body">
                            <div class="form-group text-center btn-container btn-group-lg">
                                <a class="text-decoration-none" href="<?php echo "form_seekfind.php?seekfind=" . $seeker?>" onclick="window.open(this.href, '_self'); return false;">
                                    <button type="button" class="btn btn-light mb-3">Soy seeker, he perdido un elemento</button>
                                </a>
                                <a class="text-decoration-none" href="<?php echo "form_seekfind.php?seekfind=" . $finder?>" onclick="window.open(this.href, '_self'); return false;">
                                    <button type="submit" class="btn btn-primary btn-block">Soy finder, he encontrado un elemento</button>
                                </a>
                            </div>  
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br><br><br><br><br><br><br>
    <?php
    include_once "footer.php"; 
    ?>
</body>
</html>