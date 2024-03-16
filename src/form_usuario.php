<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Registro</title>
    <link rel="icon" type="image/x-icon" href="../img/icon.ico" />
    <link rel="stylesheet" href="../css/styles.css">
    <link rel="stylesheet" href="../css/style-chek.css">
    <script src="js/vali.js"></script>
</head>
    
<?php 
    include_once "base_de_datos.php";
    /*echo "Entro a Listar para saber si está entrando o no....";*/
    $s_depmun = $base_de_datos->prepare('SELECT a.id_depto, a.nom_munic, a.id_munic, b.nom_depto  FROM tab_munics as a, tab_deptos as b WHERE a.id_depto = b.id_depto  ORDER BY 2 asc');
    $s_depmun->execute();
    $enc_depmun = $s_depmun->fetchAll(PDO::FETCH_OBJ);
?>

<body class="bg-image">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-5 col-md-4">
                <div class="card card-form">
                    <div class="card-header text-center">
                        <h4>Registro de Usuario</h4>
                    </div>
                    <div class="card-body">
                        <form action="ins_usuario.php" method="post" onsubmit="return validarFormulario()">
                            <input type="email" class="form-control" name="email_usuario" id="email_usuario" placeholder="Correo Electrónico" required>
                            <input type="text" class="form-control" name="doc_usuario" id="doc_usuario" placeholder="Documento" required>
                            <input type="text" class="form-control" name="nom_usuario" id="nom_usuario" placeholder="Nombre" required>
                            <input type="text" class="form-control" name="ape_usuario" id="ape_usuario" placeholder="Apellido" required>
                            <input type="password" class="form-control" name="pass_usuario" id="pass_usuario" placeholder="Contraseña" required>
                            <input type="text" class="form-control" name="cel_usuario" id="cel_usuario" placeholder="Número de Celular" required>
                            <input type="text" class="form-control" name="dir_usuario" id="dir_usuario" placeholder="Dirección de Residencia" required>

                            <select class="form-select form-control bg-transparent" name="id_depto" id="id_depto">
                                <option value="">Departamento</option>      
                                <?php 
                                $s_depto = $base_de_datos->prepare('SELECT a.id_depto, a.nom_depto FROM tab_deptos AS a ORDER BY 2');
                                $s_depto->execute();
                                $count= $s_depto->rowCount();
                                $enc_depto = $s_depto->fetchAll(PDO::FETCH_ASSOC);
                                
                                foreach($enc_depto as $depto)
                                {
                                ?>
                                    <option value="<?php echo $depto['id_depto']?>"><?php echo $depto['nom_depto']?></option>
                                <?php
                                } ?>
                            </select>
                                 
                            <select class="form-select form-control bg-transparent" name="id_munic" id="id_munic">
                                <option value="">Municipio</option>  
                            </select>

                            <div class="form-group text-center btn-container">
                                <button type="submit" class="btn btn-primary btn-block" onclick="showWelcomeMessage()">Registrarse</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br>
    <script src="../js/ajax_buscar_municipios.js"></script>
    
    <script>
        function showWelcomeMessage() {
            alert("Welcome to International Finders Community");
        }
    </script>
</body>
</html>


