<?php 
include_once "encabezado.php";
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EUREKA!</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>

<?php
    include "base_de_datos.php";
    $sentencia = $base_de_datos->prepare('SELECT a.id_seekfind, a.id_usuario, b.nom_usuario, 
        a.id_rol_usuario, a.estado_usuario, a.id_tipo, c.nom_tipo, a.id_elemento, 
        d.nom_elemento, a.desc_elemento, a.id_depto, e.nom_depto,  a.id_munic, 
        f.nom_munic, a.id_sitio, g.nom_sitio, a.desc_sitio, a.fecha, a.hora   
    FROM tab_seekfind AS a, tab_usuarios AS b, tab_tipo_elemento AS c, 
        tab_elemento AS d, tab_deptos AS e, tab_munics AS f, tab_sitios AS g
    WHERE a.id_usuario  = b.id_usuario  AND
        a.id_tipo       = c.id_tipo     AND
        a.id_elemento   = d.id_elemento AND
        d.id_tipo       = c.id_tipo     AND
        a.id_depto      = e.id_depto    AND
        a.id_munic      = f.id_munic    AND
        f.id_depto      = e.id_depto    AND
        a.id_sitio      = g.id_sitio    order by 18 desc LIMIT 20;');
    $sentencia->execute();
    $d_seekfind = $sentencia->fetchAll(PDO::FETCH_OBJ);

?>

<body class="body">
    <br><br><br>
    <h2 class="text-center text-white">
        Elementos Extraviados en tu zona.
    </h2>
    <div class="container">
        <div class="row">
            <?php foreach($d_seekfind as $seekfind) 
			{
			?>
                <div class="col-md-6">
                    <div class="card bg-light mb-3">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $seekfind->nom_tipo; ?> - <?php echo $seekfind->nom_elemento; ?></h5>
                            <h6 class="card-subtitle mb-2 text-muted">Lugar: <?php echo $seekfind->nom_munic; ?> - <?php echo $seekfind->nom_sitio; ?></h6>
                            <p class="card-text"><?php echo $seekfind->desc_sitio; ?></p>
                            <a href="form_seekfind.php" class="btn btn-primary">He encontrado algo similar</a>
                        </div>
                    </div>
                </div>
            <?php
			} 
            ?>
            <!-- Resto de las publicaciones -->
        </div>
    </div>
    <?php 
    include_once "footer.php";
?>
</body>
</html>