<?php
//  if (!isset($_GET["seekfind"]))
//  {
//  	echo "No existe el valor seek or find";
//  	exit();
//  }

//  $seekfind = $_GET["seekfind"];

//  echo "el valor de el seekfind es $seekfind"
?>
<?php 
include_once "encabezado.php";
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style-chek.css">    
    <title>Registra Elementos</title>
</head>

<?php 
    include_once "base_de_datos.php";
?>

<body class="body">
    <br><br><br>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-5 col-md-4">
                <div class="card card-form">
                    <div class="card-header text-center">
                        <h4>Registra tu elemento extraviado</h4>
                    </div>
                    <div class="card-body">
                        <form action="ins_seekfind.php" method="post" onsubmit="return validarFormulario()">
                            <label class="form-label" for="">Informacion sobre el elemento:</label>
                            <input disabled type="file" class="form-control elemento" name="foto" id="foto" accept="image/*" title="Sube una foto de tu elemento">
                            <select class="form-select form-control bg-transparent" name="id_tipo" id="id_tipo" >
                                <option value="">SELECCIONE UN TIPO DE ELEMENTO</option>      
                                <?php 
                                $s_tipo_elemento = $base_de_datos->prepare('SELECT a.id_tipo, a.nom_tipo FROM tab_tipo_elemento AS a ORDER BY 2');
                                $s_tipo_elemento->execute();
                                $count= $s_tipo_elemento->rowCount();
                                $enc_tipo_elemento = $s_tipo_elemento->fetchAll(PDO::FETCH_ASSOC);
                                
                                foreach($enc_tipo_elemento as $tipo_elemento)
                                {
                                ?>
                                    <option value="<?php echo $tipo_elemento['id_tipo']?>"><?php echo $tipo_elemento['nom_tipo']?></option>
                                <?php
                                } ?>
                            </select>

                            <select class="form-select form-control bg-transparent" name="id_elemento" id="id_elemento" >
                                <option value="">SELECCIONE ELEMENTO</option> 
                            </select>

                            <input type="text" class="form-control" name="desc_elemento" id="desc_elemento" placeholder="Descripción del elemento" maxlength="300" required>

                            <label class="form-label" for="">Lugar:</label>

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
                                 
                            <select class="form-select form-control bg-transparent" name="id_sitio" id="id_sitio" >
                                <option value="">Sitio</option>
                            </select>
                            <input type="text" class="form-control" name="desc_sitio" id="desc_sitio" placeholder="Descripción del sitio" maxlength="500" required>

                            <label class="form-label" for="">Fecha y hora:</label>
                            <input type="date" class="form-control" name="fecha" id="fecha" placeholder="Dia de extravío" required>
                            <input type="time" class="form-control" name="hora" id="hora" placeholder="Hora de extravío" required>
                            <div class="form-group text-center btn-container">
                                <button type="submit" class="btn btn-primary btn-block">Enviar registro</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br><br><br><br>
    <?php
    include_once "footer.php";
    ?>
    <script src="../js/ajax_buscar_elementos.js"></script> 
    <script src="../js/ajax_buscar_municipios.js"></script>
    <script src="../js/ajax_buscar_sitios.js"></script> 

    <script>
        document.getElementById('id_sitio').addEventListener('change', function() {
            if (this.value === 'form_sitios.php') {
                window.location.href = this.value;
            }
        });
        document.getElementById('id_elemento').addEventListener('change', function() {
            if (this.value === 'form_elemento.php') {
                window.location.href = this.value;
            }
        });
        document.getElementById('id_tipo').addEventListener('change', function() {
            if (this.value === 'form_tipo_elemento.php') {
                window.location.href = this.value;
            }
        });
    </script>
</body>
</html>



